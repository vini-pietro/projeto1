@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manage Members</h2>
        <a href="{{ route('users.create') }}" class="btn btn-primary">New Member</a>
    </div>
    
    <table class="table table-striped">
        <thead>
            <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th>
            <th>User Type</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Professional Summary</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->age }}</td>
                <td>{{ $user->user_type }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->professional_summary }}</td>
                <td>
                        <!-- Botão de editar usuário -->
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a>
                        

                        <!-- Botão de excluir usuário -->
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        
                        <!-- Botão de alterar categoria -->
                        <form action="{{ route('users.changeRole', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-warning btn-sm">
                                {{ $user->role === 'user' ? 'Change to Admin' : 'Change to User' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
