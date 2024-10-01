@extends('layouts.admin')

@section('title', 'Classes')

@section('content')
<div class="heading">
    <h1>Create Classes</h1>
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

<div class="button d-flex justify-content-end">
    {{-- Button to trigger modal --}}
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createClassModal">
        Add New Class
    </button>
</div>

{{-- Classes List --}}
<div class="card">
    <div class="card-header">
        <h2>All Classes</h2>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered" id="classesTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classes as $class)
                <tr>
                    <td>{{ $class->id }}</td>
                    <td>{{ $class->name }}</td>
                    <td>
                        <a href="{{ route('classes.edit', $class->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('classes.destroy', $class->id) }}" method="POST" style="display:inline;">
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

{{-- Modal for creating a new class --}}
<div class="modal fade" id="createClassModal" tabindex="-1" aria-labelledby="createClassModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createClassModalLabel">Add New Class</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('classes.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Class Name:</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Create Class</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@stop

@push('scripts')
<script>
    $(document).ready(function() {
        $('#classesTable').DataTable({
            // Add any DataTables configuration options here
        });
    });
</script>
@endpush