@extends('layouts.admin')

@section('title', 'Edit Class')

@section('content')
<div class="container">
    <h1>Edit Class</h1>

    <form action="{{ route('classes.update', $class->id) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $class->name }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
        <a href="{{ route('classes.index') }}" class="btn btn-secondary mt-3">Back to Classes</a>
    </form>
</div>
@stop