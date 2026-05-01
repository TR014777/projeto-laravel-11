<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use App\Listeners\UpdateStatusOnLogin;
use App\Listeners\UpdateStatusOnLogout;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(Login::class, UpdateStatusOnLogin::class);
        Event::listen(Logout::class, UpdateStatusOnLogout::class);
        \Carbon\Carbon::setLocale('pt_BR');
    }
}
