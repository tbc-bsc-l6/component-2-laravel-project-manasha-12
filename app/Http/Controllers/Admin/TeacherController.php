<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    // List all teachers
    public function index()
    {
        $teachers = Teacher::withCount('modules')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('admin.teachers.index', compact('teachers'));
    }

    // Show create form
    public function create()
    {
        return view('admin.teachers.create');
    }

    // Store new teacher
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:teachers,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        Teacher::create($validated);

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Teacher created successfully!');
    }

    // Show teacher details
    public function show(Teacher $teacher)
    {
        $teacher->load('modules.activeEnrollments');
        
        return view('admin.teachers.show', compact('teacher'));
    }

    // Show edit form
    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    // Update teacher
    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:teachers,email,' . $teacher->id],
        ]);

        $teacher->update($validated);

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Teacher updated successfully!');
    }

    // Delete teacher
    public function destroy(Teacher $teacher)
    {
        // Check if teacher has assigned modules
        if ($teacher->modules()->count() > 0) {
            return redirect()
                ->back()
                ->with('error', 'Cannot delete teacher with assigned modules. Please remove module assignments first.');
        }

        $teacher->delete();

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Teacher deleted successfully!');
    }
}