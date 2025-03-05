<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Exibir a lista de usuários na página Manage Members
    public function index()
    {
        $users = User::all(); // Buscar todos os usuários
        return view('manage-members', compact('users'));
    }

    // Excluir um usuário
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuário deletado com sucesso!');
    }

    // Alterar a categoria do usuário (User -> Admin)
    public function changeRole($id)
    {
        $user = User::findOrFail($id);
        $user->role = 'admin'; // Atualiza o tipo de usuário
        $user->save();

        return redirect()->route('users.index')->with('success', 'Permissão alterada para Admin!');
    }
}
