<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get("/appointments", function () {
    return 'oi';//view("appointments");
});

Route::middleware('admin')->prefix('admin')->group(function() {
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::delete('users/{user}', [UserController::class,'destroy'])->name('users.destroy');
    Route::get('users/{user}/delete', [UserController::class,'delete'])->name('users.delete');
    Route::put('users/{user}', [UserController::class,'update'])->name('users.update');
    Route::get('users/{user}/edit', [UserController::class,'edit'])->name('users.edit');
    Route::get('users/{user}', [UserController::class,'show'])->name('users.show');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get ("users", [UserController::class, 'index'])->name('users.index');
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
