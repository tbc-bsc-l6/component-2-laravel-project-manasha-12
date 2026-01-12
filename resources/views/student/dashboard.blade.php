@extends('layouts.student-layout')

@section('content')

<div style="padding: 2rem 0; background-color: #fdfcfb;">
    <div style="max-width: 1400px; margin: 0 auto; padding: 0 2rem;">
        
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
            
            <!-- Left Column - Main Content -->
            <div>
                
                <!-- Welcome Section -->
                <div style="margin-bottom: 2rem;">
                    <h1 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 2.7rem; font-weight: 500; color: #1a1a1a; margin: 0 0 0.5rem 0; line-height: 1.2;">
                        Welcome back, {{ $student->name }} 👋
                    </h1>
                    <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1rem; color: #6b7280; margin: 0; font-weight: 500;">
                        Track your progress and manage your module enrollments
                    </p>
                </div>

                <!-- Stats Cards -->
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.25rem; margin-bottom: 2rem;">
                    
                    <!-- Active Modules -->
                    <div style="background: #93c5fd; border-radius: 24px; padding: 2rem; transition: all 0.3s; position: relative;"
                         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(147, 197, 253, 0.25)'"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <div style="position: absolute; top: 1.25rem; right: 1.25rem;">
                            <div style="background: white; padding: 0.5rem 0.875rem; border-radius: 50px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                <span style="font-size: 1.25rem; color: #1e3a8a; font-weight: 700; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ $stats['current_enrollments'] }}/4</span>
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.875rem; margin-bottom: 1.25rem;">
                            <div style="background: #bfdbfe; border-radius: 14px; padding: 0.75rem; display: inline-flex;">
                                <svg style="width: 28px; height: 28px; color: #1e3a8a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <span style="font-size: 0.75rem; font-weight: 700; color: #1e3a8a; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; text-transform: uppercase; letter-spacing: 0.05em;">ACTIVE</span>
                        </div>
                        <h4 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1.25rem; font-weight: 600; color: #1a1a1a; margin: 0 0 0.5rem 0; line-height: 1.3;">
                            Active Modules
                        </h4>
                        <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.875rem; color: #1e40af; margin: 0; font-weight: 500;">
                            Currently studying
                        </p>
                    </div>

                    <!-- Available Slots -->
                    <div style="background: #86efac; border-radius: 24px; padding: 2rem; transition: all 0.3s; position: relative;"
                         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(134, 239, 172, 0.25)'"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <div style="position: absolute; top: 1.25rem; right: 1.25rem;">
                            <div style="background: white; padding: 0.5rem 0.875rem; border-radius: 50px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                <span style="font-size: 1.25rem; color: #064e3b; font-weight: 700; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ $stats['available_slots'] }}</span>
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.875rem; margin-bottom: 1.25rem;">
                            <div style="background: #bbf7d0; border-radius: 14px; padding: 0.75rem; display: inline-flex;">
                                <svg style="width: 28px; height: 28px; color: #064e3b;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </div>
                            <span style="font-size: 0.75rem; font-weight: 700; color: #064e3b; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; text-transform: uppercase; letter-spacing: 0.05em;">SLOTS</span>
                        </div>
                        <h4 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1.25rem; font-weight: 600; color: #1a1a1a; margin: 0 0 0.5rem 0; line-height: 1.3;">
                            Available Slots
                        </h4>
                        <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.875rem; color: #047857; margin: 0; font-weight: 500;">
                            @if($stats['can_enroll'])
                                Can enroll more
                            @else
                                At maximum
                            @endif
                        </p>
                    </div>

                    <!-- Completed -->
                    <div style="background: #d8b4fe; border-radius: 24px; padding: 2rem; transition: all 0.3s; position: relative;"
                         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(216, 180, 254, 0.25)'"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <div style="position: absolute; top: 1.25rem; right: 1.25rem;">
                            <div style="background: white; padding: 0.5rem 0.875rem; border-radius: 50px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                <span style="font-size: 1.25rem; color: #581c87; font-weight: 700; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ $stats['total_completed'] }}</span>
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.875rem; margin-bottom: 1.25rem;">
                            <div style="background: #e9d5ff; border-radius: 14px; padding: 0.75rem; display: inline-flex;">
                                <svg style="width: 28px; height: 28px; color: #581c87;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span style="font-size: 0.75rem; font-weight: 700; color: #581c87; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; text-transform: uppercase; letter-spacing: 0.05em;">COMPLETED</span>
                        </div>
                        <h4 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1.25rem; font-weight: 600; color: #1a1a1a; margin: 0 0 0.5rem 0; line-height: 1.3;">
                            Completed
                        </h4>
                        <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.875rem; color: #6b21a8; margin: 0; font-weight: 500;">
                            Total finished
                        </p>
                    </div>

                    <!-- Passed -->
                    <div style="background: #fde68a; border-radius: 24px; padding: 2rem; transition: all 0.3s; position: relative;"
                         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(253, 224, 71, 0.25)'"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <div style="position: absolute; top: 1.25rem; right: 1.25rem;">
                            <div style="background: white; padding: 0.5rem 0.875rem; border-radius: 50px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                <span style="font-size: 1.25rem; color: #713f12; font-weight: 700; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ $stats['total_passed'] }}</span>
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.875rem; margin-bottom: 1.25rem;">
                            <div style="background: #fef3c7; border-radius: 14px; padding: 0.75rem; display: inline-flex;">
                                <svg style="width: 28px; height: 28px; color: #713f12;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span style="font-size: 0.75rem; font-weight: 700; color: #713f12; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; text-transform: uppercase; letter-spacing: 0.05em;">PASSED</span>
                        </div>
                        <h4 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1.25rem; font-weight: 600; color: #1a1a1a; margin: 0 0 0.5rem 0; line-height: 1.3;">
                            Passed
                        </h4>
                        <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.875rem; color: #78350f; margin: 0; font-weight: 500;">
                            Successful
                        </p>
                    </div>

                </div>

                <!-- Quick Actions Section -->
                <div style="background: white; border-radius: 24px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04); border: 1px solid #f3f4f6;">
                    <h3 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1.125rem; font-weight: 600; color: #1a1a1a; margin: 0 0 1.5rem 0;">
                        Quick Actions
                    </h3>
                    
                    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem;">
                        
                        <!-- Enroll in Modules -->
                        @if($stats['can_enroll'])
                            <a href="{{ route('student.modules.available') }}" style="text-decoration: none;">
                                <div style="background: #93c5fd; border-radius: 18px; padding: 1.5rem; transition: all 0.3s; cursor: pointer; text-align: center;"
                                     onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(147, 197, 253, 0.2)'"
                                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                    <div style="background: #bfdbfe; border-radius: 12px; padding: 0.75rem; display: inline-flex; margin-bottom: 0.75rem;">
                                        <svg style="width: 28px; height: 28px; color: #1e3a8a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                    </div>
                                    <h4 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.9375rem; font-weight: 600; color: #1a1a1a; margin: 0;">
                                        Enroll
                                    </h4>
                                </div>
                            </a>
                        @else
                            <div style="background: #e5e7eb; border-radius: 18px; padding: 1.5rem; text-align: center; cursor: not-allowed; opacity: 0.7;">
                                <div style="background: #d1d5db; border-radius: 12px; padding: 0.75rem; display: inline-flex; margin-bottom: 0.75rem;">
                                    <svg style="width: 28px; height: 28px; color: #6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </div>
                                <h4 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.9375rem; font-weight: 600; color: #6b7280; margin: 0;">
                                    At Max
                                </h4>
                            </div>
                        @endif

                        <!-- Current Modules -->
                        <a href="{{ route('student.modules.current') }}" style="text-decoration: none;">
                            <div style="background: #86efac; border-radius: 18px; padding: 1.5rem; transition: all 0.3s; cursor: pointer; text-align: center;"
                                 onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(134, 239, 172, 0.2)'"
                                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                <div style="background: #bbf7d0; border-radius: 12px; padding: 0.75rem; display: inline-flex; margin-bottom: 0.75rem;">
                                    <svg style="width: 28px; height: 28px; color: #064e3b;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                </div>
                                <h4 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.9375rem; font-weight: 600; color: #1a1a1a; margin: 0;">
                                    Current
                                </h4>
                            </div>
                        </a>

                        <!-- Module History -->
                        <a href="{{ route('student.modules.history') }}" style="text-decoration: none;">
                            <div style="background: #d8b4fe; border-radius: 18px; padding: 1.5rem; transition: all 0.3s; cursor: pointer; text-align: center;"
                                 onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(216, 180, 254, 0.2)'"
                                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                <div style="background: #e9d5ff; border-radius: 12px; padding: 0.75rem; display: inline-flex; margin-bottom: 0.75rem;">
                                    <svg style="width: 28px; height: 28px; color: #581c87;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h4 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.9375rem; font-weight: 600; color: #1a1a1a; margin: 0;">
                                    History
                                </h4>
                            </div>
                        </a>

                        <!-- Dashboard -->
                        <a href="{{ route('student.dashboard') }}" style="text-decoration: none;">
                            <div style="background: #fde68a; border-radius: 18px; padding: 1.5rem; transition: all 0.3s; cursor: pointer; text-align: center;"
                                 onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(253, 224, 71, 0.2)'"
                                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                <div style="background: #fef3c7; border-radius: 12px; padding: 0.75rem; display: inline-flex; margin-bottom: 0.75rem;">
                                    <svg style="width: 28px; height: 28px; color: #713f12;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                </div>
                                <h4 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.9375rem; font-weight: 600; color: #1a1a1a; margin: 0;">
                                    Dashboard
                                </h4>
                            </div>
                        </a>

                    </div>
                </div>

                <!-- Current Modules -->
                @if($currentModules->count() > 0)
                    <div style="background: white; border-radius: 24px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04); border: 1px solid #f3f4f6;">
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
                            <div>
                                <h3 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1.125rem; font-weight: 600; color: #1a1a1a; margin: 0 0 0.25rem 0;">
                                    Currently Studying
                                </h3>
                                <p style="font-size: 0.8125rem; color: #6b7280; margin: 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 500;">{{ $currentModules->count() }} active module(s)</p>
                            </div>
                        </div>
                        
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.25rem;">
                            @foreach($currentModules as $enrollment)
                                <div style="background: #fafafa; border-radius: 18px; padding: 1.5rem; transition: all 0.3s; border: 1px solid #f3f4f6;"
                                     onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0, 0, 0, 0.06)'; this.style.borderColor='#93c5fd'"
                                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='#f3f4f6'">
                                    
                                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                                        <div style="background: #93c5fd; border-radius: 12px; padding: 0.75rem; flex-shrink: 0;">
                                            <span style="color: #1e3a8a; font-weight: 700; font-size: 1rem; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ substr($enrollment->module->code, 0, 2) }}</span>
                                        </div>
                                        <div style="flex: 1; min-width: 0;">
                                            <h4 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.9375rem; font-weight: 600; color: #1a1a1a; margin: 0 0 0.25rem 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                {{ $enrollment->module->name }}
                                            </h4>
                                            <p style="font-size: 0.75rem; color: #6b7280; margin: 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 500;">{{ $enrollment->module->code }}</p>
                                        </div>
                                    </div>

                                    <div style="display: flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1rem; background: #fef3c7; border-radius: 12px;">
                                        <svg style="width: 16px; height: 16px; color: #d97706;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span style="font-size: 0.75rem; color: #92400e; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 600;">
                                            Enrolled {{ $enrollment->enrolled_at->format('M d, Y') }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Recent Completed Modules -->
                @if($completedModules->count() > 0)
                    <div style="background: white; border-radius: 24px; padding: 2rem; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04); border: 1px solid #f3f4f6;">
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
                            <div>
                                <h3 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1.125rem; font-weight: 600; color: #1a1a1a; margin: 0 0 0.25rem 0;">
                                    Recent Completed Modules
                                </h3>
                                <p style="font-size: 0.8125rem; color: #6b7280; margin: 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 500;">Your latest results</p>
                            </div>
                            <a href="{{ route('student.modules.history') }}" style="font-size: 0.8125rem; color: #6b7280; text-decoration: none; font-weight: 600; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; transition: color 0.2s;"
                               onmouseover="this.style.color='#1a1a1a'"
                               onmouseout="this.style.color='#6b7280'">View all →</a>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 1rem;">
                            @foreach($completedModules->take(5) as $enrollment)
                                <div style="display: flex; align-items: center; justify-between; padding: 1.25rem; background: #fafafa; border-radius: 18px; transition: all 0.2s;"
                                     onmouseover="this.style.backgroundColor='#f3f4f6'"
                                     onmouseout="this.style.backgroundColor='#fafafa'">
                                    <div style="display: flex; align-items: center; gap: 1rem; flex: 1;">
                                        <div style="background: #d8b4fe; border-radius: 12px; padding: 0.75rem; flex-shrink: 0;">
                                            <span style="color: #581c87; font-weight: 700; font-size: 1rem; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ substr($enrollment->module->code, 0, 2) }}</span>
                                        </div>
                                        <div style="flex: 1; min-width: 0;">
                                            <h4 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.9375rem; font-weight: 600; color: #1a1a1a; margin: 0 0 0.25rem 0;">
                                                {{ $enrollment->module->name }}
                                            </h4>
                                            <p style="font-size: 0.75rem; color: #6b7280; margin: 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 500;">
                                                {{ $enrollment->module->code }} • Completed {{ $enrollment->completed_at->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div>
                                        @if(strtoupper(trim($enrollment->pass_status)) === 'PASS')
                                            <div style="padding: 0.5rem 1rem; background: #d1fae5; color: #065f46; border-radius: 50px; font-size: 0.75rem; font-weight: 700; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; display: flex; align-items: center; gap: 0.375rem;">
                                                <svg style="width: 14px; height: 14px;" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                </svg>
                                                PASS
                                            </div>
                                        @else
                                            <div style="padding: 0.5rem 1rem; background: #fee2e2; color: #991b1b; border-radius: 50px; font-size: 0.75rem; font-weight: 700; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; display: flex; align-items: center; gap: 0.375rem;">
                                                <svg style="width: 14px; height: 14px;" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                                </svg>
                                                FAIL
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>

            <!-- Right Column - Sidebar -->
            <div>
                
                <!-- Profile Card -->
                <div style="background: white; border-radius: 24px; padding: 2rem; margin-bottom: 1.5rem; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04); border: 1px solid #f3f4f6;">
                    <div style="text-align: center;">
                        <div style="width: 80px; height: 80px; border-radius: 50%; background: #93c5fd; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 16px rgba(147, 197, 253, 0.3);">
                            <span style="font-size: 2rem; color: #1a1a1a; font-weight: 700; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ substr($student->name, 0, 1) }}</span>
                        </div>
                        <h3 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1.125rem; font-weight: 600; color: #1a1a1a; margin: 0 0 0.25rem 0;">
                            {{ $student->name }}
                        </h3>
                        <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.8125rem; color: #6b7280; margin: 0 0 1.25rem 0; font-weight: 500;">
                            Student
                        </p>
                        <div style="display: flex; align-items: center; justify-content: center; gap: 1.5rem; padding-top: 1.25rem; border-top: 1px solid #f3f4f6;">
                            <div style="text-align: center;">
                                <p style="font-size: 1.5rem; font-weight: 700; color: #1a1a1a; margin: 0 0 0.125rem 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ $stats['current_enrollments'] }}</p>
                                <p style="font-size: 0.75rem; color: #6b7280; margin: 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 600;">Active</p>
                            </div>
                            <div style="width: 1px; height: 32px; background: #e5e7eb;"></div>
                            <div style="text-align: center;">
                                <p style="font-size: 1.5rem; font-weight: 700; color: #1a1a1a; margin: 0 0 0.125rem 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ $stats['total_completed'] }}</p>
                                <p style="font-size: 0.75rem; color: #6b7280; margin: 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 600;">Completed</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Tips -->
                <div style="background: white; border-radius: 24px; padding: 2rem; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04); border: 1px solid #f3f4f6;">
                    <h3 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1.125rem; font-weight: 600; color: #1a1a1a; margin: 0 0 1.5rem 0;">
                        Quick Tips
                    </h3>
                    
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <div style="display: flex; gap: 1rem; padding: 1rem; background: #fafafa; border-radius: 14px;">
                            <div style="background: #bfdbfe; border-radius: 10px; padding: 0.625rem; flex-shrink: 0; height: fit-content;">
                                <svg style="width: 20px; height: 20px; color: #3b82f6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p style="font-size: 0.875rem; font-weight: 600; color: #1a1a1a; margin: 0 0 0.25rem 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">Enroll Wisely</p>
                                <p style="font-size: 0.75rem; color: #6b7280; margin: 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 500;">You can enroll in up to 4 modules at once</p>
                            </div>
                        </div>
                        
                        <div style="display: flex; gap: 1rem; padding: 1rem; background: #fafafa; border-radius: 14px;">
                            <div style="background: #bbf7d0; border-radius: 10px; padding: 0.625rem; flex-shrink: 0; height: fit-content;">
                                <svg style="width: 20px; height: 20px; color: #10b981;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p style="font-size: 0.875rem; font-weight: 600; color: #1a1a1a; margin: 0 0 0.25rem 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">Track Progress</p>
                                <p style="font-size: 0.75rem; color: #6b7280; margin: 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 500;">View your completed modules and results</p>
                            </div>
                        </div>
                        
                        <div style="display: flex; gap: 1rem; padding: 1rem; background: #fafafa; border-radius: 14px;">
                            <div style="background: #e9d5ff; border-radius: 10px; padding: 0.625rem; flex-shrink: 0; height: fit-content;">
                                <svg style="width: 20px; height: 20px; color: #a855f7;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p style="font-size: 0.875rem; font-weight: 600; color: #1a1a1a; margin: 0 0 0.25rem 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">Stay Updated</p>
                                <p style="font-size: 0.75rem; color: #6b7280; margin: 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 500;">Check your active modules regularly</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

@endsection