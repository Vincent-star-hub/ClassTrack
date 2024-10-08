@extends('layouts.admin')

@section('title', 'Manage Students')

@section('content')

<div class="heading">
    <h1>Create Students</h1>
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
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createStudentModal">
        Add New Student
    </button>
</div>

{{-- Student Creation Modal --}}
<div class="modal fade" id="createStudentModal" tabindex="-1" aria-labelledby="createStudentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createStudentModalLabel">Create New Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('students.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="other_name">Other Name</label>
                        <input type="text" name="other_name" id="other_name" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="lrn">LRN</label>
                        <input type="text" name="lrn" id="lrn" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="class">Class</label>
                        <select name="class_id" id="class" class="form-control" required>
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="section">Section</label>
                        <select name="section_id" id="section" class="form-control" required>
                            <option value="">Select Section</option>
                            <!-- Sections will be populated here via AJAX -->
                        </select>
                    </div>


                    <button type="submit" class="btn btn-primary">Create Student</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Student List --}}
<div class="card">
    <div class="card-header">
        <h2>Student List</h2>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered" id="studentsTable">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Other Name</th>
                    <th>LRN</th>
                    <th>Class</th>
                    <th>Section</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                <tr>
                    <td>{{ $student->first_name }}</td>
                    <td>{{ $student->last_name }}</td>
                    <td>{{ $student->other_name ?? 'N/A' }}</td>
                    <td>{{ $student->lrn }}</td>
                    <td>{{ $student->class->name }}</td>
                    <td>{{ $student->section->name }}</td>
                    <td>
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                            style="display:inline;">
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
@endsection

@push('scripts')

<script>
    $(document).ready(function() {
        $('#studentsTable').DataTable();

        // AJAX call to fetch sections based on selected class
        $('#class').change(function() {
            var classId = $(this).val();

            // Clear the section dropdown
            $('#section').empty();
            $('#section').append('<option value="">Select Section</option>');

            if (classId) {
                $.ajax({
                    url: '/sections/' + classId, // Define the endpoint here
                    type: 'GET',
                    success: function(data) {
                        // Populate the section dropdown with the returned data
                        $.each(data, function(index, section) {
                            $('#section').append('<option value="' + section.id + '">' + section.name + '</option>');
                        });
                    },
                    error: function() {
                        alert('Error fetching sections. Please try again.');
                    }
                });
            }
        });
    });
</script>
@endpush