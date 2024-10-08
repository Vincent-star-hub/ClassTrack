@extends('layouts.teacher')

@section('title', 'Record Attendance')

@section('content')
<div class="container pt-3">
    <div class="card">
        <div class="card-header">
            <h1>Record Attendance</h1>
        </div>
        <div class="card-body">
            {{-- Success Messages --}}
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            {{-- Attendance Form --}}
            <form action="{{ route('attendance.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="date">Date:</label>
                    <input type="date" name="date" id="date" class="form-control" required>
                </div>
                <input type="hidden" name="class_id" value="{{ $assignedSection->class_id }}">
                <input type="hidden" name="section_id" value="{{ $assignedSection->id }}">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="attendanceTable">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                            <tr>
                                <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                <td>
                                    <select name="attendances[{{ $loop->index }}][status]" class="form-control"
                                        required>
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="Present">Present</option>
                                        <option value="Absent">Absent</option>
                                    </select>
                                    <input type="hidden" name="attendances[{{ $loop->index }}][student_id]"
                                        value="{{ $student->id }}">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Record Attendance</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#attendanceTable').DataTable({});
    });
</script>
@endpush