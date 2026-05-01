<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateStatusOnLogin
{
    public function __construct()
    {
        //
    }

    //Atualiza status do usuário para ativo
    public function handle(Login $event): void
    {
        $event->user->update([
            'status' => 1,
            'last_login_at' => now(),
            'last_login_ip' => request()->ip(),
        ]);
    }
}