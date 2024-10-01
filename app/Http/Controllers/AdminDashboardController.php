<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\User;
use App\Models\Section;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $classesCount = Classes::count();
        $sectionsCount = Section::count();
        $teachersCount = User::where('role', 'teacher')->count(); // Adjust this based on your role management
        $adminsCount = User::where('role', 'admin')->count(); // Adjust this based on your role management

        return view('admin.dashboard', compact('classesCount', 'teachersCount', 'sectionsCount', 'adminsCount'));
    }
}
