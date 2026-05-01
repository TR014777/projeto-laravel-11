<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;

class UserController extends Controller
{
    //Lista usuários com filtros opcionais de ID, busca textual (nome/email) e status
    public function index(Request $request)
    {
        $users = User::query()
            //Filtra por ID específico se fornecido
            ->when($request->user_id, function ($query, $id) {
                $query->where('id', $id);
            })
            //Filtra por termo de busca no nome ou email
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
                });
            })
            //Filtra por status se o campo estiver preenchido
            ->when($request->filled('status'), function ($query) {
                $query->where('status', request('status'));
            })
            //Pagina resultados e mantém os parâmetros de filtro na URL
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    //Exibe formulário de criação de novo usuário
    public function create()
    {
        return view('admin.users.create');
    }

    //Armazena novo usuário capturando IP e geolocalização aproximada
    public function store(StoreUserRequest $request) 
    {
        $data = $request->validated();

        //Captura o IP do cliente e tenta obter localização (Cidade/País)
        $ip = request()->ip();
        $data['created_ip'] = $ip;
        $position = Location::get($ip);
        
        $data['country_name'] = $position ? $position->countryName : 'Localhost';
        $data['city_name']    = $position ? $position->cityName : 'Localhost';
        
        // Define status padrão como inativo/pendente (0)
        $data['status'] = 0;

        User::create($data);

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
    }

    //Exibe formulário de edição de um usuário específico
    public function edit(string $id)
    {
        if (!$user = User::find($id)) {
            return redirect()->route('users.index')->with('message', 'Usuário não encontrado!');
        } 
        return view('admin.users.edit', compact('user'));
    }

    //Exibe os detalhes de um usuário
    public function show(string $id)
    {
        if (!$user = User::find($id)) {
            return redirect()->route('users.index')->with('message', 'Usuário não encontrado!');
        } 
        
        return view('admin.users.show', compact('user'));
    }

    //Atualiza dados básicos e criptografa a senha se for alterada
    public function update(UpdateUserRequest $request, string $id)
    {
        if (!$user = User::find($id)) {
            return redirect()->route('users.index')->with('message', 'Usuário não encontrado!');
        }
        
        $data = $request->only('name', 'email', 'phone', 'birth_date');
        
        // Se houver nova senha no request, realiza o hash
        if ($request->password) {
            $data["password"] = bcrypt($request->password);
        }
        
        $user->update($data);
        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    //Exibe tela de confirmação de exclusão com trava de segurança para o próprio perfil
    public function delete(string $id) {
        if (!$user = User::find($id)) {
            return redirect()->route('users.index')->with('message', 'Usuário não encontrado!');
        }
        
        // Impede que o administrador delete a si mesmo
        if (Auth::user()->id === $user->id) {
            return back()->with('message', 'Você não pode deletar o seu perfil!');
        }
        
        return view('admin.users.delete', compact('user'));
    }

    //Remove o usuário do banco de dados definitivamente
    public function destroy(string $id) {
        if (!$user = User::find($id)) {
            return redirect()->route('users.index')->with('message', 'Usuário não encontrado!');
        }
        
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuário deletado com sucesso!');
    }
}