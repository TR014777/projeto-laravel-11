<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


//-----------------------------------------------------------------------------Rotas Admin
Route::middleware('admin')->prefix('admin')->group(function() {
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::delete('users/{user}', [UserController::class,'destroy'])->name('users.destroy');
    Route::get('users/{user}/delete', [UserController::class,'delete'])->name('users.delete');
    Route::put('users/{user}', [UserController::class,'update'])->name('users.update');
    Route::get('users/{user}/edit', [UserController::class,'edit'])->name('users.edit');
    Route::get('users/{user}', [UserController::class,'show'])->name('users.show');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get ('users', [UserController::class, 'index'])->name('users.index');
});
//-----------------------------------------------------------------------------Rotas Admin

//-----------------------------------------------------------------------------Pagina Inicial
Route::get('/', function () {
    return view('welcome');
});
//-----------------------------------------------------------------------------Pagina Inicial


//-----------------------------------------------------------------------------Dashboard ( Início )
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
//-----------------------------------------------------------------------------Dashboard ( Início )

//-----------------------------------------------------------------------------Rotas normais de usuário
Route::middleware('auth')->group(function () {
    Route::post('appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::patch('/appointments/{id}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
    Route::patch('/appointments/{id}/finish', [AppointmentController::class, 'finish'])->name('appointments.finish');
    Route::delete('appointments/{appointment}', [AppointmentController::class,'destroy'])->name('appointments.destroy');
    Route::get('appointments/{appointment}/delete', [AppointmentController::class,'delete'])->name('appointments.delete');
    Route::put('appointments/{appointment}', [AppointmentController::class,'update'])->name('appointments.update');
    Route::get('appointments/{appointment}/edit', [AppointmentController::class,'edit'])->name('appointments.edit');    
    Route::get('appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
    Route::get('appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//-----------------------------------------------------------------------------Rotas normais de usuário

require __DIR__.'/auth.php';
