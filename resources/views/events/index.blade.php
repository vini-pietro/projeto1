@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Upcoming Events</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(auth()->user() && auth()->user()->role === 'admin')
    <div class="mb-3 text-end">
        <a href="{{ route('events.create') }}" class="btn btn-success">+ Create Event</a>
    </div>
@endif

    @if($events->isEmpty())
        <p class="text-center">No events available.</p>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($events as $event)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <p class="card-text flex-grow-1">{{ $event->description }}</p>
                            <p class="text-muted"><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y H:i') }}</p>
                            <p class="text-muted"><strong>Location:</strong> {{ $event->location }}</p>

                            <!-- Opções baseadas no tipo de usuário -->
                            @if(auth()->check() && auth()->user()->role === 'admin')
                                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            @else
                                <a href="{{ route('events.show', $event->id) }}" class="btn btn-success btn-sm mt-auto">More Info</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
<br><br>
@endsection
