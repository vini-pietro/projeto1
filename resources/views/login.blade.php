@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card p-4 shadow-lg" style="width: 350px;">
        <h2 class="text-center mb-4">Login</h2>
        <form>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" placeholder="Enter your username">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Enter your password">
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>
@endsection
