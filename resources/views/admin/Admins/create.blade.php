@extends('layouts.admin')

@section('title', 'Create New Admin')

@section('content')
    <h1>Create New Admin</h1>
    
    <form action="{{ route('admin.admins.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="role">Role:</label>
            <select name="role" id="role" class="form-control" required>
                <option value="admin">Admin</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary mt-3">Create Admin</button>
    </form>

    <a href="{{ route('admin.manage_admins') }}" class="btn btn-secondary mt-3">Back to Admins</a>
@endsection
