<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class TeacherProfileController extends Controller
{
    public function show()
    {
        // Retrieve the currently authenticated user
        $user = Auth::user();

        // Return the profile view with user data
        return view('teacher.profile', compact('user'));
    }
}
