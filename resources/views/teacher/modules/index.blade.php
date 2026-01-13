@extends('layouts.teacher-layout')

@section('content')

<div style="padding: 2rem 0; background-color: #fdfcfb; min-height: 100vh;">
    <div style="max-width: 1400px; margin: 0 auto; padding: 0 2rem;">
        
        <!-- Page Header -->
        <div style="margin-bottom: 3rem;">
            <h1 style="font-family: 'Playfair Display', serif; font-size: 2.5rem; font-weight: 700; color: #1a1a1a; margin: 0 0 0.5rem 0; line-height: 1.2;">
                My Modules
            </h1>
            <p style="font-family: 'Inter', sans-serif; font-size: 1rem; color: #6b7280; margin: 0; font-weight: 500;">
                View and manage your assigned teaching modules
            </p>
        </div>

        @if($modules->count() > 0)
            <!-- Modules Grid -->
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(360px, 1fr)); gap: 1.5rem;">
                @foreach($modules as $module)
                    <div style="background-color: white; border: 2px solid #e5e7eb; border-radius: 16px; padding: 2rem; transition: all 0.2s;"
                         onmouseover="this.style.transform='translateY(-4px)'; this.style.borderColor='#d8b4fe'; this.style.boxShadow='0 12px 24px rgba(216, 180, 254, 0.15)'"
                         onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'">
                        
                        <!-- Module Header -->
                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 2px solid #f3f4f6;">
                            <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <span style="color: #1a1a1a; font-weight: 700; font-size: 1.25rem; font-family: 'Inter', sans-serif;">{{ substr($module->code, 0, 2) }}</span>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <h3 style="font-family: 'Playfair Display', serif; font-size: 1.125rem; font-weight: 700; color: #1a1a1a; margin: 0 0 0.25rem 0; line-height: 1.3;">
                                    {{ $module->name }}
                                </h3>
                                <p style="font-family: 'Inter', sans-serif; font-size: 0.875rem; color: #6b7280; margin: 0; font-weight: 500;">
                                    {{ $module->code }}
                                </p>
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.75rem; margin-bottom: 1.5rem;">
                            <!-- Total -->
                            <div style="text-align: center;">
                                <p style="font-family: 'Inter', sans-serif; font-size: 1.5rem; font-weight: 700; color: #1a1a1a; margin: 0 0 0.25rem 0;">{{ $module->total_students }}</p>
                                <p style="font-family: 'Inter', sans-serif; font-size: 0.75rem; color: #6b7280; margin: 0; font-weight: 600;">Total</p>
                            </div>
                            <!-- Active -->
                            <div style="text-align: center;">
                                <p style="font-family: 'Inter', sans-serif; font-size: 1.5rem; font-weight: 700; color: #f59e0b; margin: 0 0 0.25rem 0;">{{ $module->active_students }}</p>
                                <p style="font-family: 'Inter', sans-serif; font-size: 0.75rem; color: #6b7280; margin: 0; font-weight: 600;">Active</p>
                            </div>
                            <!-- Passed -->
                            <div style="text-align: center;">
                                <p style="font-family: 'Inter', sans-serif; font-size: 1.5rem; font-weight: 700; color: #10b981; margin: 0 0 0.25rem 0;">{{ $module->passed_students }}</p>
                                <p style="font-family: 'Inter', sans-serif; font-size: 0.75rem; color: #6b7280; margin: 0; font-weight: 600;">Passed</p>
                            </div>
                            <!-- Failed -->
                            <div style="text-align: center;">
                                <p style="font-family: 'Inter', sans-serif; font-size: 1.5rem; font-weight: 700; color: #ef4444; margin: 0 0 0.25rem 0;">{{ $module->failed_students }}</p>
                                <p style="font-family: 'Inter', sans-serif; font-size: 0.75rem; color: #6b7280; margin: 0; font-weight: 600;">Failed</p>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div style="margin-bottom: 1.5rem;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                <span style="font-family: 'Inter', sans-serif; font-size: 0.75rem; font-weight: 600; color: #6b7280;">Completion Rate</span>
                                <span style="font-family: 'Inter', sans-serif; font-size: 0.75rem; font-weight: 700; color: #1a1a1a;">
                                    {{ $module->total_students > 0 ? round((($module->passed_students + $module->failed_students) / $module->total_students) * 100) : 0 }}%
                                </span>
                            </div>
                            <div style="width: 100%; height: 6px; background-color: #f3f4f6; border-radius: 50px; overflow: hidden;">
                                <div style="height: 100%; background: linear-gradient(90deg, #d8b4fe 0%, #c084fc 100%); border-radius: 50px; width: {{ $module->total_students > 0 ? round((($module->passed_students + $module->failed_students) / $module->total_students) * 100) : 0 }}%; transition: width 0.3s;"></div>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <a href="{{ route('teacher.modules.show', $module) }}" 
                           style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; width: 100%; padding: 0.875rem; background: white; color: #1a1a1a; font-weight: 600; font-size: 0.9375rem; border: 2px solid #e5e7eb; border-radius: 50px; text-align: center; text-decoration: none; transition: all 0.2s; font-family: 'Inter', sans-serif;"
                           onmouseover="this.style.background='#1a1a1a'; this.style.color='white'; this.style.borderColor='#1a1a1a'"
                           onmouseout="this.style.background='white'; this.style.color='#1a1a1a'; this.style.borderColor='#e5e7eb'">
                            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            View & Grade Students
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div style="text-align: center; padding: 4rem 2rem; background-color: white; border: 2px solid #e5e7eb; border-radius: 16px;">
                <div style="width: 100px; height: 100px; background: linear-gradient(135deg, #e9d5ff 0%, #d8b4fe 100%); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 2rem;">
                    <svg style="width: 50px; height: 50px; color: #1a1a1a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h3 style="font-family: 'Playfair Display', serif; font-size: 1.5rem; font-weight: 700; color: #1a1a1a; margin: 0 0 0.75rem 0;">No Modules Assigned</h3>
                <p style="font-family: 'Inter', sans-serif; font-size: 1rem; color: #6b7280; margin: 0 0 0.5rem 0; font-weight: 500;">You haven't been assigned to any modules yet</p>
                <p style="font-family: 'Inter', sans-serif; font-size: 0.875rem; color: #9ca3af; margin: 0;">Contact your administrator to get modules assigned</p>
            </div>
        @endif

    </div>
</div>

@endsection