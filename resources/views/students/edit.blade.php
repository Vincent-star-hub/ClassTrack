<!-- resources/views/students/edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Edit Student')

@section('content')
<div class="container">
    <h1>Edit Student</h1>
    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" class="form-control" value="{{ $student->first_name }}" required>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" class="form-control" value="{{ $student->last_name }}" required>
        </div>

        <div class="form-group">
            <label for="other_name">Other Name:</label>
            <input type="text" name="other_name" class="form-control" value="{{ $student->other_name }}">
        </div>

        <div class="form-group">
            <label for="lrn">LRN:</label>
            <input type="text" name="lrn" class="form-control" value="{{ $student->lrn }}" required>
        </div>

        <div class="form-group">
            <label for="class_id">Class:</label>
            <select name="class_id" class="form-control">
                @foreach($classes as $class)
                <option value="{{ $class->id }}" @if($class->id == $student->class_id) selected @endif>
                    {{ $class->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="section_id">Section:</label>
            <select name="section_id" class="form-control">
                @foreach($sections as $section)
                <option value="{{ $section->id }}" @if($section->id == $student->section_id) selected @endif>
                    {{ $section->name }}
                </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection