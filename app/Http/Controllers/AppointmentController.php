<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;

class AppointmentController extends Controller
{
    //Lista agendamentos e gerencia a grade de horários/preferências do usuário
    public function index(Request $request) 
    {
        $user = auth()->user();

        //Define horários de início/fim baseados no request ou preferência do banco
        $prefStart = (int) $request->get('start_time', $user->start_time ?? 8);
        $prefEnd = (int) $request->get('end_time', $user->end_time ?? 18);

        //Atualiza preferências de exibição do usuário se solicitado
        if ($request->has('save_preference')) {
            $user->update(['start_time' => $prefStart, 'end_time' => $prefEnd]);
        }

        //Calcula o offset da semana e define a segunda-feira correspondente
        $weekOffset = max(0, (int) $request->get('week', 0));
        $inicioDaSemana = now()->addWeeks($weekOffset)->startOfWeek(\Carbon\Carbon::MONDAY);

        //Monta array com os 7 dias da semana para o cabeçalho da view
        $dias = [];
        for ($i = 0; $i < 7; $i++) {
            $data = $inicioDaSemana->copy()->addDays($i);
            $dias[] = [
                'label'      => $data->translatedFormat('D'), 
                'dia_mes'    => $data->format('d/m'),
                'data_banco' => $data->format('Y-m-d'),
            ];
        }

        //Gera lista de horários (horas cheias) para a lateral da grade
        $horarios = [];
        for ($h = $prefStart; $h <= $prefEnd; $h++) {
            $horarios[] = sprintf('%02d:00', $h);
        }

        //Recupera agendamentos vinculados ao usuário autenticado
        $appointments = $user->appointments()->get();

        return view('appointments.index', compact(
            'appointments', 'weekOffset', 'prefStart', 'prefEnd', 'dias', 'horarios'
        ));
    }

    //Exibe detalhes de um agendamento específico
    public function show(string $id)
    {
        if (!$appointment = Appointment::find($id)) {
            return redirect()->route('appointments.index')->with('message', 'Agendamento não encontrado!');
        }

        return view('appointments.show', compact('appointment'));
    }

    //Exibe formulário de criação
    public function create()
    {
        return view('appointments.create');
    }

    //Salva novo agendamento processando strings de data e hora
    public function store(StoreAppointmentRequest $request)
    {
        $validated = $request->validated();

        // Concatena data e hora para o formato datetime do banco
        $startStr = $validated['date'] . ' ' . $validated['start'] . ':00';
        $endStr   = $validated['date'] . ' ' . $validated['end'] . ':00';

        auth()->user()->appointments()->create([
            'client' => $validated['client'],
            'date'   => $validated['date'],
            'service' => $validated['service'],
            'start'  => $startStr,
            'end'    => $endStr,
            'color'  => $validated['color'] ?? '#000000',
        ]);

        return redirect()->route('appointments.index')
            ->with('success', 'Agendamento criado com sucesso!');
    }

    //Exibe formulário de edição
    public function edit(string $id)
    {
        if (!$appointment = Appointment::find($id)) {
            return redirect()->route('appointments.index')->with('message', 'Agendamento não encontrado!');
        } 
        return view('appointments.edit', compact('appointment'));
    }

    //Atualiza agendamento mantendo horários originais se os campos estiverem vazios
    public function update(UpdateAppointmentRequest $request, string $id)
    {
        $appointment = Appointment::findOrFail($id);
        $validated = $request->validated();

        //Se 'start' ou 'end' não forem enviados, preserva o valor atual do banco
        $startStr = $request->filled('start') 
            ? $validated['date'] . ' ' . $validated['start'] . ':00' 
            : $appointment->start;

        $endStr = $request->filled('end') 
            ? $validated['date'] . ' ' . $validated['end'] . ':00' 
            : $appointment->end;

        $appointment->update([
            'client' => $validated['client'],
            'date'   => $validated['date'],
            'service' => $validated['service'],
            'start'  => $startStr,
            'end'    => $endStr,
            'color'  => $validated['color'] ?? $appointment->color,
        ]);

        return redirect()->route('appointments.index')
            ->with('success', 'Agendamento atualizado com sucesso!');
    }

    //Exibe tela de confirmação de exclusão
    public function delete(string $id) {
        if (!$appointment = Appointment::find($id)) {
            return redirect()->route('appointments.index')->with('message', 'Agendamento não encontrado!');
        }
        return view('appointments.delete', compact('appointment'));
    }

    //Remove o registro do banco de dados
    public function destroy(string $id) {
        if (!$appointment = Appointment::find($id)) {
            return redirect()->route('appointments.index')->with('message', 'Agendamento não encontrado!');
        }
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Agendamento deletado com sucesso!');
    }

    //Altera status para 1 (Finalizado)
    public function finish(string $id) 
    {
        if (!$appointment = Appointment::find($id)) {
            return redirect()->route('appointments.index')->with('message', 'Agendamento não encontrado!');
        }

        $appointment->update(['status' => 1]);

        return redirect()->route('appointments.show', $appointment->id)->with('success', 'Agendamento finalizado com sucesso!');
    }

    //Altera status para -1 (Cancelado)
    public function cancel(string $id) 
    {
        if (!$appointment = Appointment::find($id)) {
            return redirect()->route('appointments.index')->with('message', 'Agendamento não encontrado!');
        }

        $appointment->update(['status' => -1]);

        return redirect()->route('appointments.show', $appointment->id)->with('success', 'Agendamento cancelado com sucesso!');
    }
}