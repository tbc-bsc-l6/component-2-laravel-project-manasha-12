<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    // List all modules
    public function index()
    {
        $modules = Module::withCount(['activeEnrollments', 'teachers'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('admin.modules.index', compact('modules'));
    }

    // Show create form
    public function create()
    {
        return view('admin.modules.create');
    }

    // Store new module
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:20', 'unique:modules,code'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'max_students' => ['required', 'integer', 'min:1', 'max:10'],
            'is_available' => ['boolean'],
        ]);

        Module::create($validated);

        return redirect()
            ->route('admin.modules.index')
            ->with('success', 'Module created successfully!');
    }

    // Show edit form
    public function edit(Module $module)
    {
        return view('admin.modules.edit', compact('module'));
    }

    // Update module
    public function update(Request $request, Module $module)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:20', 'unique:modules,code,' . $module->id],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'max_students' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        $module->update($validated);

        return redirect()
            ->route('admin.modules.index')
            ->with('success', 'Module updated successfully!');
    }

    // Toggle module availability
    public function toggleAvailability(Module $module)
    {
        $module->update([
            'is_available' => !$module->is_available
        ]);

        $status = $module->is_available ? 'available' : 'unavailable';

        return redirect()
            ->back()
            ->with('success', "Module marked as {$status}!");
    }

    // Assign teacher to module
    public function assignTeacher(Request $request, Module $module)
    {
        $validated = $request->validate([
            'teacher_id' => ['required', 'exists:teachers,id']
        ]);

        // Check if teacher is already assigned
        if ($module->teachers()->where('teacher_id', $validated['teacher_id'])->exists()) {
            return redirect()
                ->back()
                ->with('error', 'Teacher is already assigned to this module!');
        }

        $module->teachers()->attach($validated['teacher_id'], [
            'assigned_at' => now()
        ]);

        return redirect()
            ->back()
            ->with('success', 'Teacher assigned successfully!');
    }

    // Remove teacher from module
    public function removeTeacher(Module $module, Teacher $teacher)
    {
        $module->teachers()->detach($teacher->id);

        return redirect()
            ->back()
            ->with('success', 'Teacher removed from module!');
    }

    // Show module details with enrollments
    public function show(Module $module)
    {
        //  Load both active and completed enrollments with students
        $module->load([
            'activeEnrollments.student', 
            'completedEnrollments.student',
            'teachers'
        ]);
        
        //  Filter out enrollments with null students (deleted students)
        $activeEnrollments = $module->activeEnrollments->filter(function ($enrollment) {
            return $enrollment->student !== null;
        });

        $completedEnrollments = $module->completedEnrollments->filter(function ($enrollment) {
            return $enrollment->student !== null;
        });

        // Get available teachers (not assigned to this module)
        $availableTeachers = Teacher::whereNotIn('id', $module->teachers->pluck('id'))->get();
        
        //  Pass both active and completed enrollments to view
        return view('admin.modules.show', compact(
            'module', 
            'availableTeachers',
            'activeEnrollments',
            'completedEnrollments'
        ));
    }
}