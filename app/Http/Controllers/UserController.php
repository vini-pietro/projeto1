<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
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

    // Alterar a categoria do usuário (User <-> Admin)
    public function changeRole($id)
    {
        $user = User::findOrFail($id);
        
        // Alternar entre 'user' e 'admin'
        $user->role = $user->role === 'user' ? 'admin' : 'user';
        $user->save();

        return redirect()->route('users.index')->with('success', 'Permissão alterada com sucesso!');
    }
    public function create()
{
    return view('users.create'); // Carrega a view para adicionar um novo usuário
}
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'role' => 'required|in:user,admin',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
    ]);

    return redirect()->route('users.index')->with('success', 'Novo usuário criado com sucesso!');
}
}
