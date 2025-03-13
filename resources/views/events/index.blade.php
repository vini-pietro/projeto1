@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Available Events</h2>

    @if(auth()->check() && auth()->user()->user_type === 'admin')
        <a href="{{ route('events.create') }}" class="btn btn-primary mb-3">Create New Event</a>
    @endif

    <div class="row">
        @foreach($events as $event)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('images/' . $event->image) }}" class="card-img-top" alt="{{ $event->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <!-- Exibição da descrição breve no card -->
                        <p class="card-text">{{ Str::limit($event->description, 100, '...') }}</p>
                        <p><strong>Location:</strong> {{ $event->location }}</p>
                        <p><strong>Date:</strong> {{ $event->event_date }}</p>
                        <p><strong>Participants:</strong> {{ $event->users->count() }}</p>

                        <!-- Botão para ver mais detalhes -->
                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">View Details</a>

                        @auth
                            <form action="{{ route('events.join', $event->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    {{ auth()->user()->events->contains($event->id) ? 'Leave Event' : 'Join Event' }}
                                </button>
                            </form>
                        @endauth

                        @if(auth()->check() && auth()->user()->user_type === 'admin')
                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning">Edit</a>

                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this event?')">
                                    Delete
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
