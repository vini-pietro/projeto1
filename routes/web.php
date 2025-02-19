<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/about-us', function () {
    return view('about');
});

Route::get('/contact-us', function () {
    return view('contact');
});

Route::get('/event', function () {
    return view('event');
});

Route::get('/view-members', function () {
    return view('view-members');
});

Route::get('/manage-members', function () {
    return view('manage-members');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\EventController;
Route::get('/events', [EventController::class, 'index'])->name('events.index');

// Rotas para eventos (apenas usuários autenticados)
Route::middleware(['auth'])->group(function () {
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
});

// Rotas para administradores (CRUD de eventos)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');
});
