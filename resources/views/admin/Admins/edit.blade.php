@extends('layouts.admin')

@section('title', 'Edit Admin')

@section('content')
<h1>Edit Admin</h1>

{{-- Success Messages --}}
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

{{-- Error Messages --}}
@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
    {{ $error }}
    @endforeach
</div>
@endif

<form action="{{ route('admin.admins.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
    </div>
    <div class="form-group">
        <label for="password">Password (leave blank to keep current password):</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>
    <div class="form-group">
        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary mt-3">Update</button>
    <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary mt-3">Back to Admin</a>
</form>
@endsection