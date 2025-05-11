<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;

class GradeController extends Controller
{
    public function index()
    {
        $search = request('search');
          
    $grades = Grade::query()
    ->withCount('classProfiles') // This adds class_profiles_count
    ->when($search, function($query) use ($search) {
        $query->where('name', 'like', '%'.$search.'%');
    })
    ->orderBy('name')
    ->paginate(10);
        return view('admin.grades.index', compact('grades'));
    }

    public function create()
    {
        return view('admin.grades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:grades,name',
        ]);

        Grade::create(['name' => $request->name]);

        return redirect()->route('admin.grades.index')->with('success', 'Grade created successfully.');
    }

    public function edit(Grade $grade)
    {
        return view('admin.grades.edit', compact('grade'));
    }

    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:grades,name,' . $grade->id,
        ]);

        $grade->update(['name' => $request->name]);

        return redirect()->route('admin.grades.index')->with('success', 'Grade updated successfully.');
    }

   public function destroy(Grade $grade)
{
    $hasStudents = $grade->classProfiles()->withCount('students')->get()
        ->sum('students_count') > 0;

    if ($hasStudents) {
        return back()->with('error', 'Cannot delete grade with students in its classes.');
    }

    $grade->delete();
    return redirect()->route('admin.grades.index')->with('success', 'Grade deleted successfully.');
}
}
