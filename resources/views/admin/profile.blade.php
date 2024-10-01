@extends('layouts.admin') <!-- Change 'layouts.app' to your layout's filename -->

@section('title', 'User Profile')

@section('content')
<div class="container pt-3">
    <div class="card">
        <div class="card-header bg-gradient-info text-white">
            <h2>Admin's Profile</h2>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <!-- Add more user details here -->
        </div>
    </div>
</div>
@endsection