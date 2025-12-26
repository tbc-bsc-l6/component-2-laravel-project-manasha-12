@extends('layouts.teacher-layout')

@section('content')

<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Welcome Message -->
        <div style="background: linear-gradient(135deg, #a855f7 0%, #9333ea 100%); border-radius: 1rem; padding: 2rem; margin-bottom: 2rem; color: white;">
            <h1 style="font-size: 1.875rem; font-weight: 700; margin: 0 0 0.5rem 0;">Welcome back, {{ auth('teacher')->user()->name }}!</h1>
            <p style="font-size: 1rem; opacity: 0.9; margin: 0;">Manage your modules and evaluate student performance</p>
        </div>

        <!-- Statistics Cards -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
            
            <!-- Total Modules -->
            <div style="background-color: var(--card-bg, white); border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #a855f7;">
                <div style="display: flex; justify-content: space-between; align-items: start;">
                    <div>
                        <p style="font-size: 0.875rem; color: var(--text-secondary, #6b7280); margin: 0 0 0.5rem 0;">Assigned Modules</p>
                        <p style="font-size: 2rem; font-weight: 700; color: var(--text-primary, #111827); margin: 0;">{{ $stats['total_modules'] ?? 0 }}</p>
                    </div>
                    <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #ede9fe 0%, #ddd6fe 100%); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 24px; height: 24px; color: #a855f7;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Students -->
            <div style="background-color: var(--card-bg, white); border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #3b82f6;">
                <div style="display: flex; justify-content: space-between; align-items: start;">
                    <div>
                        <p style="font-size: 0.875rem; color: var(--text-secondary, #6b7280); margin: 0 0 0.5rem 0;">Total Students</p>
                        <p style="font-size: 2rem; font-weight: 700; color: var(--text-primary, #111827); margin: 0;">{{ $stats['total_students'] ?? 0 }}</p>
                    </div>
                    <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 24px; height: 24px; color: #3b82f6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pending Evaluations -->
            <div style="background-color: var(--card-bg, white); border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #f59e0b;">
                <div style="display: flex; justify-content: space-between; align-items: start;">
                    <div>
                        <p style="font-size: 0.875rem; color: var(--text-secondary, #6b7280); margin: 0 0 0.5rem 0;">Pending Evaluations</p>
                        <p style="font-size: 2rem; font-weight: 700; color: var(--text-primary, #111827); margin: 0;">{{ $stats['pending_evaluations'] ?? 0 }}</p>
                    </div>
                    <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 24px; height: 24px; color: #f59e0b;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Completed Evaluations -->
            <div style="background-color: var(--card-bg, white); border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #10b981;">
                <div style="display: flex; justify-content: space-between; align-items: start;">
                    <div>
                        <p style="font-size: 0.875rem; color: var(--text-secondary, #6b7280); margin: 0 0 0.5rem 0;">Completed</p>
                        <p style="font-size: 2rem; font-weight: 700; color: var(--text-primary, #111827); margin: 0;">{{ $stats['completed_evaluations'] ?? 0 }}</p>
                    </div>
                    <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 24px; height: 24px; color: #10b981;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

        </div>

        <!-- My Modules -->
        <div style="background-color: var(--card-bg, white); border-radius: 1rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h3 style="font-size: 1.25rem; font-weight: 600; color: var(--text-primary, #111827); margin: 0;">My Modules</h3>
            </div>

            @if($modules->count() > 0)
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
                    @foreach($modules as $module)
                        <a href="{{ route('teacher.modules.show', $module) }}" style="text-decoration: none;">
                            <div style="background-color: var(--bg-tertiary, #f9fafb); border-radius: 0.75rem; padding: 1.5rem; border: 1px solid var(--border-color, #e5e7eb); transition: all 0.2s;"
                                 onmouseover="this.style.borderColor='#a855f7'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(168, 85, 247, 0.1)'"
                                 onmouseout="this.style.borderColor='var(--border-color, #e5e7eb)'; this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                
                                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                                    <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #a855f7 0%, #9333ea 100%); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <span style="color: white; font-weight: 700; font-size: 0.875rem;">{{ substr($module->code, 0, 2) }}</span>
                                    </div>
                                    <div style="flex: 1; min-width: 0;">
                                        <h4 style="font-size: 1rem; font-weight: 600; color: var(--text-primary, #111827); margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $module->name }}</h4>
                                        <p style="font-size: 0.75rem; color: var(--text-secondary, #6b7280); margin: 0;">{{ $module->code }}</p>
                                    </div>
                                </div>

                                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; padding-top: 1rem; border-top: 1px solid var(--border-color, #e5e7eb);">
                                    <div>
                                        <p style="font-size: 0.75rem; color: var(--text-secondary, #6b7280); margin: 0 0 0.25rem 0;">Active</p>
                                        <p style="font-size: 1.25rem; font-weight: 700; color: var(--text-primary, #111827); margin: 0;">{{ $module->pending_count ?? 0 }}</p>
                                    </div>
                                    <div>
                                        <p style="font-size: 0.75rem; color: var(--text-secondary, #6b7280); margin: 0 0 0.25rem 0;">Completed</p>
                                        <p style="font-size: 1.25rem; font-weight: 700; color: var(--text-primary, #111827); margin: 0;">{{ $module->completed_count ?? 0 }}</p>
                                    </div>
                                    <div>
                                        <p style="font-size: 0.75rem; color: var(--text-secondary, #6b7280); margin: 0 0 0.25rem 0;">Total</p>
                                        <p style="font-size: 1.25rem; font-weight: 700; color: var(--text-primary, #111827); margin: 0;">{{ ($module->pending_count ?? 0) + ($module->completed_count ?? 0) }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div style="text-align: center; padding: 3rem 0;">
                    <svg style="width: 64px; height: 64px; color: var(--text-tertiary, #9ca3af); margin: 0 auto 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <p style="font-size: 1.125rem; color: var(--text-secondary, #6b7280); margin: 0;">No modules assigned yet</p>
                    <p style="font-size: 0.875rem; color: var(--text-tertiary, #9ca3af); margin: 0.5rem 0 0 0;">Contact your administrator to get modules assigned</p>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection