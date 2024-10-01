@extends('layouts.admin')

@section('title', 'Manage Sections')

@section('content')

<div class="heading">
    <h1>Create Sections</h1>
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
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createSectionModal">
        Add New Section
    </button>
</div>

{{-- Sections List --}}
<div class="card">
    <div class="card-header">
        <h2>Sections List</h2>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered" id="sectionsTable">
            <thead>
                <tr>
                    <th>Class</th>
                    <th>Section</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sections as $section)
                <tr>
                    <td>{{ $section->class->name }}</td>
                    <td>{{ $section->name }}</td>
                    <td>{{ $section->status }}</td>
                    <td>
                        <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('sections.destroy', $section->id) }}" method="POST" style="display:inline;">
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

{{-- Modal for creating a new section --}}
<div class="modal fade" id="createSectionModal" tabindex="-1" aria-labelledby="createSectionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createSectionModalLabel">Add New Section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sections.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="class_id">Class:</label>
                        <select name="class_id" id="class_id" class="form-control" required>
                            <option value="" disabled selected>Select a Class</option>
                            @foreach ($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">Section Name:</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <!-- with dropdown -->
                    <!-- <div class="form-group mb-3">
                        <label for="section_id">Section:</label>
                        <select name="section_id" id="section_id" class="form-control" required>
                            <option value="" disabled selected>Select a Section</option>
                            @foreach ($sections->where('status', 'Assigned') as $section)
                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                            @endforeach
                        </select>
                    </div> -->
                    <button type="submit" class="btn btn-primary">Create Section</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#sectionsTable').DataTable();
    });
</script>
@endpush