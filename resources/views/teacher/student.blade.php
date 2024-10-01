@extends('layouts.teacher')

@section('title', 'Teacher’s Students')

@section('content')
<div class="heading">
    <h1>Welcome, {{ $teacher->name }}!👋</h1>
</div>

{{-- Students List --}}
@if($students && $students->isNotEmpty())
<div class="card">
    <div class="card-header">
        <h3>Students in Your Class ({{ $assignedSection->name }})</h3>
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
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                <tr>
                    <td>{{ $student->first_name }}</td>
                    <td>{{ $student->last_name }}</td>
                    <td>{{ $student->other_name }}</td>
                    <td>{{ $student->lrn }}</td>
                    <td>{{ $student->class->name }}</td>
                    <td>{{ $student->section->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
<div class="alert alert-info">
    <p>No students assigned to your class and section yet.</p>
</div>
@endif
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#studentsTable').DataTable({
            // Add any DataTables configuration options here
        });
    });
</script>
@endpush