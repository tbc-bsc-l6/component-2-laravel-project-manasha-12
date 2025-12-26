@extends('layouts.teacher-layout')

@section('content')

<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Page Header -->
        <div style="margin-bottom: 2rem;">
            <h1 style="font-size: 1.875rem; font-weight: 700; color: var(--text-primary, #111827); margin: 0 0 0.5rem 0;">My Modules</h1>
            <p style="font-size: 0.875rem; color: var(--text-secondary, #6b7280); margin: 0;">View and manage your assigned modules</p>
        </div>

        @if($modules->count() > 0)
            <!-- Modules Grid -->
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 1.5rem;">
                @foreach($modules as $module)
                    <div style="background-color: var(--card-bg, white); border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid var(--border-color, #e5e7eb); transition: all 0.2s;"
                         onmouseover="this.style.borderColor='#a855f7'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(168, 85, 247, 0.15)'"
                         onmouseout="this.style.borderColor='var(--border-color, #e5e7eb)'; this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.1)'">
                        
                        <!-- Module Header -->
                        <div style="display: flex; align-items: start; gap: 1rem; margin-bottom: 1rem;">
                            <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #a855f7 0%, #9333ea 100%); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <span style="color: white; font-weight: 700; font-size: 1.25rem;">{{ substr($module->code, 0, 2) }}</span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary, #111827); margin: 0 0 0.25rem 0;">
                                    {{ $module->name }}
                                </h3>
                                <p style="font-size: 0.875rem; color: var(--text-secondary, #6b7280); margin: 0;">
                                    {{ $module->code }}
                                </p>
                            </div>
                        </div>

                        <!-- Stats Grid -->
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-bottom: 1rem; padding: 1rem; background-color: var(--bg-tertiary, #f9fafb); border-radius: 0.5rem;">
                            <div>
                                <p style="font-size: 0.75rem; color: var(--text-secondary, #6b7280); margin: 0 0 0.25rem 0; text-transform: uppercase; font-weight: 600;">Total</p>
                                <p style="font-size: 1.5rem; font-weight: 700; color: var(--text-primary, #111827); margin: 0;">{{ $module->total_students }}</p>
                            </div>
                            <div>
                                <p style="font-size: 0.75rem; color: var(--text-secondary, #6b7280); margin: 0 0 0.25rem 0; text-transform: uppercase; font-weight: 600;">Active</p>
                                <p style="font-size: 1.5rem; font-weight: 700; color: #f59e0b; margin: 0;">{{ $module->active_students }}</p>
                            </div>
                            <div>
                                <p style="font-size: 0.75rem; color: var(--text-secondary, #6b7280); margin: 0 0 0.25rem 0; text-transform: uppercase; font-weight: 600;">Passed</p>
                                <p style="font-size: 1.5rem; font-weight: 700; color: #10b981; margin: 0;">{{ $module->passed_students }}</p>
                            </div>
                            <div>
                                <p style="font-size: 0.75rem; color: var(--text-secondary, #6b7280); margin: 0 0 0.25rem 0; text-transform: uppercase; font-weight: 600;">Failed</p>
                                <p style="font-size: 1.5rem; font-weight: 700; color: #ef4444; margin: 0;">{{ $module->failed_students }}</p>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <a href="{{ route('teacher.modules.show', $module) }}" 
                           style="display: block; width: 100%; padding: 0.75rem; background: linear-gradient(135deg, #a855f7 0%, #9333ea 100%); color: white; font-weight: 600; font-size: 0.875rem; border-radius: 0.5rem; text-align: center; text-decoration: none; transition: all 0.2s;"
                           onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 12px rgba(168, 85, 247, 0.3)'"
                           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                            View Students & Grade
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div style="text-align: center; padding: 4rem 2rem; background-color: var(--card-bg, white); border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <svg style="width: 80px; height: 80px; color: var(--text-tertiary, #9ca3af); margin: 0 auto 1.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <h3 style="font-size: 1.25rem; font-weight: 600; color: var(--text-primary, #111827); margin: 0 0 0.5rem 0;">No Modules Assigned</h3>
                <p style="font-size: 0.875rem; color: var(--text-secondary, #6b7280); margin: 0 0 1.5rem 0;">You haven't been assigned to any modules yet.</p>
                <p style="font-size: 0.875rem; color: var(--text-tertiary, #9ca3af); margin: 0;">Contact your administrator to get modules assigned to you.</p>
            </div>
        @endif

    </div>
</div>

@endsection