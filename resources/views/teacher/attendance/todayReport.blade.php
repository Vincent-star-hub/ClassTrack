@extends('layouts.teacher')

@section('content')
<div class="container">
    <h1>Attendance Management</h1>

    {{-- Button to download today's attendance report --}}
    <a href="{{ route('attendance.todayReport') }}" class="btn btn-success">Download Today's Attendance Report</a>
</div>
@endsection