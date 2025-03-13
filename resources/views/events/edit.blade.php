@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Event</h1>

    <form action="{{ route('events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" value="{{ $event->title }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="4" required>{{ $event->description }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Date & Time</label>
            <input type="datetime-local" class="form-control" name="event_date" value="{{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d\TH:i') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" class="form-control" name="location" value="{{ $event->location }}" required>
        </div>
        <div>
            <label for="image">Alterar Imagem</label>
        <input type="file" class="form-control" name="image">
</div><br>
        <button type="submit" class="btn btn-warning w-100">Update Event</button>
    </form>
</div><br>
@endsection
