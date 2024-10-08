<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classes;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show the form for creating a new teacher
    public function createTeacher()
    {
        $classes = Classes::all();
        $sections = Section::all(); // Fetch all sections
        return view('admin.teachers.create', compact('classes', 'sections'));
    }

    // Store a new teacher in the database
    public function storeTeacher(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'class_id' => 'required|exists:classes,id',
            // 'section_id' => 'required|exists:sections,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'teacher',
            'class_id' => $request->class_id,
            // 'section_id' => $request->section_id,
        ]);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher created successfully.');
    }

    // Show the form for editing a specific teacher
    public function editTeacher(User $user)
    {
        $classes = Classes::all();
        $sections = Section::all(); // Fetch all sections
        return view('admin.teachers.edit', compact('user', 'classes', 'sections'));
    }

    // Update a specific teacher in the database
    public function updateTeacher(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'class_id' => 'required|exists:classes,id',
            'section_id' => 'required|exists:sections,id',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
        ]);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated successfully.');
    }

    // Show the form for creating a new admin
    public function createAdmin()
    {
        return view('admin.admins.create');
    }

    // Store a new admin in the database
    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'Admin created successfully.');
    }

    // Show the form for editing a specific admin
    public function editAdmin(User $user)
    {
        return view('admin.admins.edit', compact('user'));
    }

    // Update a specific admin in the database
    public function updateAdmin(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'Admin updated successfully.');
    }

    // Method for managing teachers
    public function manageTeachers()
    {
        $teachers = User::where('role', 'teacher')
            ->with('class', 'section') // Load class and section relationships
            ->get();
        $classes = Classes::all(); // Fetch all classes
        $sections = Section::all(); // Fetch all sections

        return view('admin.teachers.index', compact('teachers', 'classes', 'sections'));
    }

    // Method for managing admins
    public function manageAdmins()
    {
        $admins = User::where('role', 'admin')->get();
        return view('admin.admins.index', compact('admins'));
    }

    // Delete a specific user (admin or teacher) from the database
    public function destroy(User $user)
    {
        $role = $user->role;
        $user->delete();

        if ($role === 'teacher') {
            return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully.');
        } elseif ($role === 'admin') {
            return redirect()->route('admin.admins.index')->with('success', 'Admin deleted successfully.');
        }
    }
}
