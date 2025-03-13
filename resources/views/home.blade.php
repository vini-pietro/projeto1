@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <h1 class="mb-4">Welcome to Career Training College Events</h1>
    <p class="lead">Empowering students through technology-driven events and hands-on experiences.</p>

    <div class="row mt-3">
        
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Upcoming Events</h5>
                    <p class="card-text">Stay updated with the latest events and activities at Career Training College.</p>
                    <a href="{{ route('events.index') }}" class="btn btn-success">View Events</a>
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
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">About Us</h5>
                    <p class="card-text">Learn a little about our history and how we got here.</p><br>
                    <a href="/about-us" class="btn btn-success">Meet us</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Our Courses -->
<div class="row mt-5">
    <h2 class="mb-4">Our Courses</h2>
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Full Stack Development</h5>
                <p class="card-text">Master modern web development, including HTML, CSS, JavaScript, PHP, and databases.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Cloud Computing & DevOps</h5>
                <p class="card-text">Learn AWS, Azure, Docker, and Kubernetes to prepare for top industry certifications.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Cybersecurity</h5>
                <p class="card-text">Protect systems and networks with advanced security practices.</p>
            </div>
        </div>
    </div>
</div>

<!-- Events & Workshops -->
<div class="row mt-5">
    <h2 class="mb-4">Events & Workshops</h2>
    <p>Join exclusive events, including tech talks, hackathons, and hands-on simulations.</p>
    <a href="{{ route('events.index') }}" class="btn btn-success mt-3">View Events</a>
</div>

<!-- Training Benefits -->
<div class="row mt-5">
    <h2 class="mb-4">Why Choose Career Training College?</h2>
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Recognized Certifications</h5>
                <p class="card-text">All courses include certifications that are widely accepted in the IT industry.</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Expert Instructors</h5>
                <p class="card-text">Learn from industry professionals with real-world experience.</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Access to Professional Tools</h5>
                <p class="card-text">Use the same technologies as leading tech companies.</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Industry Connections</h5>
                <p class="card-text">Partnered with companies to provide internship and job opportunities.</p>
            </div>
        </div>
    </div>
</div>

<!-- Student Testimonials -->
<div class="row mt-5">
    <h2 class="mb-4 text-center">What Our Students Say</h2>
    
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Ana Souza - Brazil</h5>
                    <p><strong>Course:</strong> Cloud Computing</p>
                    <p class="card-text">"Thanks to Career Training College, I earned my AWS certification and was hired by a multinational company!"</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Lucas Oliveira - Portugal</h5>
                    <p><strong>Course:</strong> Cybersecurity</p>
                    <p class="card-text">"I learned more about cybersecurity in three months than I did in years of self-study!"</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Emily Tan - Singapore</h5>
                    <p><strong>Course:</strong> Full Stack Development</p>
                    <p class="card-text">"This course helped me land a job as a junior developer in a top tech firm!"</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Ahmed Khan - Pakistan</h5>
                    <p><strong>Course:</strong> DevOps</p>
                    <p class="card-text">"Learning Docker and Kubernetes here was the best decision for my career growth!"</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Sophia Lee - South Korea</h5>
                    <p><strong>Course:</strong> Software Testing</p>
                    <p class="card-text">"I now work as a QA engineer, all thanks to the structured training at Career Training College!"</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Carlos Mendoza - Mexico</h5>
                    <p><strong>Course:</strong> IT Support & Networking</p>
                    <p class="card-text">"This program helped me gain hands-on experience and secure my first job in IT support!"</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="mt-5">
    <h3>Ready to take your career to the next level?</h3>
    <p>Sign up today and gain access to the best IT training programs.</p>
    <a href="{{ route('contact-us') }}" class="btn btn-primary">Get in Touch</a>
</div><br>

</div>

@endsection
