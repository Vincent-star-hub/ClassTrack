@extends('layouts.admin')

@section('title', 'Edit Session Term')

@section('content')
<div class="container">
    <h1>Edit Session Term</h1>

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
        <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif

    <form action="{{ route('sessionterm.update', $sessionTerm->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="session_name">Session Name:</label>
            <input type="text" name="session_name" id="session_name" class="form-control" value="{{ $sessionTerm->session_name }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="term_name">Term Name:</label>
            <select name="term_name" id="term_name" class="form-control" required>
                <option value="First" {{ $sessionTerm->term_name == 'First' ? 'selected' : '' }}>First</option>
                <option value="Second" {{ $sessionTerm->term_name == 'Second' ? 'selected' : '' }}>Second</option>
                <option value="Third" {{ $sessionTerm->term_name == 'Third' ? 'selected' : '' }}>Third</option>
                <option value="Fourth" {{ $sessionTerm->term_name == 'Fourth' ? 'selected' : '' }}>Fourth</option>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="1" {{ $sessionTerm->status ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$sessionTerm->status ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Session Term</button>
    </form>
</div>
@endsection