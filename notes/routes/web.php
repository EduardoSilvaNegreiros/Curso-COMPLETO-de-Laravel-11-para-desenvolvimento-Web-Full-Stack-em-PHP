<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

// Rotas para usuários não autenticados (middleware impede acesso se já estiver logado)
Route::middleware([CheckIsNotLogged::class])->group(function () {
    Route::get('/login', [AuthController::class, 'login']); // Página de login
    Route::post('loginSubmit', [AuthController::class, 'loginSubmit']); // Submissão do formulário de login
});

// Rotas para usuários autenticados (middleware impede acesso se não estiver logado)
Route::middleware([CheckIsLogged::class])->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('home'); // Página inicial do usuário logado
    Route::get('/newNote', [MainController::class, 'newNote'])->name('new'); // Página para criar uma nova anotação

    //edit note
    Route::get('/editNote/{id}', [MainController::class, 'editNote'])->name('edit');
    //delete note
    Route::get('/deleteNote/{id}', [MainController::class, 'deleteNote'])->name('delete');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout'); // Logout do usuário
});
