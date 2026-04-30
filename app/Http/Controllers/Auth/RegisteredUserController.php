<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Stevebauman\Location\Facades\Location;

class RegisteredUserController extends Controller
{     /**
     * Display the registration view.
     */
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $ip = request()->ip();
        $position = Location::get($ip);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'birth_date'=> $request->birth_date,
            'password' => Hash::make($request->password),
            'created_ip' => $ip,
            'country_name' => $position ? $position->countryName : 'Localhost',
            'city_name' => $position ? $position->cityName : 'Localhost',
            'status' => 0,
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect()->intended(route('dashboard', absolute: false));
    }
}