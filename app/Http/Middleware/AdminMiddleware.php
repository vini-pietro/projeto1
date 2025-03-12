<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Manipula a solicitação para garantir que apenas administradores acessem certas rotas.
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica se o usuário está autenticado
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Você precisa estar logado para acessar esta página.');
        }

        // Verifica se o usuário tem a função 'admin'
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }

        return $next($request);
    }
}
