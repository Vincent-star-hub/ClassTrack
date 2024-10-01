<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class TeacherStudentDashboardController extends Controller
{
    public function showStudents()
    {
        $teacher = Auth::user();

        // Retrieve the teacher's assigned class and section
        $assignedClass = Classes::find($teacher->class_id);
        $assignedSection = Section::find($teacher->section_id);

        // Retrieve students assigned to the teacher's specific class and section
        $students = Student::where('class_id', $teacher->class_id)
            ->where('section_id', $teacher->section_id)
            ->get();

        return view('teacher.student', compact('teacher', 'assignedClass', 'assignedSection', 'students'));
    }
}
