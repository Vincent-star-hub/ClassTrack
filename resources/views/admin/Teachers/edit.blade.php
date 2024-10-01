@extends('layouts.admin')

@section('title', 'Edit Teacher')

@section('content')
<h1>Edit Teacher</h1>

<form action="{{ route('admin.teachers.update', $user->id) }}" method="POST">
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
    <div class="form-group">
        <label for="class_id">Assign to Class:</label>
        <select name="class_id" id="class_id" class="form-control" required>
            <option value="">Select a Class</option>
            @foreach ($classes as $class)
            <option value="{{ $class->id }}" {{ $user->class_id == $class->id ? 'selected' : '' }}>
                {{ $class->name }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="section_id">Assign to Section:</label>
        <select name="section_id" id="section_id" class="form-control" required>
            <option value="">Select a Section</option>
            @foreach ($sections as $section)
            <option value="{{ $section->id }}" {{ $user->section_id == $section->id ? 'selected' : '' }}>
                {{ $section->name }}
            </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Update</button>
    <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary mt-3">Back to Teachers</a>
</form>
@endsection