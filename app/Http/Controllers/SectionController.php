<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Classes; // Ensure this model is correctly named and used
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        // Fetch sections with their related class
        $sections = Section::with('class')->get();
        // Fetch all classes to populate the dropdown
        $classes = Classes::all();
        return view('sections.index', compact('sections', 'classes'));
    }

    // Method for showing the form to create a new section
    public function create()
    {
        $classes = Classes::all(); // Fetch all classes to populate the dropdown
        return view('sections.create', compact('classes'));
    }

    // Method for storing a new section
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id',
            // Uncomment the line below if you want to validate the status field
            // 'status' => 'required|in:Assigned,Unassigned',
        ]);

        Section::create($request->all());

        return redirect()->route('sections.index')->with('success', 'Section created successfully.');
    }

    // Method for showing the edit section form
    public function edit(Section $section)
    {
        $classes = Classes::all(); // Fetch all classes to populate the dropdown
        return view('sections.edit', compact('section', 'classes'));
    }

    // Method for updating a section
    public function update(Request $request, Section $section)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:Assigned,Unassigned',
        ]);

        $section->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('sections.index')->with('success', 'Section updated successfully.');
    }

    // Method for deleting a section
    public function destroy(Section $section)
    {
        $section->delete();

        return redirect()->route('sections.index')->with('success', 'Section deleted successfully.');
    }
}
