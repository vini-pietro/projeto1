<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #556B2F;">
    <div class="container-fluid">
        <a class="navbar-brand" href="/home">
            <img src="{{ asset('images/logo.png') }}" alt="Career Training College" height="50">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link text-white" href="/home">Home</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="/login">Login</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="/about-us">About Us</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="/contact-us">Contact Us</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="/event">Event</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    @yield('content')
</div>

<footer class="text-center text-white py-2">
    © 2025 Career Training College. All rights reserved.
</footer>

</body>
</html>
