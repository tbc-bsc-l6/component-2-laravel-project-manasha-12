<x-admin-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Teacher Details: {{ $teacher->name }}
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
            <div style="background-color: white; border-radius: 1rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 2rem;">
                <div style="display: flex; align-items: center; margin-bottom: 2rem;">
                    <div style="background: linear-gradient(135deg, #a855f7 0%, #9333ea 100%); border-radius: 50%; width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; margin-right: 1.5rem;">
                        <span style="color: white; font-size: 2rem; font-weight: 700;">{{ substr($teacher->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <h3 style="font-size: 1.5rem; font-weight: 600; color: #111827; margin-bottom: 0.5rem;">{{ $teacher->name }}</h3>
                        <p style="color: #6b7280; font-size: 0.875rem;">{{ $teacher->email }}</p>
                    </div>
                </div>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
                    <div>
                        <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 0.25rem;">Total Modules</p>
                        <p style="font-size: 1.5rem; font-weight: 700; color: #a855f7;">{{ $teacher->modules->count() }}</p>
                    </div>
                    <div>
                        <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 0.25rem;">Member Since</p>
                        <p style="font-size: 1.125rem; font-weight: 600; color: #111827;">{{ $teacher->created_at->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 0.25rem;">Last Updated</p>
                        <p style="font-size: 1.125rem; font-weight: 600; color: #111827;">{{ $teacher->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>

            <!-- Assigned Modules -->
            <div style="background-color: white; border-radius: 1rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h3 style="font-size: 1.25rem; font-weight: 600; color: #111827; margin-bottom: 1.5rem;">
                    Assigned Modules ({{ $teacher->modules->count() }})
                </h3>

                @if($teacher->modules->count() > 0)
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
                        @foreach($teacher->modules as $module)
                            <div style="border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1.5rem; transition: box-shadow 0.2s;">
                                <div style="display: flex; justify-content: between; align-items: start; margin-bottom: 1rem;">
                                    <div style="flex: 1;">
                                        <h4 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin-bottom: 0.5rem;">
                                            {{ $module->name }}
                                        </h4>
                                        <p style="font-size: 0.875rem; color: #6b7280;">{{ $module->code }}</p>
                                    </div>
                                    <span style="display: inline-block; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; 
                                                 background-color: {{ $module->is_available ? '#d1fae5' : '#fee2e2' }}; 
                                                 color: {{ $module->is_available ? '#065f46' : '#991b1b' }};">
                                        {{ $module->is_available ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>

                                <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 1rem; border-top: 1px solid #e5e7eb;">
                                    <span style="font-size: 0.875rem; color: #6b7280;">
                                        {{ $module->activeEnrollments->count() }} / {{ $module->max_students }} students
                                    </span>
                                    <a href="{{ route('admin.modules.show', $module) }}" 
                                       style="color: #3b82f6; font-size: 0.875rem; font-weight: 500; text-decoration: none;">
                                        View Module →
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; padding: 3rem 0;">
                        <div style="background-color: #f3e8ff; border-radius: 50%; width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                            <svg style="width: 40px; height: 40px; color: #9333ea;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <p style="color: #6b7280; font-size: 1.125rem; margin-bottom: 1rem;">No modules assigned yet</p>
                        <p style="color: #9ca3af; font-size: 0.875rem;">Assign this teacher to modules from the module management page</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-admin-layout>