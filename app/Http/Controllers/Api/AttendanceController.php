<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendanceResource;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::get();
        if ($attendances) {
            return AttendanceResource::collection($attendances);
        } else {
            return response()->json(['message' => 'No record available'], 200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:classes,id',
            'section_id' => 'required|exists:sections,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->messages()
            ], 422);
        }

        $attendance = Attendance::create([
            'student_id' => $request->student_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'date' => $request->date,
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'Attendance marked successfully',
            'data' => new AttendanceResource($attendance)
        ], 200);
    }

    //successful combined with show and view
    //the attendance/view is manually created in api.php
    public function show(Attendance $attendance)
    {
        return new AttendanceResource($attendance);
    }

    public function view(Request $request)
    {
        // Validate that student_id is required
        $request->validate([
            'student_id' => 'required|exists:students,id',
        ]);

        // Fetch all attendance records for the specified student
        $attendances = Attendance::where('student_id', $request->student_id)->get();

        // Check if no records were found
        if ($attendances->isEmpty()) {
            return response()->json(['error' => 'No attendance records found for this student.'], 404);
        }

        return response()->json($attendances);
    }
}
