<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Enrollments Management
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div style="margin-bottom: 1.5rem; background-color: #d1fae5; border-left: 4px solid #10b981; padding: 1rem; border-radius: 0.5rem;">
                    <p style="color: #065f46; font-weight: 500;">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Stats Cards -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                <div style="background: linear-gradient(135deg, #dbeafe 0%, #eff6ff 100%); border: 1px solid #bfdbfe; border-radius: 1rem; padding: 1.5rem;">
                    <p style="font-size: 0.875rem; color: #1e40af; font-weight: 500;">Total Enrollments</p>
                    <p style="font-size: 2rem; font-weight: 700; color: #1e3a8a;">{{ $enrollments->total() }}</p>
                </div>
                
                <div style="background: linear-gradient(135deg, #d1fae5 0%, #e7f9f0 100%); border: 1px solid #a7f3d0; border-radius: 1rem; padding: 1.5rem;">
                    <p style="font-size: 0.875rem; color: #059669; font-weight: 500;">Actively Enrolled Students</p>
                    <p style="font-size: 2rem; font-weight: 700; color: #064e3b;">
                        {{ $enrollments->filter(function($e) { return $e->status === 'active'; })->count() }}
                    </p>
                </div>
            </div>

            <div style="background-color: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                
                @if($enrollments->count() > 0)
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background-color: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                                    <th style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: #374151;">Student</th>
                                    <th style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: #374151;">Module</th>
                                    <th style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: #374151;">Enrolled Date</th>
                                    <th style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: #374151;">Status</th>
                                    <th style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: #374151;">Pass Status</th>
                                    <th style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: #374151;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($enrollments as $enrollment)
                                    <tr style="border-bottom: 1px solid #e5e7eb;">
                                        <td style="padding: 1rem;">
                                            <div>
                                                <p style="font-size: 0.875rem; color: #111827; font-weight: 500;">
                                                    {{ $enrollment->student ? $enrollment->student->name : 'Unknown Student' }}
                                                </p>
                                                <p style="font-size: 0.75rem; color: #6b7280;">
                                                    {{ $enrollment->student ? $enrollment->student->email : 'N/A' }}
                                                </p>
                                            </div>
                                        </td>
                                        <td style="padding: 1rem;">
                                            <div>
                                                <p style="font-size: 0.875rem; color: #111827; font-weight: 500;">
                                                    {{ $enrollment->module ? $enrollment->module->name : 'Unknown Module' }}
                                                </p>
                                                <p style="font-size: 0.75rem; color: #6b7280;">
                                                    {{ $enrollment->module ? $enrollment->module->code : 'N/A' }}
                                                </p>
                                            </div>
                                        </td>
                                        <td style="padding: 1rem; font-size: 0.875rem; color: #6b7280;">
                                            {{ $enrollment->enrolled_at ? $enrollment->enrolled_at->format('M d, Y') : 'N/A' }}
                                        </td>
                                        <td style="padding: 1rem;">
                                            <span style="display: inline-block; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; 
                                                         background-color: {{ $enrollment->status === 'active' ? '#d1fae5' : '#e0e7ff' }}; 
                                                         color: {{ $enrollment->status === 'active' ? '#065f46' : '#4338ca' }};">
                                                {{ ucfirst($enrollment->status) }}
                                            </span>
                                        </td>
                                        <td style="padding: 1rem;">
                                            @if($enrollment->pass_status)
                                                <span style="display: inline-block; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; 
                                                             background-color: {{ $enrollment->pass_status === 'PASS' ? '#d1fae5' : '#fee2e2' }}; 
                                                             color: {{ $enrollment->pass_status === 'PASS' ? '#065f46' : '#991b1b' }};">
                                                    {{ $enrollment->pass_status }}
                                                </span>
                                            @else
                                                <span style="font-size: 0.75rem; color: #9ca3af;">Pending</span>
                                            @endif
                                        </td>
                                        <td style="padding: 1rem;">
                                            <div style="display: flex; gap: 0.75rem;">
                                                @if($enrollment->module)
                                                    <a href="{{ route('admin.modules.show', $enrollment->module) }}" 
                                                       style="color: #3b82f6; font-size: 0.875rem; font-weight: 500; text-decoration: none;">
                                                        View Module
                                                    </a>
                                                @endif
                                                <form action="{{ route('admin.enrollments.destroy', $enrollment) }}" method="POST" 
                                                      onsubmit="return confirm('Remove this enrollment? The student will be unenrolled from this module.');"
                                                      style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            style="color: #ef4444; font-size: 0.875rem; font-weight: 500; background: none; border: none; cursor: pointer; padding: 0;">
                                                        Remove
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
                        {{ $enrollments->links() }}
                    </div>
                @else
                    <div style="text-align: center; padding: 3rem 0;">
                        <div style="background-color: #e0e7ff; border-radius: 50%; width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                            <svg style="width: 40px; height: 40px; color: #4338ca;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <p style="color: #6b7280; font-size: 1.125rem; margin-bottom: 0.5rem;">No enrollments found</p>
                        <p style="color: #9ca3af; font-size: 0.875rem;">Students haven't enrolled in any modules yet</p>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-admin-layout>