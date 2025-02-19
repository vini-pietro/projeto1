@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Create New Event</h1>

    <form action="{{ route('events.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Date & Time</label>
            <input type="datetime-local" class="form-control" name="event_date" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" class="form-control" name="location" required>
        </div>
        <button type="submit" class="btn btn-success w-100">Create Event</button>
    </form>
</div>
@endsection
