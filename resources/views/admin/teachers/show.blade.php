<x-admin-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Teacher Details
            </h2>
            <a href="{{ route('admin.teachers.edit', $teacher) }}"
                style="padding: 0.5rem 1rem; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; font-weight: 500; border-radius: 0.5rem; text-decoration: none; display: inline-block;">
                Edit Teacher
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

            <!-- Teacher Info Card -->
            <div style="background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%); border-radius: 1rem; padding: 2rem; box-shadow: 0 4px 12px rgba(168, 85, 247, 0.1); margin-bottom: 2rem; overflow: hidden; border: 1px solid #f3e8ff;">
    <!-- Header Section -->
    <div style="display: flex; align-items: center; margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 2px solid #f3e8ff;">
        <div style="position: relative;">
            <div style="background: linear-gradient(135deg, #a855f7 0%, #7c3aed 100%); border-radius: 50%; width: 88px; height: 88px; display: flex; align-items: center; justify-content: center; margin-right: 1.5rem; box-shadow: 0 4px 12px rgba(168, 85, 247, 0.25);">
                <span style="color: white; font-size: 2.25rem; font-weight: 700; letter-spacing: -0.5px;">{{ substr($teacher->name, 0, 1) }}</span>
            </div>
            <!-- Status indicator -->
            <div style="position: absolute; bottom: 0; right: 20px; width: 20px; height: 20px; background: linear-gradient(135deg, #10b981, #059669); border: 3px solid white; border-radius: 50%; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"></div>
        </div>
        <div style="flex: 1;">
            <h3 style="font-size: 1.625rem; font-weight: 700; color: #1f2937; margin: 0 0 0.5rem 0; background: linear-gradient(135deg, #1f2937, #4b5563); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                {{ $teacher->name }}
            </h3>
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <svg style="width: 16px; height: 16px; color: #9333ea;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <p style="color: #6b7280; font-size: 0.9375rem; margin: 0; font-weight: 500;">{{ $teacher->email }}</p>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1.25rem;">
        <!-- Total Modules -->
        <div style="background: white; border-radius: 0.75rem; padding: 1.25rem; border: 1px solid #f3e8ff; position: relative; overflow: hidden; transition: all 0.2s ease;"
             onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 16px rgba(168, 85, 247, 0.15)';"
             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
            <div style="position: absolute; top: -10px; right: -10px; width: 60px; height: 60px; background: linear-gradient(135deg, #f3e8ff, #e9d5ff); border-radius: 50%; opacity: 0.5;"></div>
            <div style="position: relative; z-index: 1;">
                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.75rem;">
                    <svg style="width: 18px; height: 18px; color: #a855f7;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <p style="font-size: 0.8125rem; color: #6b7280; margin: 0; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Total Modules</p>
                </div>
                <p style="font-size: 2rem; font-weight: 700; margin: 0; background: linear-gradient(135deg, #a855f7, #7c3aed); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    {{ $teacher->modules->count() }}
                </p>
            </div>
        </div>

        <!-- Member Since -->
        <div style="background: white; border-radius: 0.75rem; padding: 1.25rem; border: 1px solid #f3e8ff; position: relative; overflow: hidden; transition: all 0.2s ease;"
             onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 16px rgba(168, 85, 247, 0.15)';"
             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
            <div style="position: absolute; top: -10px; right: -10px; width: 60px; height: 60px; background: linear-gradient(135deg, #ddd6fe, #c4b5fd); border-radius: 50%; opacity: 0.5;"></div>
            <div style="position: relative; z-index: 1;">
                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.75rem;">
                    <svg style="width: 18px; height: 18px; color: #8b5cf6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p style="font-size: 0.8125rem; color: #6b7280; margin: 0; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Member Since</p>
                </div>
                <p style="font-size: 1.125rem; font-weight: 700; color: #1f2937; margin: 0;">
                    {{ $teacher->created_at->format('M d, Y') }}
                </p>
            </div>
        </div>

        <!-- Last Updated -->
        <div style="background: white; border-radius: 0.75rem; padding: 1.25rem; border: 1px solid #f3e8ff; position: relative; overflow: hidden; transition: all 0.2s ease;"
             onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 16px rgba(168, 85, 247, 0.15)';"
             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
            <div style="position: absolute; top: -10px; right: -10px; width: 60px; height: 60px; background: linear-gradient(135deg, #e9d5ff, #f3e8ff); border-radius: 50%; opacity: 0.5;"></div>
            <div style="position: relative; z-index: 1;">
                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.75rem;">
                    <svg style="width: 18px; height: 18px; color: #7c3aed;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p style="font-size: 0.8125rem; color: #6b7280; margin: 0; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Last Updated</p>
                </div>
                <p style="font-size: 1.125rem; font-weight: 700; color: #1f2937; margin: 0;">
                    {{ $teacher->updated_at->diffForHumans() }}
                </p>
            </div>
        </div>
    </div>
</div>

            <!-- Assigned Modules -->
            <div style="background-color: #f8f9fa; border-radius: 0.75rem; padding: 1.5rem 2rem;">
                <div style="margin-bottom: 1.5rem;">
                    <h3 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin: 0 0 0.25rem 0;">
                        Assigned Modules
                    </h3>
                    <p style="font-size: 0.9375rem; color: #6b7280; margin: 0;">
                        {{ $teacher->modules->count() }} active module(s)
                    </p>
                </div>

                @if($teacher->modules->count() > 0)
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 1.25rem;">
                    @foreach($teacher->modules as $module)
                    <div style="background: white; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06); transition: all 0.2s ease; cursor: pointer;"
                        onmouseover="this.style.boxShadow='0 4px 16px rgba(0,0,0,0.1)'; this.style.transform='translateY(-2px)';"
                        onmouseout="this.style.boxShadow='0 2px 8px rgba(0, 0, 0, 0.06)'; this.style.transform='translateY(0)';">

                        <div style="display: flex; align-items: flex-start; gap: 1rem;">
                            <!-- Module Icon/Avatar -->
                            <div style="flex-shrink: 0; width: 64px; height: 64px; background: linear-gradient(135deg, #3b82f6, #8b5cf6); border-radius: 0.625rem; display: flex; align-items: center; justify-content: center;">
                                <span style="color: white; font-size: 1.5rem; font-weight: 700; letter-spacing: -0.5px;">
                                    {{ strtoupper(substr($module->code, 0, 2)) }}
                                </span>
                            </div>

                            <!-- Module Info -->
                            <div style="flex: 1; min-width: 0;">
                                <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 0.75rem; margin-bottom: 0.5rem;">
                                    <h4 style="font-size: 1.0625rem; font-weight: 600; color: #1f2937; margin: 0; line-height: 1.4;">
                                        {{ $module->name }}
                                    </h4>
                                    <span style="flex-shrink: 0; padding: 0.25rem 0.75rem; border-radius: 0.375rem; font-size: 0.8125rem; font-weight: 500;
                                             background-color: {{ $module->is_available ? '#fef3c7' : '#fee2e2' }}; 
                                             color: {{ $module->is_available ? '#92400e' : '#991b1b' }};">
                                        {{ $module->is_available ? 'In Progress' : 'Inactive' }}
                                    </span>
                                </div>

                                <p style="font-size: 0.9375rem; color: #6b7280; margin: 0 0 0.75rem 0; font-weight: 500;">
                                    {{ $module->code }}
                                </p>

                                <!-- Enrollment Date -->
                                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                                    <svg style="width: 16px; height: 16px; color: #9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span style="font-size: 0.875rem; color: #6b7280;">
                                        Assigned {{ $module->created_at->format('M d, Y') }}
                                    </span>
                                </div>

                                <!-- Students Enrolled -->
                                <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.75rem; background-color: #f9fafb; border-radius: 0.5rem; margin-bottom: 1rem;">
                                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                                        <svg style="width: 18px; height: 18px; color: #6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        <span style="font-size: 0.875rem; color: #6b7280; font-weight: 500;">Students Enrolled</span>
                                    </div>
                                    <span style="font-size: 0.9375rem; color: #1f2937; font-weight: 600;">
                                        {{ $module->activeEnrollments->count() }} / {{ $module->max_students }}
                                    </span>
                                </div>

                                <!-- Progress Bar -->
                                @php
                                $enrollmentPercentage = $module->max_students > 0 ? ($module->activeEnrollments->count() / $module->max_students) * 100 : 0;
                                @endphp
                                <div style="width: 100%; background-color: #e5e7eb; border-radius: 9999px; height: 8px; overflow: hidden; margin-bottom: 1rem;">
                                    <div style="height: 100%; border-radius: 9999px; transition: width 0.3s ease;
                                            width: {{ min($enrollmentPercentage, 100) }}%;
                                            background: {{ $enrollmentPercentage >= 90 ? 'linear-gradient(90deg, #f59e0b, #ef4444)' : ($enrollmentPercentage >= 75 ? 'linear-gradient(90deg, #8b5cf6, #ec4899)' : 'linear-gradient(90deg, #3b82f6, #8b5cf6)') }};">
                                    </div>
                                </div>

                                <!-- Action Button -->
                                <a href="{{ route('admin.modules.show', $module) }}"
                                    style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.625rem 1.25rem; background-color: #f3e8ff; border: 1px solid #e9d5ff; border-radius: 0.5rem; color: #7c3aed; font-size: 0.875rem; font-weight: 600; text-decoration: none; transition: all 0.2s ease;"
                                    onmouseover="this.style.backgroundColor='#ede9fe'; this.style.borderColor='#d8b4fe'; this.style.color='#6d28d9';"
                                    onmouseout="this.style.backgroundColor='#f3e8ff'; this.style.borderColor='#e9d5ff'; this.style.color='#7c3aed';">
                                    View Module Details
                                    <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div style="text-align: center; padding: 4rem 2rem; background: white; border-radius: 0.75rem; border: 2px dashed #d1d5db;">
                    <div style="background: linear-gradient(135deg, #e0e7ff, #ddd6fe); border-radius: 50%; width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                        <svg style="width: 40px; height: 40px; color: #6366f1;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <p style="color: #1f2937; font-size: 1.125rem; font-weight: 600; margin: 0 0 0.5rem 0;">No modules assigned yet</p>
                    <p style="color: #6b7280; font-size: 0.9375rem; margin: 0; line-height: 1.5;">Assign this teacher to modules from the module management page</p>
                </div>
                @endif
            </div>

        </div>
    </div>
</x-admin-layout>