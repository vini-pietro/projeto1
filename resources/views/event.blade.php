@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Events</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($events as $event)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-text">{{ $event->description }}</p>
                        <p><strong>Date:</strong> {{ $event->date }}</p>

                        <!-- 🔹 O BOTÃO DE VIEW EVENT APARECE PARA TODOS OS USUÁRIOS -->
                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary btn-sm">View Event</a>

                        @if(Auth::check() && Auth::user()->role === 'admin')
                            <!-- 🔹 ADMINISTRADORES TAMBÉM VEEM OS BOTÕES DE EDITAR E DELETAR -->
                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
