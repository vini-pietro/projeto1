@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <h1 class="mb-4">Welcome to Career Training College Events</h1>
    <p class="lead">Empowering students through technology-driven events and hands-on experiences.</p>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Active Members</h5>
                    <p class="card-text">View and manage the list of active participants for all events.</p>
                    <a href="/view-members" class="btn btn-success">View Members</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Upcoming Events</h5>
                    <p class="card-text">Stay updated with the latest events and activities at Career Training College.</p>
                    <a href="/event" class="btn btn-success">View Events</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Manage Members</h5>
                    <p class="card-text">Add, edit, and manage member details seamlessly through our system.</p>
                    <a href="/manage-members" class="btn btn-success">Manage Members</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
