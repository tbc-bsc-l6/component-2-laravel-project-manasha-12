@extends('layouts.teacher-layout')

@section('content')

<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Back Button & Header -->
        <div style="margin-bottom: 2rem;">
            <a href="{{ route('teacher.modules.index') }}" 
               style="display: inline-flex; align-items: center; font-size: 0.875rem; color: #a855f7; font-weight: 500; text-decoration: none; margin-bottom: 1rem;"
               onmouseover="this.style.color='#9333ea'"
               onmouseout="this.style.color='#a855f7'">
                <svg style="width: 16px; height: 16px; margin-right: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to My Modules
            </a>
            
            <div style="display: flex; justify-content: space-between; align-items: start;">
                <div>
                    <h1 style="font-size: 1.875rem; font-weight: 700; color: var(--text-primary, #111827); margin: 0 0 0.5rem 0;">{{ $module->name }}</h1>
                    <p style="font-size: 0.875rem; color: var(--text-secondary, #6b7280); margin: 0;">{{ $module->code }}</p>
                </div>
                <div style="padding: 0.5rem 1rem; background: linear-gradient(135deg, #ede9fe 0%, #ddd6fe 100%); border-radius: 0.5rem;">
                    <span style="font-size: 0.875rem; font-weight: 600; color: #7e22ce;">Max Students: {{ $module->max_students }}</span>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
            <div style="background-color: var(--card-bg, white); border-radius: 0.75rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #3b82f6;">
                <p style="font-size: 0.875rem; color: var(--text-secondary, #6b7280); margin: 0 0 0.5rem 0;">Total Students</p>
                <p style="font-size: 2rem; font-weight: 700; color: var(--text-primary, #111827); margin: 0;">{{ $stats['total_students'] }}</p>
            </div>
            <div style="background-color: var(--card-bg, white); border-radius: 0.75rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #f59e0b;">
                <p style="font-size: 0.875rem; color: var(--text-secondary, #6b7280); margin: 0 0 0.5rem 0;">Pending Evaluation</p>
                <p style="font-size: 2rem; font-weight: 700; color: var(--text-primary, #111827); margin: 0;">{{ $stats['active_students'] }}</p>
            </div>
            <div style="background-color: var(--card-bg, white); border-radius: 0.75rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #10b981;">
                <p style="font-size: 0.875rem; color: var(--text-secondary, #6b7280); margin: 0 0 0.5rem 0;">Passed</p>
                <p style="font-size: 2rem; font-weight: 700; color: var(--text-primary, #111827); margin: 0;">{{ $stats['passed_students'] }}</p>
            </div>
            <div style="background-color: var(--card-bg, white); border-radius: 0.75rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #ef4444;">
                <p style="font-size: 0.875rem; color: var(--text-secondary, #6b7280); margin: 0 0 0.5rem 0;">Failed</p>
                <p style="font-size: 2rem; font-weight: 700; color: var(--text-primary, #111827); margin: 0;">{{ $stats['failed_students'] }}</p>
            </div>
            <div style="background-color: var(--card-bg, white); border-radius: 0.75rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #a855f7;">
                <p style="font-size: 0.875rem; color: var(--text-secondary, #6b7280); margin: 0 0 0.5rem 0;">Pass Rate</p>
                <p style="font-size: 2rem; font-weight: 700; color: var(--text-primary, #111827); margin: 0;">{{ $stats['pass_rate'] }}%</p>
            </div>
        </div>

        <!-- Active Students - Pending Evaluation -->
        @if($activeEnrollments->count() > 0)
            <div style="background-color: var(--card-bg, white); border-radius: 1rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 2rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <h2 style="font-size: 1.25rem; font-weight: 600; color: var(--text-primary, #111827); margin: 0;">Students Pending Evaluation</h2>
                    <span style="padding: 0.375rem 0.75rem; background-color: #fef3c7; color: #92400e; font-size: 0.875rem; font-weight: 600; border-radius: 0.375rem;">{{ $activeEnrollments->count() }} students</span>
                </div>

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="border-bottom: 2px solid var(--border-color, #e5e7eb);">
                                <th style="padding: 0.75rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: var(--text-secondary, #6b7280);">Student</th>
                                <th style="padding: 0.75rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: var(--text-secondary, #6b7280);">Email</th>
                                <th style="padding: 0.75rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: var(--text-secondary, #6b7280);">Enrolled</th>
                                <th style="padding: 0.75rem; text-align: center; font-size: 0.875rem; font-weight: 600; color: var(--text-secondary, #6b7280);">Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activeEnrollments as $enrollment)
                                <tr style="border-bottom: 1px solid var(--border-color, #e5e7eb);">
                                    <td style="padding: 1rem; font-size: 0.875rem; color: var(--text-primary, #111827); font-weight: 500;">
                                        {{ $enrollment->student->name }}
                                    </td>
                                    <td style="padding: 1rem; font-size: 0.875rem; color: var(--text-secondary, #6b7280);">
                                        {{ $enrollment->student->email }}
                                    </td>
                                    <td style="padding: 1rem; font-size: 0.875rem; color: var(--text-secondary, #6b7280);">
                                        {{ $enrollment->enrolled_at->format('M d, Y') }}
                                    </td>
                                    <td style="padding: 1rem; text-align: center;">
                                        <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                            <form method="POST" action="{{ route('teacher.modules.grade-student', [$module, $enrollment]) }}" style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="pass_status" value="PASS">
                                                <button type="submit" 
                                                        onclick="return confirm('Mark {{ $enrollment->student->name }} as PASS?')"
                                                        style="padding: 0.5rem 1rem; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; font-weight: 600; font-size: 0.75rem; border: none; border-radius: 0.375rem; cursor: pointer; transition: all 0.2s;"
                                                        onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 8px rgba(16, 185, 129, 0.3)'"
                                                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                                    PASS
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('teacher.modules.grade-student', [$module, $enrollment]) }}" style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="pass_status" value="FAIL">
                                                <button type="submit" 
                                                        onclick="return confirm('Mark {{ $enrollment->student->name }} as FAIL?')"
                                                        style="padding: 0.5rem 1rem; background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; font-weight: 600; font-size: 0.75rem; border: none; border-radius: 0.375rem; cursor: pointer; transition: all 0.2s;"
                                                        onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 8px rgba(239, 68, 68, 0.3)'"
                                                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                                    FAIL
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div style="background-color: var(--card-bg, white); border-radius: 1rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 2rem; text-align: center;">
                <svg style="width: 64px; height: 64px; color: var(--text-tertiary, #9ca3af); margin: 0 auto 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary, #111827); margin: 0 0 0.5rem 0;">No Pending Evaluations</h3>
                <p style="font-size: 0.875rem; color: var(--text-secondary, #6b7280); margin: 0;">All active students have been evaluated.</p>
            </div>
        @endif

        <!-- Completed Students -->
        @if($completedEnrollments->count() > 0)
            <div style="background-color: var(--card-bg, white); border-radius: 1rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <h2 style="font-size: 1.25rem; font-weight: 600; color: var(--text-primary, #111827); margin: 0;">Completed Students</h2>
                    <span style="padding: 0.375rem 0.75rem; background-color: #dbeafe; color: #1e40af; font-size: 0.875rem; font-weight: 600; border-radius: 0.375rem;">{{ $completedEnrollments->count() }} students</span>
                </div>

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="border-bottom: 2px solid var(--border-color, #e5e7eb);">
                                <th style="padding: 0.75rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: var(--text-secondary, #6b7280);">Student</th>
                                <th style="padding: 0.75rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: var(--text-secondary, #6b7280);">Email</th>
                                <th style="padding: 0.75rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: var(--text-secondary, #6b7280);">Completed</th>
                                <th style="padding: 0.75rem; text-align: center; font-size: 0.875rem; font-weight: 600; color: var(--text-secondary, #6b7280);">Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($completedEnrollments as $enrollment)
                                <tr style="border-bottom: 1px solid var(--border-color, #e5e7eb);">
                                    <td style="padding: 1rem; font-size: 0.875rem; color: var(--text-primary, #111827); font-weight: 500;">
                                        {{ $enrollment->student->name }}
                                    </td>
                                    <td style="padding: 1rem; font-size: 0.875rem; color: var(--text-secondary, #6b7280);">
                                        {{ $enrollment->student->email }}
                                    </td>
                                    <td style="padding: 1rem; font-size: 0.875rem; color: var(--text-secondary, #6b7280);">
                                        {{ $enrollment->completed_at ? $enrollment->completed_at->format('M d, Y H:i') : 'N/A' }}
                                    </td>
                                    <td style="padding: 1rem; text-align: center;">
                                        
                                        @if(strtoupper(trim($enrollment->pass_status)) === 'PASS')
                                            <span style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; background-color: #d1fae5; color: #065f46; font-size: 0.75rem; font-weight: 700; border-radius: 0.375rem;">
                                                <svg style="width: 14px; height: 14px; margin-right: 0.25rem;" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                </svg>
                                                PASS
                                            </span>
                                        @elseif(strtoupper(trim($enrollment->pass_status)) === 'FAIL')
                                            <span style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; background-color: #fee2e2; color: #991b1b; font-size: 0.75rem; font-weight: 700; border-radius: 0.375rem;">
                                                <svg style="width: 14px; height: 14px; margin-right: 0.25rem;" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                                </svg>
                                                FAIL
                                            </span>
                                        @else
                                            <span style="padding: 0.375rem 0.75rem; background-color: #fef3c7; color: #92400e; font-size: 0.75rem; font-weight: 700; border-radius: 0.375rem;">
                                                PENDING
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    </div>
</div>

@endsection