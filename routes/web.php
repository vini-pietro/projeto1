<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;

// Página inicial
Route::get('/', function () {
    return view('home');
})->name('home');

// Rotas públicas
Route::view('/login', 'login')->name('login');
Route::view('/about-us', 'about')->name('about-us');
Route::view('/contact-us', 'contact')->name('contact-us');

// Autenticação
Auth::routes();

// Redirecionamento após login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); // Verifique se existe 'resources/views/dashboard.blade.php'
    })->name('dashboard');
});

// Rotas para usuários autenticados
Route::middleware(['auth'])->group(function () {
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
});

// 🔹🔹🔹 ROTAS DE ADMINISTRADOR 🔹🔹🔹
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    // Gerenciamento de usuários
    Route::get('/manage-members', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create'); 
    Route::post('/users', [UserController::class, 'store'])->name('users.store'); 
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::put('/users/{id}/change-role', [UserController::class, 'changeRole'])->name('users.changeRole');

    // Gerenciamento de eventos
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');
});

// Rotas de Login e Logout
Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');
