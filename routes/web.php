<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

// Página inicial
Route::get('/', function () {
    return view('home');
})->name('home');

// Rotas públicas (acessíveis a todos)
Route::view('/login', 'login')->name('login');
Route::view('/about-us', 'about')->name('about-us');
Route::view('/contact-us', 'contact')->name('contact-us');

// Autenticação
Auth::routes();

// Página inicial após login (dashboard)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});

// Rotas para membros (apenas usuários autenticados)
Route::middleware(['auth'])->group(function () {
    Route::view('/view-members', 'view-members')->name('view-members');
    Route::get('/manage-members', [UserController::class, 'index'])->name('users.index');
});

// Rotas para eventos (usuários autenticados)
Route::middleware(['auth'])->group(function () {
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
});

// 🔹🔹🔹 GRUPO DE ROTAS PARA ADMINISTRADORES 🔹🔹🔹
Route::middleware(['auth', 'admin'])->group(function () {
    // Gerenciamento de usuários
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create'); // Exibe o formulário
    Route::post('/users', [UserController::class, 'store'])->name('users.store'); // Processa a criação
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::put('/users/{id}/change-role', [UserController::class, 'changeRole'])->name('users.changeRole');

    // Gerenciamento de eventos
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');
});

// Rota de logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // Redireciona para Home após logout
})->name('logout');
