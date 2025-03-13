@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="col-md-6">
        <h2 class="text-center mb-4">Create New Event</h2>
        <div class="card shadow-sm p-4">
            <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label for="title" class="form-label">Event Name</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="location" name="location" required>
                </div>

                <div class="mb-3">
                    <label for="event_date" class="form-label">Date and Time</label>
                    <input type="datetime-local" class="form-control" id="event_date" name="event_date" required>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Event Image</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Details</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success w-100">Create Event</button>
                </div>
            </form>
        </div>
    </div>
</div><br>
@endsection
