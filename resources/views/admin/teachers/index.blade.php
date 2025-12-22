<x-admin-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Teachers Management
            </h2>
            <a href="{{ route('admin.teachers.create') }}" 
               style="padding: 0.5rem 1rem; background: linear-gradient(135deg, #a855f7 0%, #9333ea 100%); color: white; font-weight: 500; border-radius: 0.5rem; text-decoration: none; display: inline-block;">
                Add New Teacher
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

            <div style="background-color: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                
                @if($teachers->count() > 0)
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background-color: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                                    <th style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: #374151;">Name</th>
                                    <th style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: #374151;">Email</th>
                                    <th style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: #374151;">Modules</th>
                                    <th style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: #374151;">Created</th>
                                    <th style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: #374151;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teachers as $teacher)
                                    <tr style="border-bottom: 1px solid #e5e7eb;">
                                        <td style="padding: 1rem; font-size: 0.875rem; color: #111827; font-weight: 500;">
                                            {{ $teacher->name }}
                                        </td>
                                        <td style="padding: 1rem; font-size: 0.875rem; color: #6b7280;">
                                            {{ $teacher->email }}
                                        </td>
                                        <td style="padding: 1rem; font-size: 0.875rem; color: #6b7280;">
                                            <span style="display: inline-block; padding: 0.25rem 0.75rem; background-color: #e0e7ff; color: #4338ca; border-radius: 9999px; font-weight: 600; font-size: 0.75rem;">
                                                {{ $teacher->modules_count }} modules
                                            </span>
                                        </td>
                                        <td style="padding: 1rem; font-size: 0.875rem; color: #6b7280;">
                                            {{ $teacher->created_at->format('M d, Y') }}
                                        </td>
                                        <td style="padding: 1rem;">
                                            <div style="display: flex; gap: 0.75rem;">
                                                <a href="{{ route('admin.teachers.show', $teacher) }}" 
                                                   style="color: #3b82f6; font-size: 0.875rem; font-weight: 500; text-decoration: none;">
                                                    View
                                                </a>
                                                <a href="{{ route('admin.teachers.edit', $teacher) }}" 
                                                   style="color: #f59e0b; font-size: 0.875rem; font-weight: 500; text-decoration: none;">
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST" 
                                                      onsubmit="return confirm('Are you sure you want to delete this teacher? This action cannot be undone.');"
                                                      style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            style="color: #ef4444; font-size: 0.875rem; font-weight: 500; background: none; border: none; cursor: pointer; padding: 0;">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div style="margin-top: 1.5rem;">
                        {{ $teachers->links() }}
                    </div>
                @else
                    <div style="text-align: center; padding: 3rem 0;">
                        <div style="background-color: #f3e8ff; border-radius: 50%; width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                            <svg style="width: 40px; height: 40px; color: #9333ea;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <p style="color: #6b7280; font-size: 1.125rem; margin-bottom: 1rem;">No teachers found</p>
                        <a href="{{ route('admin.teachers.create') }}" 
                           style="display: inline-block; padding: 0.75rem 1.5rem; background: linear-gradient(135deg, #a855f7 0%, #9333ea 100%); color: white; font-weight: 500; border-radius: 0.5rem; text-decoration: none;">
                            Add First Teacher
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-admin-layout>