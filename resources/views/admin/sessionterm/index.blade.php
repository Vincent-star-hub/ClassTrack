@extends('layouts.admin')

@section('title', 'Manage Session & Term')

@section('content')
<div class="container">
    <div class="heading">
        <h1>Manage Session & Term</h1>
    </div>

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

    {{-- Button to trigger modal for adding a new session/term --}}
    <div class="button d-flex justify-content-end mb-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createSessionTermModal">
            Add New Session/Term
        </button>
    </div>

    {{-- Session & Term Creation Modal --}}
    <div class="modal fade" id="createSessionTermModal" tabindex="-1" aria-labelledby="createSessionTermModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createSessionTermModalLabel">Create New Session/Term</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('sessionterm.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="session_name">Session</label>
                            <input type="text" name="session_name" id="session_name" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="term_name">Term</label>
                            <select name="term_name" id="term_name" class="form-control" required>
                                <option value="First">First</option>
                                <option value="Second">Second</option>
                                <option value="Third">Third</option>
                                <option value="Fourth">Fourth</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Session & Term List --}}
    <div class="card">
        <div class="card-header">
            <h2>Session & Term List</h2>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered" id="sessionTermTable">
                <thead>
                    <tr>
                        <th>Session</th>
                        <th>Term</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sessionTerms as $sessionTerm)
                    <tr>
                        <td>{{ $sessionTerm->session_name }}</td>
                        <td>{{ $sessionTerm->term_name }}</td>
                        <td>{{ $sessionTerm->status ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <a href="{{ route('sessionterm.edit', $sessionTerm->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('sessionterm.destroy', $sessionTerm->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#sessionTermTable').DataTable();
    });
</script>
@endpush