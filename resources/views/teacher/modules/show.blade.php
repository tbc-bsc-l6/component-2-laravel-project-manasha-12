@extends('layouts.teacher-layout')

@section('content')

<div style="padding: 2rem 0; background-color: #fdfcfb; min-height: 100vh;">
    <div style="max-width: 1400px; margin: 0 auto; padding: 0 2rem;">
        
        <!-- Back Button & Header -->
        <div style="margin-bottom: 2rem;">
            <a href="{{ route('teacher.modules.index') }}" 
               style="display: inline-flex; align-items: center; font-size: 0.875rem; color: #6b7280; font-weight: 600; text-decoration: none; margin-bottom: 1.5rem; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; transition: color 0.2s;"
               onmouseover="this.style.color='#1a1a1a'"
               onmouseout="this.style.color='#6b7280'">
                <svg style="width: 18px; height: 18px; margin-right: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to My Modules
            </a>
            
            <div style="display: flex; justify-content: space-between; align-items: start; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <h1 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 2.5rem; font-weight: 500; color: #1a1a1a; margin: 0 0 0.5rem 0; line-height: 1.2;">
                        {{ $module->name }} 
                    </h1>
                    <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1rem; color: #6b7280; margin: 0; font-weight: 500;">
                        {{ $module->code }}
                    </p>
                </div>
                <div style="padding: 0.75rem 1.25rem; background: #e9d5ff; border-radius: 50px; border: 2px solid #d8b4fe;">
                    <span style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.875rem; font-weight: 700; color: #581c87;">Max Students: {{ $module->max_students }}</span>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.25rem; margin-bottom: 2.5rem;">
            <div style="background: #bfdbfe; border-radius: 20px; padding: 1.75rem; border: 1px solid #93c5fd; transition: all 0.3s;"
                 onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(147, 197, 253, 0.2)'"
                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.75rem; color: #1e3a8a; margin: 0 0 0.75rem 0; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Total Students</p>
                <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 2.5rem; font-weight: 700; color: #1a1a1a; margin: 0;">{{ $stats['total_students'] }}</p>
            </div>
            
            <div style="background: #fde68a; border-radius: 20px; padding: 1.75rem; border: 1px solid #fcd34d; transition: all 0.3s;"
                 onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(253, 224, 71, 0.2)'"
                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.75rem; color: #78350f; margin: 0 0 0.75rem 0; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Pending</p>
                <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 2.5rem; font-weight: 700; color: #1a1a1a; margin: 0;">{{ $stats['active_students'] }}</p>
            </div>
            
            <div style="background: #86efac; border-radius: 20px; padding: 1.75rem; border: 1px solid #4ade80; transition: all 0.3s;"
                 onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(134, 239, 172, 0.2)'"
                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.75rem; color: #064e3b; margin: 0 0 0.75rem 0; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Passed</p>
                <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 2.5rem; font-weight: 700; color: #1a1a1a; margin: 0;">{{ $stats['passed_students'] }}</p>
            </div>
            
            <div style="background: #fca5a5; border-radius: 20px; padding: 1.75rem; border: 1px solid #f87171; transition: all 0.3s;"
                 onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(252, 165, 165, 0.2)'"
                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.75rem; color: #7f1d1d; margin: 0 0 0.75rem 0; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Failed</p>
                <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 2.5rem; font-weight: 700; color: #1a1a1a; margin: 0;">{{ $stats['failed_students'] }}</p>
            </div>
            
            <div style="background: #d8b4fe; border-radius: 20px; padding: 1.75rem; border: 1px solid #c084fc; transition: all 0.3s;"
                 onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(216, 180, 254, 0.2)'"
                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.75rem; color: #581c87; margin: 0 0 0.75rem 0; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Pass Rate</p>
                <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 2.5rem; font-weight: 700; color: #1a1a1a; margin: 0;">{{ $stats['pass_rate'] }}%</p>
            </div>
        </div>

        <!-- Active Students - Pending Evaluation -->
        @if($activeEnrollments->count() > 0)
            <div style="background-color: white; border-radius: 24px; padding: 2rem; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04); border: 1px solid #f3f4f6; margin-bottom: 2rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
                    <h2 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1.25rem; font-weight: 600; color: #1a1a1a; margin: 0;">Students Pending Evaluation</h2>
                    <span style="padding: 0.5rem 1rem; background-color: #fef3c7; color: #78350f; font-size: 0.875rem; font-weight: 700; border-radius: 50px; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ $activeEnrollments->count() }} students</span>
                </div>

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="border-bottom: 2px solid #e5e7eb;">
                                <th style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: #6b7280; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; text-transform: uppercase; letter-spacing: 0.05em;">Student</th>
                                <th style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: #6b7280; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; text-transform: uppercase; letter-spacing: 0.05em;">Email</th>
                                <th style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: #6b7280; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; text-transform: uppercase; letter-spacing: 0.05em;">Enrolled</th>
                                <th style="padding: 1rem; text-align: center; font-size: 0.875rem; font-weight: 600; color: #6b7280; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; text-transform: uppercase; letter-spacing: 0.05em;">Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activeEnrollments as $enrollment)
                                <tr style="border-bottom: 1px solid #f3f4f6; transition: background 0.2s;"
                                    onmouseover="this.style.backgroundColor='#fafafa'"
                                    onmouseout="this.style.backgroundColor='transparent'">
                                    <td style="padding: 1.25rem 1rem; font-size: 0.9375rem; color: #1a1a1a; font-weight: 600; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">
                                        {{ $enrollment->student->name }}
                                    </td>
                                    <td style="padding: 1.25rem 1rem; font-size: 0.875rem; color: #6b7280; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 500;">
                                        {{ $enrollment->student->email }}
                                    </td>
                                    <td style="padding: 1.25rem 1rem; font-size: 0.875rem; color: #6b7280; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 500;">
                                        {{ $enrollment->enrolled_at->format('M d, Y') }}
                                    </td>
                                    <td style="padding: 1.25rem 1rem; text-align: center;">
                                        <div style="display: flex; gap: 0.625rem; justify-content: center;">
                                            <form method="POST" action="{{ route('teacher.modules.grade-student', [$module, $enrollment]) }}" style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="pass_status" value="PASS">
                                                <button type="submit" 
                                                        onclick="return confirm('Mark {{ $enrollment->student->name }} as PASS?')"
                                                        style="padding: 0.625rem 1.25rem; background: #86efac; color: #1a1a1a; font-weight: 700; font-size: 0.8125rem; border: 2px solid #4ade80; border-radius: 50px; cursor: pointer; transition: all 0.3s; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;"
                                                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 16px rgba(134, 239, 172, 0.3)'; this.style.background='#4ade80'"
                                                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.background='#86efac'">
                                                    ✓ PASS
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('teacher.modules.grade-student', [$module, $enrollment]) }}" style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="pass_status" value="FAIL">
                                                <button type="submit" 
                                                        onclick="return confirm('Mark {{ $enrollment->student->name }} as FAIL?')"
                                                        style="padding: 0.625rem 1.25rem; background: #fca5a5; color: #1a1a1a; font-weight: 700; font-size: 0.8125rem; border: 2px solid #f87171; border-radius: 50px; cursor: pointer; transition: all 0.3s; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;"
                                                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 16px rgba(252, 165, 165, 0.3)'; this.style.background='#f87171'"
                                                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.background='#fca5a5'">
                                                    ✗ FAIL
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
            <div style="background-color: white; border-radius: 24px; padding: 3rem 2rem; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04); border: 1px solid #f3f4f6; margin-bottom: 2rem; text-align: center;">
                <div style="width: 100px; height: 100px; background: #d1fae5; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
                    <svg style="width: 50px; height: 50px; color: #10b981;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1.25rem; font-weight: 600; color: #1a1a1a; margin: 0 0 0.5rem 0;">No Pending Evaluations</h3>
                <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.9375rem; color: #6b7280; margin: 0; font-weight: 500;">All active students have been evaluated.</p>
            </div>
        @endif

        <!-- Completed Students -->
        @if($completedEnrollments->count() > 0)
            <div style="background-color: white; border-radius: 24px; padding: 2rem; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04); border: 1px solid #f3f4f6;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
                    <h2 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1.25rem; font-weight: 600; color: #1a1a1a; margin: 0;">Completed Students</h2>
                    <span style="padding: 0.5rem 1rem; background-color: #dbeafe; color: #1e3a8a; font-size: 0.875rem; font-weight: 700; border-radius: 50px; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ $completedEnrollments->count() }} students</span>
                </div>

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="border-bottom: 2px solid #e5e7eb;">
                                <th style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: #6b7280; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; text-transform: uppercase; letter-spacing: 0.05em;">Student</th>
                                <th style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: #6b7280; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; text-transform: uppercase; letter-spacing: 0.05em;">Email</th>
                                <th style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: #6b7280; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; text-transform: uppercase; letter-spacing: 0.05em;">Completed</th>
                                <th style="padding: 1rem; text-align: center; font-size: 0.875rem; font-weight: 600; color: #6b7280; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; text-transform: uppercase; letter-spacing: 0.05em;">Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($completedEnrollments as $enrollment)
                                <tr style="border-bottom: 1px solid #f3f4f6; transition: background 0.2s;"
                                    onmouseover="this.style.backgroundColor='#fafafa'"
                                    onmouseout="this.style.backgroundColor='transparent'">
                                    <td style="padding: 1.25rem 1rem; font-size: 0.9375rem; color: #1a1a1a; font-weight: 600; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">
                                        {{ $enrollment->student->name }}
                                    </td>
                                    <td style="padding: 1.25rem 1rem; font-size: 0.875rem; color: #6b7280; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 500;">
                                        {{ $enrollment->student->email }}
                                    </td>
                                    <td style="padding: 1.25rem 1rem; font-size: 0.875rem; color: #6b7280; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 500;">
                                        {{ $enrollment->completed_at ? $enrollment->completed_at->format('M d, Y H:i') : 'N/A' }}
                                    </td>
                                    <td style="padding: 1.25rem 1rem; text-align: center;">
                                        @if(strtoupper(trim($enrollment->pass_status)) === 'PASS')
                                            <span style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background-color: #86efac; color: #1a1a1a; font-size: 0.8125rem; font-weight: 700; border-radius: 50px; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; border: 2px solid #4ade80;">
                                                <svg style="width: 16px; height: 16px; margin-right: 0.375rem;" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                </svg>
                                                PASS
                                            </span>
                                        @elseif(strtoupper(trim($enrollment->pass_status)) === 'FAIL')
                                            <span style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background-color: #fca5a5; color: #1a1a1a; font-size: 0.8125rem; font-weight: 700; border-radius: 50px; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; border: 2px solid #f87171;">
                                                <svg style="width: 16px; height: 16px; margin-right: 0.375rem;" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                                </svg>
                                                FAIL
                                            </span>
                                        @else
                                            <span style="padding: 0.5rem 1rem; background-color: #fef3c7; color: #78350f; font-size: 0.8125rem; font-weight: 700; border-radius: 50px; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; border: 2px solid #fde68a;">
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