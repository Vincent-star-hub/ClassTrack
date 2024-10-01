<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    // Display a listing of the classes
    public function index()
    {
        $classes = Classes::all();
        return view('admin.classes.index', compact('classes'));
    }

    // Store a newly created class in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Classes::create($request->all());

        return redirect()->route('classes.index')
            ->with('success', 'Class created successfully.');
    }

    // Show the form for editing the specified class
    public function edit(Classes $class)
    {
        return view('admin.classes.edit', compact('class'));
    }

    // Update the specified class in the database
    public function update(Request $request, Classes $class)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $class->update($request->all());

        return redirect()->route('classes.index')
            ->with('success', 'Class updated successfully.');
    }

    // Remove the specified class from the database
    public function destroy(Classes $class)
    {
        $class->delete();

        return redirect()->route('classes.index')
            ->with('success', 'Class deleted successfully.');
    }
}
