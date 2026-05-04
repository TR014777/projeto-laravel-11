<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $agora = now(); 

        //Query para usuário 
        $queryLocal = $user->appointments();
        
        //Query para admin
        $queryGlobal = Appointment::query();

        //Processamento local
        $totalMesLocal = (clone $queryLocal)->whereMonth('date', $agora->month)->count();
        $demandaSemanalLocal = $this->getDemandaSemanal($queryLocal, $totalMesLocal);
        $picoHorarioLocal = $this->getPicoHorario($queryLocal);

        //Estatísticas e listas
        $statsAppo = [
            'total'      => (clone $queryLocal)->count(),
            'concluidos' => (clone $queryLocal)->where('status', 1)->count(),
            'cancelados' => (clone $queryLocal)->where('status', -1)->count(),
            'hoje'       => (clone $queryLocal)->whereDate('date', $agora->toDateString())->count(),
            
            'hojeLista'  => (clone $queryLocal)
                ->where('status', 0)
                ->whereDate('date', $agora->toDateString())
                ->whereTime('start', '>=', $agora->toTimeString())
                ->orderBy('start', 'asc')
                ->take(4) 
                ->get(),

            'historicoPaginado' => (clone $queryLocal)
                ->where('date', '>=', $agora->copy()->subDays(7))
                ->orderBy('date', 'desc')
                ->paginate(5),

            'proximoAtendimento' => (clone $queryLocal)
                ->where('status', 0)
                ->whereDate('date', $agora->toDateString())
                ->whereTime('start', '>=', $agora->toTimeString())
                ->orderBy('start', 'asc')
                ->first(),

            //Dados local para os Gráficos
            'demandaSemanal' => $demandaSemanalLocal,
            'picoHorario'    => $picoHorarioLocal,
        ];

        //Estatísticas globais (apenas admin)
        $statsGlobal = [];
        if ($user->is_admin) {
            $totalMesGlobal = (clone $queryGlobal)->whereMonth('date', $agora->month)->count();
            $statsGlobal = [
                'demandaSemanal' => $this->getDemandaSemanal($queryGlobal, $totalMesGlobal),
                'picoHorario'    => $this->getPicoHorario($queryGlobal),
            ];
        }

        //Estatísticas de usuários
        $adminData = $this->getAdminStats($user);

        return view('index', array_merge(
            [
                'statsAppo'   => $statsAppo,
                'statsGlobal' => $statsGlobal,
            ],
            $adminData
        ));
    }

    private function getDemandaSemanal($query, $totalMes)
    {
        $diasNome = [2 => 'Seg', 3 => 'Ter', 4 => 'Qua', 5 => 'Qui', 6 => 'Sex', 7 => 'Sáb', 1 => 'Dom'];
        
        $dados = (clone $query)
            ->whereMonth('date', now()->month)
            ->selectRaw('DAYOFWEEK(date) as dia_semana, COUNT(*) as total')
            ->groupBy('dia_semana')
            ->get()
            ->keyBy('dia_semana');

        return collect($diasNome)->map(function ($nome, $numero) use ($dados, $totalMes) {
            $totalDia = $dados->get($numero)->total ?? 0;
            return [
                'dia' => $nome,
                'porcentagem' => $totalMes > 0 ? round(($totalDia / $totalMes) * 100, 1) : 0
            ];
        })->values()->all();
    }

    private function getPicoHorario($query)
    {
        $dados = (clone $query)
            ->whereMonth('date', now()->month)
            ->selectRaw('FLOOR(HOUR(start) / 2) * 2 as hora_inicio, COUNT(*) as total')
            ->groupBy('hora_inicio')
            ->orderBy('hora_inicio')
            ->get();

        return [
            'labels' => $dados->map(fn($d) => sprintf('%02dh-%02dh', $d->hora_inicio, $d->hora_inicio + 2)),
            'data'   => $dados->pluck('total')
        ];
    }

    private function getAdminStats($user)
    {
        if (!$user->is_admin) {
            return ['statsUsers' => [], 'allUsers' => []];
        }

        return [
            'statsUsers' => [
                'total'    => User::count(),
                'ativos'   => User::where('status', 1)->count(),
                'recentes' => User::where('created_at', '>=', now()->subDays(7))->count(),
            ],
            'allUsers' => User::orderBy('created_at', 'desc')->take(5)->get()
        ];
    }
}