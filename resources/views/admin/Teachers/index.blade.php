@extends('layouts.admin')

@section('title', 'Manage Teachers')

@section('content')
<div class="heading">
    <h1>Create Teachers</h1>
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
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTeacherModal">
        Add New Teacher
    </button>
</div>

{{-- Teacher Creation Modal --}}
<div class="modal fade" id="createTeacherModal" tabindex="-1" aria-labelledby="createTeacherModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTeacherModalLabel">Create New Teacher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.teachers.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password_confirmation">Confirm Password:</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="class_id">Assign to Class:</label>
                        <select name="class_id" id="class_id" class="form-control" required>
                            <option value="">Select a Class</option>
                            @foreach ($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="section_id">Assign to Section:</label>
                        <select name="section_id" id="section_id" class="form-control" required>
                            <option value="">Select a Section</option>
                            @foreach ($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->name }} {{ $section->status == 'Unassigned' ? '(unsigned)' : '' }}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" name="role" value="teacher">

                    <button type="submit" class="btn btn-primary">Create Teacher</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Teacher List --}}
<div class="card">
    <div class="card-header">
        <h2>Teacher List</h2>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered" id="teachersTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Class</th>
                    <th>Section</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teachers as $teacher)
                <tr>
                    <td>{{ $teacher->name }}</td>
                    <td>{{ $teacher->email }}</td>
                    <td>{{ $teacher->class ? $teacher->class->name : 'N/A' }}</td>
                    <td>
                        @if ($teacher->section)
                        {{ $teacher->section->name }}
                        @if ($teacher->section->status == 'Unassigned')
                        (unsigned)
                        @endif
                        @else
                        N/A
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.teachers.edit', $teacher->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.teachers.destroy', $teacher->id) }}" method="POST" style="display:inline;">
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
@stop

@push('scripts')
<script>
    $(document).ready(function() {
        $('#teachersTable').DataTable();
    });
</script>
@endpush