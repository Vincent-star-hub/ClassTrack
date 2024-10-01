<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AttendanceController extends Controller
{
    public function create()
    {
        $teacher = Auth::user();
        $assignedSection = Section::where('id', $teacher->section_id)->first();
        $students = Student::where('section_id', $assignedSection->id)->get();

        return view('teacher.attendance.create', compact('students', 'assignedSection'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'attendances.*.student_id' => 'required|exists:students,id',
            'attendances.*.status' => 'required|in:Present,Absent',
        ]);

        $attendances = [];

        foreach ($request->attendances as $attendance) {
            $attendances[] = [
                'student_id' => $attendance['student_id'],
                'class_id' => $request->class_id,
                'section_id' => $request->section_id,
                'date' => $request->date,
                'status' => $attendance['status'],
            ];
        }

        Attendance::insert($attendances);

        return redirect()->route('attendance.create')->with('success', 'Attendance recorded successfully.');
    }

    public function index(Request $request)
    {
        $teacher = Auth::user(); // Get the currently authenticated user

        // Retrieve the teacher's assigned class and section
        $students = Student::where('class_id', $teacher->class_id)
            ->where('section_id', $teacher->section_id)
            ->get();

        $date = $request->input('date', date('Y-m-d')); // Default to today's date if no date is provided

        // Fetch attendance records for the selected date
        $attendances = Attendance::whereIn('student_id', $students->pluck('id'))
            ->where('date', $date)
            ->get()
            ->keyBy('student_id'); // Key by student_id for easy access

        return view('teacher.attendance.index', compact('students', 'attendances', 'date'));
    }

    public function viewStudentAttendance(Request $request)
    {
        // Fetch all students assigned to the teacher
        $teacher = Auth::user();
        $students = Student::where('class_id', $teacher->class_id)
            ->where('section_id', $teacher->section_id)
            ->get();

        $attendances = collect(); // Initialize an empty collection for attendance records

        // Check if a student has been selected
        if ($request->has('student_id') && $request->student_id) {
            // Fetch attendance records for the selected student
            $attendances = Attendance::where('student_id', $request->student_id)->get();
        }

        return view('teacher.attendance.view', compact('students', 'attendances'));
    }

    public function todayReport()
    {
        $teacher = Auth::user(); // Get the currently authenticated user
        $classes = $teacher->class; // Fetch the classes assigned to the teacher
        $classIds = $classes->pluck('id');

        // Fetch attendance records for today and assigned classes
        $today = date('Y-m-d');
        $attendances = Attendance::whereIn('class_id', $classIds)
            ->whereDate('date', $today)
            ->get();

        // Generate and return the Excel file
        return $this->generateExcel($attendances);
    }

    protected function generateExcel($attendances)
    {
        $response = new StreamedResponse(function () use ($attendances) {
            $handle = fopen('php://output', 'w');

            // Output the column headings
            fputcsv($handle, ['Student Name', 'Student Last Name', 'Student Other Name', 'Class', 'Date', 'Status']);

            // Output each row of data
            foreach ($attendances as $attendance) {
                $student = $attendance->student;
                $class = $attendance->class; // Ensure you have the class relation

                fputcsv($handle, [
                    $student->first_name,
                    $student->last_name,
                    $student->other_name ?? 'N/A',
                    $class->name, // Adjust if necessary
                    $attendance->date,
                    $attendance->status
                ]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="today_attendance_report.csv"');

        return $response;
    }
}
