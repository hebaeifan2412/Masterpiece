<?php

namespace App\Http\Controllers\Admin;;
use App\Http\Controllers\Controller;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    // Display a listing of the subjects
    public function index()
    {
        $subjects = Subject::all();
        return view('admin.subjects.index', compact('subjects'));
    }

    // Show the form for creating a new subject
    public function create()
    {
        return view('admin.subjects.create');
    }

    // Store a newly created subject
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:20|unique:subjects,code',
        ]);

        Subject::create($request->all());

        return redirect()->route('admin.subjects.index')->with('success', 'Subject created successfully!');
    }

    // Display the specified subject
    public function show(Subject $subject)
    {
        return view('admin.subjects.show', compact('subject'));
    }

    // Show the form for editing the specified subject
    public function edit(Subject $subject)
    {
        return view('admin.subjects.edit', compact('subject'));
    }

    // Update the specified subject
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:20|unique:subjects,code,' . $subject->id,
        ]);

        $subject->update($request->all());

        return redirect()->route('admin.subjects.index')->with('success', 'Subject updated successfully!');
    }

    // Remove the specified subject
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted successfully!');
    }
}
