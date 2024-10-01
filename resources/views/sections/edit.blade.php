@extends('layouts.admin')

@section('title', 'Edit Section')

@section('content')
<h1>Edit Section</h1>

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

<form action="{{ route('sections.update', $section->id) }}" method="POST">
    @csrf
    @method('PUT')

    {{-- Section Name field --}}
    <div class="form-group mb-3">
        <label for="name">Section Name:</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $section->name) }}" required>
    </div>

    {{-- Assigned field --}}
    <div class="form-group mb-3">
        <label for="status">Status:</label>
        <select name="status" id="status" class="form-control" required>
            <option value="" disabled>Select Status</option>
            <option value="Assigned" {{ old('status', $section->status) === 'Assigned' ? 'selected' : '' }}>Assigned</option>
            <option value="Unassigned" {{ old('status', $section->status) === 'Unassigned' ? 'selected' : '' }}>Unassigned</option>
        </select>
    </div>

    {{-- Submit button and Back button --}}
    <button type="submit" class="btn btn-primary">Update Section</button>
    <a href="{{ route('sections.index') }}" class="btn btn-secondary">Back to Sections</a>
</form>
@stop