<x-admin-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Module Details: {{ $module->code }}
            </h2>
            <a href="{{ route('admin.modules.edit', $module) }}" 
               style="padding: 0.5rem 1rem; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; font-weight: 500; border-radius: 0.5rem; text-decoration: none; display: inline-block;">
                Edit Module
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div style="margin-bottom: 1.5rem; background-color: #d1fae5; border-left: 4px solid #10b981; padding: 1rem; border-radius: 0.5rem;">
                    <p style="color: #065f46; font-weight: 500;">{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div style="margin-bottom: 1.5rem; background-color: #fee2e2; border-left: 4px solid #ef4444; padding: 1rem; border-radius: 0.5rem;">
                    <p style="color: #991b1b; font-weight: 500;">{{ session('error') }}</p>
                </div>
            @endif

            <!-- Module Info Card -->
            <div style="background-color: white; border-radius: 1rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 2rem;">
                <h3 style="font-size: 1.5rem; font-weight: 600; color: #111827; margin-bottom: 1rem;">{{ $module->name }}</h3>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div>
                        <p style="font-size: 0.875rem; color: #6b7280;">Module Code</p>
                        <p style="font-size: 1.125rem; font-weight: 600; color: #111827;">{{ $module->code }}</p>
                    </div>
                    <div>
                        <p style="font-size: 0.875rem; color: #6b7280;">Active Students</p>
                        <p style="font-size: 1.125rem; font-weight: 600; color: #111827;">{{ $activeEnrollments->count() }} / {{ $module->max_students }}</p>
                    </div>
                    <div>
                        <p style="font-size: 0.875rem; color: #6b7280;">Completed</p>
                        <p style="font-size: 1.125rem; font-weight: 600; color: #111827;">{{ $completedEnrollments->count() }}</p>
                    </div>
                    <div>
                        <p style="font-size: 0.875rem; color: #6b7280;">Status</p>
                        <span style="display: inline-block; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 600; 
                                     background-color: {{ $module->is_available ? '#d1fae5' : '#fee2e2' }}; 
                                     color: {{ $module->is_available ? '#065f46' : '#991b1b' }};">
                            {{ $module->is_available ? 'Available' : 'Unavailable' }}
                        </span>
                    </div>
                </div>

                @if($module->description)
                    <div>
                        <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 0.5rem;">Description</p>
                        <p style="color: #374151;">{{ $module->description }}</p>
                    </div>
                @endif

                <!-- Toggle Availability -->
                <form action="{{ route('admin.modules.toggle', $module) }}" method="POST" style="margin-top: 1.5rem;">
                    @csrf
                    <button type="submit" 
                            style="padding: 0.5rem 1rem; background-color: {{ $module->is_available ? '#ef4444' : '#10b981' }}; color: white; font-weight: 500; border-radius: 0.5rem; border: none; cursor: pointer;">
                        {{ $module->is_available ? 'Mark as Unavailable' : 'Mark as Available' }}
                    </button>
                </form>
            </div>

            <!-- Assigned Teachers -->
            <div style="background-color: white; border-radius: 1rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 2rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <h3 style="font-size: 1.25rem; font-weight: 600; color: #111827;">Assigned Teachers</h3>
                </div>

                @if($module->teachers->count() > 0)
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background-color: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                                    <th style="padding: 0.75rem; text-align: left; font-size: 0.875rem; font-weight: 500; color: #6b7280;">Name</th>
                                    <th style="padding: 0.75rem; text-align: left; font-size: 0.875rem; font-weight: 500; color: #6b7280;">Email</th>
                                    <th style="padding: 0.75rem; text-align: left; font-size: 0.875rem; font-weight: 500; color: #6b7280;">Assigned Date</th>
                                    <th style="padding: 0.75rem; text-align: left; font-size: 0.875rem; font-weight: 500; color: #6b7280;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($module->teachers as $teacher)
                                    <tr style="border-bottom: 1px solid #e5e7eb;">
                                        <td style="padding: 1rem; font-size: 0.875rem; color: #111827;">{{ $teacher->name }}</td>
                                        <td style="padding: 1rem; font-size: 0.875rem; color: #6b7280;">{{ $teacher->email }}</td>
                                        <td style="padding: 1rem; font-size: 0.875rem; color: #6b7280;">
                                            @if($teacher->pivot->assigned_at)
                                                {{ \Carbon\Carbon::parse($teacher->pivot->assigned_at)->format('M d, Y') }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td style="padding: 1rem;">
                                            <form action="{{ route('admin.modules.remove-teacher', [$module, $teacher]) }}" method="POST" 
                                                  onsubmit="return confirm('Remove this teacher from the module?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="color: #ef4444; font-size: 0.875rem; font-weight: 500; background: none; border: none; cursor: pointer;">
                                                    Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p style="color: #6b7280; text-align: center; padding: 2rem 0;">No teachers assigned to this module yet.</p>
                @endif

                <!-- Assign Teacher Form -->
                @if($availableTeachers->count() > 0)
                    <form action="{{ route('admin.modules.assign-teacher', $module) }}" method="POST" style="margin-top: 1.5rem; display: flex; gap: 1rem; align-items: flex-end;">
                        @csrf
                        <div style="flex: 1;">
                            <label for="teacher_id" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                                Assign New Teacher
                            </label>
                            <select name="teacher_id" id="teacher_id" required
                                    style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;">
                                <option value="">Select a teacher...</option>
                                @foreach($availableTeachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }} ({{ $teacher->email }})</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" 
                                style="padding: 0.75rem 1.5rem; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; font-weight: 500; border-radius: 0.5rem; border: none; cursor: pointer;">
                            Assign Teacher
                        </button>
                    </form>
                @endif
            </div>

            <!-- Active Enrolled Students -->
            <div style="background-color: white; border-radius: 1rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 2rem;">
                <h3 style="font-size: 1.25rem; font-weight: 600; color: #111827; margin-bottom: 1.5rem;">
                    Active Students ({{ $activeEnrollments->count() }})
                </h3>

                @if($activeEnrollments->count() > 0)
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background-color: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                                    <th style="padding: 0.75rem; text-align: left; font-size: 0.875rem; font-weight: 500; color: #6b7280;">Student Name</th>
                                    <th style="padding: 0.75rem; text-align: left; font-size: 0.875rem; font-weight: 500; color: #6b7280;">Email</th>
                                    <th style="padding: 0.75rem; text-align: left; font-size: 0.875rem; font-weight: 500; color: #6b7280;">Enrolled Date</th>
                                    <th style="padding: 0.75rem; text-align: left; font-size: 0.875rem; font-weight: 500; color: #6b7280;">Status</th>
                                    <th style="padding: 0.75rem; text-align: left; font-size: 0.875rem; font-weight: 500; color: #6b7280;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activeEnrollments as $enrollment)
                                    <tr style="border-bottom: 1px solid #e5e7eb;">
                                        <td style="padding: 1rem; font-size: 0.875rem; color: #111827; font-weight: 500;">{{ $enrollment->student->name }}</td>
                                        <td style="padding: 1rem; font-size: 0.875rem; color: #6b7280;">{{ $enrollment->student->email }}</td>
                                        <td style="padding: 1rem; font-size: 0.875rem; color: #6b7280;">{{ $enrollment->enrolled_at->format('M d, Y') }}</td>
                                        <td style="padding: 1rem;">
                                            <span style="display: inline-block; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; background-color: #dbeafe; color: #1e40af;">
                                                In Progress
                                            </span>
                                        </td>
                                        <td style="padding: 1rem;">
                                            <form action="{{ route('admin.enrollments.destroy', $enrollment) }}" method="POST" 
                                                  onsubmit="return confirm('Remove this student from the module?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="color: #ef4444; font-size: 0.875rem; font-weight: 500; background: none; border: none; cursor: pointer;">
                                                    Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p style="color: #6b7280; text-align: center; padding: 2rem 0;">No active students enrolled in this module.</p>
                @endif
            </div>

            <!-- Completed Enrollments -->
            <div style="background-color: white; border-radius: 1rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h3 style="font-size: 1.25rem; font-weight: 600; color: #111827; margin-bottom: 1.5rem;">
                    Completed Students ({{ $completedEnrollments->count() }})
                </h3>

                @if($completedEnrollments->count() > 0)
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background-color: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                                    <th style="padding: 0.75rem; text-align: left; font-size: 0.875rem; font-weight: 500; color: #6b7280;">Student Name</th>
                                    <th style="padding: 0.75rem; text-align: left; font-size: 0.875rem; font-weight: 500; color: #6b7280;">Email</th>
                                    <th style="padding: 0.75rem; text-align: left; font-size: 0.875rem; font-weight: 500; color: #6b7280;">Start Date</th>
                                    <th style="padding: 0.75rem; text-align: left; font-size: 0.875rem; font-weight: 500; color: #6b7280;">Completion Date</th>
                                    <th style="padding: 0.75rem; text-align: left; font-size: 0.875rem; font-weight: 500; color: #6b7280;">Result</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($completedEnrollments as $enrollment)
                                    @php
                                        $passStatus = strtoupper(trim($enrollment->pass_status ?? ''));
                                        $isPassed = $passStatus === 'PASS';
                                    @endphp
                                    <tr style="border-bottom: 1px solid #e5e7eb;">
                                        <td style="padding: 1rem; font-size: 0.875rem; color: #111827; font-weight: 500;">{{ $enrollment->student->name }}</td>
                                        <td style="padding: 1rem; font-size: 0.875rem; color: #6b7280;">{{ $enrollment->student->email }}</td>
                                        <td style="padding: 1rem; font-size: 0.875rem; color: #6b7280;">
                                            {{ $enrollment->enrolled_at->format('M d, Y') }}
                                        </td>
                                        <td style="padding: 1rem; font-size: 0.875rem; color: #6b7280;">
                                            @if($enrollment->completed_at)
                                                {{ \Carbon\Carbon::parse($enrollment->completed_at)->format('M d, Y') }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td style="padding: 1rem;">
                                            <span style="display: inline-block; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; 
                                                        background-color: {{ $isPassed ? '#d1fae5' : '#fee2e2' }}; 
                                                        color: {{ $isPassed ? '#065f46' : '#991b1b' }};">
                                                {{ $isPassed ? 'PASS' : 'FAIL' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p style="color: #6b7280; text-align: center; padding: 2rem 0;">No completed students for this module yet.</p>
                @endif
            </div>

        </div>
    </div>
</x-admin-layout>