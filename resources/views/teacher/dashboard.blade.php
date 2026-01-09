@extends('layouts.teacher-layout')

@section('content')

<div style="padding: 2rem 0; background-color: #fdfcfb;">
    <div style="max-width: 1400px; margin: 0 auto; padding: 0 2rem;">
        
        <!-- Success Message -->
        @if (session('success'))
            <div style="margin-bottom: 2rem; background-color: #d1fae5; border-left: 4px solid #10b981; color: #065f46; padding: 1rem 1.5rem; border-radius: 16px; box-shadow: 0 2px 8px rgba(16, 185, 129, 0.1);">
                <p style="font-weight: 600; margin: 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.9375rem;">{{ session('success') }}</p>
            </div>
        @endif

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
            
            <!-- Left Column - Main Content -->
            <div>
                
                <!-- Welcome Section -->
                <div style="margin-bottom: 2rem;">
                    <h1 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 2.7rem; font-weight: 500; color: #1a1a1a; margin: 0 0 0.5rem 0; line-height: 1.2;">
                        Welcome back, Teacher 👋
                    </h1>
                    <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1rem; color: #6b7280; margin: 0; font-weight: 500;">
                        Here's an overview of your teaching activities
                    </p>
                </div>

                <!-- Stats Cards -->
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.25rem; margin-bottom: 2rem;">
                    
                    <!-- Assigned Modules -->
                    <div style="background: #d8b4fe; border-radius: 24px; padding: 2rem; transition: all 0.3s; position: relative;"
                         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(216, 180, 254, 0.25)'"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <div style="position: absolute; top: 1.25rem; right: 1.25rem;">
                            <div style="background: white; padding: 0.5rem 0.875rem; border-radius: 50px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                <span style="font-size: 1.25rem; color: #581c87; font-weight: 700; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ $stats['total_modules'] ?? 0 }}</span>
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.875rem; margin-bottom: 1.25rem;">
                            <div style="background: #e9d5ff; border-radius: 14px; padding: 0.75rem; display: inline-flex;">
                                <svg style="width: 28px; height: 28px; color: #581c87;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <span style="font-size: 0.75rem; font-weight: 700; color: #581c87; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; text-transform: uppercase; letter-spacing: 0.05em;">MODULES</span>
                        </div>
                        <h4 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1.25rem; font-weight: 600; color: #1a1a1a; margin: 0 0 0.5rem 0; line-height: 1.3;">
                            Assigned Modules
                        </h4>
                        <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.875rem; color: #6b21a8; margin: 0; font-weight: 500;">
                            Your teaching modules
                        </p>
                    </div>

                    <!-- Total Students -->
                    <div style="background: #93c5fd; border-radius: 24px; padding: 2rem; transition: all 0.3s; position: relative;"
                         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(147, 197, 253, 0.25)'"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <div style="position: absolute; top: 1.25rem; right: 1.25rem;">
                            <div style="background: white; padding: 0.5rem 0.875rem; border-radius: 50px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                <span style="font-size: 1.25rem; color: #1e3a8a; font-weight: 700; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ $stats['total_students'] ?? 0 }}</span>
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.875rem; margin-bottom: 1.25rem;">
                            <div style="background: #bfdbfe; border-radius: 14px; padding: 0.75rem; display: inline-flex;">
                                <svg style="width: 28px; height: 28px; color: #1e3a8a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <span style="font-size: 0.75rem; font-weight: 700; color: #1e3a8a; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; text-transform: uppercase; letter-spacing: 0.05em;">STUDENTS</span>
                        </div>
                        <h4 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1.25rem; font-weight: 600; color: #1a1a1a; margin: 0 0 0.5rem 0; line-height: 1.3;">
                            Total Students
                        </h4>
                        <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.875rem; color: #1e40af; margin: 0; font-weight: 500;">
                            Active across all modules
                        </p>
                    </div>

                    <!-- Pending Evaluations -->
                    <div style="background: #fde68a; border-radius: 24px; padding: 2rem; transition: all 0.3s; position: relative;"
                         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(253, 224, 71, 0.25)'"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <div style="position: absolute; top: 1.25rem; right: 1.25rem;">
                            <div style="background: white; padding: 0.5rem 0.875rem; border-radius: 50px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                <span style="font-size: 1.25rem; color: #713f12; font-weight: 700; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ $stats['pending_evaluations'] ?? 0 }}</span>
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.875rem; margin-bottom: 1.25rem;">
                            <div style="background: #fef3c7; border-radius: 14px; padding: 0.75rem; display: inline-flex;">
                                <svg style="width: 28px; height: 28px; color: #713f12;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span style="font-size: 0.75rem; font-weight: 700; color: #713f12; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; text-transform: uppercase; letter-spacing: 0.05em;">PENDING</span>
                        </div>
                        <h4 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1.25rem; font-weight: 600; color: #1a1a1a; margin: 0 0 0.5rem 0; line-height: 1.3;">
                            Pending Evaluations
                        </h4>
                        <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.875rem; color: #78350f; margin: 0; font-weight: 500;">
                            Need grading
                        </p>
                    </div>

                    <!-- Completed Evaluations -->
                    <div style="background: #86efac; border-radius: 24px; padding: 2rem; transition: all 0.3s; position: relative;"
                         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(134, 239, 172, 0.25)'"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <div style="position: absolute; top: 1.25rem; right: 1.25rem;">
                            <div style="background: white; padding: 0.5rem 0.875rem; border-radius: 50px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                <span style="font-size: 1.25rem; color: #064e3b; font-weight: 700; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ $stats['completed_evaluations'] ?? 0 }}</span>
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.875rem; margin-bottom: 1.25rem;">
                            <div style="background: #bbf7d0; border-radius: 14px; padding: 0.75rem; display: inline-flex;">
                                <svg style="width: 28px; height: 28px; color: #064e3b;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span style="font-size: 0.75rem; font-weight: 700; color: #064e3b; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; text-transform: uppercase; letter-spacing: 0.05em;">COMPLETED</span>
                        </div>
                        <h4 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1.25rem; font-weight: 600; color: #1a1a1a; margin: 0 0 0.5rem 0; line-height: 1.3;">
                            Completed Evaluation
                        </h4>
                        <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.875rem; color: #047857; margin: 0; font-weight: 500;">
                            Successfully graded
                        </p>
                    </div>

                </div>

                <!-- Quick Actions Section -->
                <div style="background: white; border-radius: 24px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04); border: 1px solid #f3f4f6;">
                    <h3 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1.125rem; font-weight: 600; color: #1a1a1a; margin: 0 0 1.5rem 0;">
                        Quick Actions
                    </h3>
                    
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                        
                        <!-- View All Modules -->
                        <a href="{{ route('teacher.modules.index') }}" style="text-decoration: none;">
                            <div style="background: #d8b4fe; border-radius: 18px; padding: 1.5rem; transition: all 0.3s; cursor: pointer; text-align: center;"
                                 onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(216, 180, 254, 0.2)'"
                                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                <div style="background: #e9d5ff; border-radius: 12px; padding: 0.75rem; display: inline-flex; margin-bottom: 0.75rem;">
                                    <svg style="width: 28px; height: 28px; color: #581c87;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                </div>
                                <h4 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.9375rem; font-weight: 600; color: #1a1a1a; margin: 0;">
                                    My Modules
                                </h4>
                            </div>
                        </a>

                        <!-- Grade Students -->
                        <a href="{{ route('teacher.grading.index') }}" style="text-decoration: none;">
                            <div style="background: #93c5fd; border-radius: 18px; padding: 1.5rem; transition: all 0.3s; cursor: pointer; text-align: center;"
                                 onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(147, 197, 253, 0.2)'"
                                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                <div style="background: #bfdbfe; border-radius: 12px; padding: 0.75rem; display: inline-flex; margin-bottom: 0.75rem;">
                                    <svg style="width: 28px; height: 28px; color: #1e3a8a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                    </svg>
                                </div>
                                <h4 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.9375rem; font-weight: 600; color: #1a1a1a; margin: 0;">
                                    Grade Students
                                </h4>
                            </div>
                        </a>

                        <!-- View Dashboard -->
                        <a href="{{ route('teacher.dashboard') }}" style="text-decoration: none;">
                            <div style="background: #86efac; border-radius: 18px; padding: 1.5rem; transition: all 0.3s; cursor: pointer; text-align: center;"
                                 onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(134, 239, 172, 0.2)'"
                                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                <div style="background: #bbf7d0; border-radius: 12px; padding: 0.75rem; display: inline-flex; margin-bottom: 0.75rem;">
                                    <svg style="width: 28px; height: 28px; color: #064e3b;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                                <h4 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.9375rem; font-weight: 600; color: #1a1a1a; margin: 0;">
                                    Dashboard
                                </h4>
                            </div>
                        </a>

                    </div>
                </div>

                <!-- My Modules Section -->
                @if($modules->count() > 0)
                    <div style="background: white; border-radius: 24px; padding: 2rem; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04); border: 1px solid #f3f4f6;">
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
                            <h3 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1.125rem; font-weight: 600; color: #1a1a1a; margin: 0;">
                                My Teaching Modules
                            </h3>
                            <a href="{{ route('teacher.modules.index') }}" style="font-size: 0.8125rem; color: #6b7280; text-decoration: none; font-weight: 600; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; transition: color 0.2s;"
                               onmouseover="this.style.color='#1a1a1a'"
                               onmouseout="this.style.color='#6b7280'">View all →</a>
                        </div>
                        
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.25rem;">
                            @foreach($modules->take(4) as $module)
                                <a href="{{ route('teacher.modules.show', $module) }}" style="text-decoration: none;">
                                    <div style="background: #fafafa; border-radius: 18px; padding: 1.5rem; transition: all 0.3s; border: 1px solid #f3f4f6;"
                                         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0, 0, 0, 0.06)'; this.style.borderColor='#d8b4fe'"
                                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='#f3f4f6'">
                                        
                                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.25rem;">
                                            <div style="background: #d8b4fe; border-radius: 12px; padding: 0.75rem; flex-shrink: 0;">
                                                <span style="color: #581c87; font-weight: 700; font-size: 1rem; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ substr($module->code, 0, 2) }}</span>
                                            </div>
                                            <div style="flex: 1; min-width: 0;">
                                                <h4 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.9375rem; font-weight: 600; color: #1a1a1a; margin: 0 0 0.25rem 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                    {{ $module->name }}
                                                </h4>
                                                <p style="font-size: 0.75rem; color: #6b7280; margin: 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 500;">{{ $module->code }}</p>
                                            </div>
                                        </div>

                                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.75rem; padding-top: 1rem; border-top: 1px solid #e5e7eb;">
                                            <div style="text-align: center;">
                                                <p style="font-size: 0.6875rem; color: #6b7280; margin: 0 0 0.375rem 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 600; text-transform: uppercase;">Active</p>
                                                <p style="font-size: 1.25rem; font-weight: 700; color: #ea580c; margin: 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ $module->pending_count ?? 0 }}</p>
                                            </div>
                                            <div style="text-align: center;">
                                                <p style="font-size: 0.6875rem; color: #6b7280; margin: 0 0 0.375rem 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 600; text-transform: uppercase;">Done</p>
                                                <p style="font-size: 1.25rem; font-weight: 700; color: #10b981; margin: 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ $module->completed_count ?? 0 }}</p>
                                            </div>
                                            <div style="text-align: center;">
                                                <p style="font-size: 0.6875rem; color: #6b7280; margin: 0 0 0.375rem 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 600; text-transform: uppercase;">Total</p>
                                                <p style="font-size: 1.25rem; font-weight: 700; color: #3b82f6; margin: 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ ($module->pending_count ?? 0) + ($module->completed_count ?? 0) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <!-- Empty State -->
                    <div style="background: white; border-radius: 24px; padding: 2rem; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04); border: 1px solid #f3f4f6;">
                        <div style="text-align: center; padding: 3rem 2rem;">
                            <div style="width: 100px; height: 100px; background: #e9d5ff; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
                                <svg style="width: 48px; height: 48px; color: #a855f7;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <h3 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1.25rem; font-weight: 600; color: #1a1a1a; margin: 0 0 0.5rem 0;">No Modules Assigned Yet</h3>
                            <p style="font-size: 0.9375rem; color: #6b7280; margin: 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 500;">Contact your administrator to get modules assigned to you.</p>
                        </div>
                    </div>
                @endif

            </div>

            <!-- Right Column - Sidebar -->
            <div>
                
                <!-- Profile Card -->
                <div style="background: white; border-radius: 24px; padding: 2rem; margin-bottom: 1.5rem; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04); border: 1px solid #f3f4f6;">
                    <div style="text-align: center;">
                        <div style="width: 80px; height: 80px; border-radius: 50%; background: #d8b4fe; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 16px rgba(216, 180, 254, 0.3);">
                            <span style="font-size: 2rem; color: #1a1a1a; font-weight: 700; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ substr(auth('teacher')->user()->name, 0, 1) }}</span>
                        </div>
                        <h3 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1.125rem; font-weight: 600; color: #1a1a1a; margin: 0 0 0.25rem 0;">
                            {{ auth('teacher')->user()->name }}
                        </h3>
                        <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.8125rem; color: #6b7280; margin: 0 0 1.25rem 0; font-weight: 500;">
                            Teacher
                        </p>
                        <div style="display: flex; align-items: center; justify-content: center; gap: 1.5rem; padding-top: 1.25rem; border-top: 1px solid #f3f4f6;">
                            <div style="text-align: center;">
                                <p style="font-size: 1.5rem; font-weight: 700; color: #1a1a1a; margin: 0 0 0.125rem 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ $stats['total_modules'] ?? 0 }}</p>
                                <p style="font-size: 0.75rem; color: #6b7280; margin: 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 600;">Modules</p>
                            </div>
                            <div style="width: 1px; height: 32px; background: #e5e7eb;"></div>
                            <div style="text-align: center;">
                                <p style="font-size: 1.5rem; font-weight: 700; color: #1a1a1a; margin: 0 0 0.125rem 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ $stats['total_students'] ?? 0 }}</p>
                                <p style="font-size: 0.75rem; color: #6b7280; margin: 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 600;">Students</p>
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
                            <div style="background: #e9d5ff; border-radius: 10px; padding: 0.625rem; flex-shrink: 0; height: fit-content;">
                                <svg style="width: 20px; height: 20px; color: #a855f7;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p style="font-size: 0.875rem; font-weight: 600; color: #1a1a1a; margin: 0 0 0.25rem 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">Grade Students</p>
                                <p style="font-size: 0.75rem; color: #6b7280; margin: 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 500;">Click on any module to view and grade students</p>
                            </div>
                        </div>
                        
                        <div style="display: flex; gap: 1rem; padding: 1rem; background: #fafafa; border-radius: 14px;">
                            <div style="background: #bfdbfe; border-radius: 10px; padding: 0.625rem; flex-shrink: 0; height: fit-content;">
                                <svg style="width: 20px; height: 20px; color: #3b82f6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p style="font-size: 0.875rem; font-weight: 600; color: #1a1a1a; margin: 0 0 0.25rem 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">Evaluation Status</p>
                                <p style="font-size: 0.75rem; color: #6b7280; margin: 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 500;">Mark students as PASS or FAIL after evaluation</p>
                            </div>
                        </div>
                        
                        <div style="display: flex; gap: 1rem; padding: 1rem; background: #fafafa; border-radius: 14px;">
                            <div style="background: #bbf7d0; border-radius: 10px; padding: 0.625rem; flex-shrink: 0; height: fit-content;">
                                <svg style="width: 20px; height: 20px; color: #10b981;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p style="font-size: 0.875rem; font-weight: 600; color: #1a1a1a; margin: 0 0 0.25rem 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">Track Progress</p>
                                <p style="font-size: 0.75rem; color: #6b7280; margin: 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 500;">Monitor completed evaluations with timestamps</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection