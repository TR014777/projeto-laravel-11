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
    public function index()
    {
        $users = User::paginate(10); //User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request) 
    {
        $data = $request->validated();

        $ip = request()->ip();
        $data['created_ip'] = $ip;

        $position = Location::get($ip);
        
        $data['country_name'] = $position ? $position->countryName : 'Localhost';
        $data['city_name']    = $position ? $position->cityName : 'Localhost';
        
        $data['status'] = 0;

        User::create($data);

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
    }

    public function edit(string $id)
    {
        if (!$user = User::find($id)) {
            return redirect()->route('users.index')->with('message', 'Usuário não encontrado!');
        } 
        return view('admin.users.edit', compact('user'));
        
    }

    public function show(string $id)
    {
        if (!$user = User::find($id)) {
            return redirect()->route('users.index')->with('message', 'Usuário não encontrado!');
        } 
        
        return view('admin.users.show', compact('user'));
    }

    public function update(UpdateUserRequest $request, string $id)
    {
        if (!$user = User::find($id)) {
            return redirect()->route('users.index')->with('message', 'Usuário não encontrado!');
        }
        $data = $request->only('name', 'email', 'phone', 'birth_date');
        if ($request->password) {
            $data["password"] = bcrypt($request->password);
        }
        $user->update($data);
        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function delete(string $id) {
        if (!$user = User::find($id)) {
            return redirect()->route('users.index')->with('message', 'Usuário não encontrado!');
        }
        if (Auth::user()->id === $user->id) {
            return back()->with('users.index')->with('message', 'Você não pode deletar o seu perfil!');
        }
        return view('admin.users.delete', compact('user'));
    }

    public function destroy(string $id) {
        if (!$user = User::find($id)) {
            return redirect()->route('users.index')->with('message', 'Usuário não encontrado!');
        }
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuário deletado com sucesso!');
    }
}
