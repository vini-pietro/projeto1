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
        $user->role = $user->role === 'user' ? 'admin' : 'user';
        $user->save();

        return redirect()->route('users.index')->with('success', 'Permissão alterada com sucesso!');
    }

    // Exibir o formulário para criação de um novo usuário
    public function create()
    {
        return view('users.create');
    }

    // Armazena um novo usuário no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'user_type' => 'required|in:admin,user',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'professional_summary' => 'nullable|string',
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'age' => $request->age,
            'user_type' => $request->user_type,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'professional_summary' => $request->professional_summary,
        ]);

        return redirect()->route('users.index')->with('success', 'Novo usuário criado com sucesso!');
    }

    // Exibir o formulário de edição de um usuário
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Atualizar um usuário existente
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'user_type' => 'required|in:admin,user',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'professional_summary' => 'nullable|string',
        ]);

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'age' => $request->age,
            'user_type' => $request->user_type,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'professional_summary' => $request->professional_summary,
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }
}
