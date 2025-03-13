@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">{{ $event->title }}</h2>

    <div class="card">
        <img src="{{ asset('images/' . $event->image) }}" class="card-img-top" alt="{{ $event->title }}">
        <div class="card-body">
            <h5 class="card-title">{{ $event->title }}</h5>
            <p class="card-text">{{ $event->description }}</p>
            <p><strong>Location:</strong> {{ $event->location }}</p>
            <p><strong>Date:</strong> {{ $event->event_date }}</p>
            <p><strong>Participants:</strong> {{ $event->users->count() }}</p>

            @if(auth()->check() && auth()->user()->user_type === 'admin')
                <h4 class="mt-4">Participants List</h4>
                <ul class="list-group">
                    @foreach($event->users as $user)
                        <li class="list-group-item">{{ $user->first_name }} {{ $user->last_name }} - {{ $user->email }}</li>
                    @endforeach
                </ul>
            @endif

            <a href="{{ route('events.index') }}" class="btn btn-secondary mt-3">Back to Events</a>
        </div>
    </div>
</div>
@endsection
