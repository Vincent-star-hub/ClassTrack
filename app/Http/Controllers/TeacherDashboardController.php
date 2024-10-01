<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $teacher = Auth::user();

        // Fetch the teacher's assigned class
        $assignedClass = Classes::find($teacher->class_id);

        // Fetch the teacher's assigned section and ensure it's assigned
        $assignedSection = Section::where('id', $teacher->section_id)
            ->where('status', 'Assigned')
            ->first();

        // If the section is not assigned, set assignedSection to null
        if (!$assignedSection) {
            $assignedSection = null;
            $studentCount = 0;  // No students if the section is not assigned
        } else {
            // Count students assigned to the teacher's specific class and section
            $studentCount = Student::where('class_id', $teacher->class_id)
                ->where('section_id', $teacher->section_id)
                ->count();
        }

        return view('teacher.dashboard', compact('teacher', 'assignedClass', 'assignedSection', 'studentCount'));
    }
}
