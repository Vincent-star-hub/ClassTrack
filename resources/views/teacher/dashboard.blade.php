@extends('layouts.teacher')

@section('title', 'Teacher Dashboard')

@section('content')
<div class="heading">
    <h1>Welcome, {{ $teacher->name }}!</h1>
</div>

{{-- Assigned Class and Sections --}}
@if($assignedClass || ($assignedSection))
<div class="card mb-4">
    <div class="card-header bg-gradient-primary text-white">
        <h2>Assigned Class and Sections</h2>
    </div>
    <div class="card-body">
        @if($assignedClass)
        <div class="mb-3">
            <h4>Your Assigned Class:</h4>
            <p class="lead">{{ $assignedClass->name }}</p>
        </div>
        @else
        <div class="alert alert-info">
            <p>You are not assigned to any class.</p>
        </div>
        @endif

        @if($assignedSection)
        <div>
            <h4s>Assigned Sections:</h4s>
            <div class="mb-3">
                <p class="lead">{{ $assignedSection->name }}</p>
            </div>
        </div>
        @else
        <div class="alert alert-info">
            <p>No sections assigned to your class.</p>
        </div>
        @endif
    </div>
</div>
@else
<div class="alert alert-info">
    <p>You are not assigned to any class or sections.</p>
</div>
@endif

{{-- Student Count --}}
@if($studentCount > 0)
<div class="row">
    <div class="box col-lg-3 col-6">
        <div class="small-box bg-danger-custom">
            <div class="inner">
                <h3>{{ $studentCount }}</h3>
                <h5>Students</h5>
            </div>
            <div class="icon">
                <i class="fas fa-user-shield"></i>
            </div>
            <a href="{{ route('teacher.student') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
@else
<div class="alert alert-info">
    <p>No students assigned to your class and sections yet.</p>
</div>
@endif

@stop

@push('scripts')
<script>
    $(document).ready(function() {
        $('#studentsTable').DataTable({
            // Add any DataTables configuration options here
        });
    });
</script>
@endpush