<!-- resources/views/students/create.blade.php -->
@extends('layouts.teacher')

@section('content')
<div class="container">
    <h1>Add Student</h1>
    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="other_name">Other Name:</label>
            <input type="text" name="other_name" class="form-control">
        </div>
        <div class="form-group">
            <label for="lrn">LRN:</label>
            <input type="text" name="lrn" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="class_id">Class:</label>
            <select name="class_id" class="form-control">
                @foreach($classes as $class)
                <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="section_id">Section:</label>
            <select name="section_id" class="form-control">
                @foreach($sections as $section)
                <option value="{{ $section->id }}">{{ $section->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection