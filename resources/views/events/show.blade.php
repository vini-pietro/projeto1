@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">{{ $event->title }}</h1>
    <p><strong>Description:</strong> {{ $event->description }}</p>
    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y H:i') }}</p>
    <p><strong>Location:</strong> {{ $event->location }}</p>
    
    <a href="{{ route('events.index') }}" class="btn btn-primary">Back to Events</a>
</div>
@endsection
