<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SessionTerm;

class SessionTermController extends Controller
{
    public function index()
    {
        $sessionTerms = SessionTerm::all(); // Retrieve all session terms

        return view('admin.sessionterm.index', compact('sessionTerms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'session_name' => 'required|string|max:255',
            'term_name' => 'required|string|max:255',
            'status' => 'required|boolean', // Validate status
        ]);

        // Create a new session term
        SessionTerm::create([
            'session_name' => $request->session_name,
            'term_name' => $request->term_name,
            'status' => $request->status, // Store status
        ]);

        return redirect()->route('sessionterm.index')->with('success', 'Session term created successfully.');
    }

    public function edit($id)
    {
        $sessionTerm = SessionTerm::findOrFail($id); // Find the session term by ID
        return view('admin.sessionterm.edit', compact('sessionTerm'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'session_name' => 'required|string|max:255',
            'term_name' => 'required|string|max:255',
            'status' => 'required|boolean', // Validate status
        ]);

        $sessionTerm = SessionTerm::findOrFail($id); // Find the session term by ID
        $sessionTerm->update([
            'session_name' => $request->session_name,
            'term_name' => $request->term_name,
            'status' => $request->status, // Update status
        ]);

        return redirect()->route('sessionterm.index')->with('success', 'Session term updated successfully.');
    }

    public function destroy($id)
    {
        $sessionTerm = SessionTerm::findOrFail($id); // Find the session term by ID
        $sessionTerm->delete(); // Delete the session term

        return redirect()->route('sessionterm.index')->with('success', 'Session term deleted successfully.');
    }
}
