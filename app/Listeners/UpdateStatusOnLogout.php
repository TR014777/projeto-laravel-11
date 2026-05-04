<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateStatusOnLogout
{
    public function __construct()
    {
        //
    }

    //Atualiza status do usuário para inativo
    public function handle(Logout $event): void
    {
        if ($event->user) {
            $event->user->update([
                'status' => 0
            ]);
        }
    }
}