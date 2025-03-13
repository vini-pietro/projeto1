@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">My Events</h2>

    @if($events->isEmpty())
        <div class="text-center mt-4">
            <h4>No upcoming events yet.</h4>
            <p class="text-muted">
                You haven't joined any events yet. Stay tuned for upcoming activities and networking opportunities!
            </p>
            <a href="{{ route('events.index') }}" class="btn btn-success">Explore Events</a>
        </div>
    @else
        <p class="text-muted">Here are the events you have joined. Stay engaged and make the most of these opportunities!</p>

        <div class="row">
            @foreach($events as $event)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ asset('images/' . $event->image) }}" class="card-img-top" alt="{{ $event->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <p class="card-text">{{ $event->description }}</p>
                            <p><strong>Location:</strong> {{ $event->location }}</p>
                            <p><strong>Date:</strong> {{ $event->event_date }}</p>
                            <p><strong>Participants:</strong> {{ $event->users->count() }}</p>

                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">View Details</a>

                            <form action="{{ route('events.join', $event->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger">Leave Event</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
