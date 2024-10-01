@extends('layouts.teacher')

@section('title', 'Attendance Status')

@section('content')
<div class="container pt-3">
    <div class="card">
        <div class="card-header">
            <h1>Student Attendance Status</h1>
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

            {{-- Date Filter Form --}}
            <form action="{{ route('attendance.index') }}" method="GET" class="mb-4">
                <div class="form-group mb-3">
                    <label for="date">Select Date</label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ $date }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>

            {{-- Attendance Table --}}
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="attendanceTable">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                            <td class="{{ isset($attendances[$student->id]) && $attendances[$student->id]->status == 'Present' ? 'bg-success text-white' : 'bg-danger text-white' }}">
                                @if(isset($attendances[$student->id]))
                                {{ $attendances[$student->id]->status }}
                                @else
                                No record
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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