@extends('layouts.teacher')

@section('title', 'View Student Attendance')

@section('content')
<div class="container p-3">
    <div class="card">
        <div class="card-header">
            <h1>View Student Attendance</h1>
        </div>
        <div class="card-body">
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

            {{-- Form to Select a Student --}}
            <form action="{{ route('attendance.view') }}" method="GET" class="mb-4">
                <div class="form-group mb-3">
                    <label for="student_id">Select Student</label>
                    <select name="student_id" id="student_id" class="form-control" required>
                        <option value="">-- Select a Student --</option>
                        @foreach ($students as $student)
                        <option value="{{ $student->id }}" {{ request('student_id') == $student->id ? 'selected' : '' }}>
                            {{ $student->first_name }} {{ $student->last_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">View Attendance</button>
            </form>

            {{-- Display Attendance Records if a Student is Selected --}}
            @if ($attendances->isNotEmpty())
            <div class="mt-4">
                <h2 class="text-center">Attendance Records</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" id="attendanceTable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendances as $attendance)
                        <tr>
                            <td>{{ $attendance->date }}</td>
                            <td class="{{ $attendance->status == 'Present' ? 'bg-success text-white' : ($attendance->status == 'Absent' ? 'bg-danger text-white' : '') }}">
                                {{ $attendance->status }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @elseif(request('student_id'))
            <p class="mt-4">No attendance records found for the selected student.</p>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#attendanceTable').DataTable({
            // DataTables configuration options can be added here
        });
    });
</script>
@endpush