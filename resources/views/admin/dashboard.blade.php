<x-admin-layout>
    <x-slot name="header">
        <h2 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', -apple-system, BlinkMacSystemFont, sans-serif; font-size: 1.75rem; font-weight: 60; color: #1a1a1a; margin: 0;">
            Dashboard Overview
        </h2>
    </x-slot>

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
                        <h1 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 2.7rem; font-weight: 70; color: #1a1a1a; margin: 0 0 0.5rem 0; line-height: 1.2;">
                            Welcome back 👋
                        </h1>
                        <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1rem; color: #6b7280; margin: 0; font-weight: 500;">
                            Here's what's happening in your institution today
                        </p>
                    </div>

                    <!-- Filter Tabs -->
                    <div style="display: flex; gap: 0.75rem; margin-bottom: 2rem; flex-wrap: wrap;">
                        <button style="padding: 0.75rem 1.5rem; background-color: #1a1a1a; color: white; border: none; border-radius: 50px; font-size: 0.875rem; font-weight: 60; cursor: pointer; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; transition: all 0.2s;"
                                onmouseover="this.style.transform='scale(1.05)'"
                                onmouseout="this.style.transform='scale(1)'">
                            🎯 All
                        </button>
                        <button style="padding: 0.75rem 1.5rem; background-color: #f3f4f6; color: #1a1a1a; border: none; border-radius: 50px; font-size: 0.875rem; font-weight: 60; cursor: pointer; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; transition: all 0.2s;"
                                onmouseover="this.style.backgroundColor='#e5e7eb'"
                                onmouseout="this.style.backgroundColor='#f3f4f6'">
                            📚 Modules
                        </button>
                        <button style="padding: 0.75rem 1.5rem; background-color: #f3f4f6; color: #1a1a1a; border: none; border-radius: 50px; font-size: 0.875rem; font-weight: 60; cursor: pointer; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; transition: all 0.2s;"
                                onmouseover="this.style.backgroundColor='#e5e7eb'"
                                onmouseout="this.style.backgroundColor='#f3f4f6'">
                            👨‍🏫 Teachers
                        </button>
                        <button style="padding: 0.75rem 1.5rem; background-color: #f3f4f6; color: #1a1a1a; border: none; border-radius: 50px; font-size: 0.875rem; font-weight: 60; cursor: pointer; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; transition: all 0.2s;"
                                onmouseover="this.style.backgroundColor='#e5e7eb'"
                                onmouseout="this.style.backgroundColor='#f3f4f6'">
                            🎓 Students
                        </button>
                    </div>

                    <!-- Section Title -->
                    <div style="margin-bottom: 1.25rem;">
                        <h3 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.875rem; font-weight: 600; color: #6b7280; margin: 0; text-transform: uppercase; letter-spacing: 0.1em;">
                            Quick Actions
                        </h3>
                    </div>

                    <!-- Action Cards Grid -->
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.25rem; margin-bottom: 2rem;">
                        
                        <!-- Create Module Card -->
                        <a href="{{ route('admin.modules.create') }}" style="text-decoration: none;">
                            <div style="background: #fecaca; border-radius: 24px; padding: 2rem; transition: all 0.3s; cursor: pointer; position: relative;"
                                 onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 16px 32px rgba(252, 165, 165, 0.3)'"
                                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                <div style="position: absolute; top: 1.25rem; right: 1.25rem;">
                                    <div style="background: white; padding: 0.5rem 0.875rem; border-radius: 50px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                        <span style="font-size: 1.25rem; color: #7f1d1d; font-weight: 700; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ $stats['total_modules'] }}</span>
                                    </div>
                                </div>
                                <div style="display: flex; align-items: center; gap: 0.875rem; margin-bottom: 1.25rem;">
                                    <div style="background: #fee2e2; border-radius: 14px; padding: 0.75rem; display: inline-flex;">
                                        <svg style="width: 28px; height: 28px; color: #7f1d1d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                    </div>
                                    <span style="font-size: 0.75rem; font-weight: 700; color: #7f1d1d; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; text-transform: uppercase; letter-spacing: 0.05em;">MODULES</span>
                                </div>
                                <h4 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1.4rem; font-weight: 500; color: #1a1a1a; margin: 0 0 0.5rem 0; line-height: 1.3;">
                                    Create New Module
                                </h4>
                                <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.875rem; color: #7f1d1d; margin: 0; font-weight: 500;">
                                    Add courses and educational content
                                </p>
                            </div>
                        </a>

                        <!-- Add Teacher Card -->
                        <a href="{{ route('admin.teachers.create') }}" style="text-decoration: none;">
                            <div style="background: #fde68a; border-radius: 24px; padding: 2rem; transition: all 0.3s; cursor: pointer; position: relative;"
                                 onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 16px 32px rgba(253, 224, 71, 0.3)'"
                                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                <div style="position: absolute; top: 1.25rem; right: 1.25rem;">
                                    <div style="background: white; padding: 0.5rem 0.875rem; border-radius: 50px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                        <span style="font-size: 1.25rem; color: #713f12; font-weight: 700; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ $stats['total_teachers'] }}</span>
                                    </div>
                                </div>
                                <div style="display: flex; align-items: center; gap: 0.875rem; margin-bottom: 1.25rem;">
                                    <div style="background: #fef3c7; border-radius: 14px; padding: 0.75rem; display: inline-flex;">
                                        <svg style="width: 28px; height: 28px; color: #713f12;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <span style="font-size: 0.75rem; font-weight: 700; color: #713f12; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; text-transform: uppercase; letter-spacing: 0.05em;">TEACHERS</span>
                                </div>
                                <h4 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1.4rem; font-weight: 500; color: #1a1a1a; margin: 0 0 0.5rem 0; line-height: 1.3;">
                                    Add New Teacher
                                </h4>
                                <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.875rem; color: #78350f; margin: 0; font-weight: 500;">
                                    Onboard teaching staff members
                                </p>
                            </div>
                        </a>

                        <!-- View Modules Card -->
                        <a href="{{ route('admin.modules.index') }}" style="text-decoration: none;">
                            <div style="background: #d8b4fe; border-radius: 24px; padding: 2rem; transition: all 0.3s; cursor: pointer; position: relative;"
                                 onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 16px 32px rgba(216, 180, 254, 0.3)'"
                                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                <div style="position: absolute; top: 1.25rem; right: 1.25rem;">
                                    <div style="background: white; padding: 0.5rem 0.875rem; border-radius: 50px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                        <span style="font-size: 1.25rem; color: #581c87; font-weight: 700; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ $stats['active_modules'] }}</span>
                                    </div>
                                </div>
                                <div style="display: flex; align-items: center; gap: 0.875rem; margin-bottom: 1.25rem;">
                                    <div style="background: #e9d5ff; border-radius: 14px; padding: 0.75rem; display: inline-flex;">
                                        <svg style="width: 28px; height: 28px; color: #581c87;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                    </div>
                                    <span style="font-size: 0.75rem; font-weight: 700; color: #581c87; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; text-transform: uppercase; letter-spacing: 0.05em;">MANAGEMENT</span>
                                </div>
                                <h4 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1.4rem; font-weight: 500; color: #1a1a1a; margin: 0 0 0.5rem 0; line-height: 1.3;">
                                    Manage All Modules
                                </h4>
                                <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.875rem; color: #6b21a8; margin: 0; font-weight: 500;">
                                    View and edit course modules
                                </p>
                            </div>
                        </a>

                        <!-- Manage Users Card -->
                        <a href="{{ route('admin.users.index') }}" style="text-decoration: none;">
                            <div style="background: #86efac; border-radius: 24px; padding: 2rem; transition: all 0.3s; cursor: pointer; position: relative;"
                                 onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 16px 32px rgba(134, 239, 172, 0.3)'"
                                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                <div style="position: absolute; top: 1.25rem; right: 1.25rem;">
                                    <div style="background: white; padding: 0.5rem 0.875rem; border-radius: 50px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                        <span style="font-size: 1.25rem; color: #064e3b; font-weight: 700; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ $stats['total_students'] }}</span>
                                    </div>
                                </div>
                                <div style="display: flex; align-items: center; gap: 0.875rem; margin-bottom: 1.25rem;">
                                    <div style="background: #bbf7d0; border-radius: 14px; padding: 0.75rem; display: inline-flex;">
                                        <svg style="width: 28px; height: 28px; color: #064e3b;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                    </div>
                                    <span style="font-size: 0.75rem; font-weight: 700; color: #064e3b; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; text-transform: uppercase; letter-spacing: 0.05em;">USERS</span>
                                </div>
                                <h4 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1.4rem; font-weight: 500; color: #1a1a1a; margin: 0 0 0.5rem 0; line-height: 1.3;">
                                    User Management
                                </h4>
                                <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.875rem; color: #047857; margin: 0; font-weight: 500;">
                                    Manage all system users
                                </p>
                            </div>
                        </a>

                    </div>

                    <!-- Recent Activity - Full Width -->
                    <div style="background: white; border-radius: 24px; padding: 2rem; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04); border: 1px solid #f3f4f6;">
                        <h3 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1.125rem; font-weight: 600; color: #1a1a1a; margin: 0 0 1.5rem 0;">
                            Recent Activity
                        </h3>
                        
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                            <!-- Modules Activity -->
                            <a href="{{ route('admin.modules.index') }}" style="text-decoration: none;">
                                <div style="background: #fde68a; border-radius: 18px; padding: 1.5rem; transition: all 0.3s; cursor: pointer;"
                                     onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(253, 224, 71, 0.2)'"
                                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                                        <div style="background: #fef3c7; border-radius: 12px; padding: 0.75rem; display: inline-flex;">
                                            <svg style="width: 24px; height: 24px; color: #713f12;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.875rem; font-weight: 500; color: #1a1a1a; margin: 0 0 0.25rem 0;">
                                                Available Modules
                                            </h4>
                                            <span style="font-size: 1.5rem; color: #713f12; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 700;">{{ $stats['active_modules'] }}</span>
                                        </div>
                                    </div>
                                    <p style="font-size: 0.75rem; color: #78350f; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 600; margin: 0;">Active now</p>
                                </div>
                            </a>

                            <!-- Teachers Activity -->
                            <a href="{{ route('admin.teachers.index') }}" style="text-decoration: none;">
                                <div style="background: #d8b4fe; border-radius: 18px; padding: 1.5rem; transition: all 0.3s; cursor: pointer;"
                                     onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(216, 180, 254, 0.2)'"
                                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                                        <div style="background: #e9d5ff; border-radius: 12px; padding: 0.75rem; display: inline-flex;">
                                            <svg style="width: 24px; height: 24px; color: #581c87;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.875rem; font-weight: 500; color: #1a1a1a; margin: 0 0 0.25rem 0;">
                                                Teaching Staff
                                            </h4>
                                            <span style="font-size: 1.5rem; color: #581c87; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 700;">{{ $stats['total_teachers'] }}</span>
                                        </div>
                                    </div>
                                    <p style="font-size: 0.75rem; color: #6b21a8; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 600; margin: 0;">Registered</p>
                                </div>
                            </a>

                            <!-- Enrollments Activity -->
                            <a href="{{ route('admin.enrollments.index') }}" style="text-decoration: none;">
                                <div style="background: #fecaca; border-radius: 18px; padding: 1.5rem; transition: all 0.3s; cursor: pointer;"
                                     onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(252, 165, 165, 0.2)'"
                                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                                        <div style="background: #fee2e2; border-radius: 12px; padding: 0.75rem; display: inline-flex;">
                                            <svg style="width: 24px; height: 24px; color: #7f1d1d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.875rem; font-weight: 500; color: #1a1a1a; margin: 0 0 0.25rem 0;">
                                                Enrollments
                                            </h4>
                                            <span style="font-size: 1.5rem; color: #7f1d1d; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 700;">{{ $stats['active_enrollments'] }}</span>
                                        </div>
                                    </div>
                                    <p style="font-size: 0.75rem; color: #991b1b; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 600; margin: 0;">Active</p>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>

                <!-- Right Column - Sidebar -->
                <div>
                    
                    <!-- Profile Card -->
                    <div style="background: white; border-radius: 24px; padding: 2rem; margin-bottom: 1.5rem; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04); border: 1px solid #f3f4f6;">
                        <div style="text-align: center;">
                            <div style="width: 80px; height: 80px; border-radius: 50%; background: #fca5a5; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 16px rgba(252, 165, 165, 0.3);">
                                <span style="font-size: 2rem; color: #1a1a1a; font-weight: 700; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ substr(auth('admin')->user()->name, 0, 1) }}</span>
                            </div>
                            <h3 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1.3rem; font-weight: 500; color: #1a1a1a; margin: 0 0 0.25rem 0;">
                                {{ auth('admin')->user()->name }}
                            </h3>
                            <p style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 0.8125rem; color: #6b7280; margin: 0 0 1.25rem 0; font-weight: 500;">
                                System Administrator
                            </p>
                            <div style="display: flex; align-items: center; justify-content: center; gap: 1.5rem; padding-top: 1.25rem; border-top: 1px solid #f3f4f6;">
                                <div style="text-align: center;">
                                    <p style="font-size: 1.5rem; font-weight: 700; color: #1a1a1a; margin: 0 0 0.125rem 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ $stats['total_modules'] }}</p>
                                    <p style="font-size: 0.75rem; color: #6b7280; margin: 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 600;">Modules</p>
                                </div>
                                <div style="width: 1px; height: 32px; background: #e5e7eb;"></div>
                                <div style="text-align: center;">
                                    <p style="font-size: 1.5rem; font-weight: 700; color: #1a1a1a; margin: 0 0 0.125rem 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ $stats['total_teachers'] }}</p>
                                    <p style="font-size: 0.75rem; color: #6b7280; margin: 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 600;">Teachers</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activity Chart -->
                    <div style="background: white; border-radius: 24px; padding: 2rem; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04); border: 1px solid #f3f4f6;">
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
                            <h3 style="font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-size: 1.125rem; font-weight: 600; color: #1a1a1a; margin: 0;">
                                Weekly Activity
                            </h3>
                        </div>
                        <div style="margin-bottom: 1.5rem;">
                            <p style="font-size: 2.5rem; font-weight: 700; color: #1a1a1a; margin: 0 0 0.25rem 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif;">{{ $stats['active_enrollments'] }}</p>
                            <p style="font-size: 0.875rem; color: #6b7280; margin: 0; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 500;">Total enrollments this week</p>
                        </div>
                        <!-- Simple Bar Chart -->
                        <div style="display: flex; align-items: flex-end; gap: 0.5rem; height: 100px;">
                            <div style="flex: 1; background: #fca5a5; border-radius: 12px 12px 0 0; height: 55%;"></div>
                            <div style="flex: 1; background: #fde68a; border-radius: 12px 12px 0 0; height: 70%;"></div>
                            <div style="flex: 1; background: #86efac; border-radius: 12px 12px 0 0; height: 45%;"></div>
                            <div style="flex: 1; background: #93c5fd; border-radius: 12px 12px 0 0; height: 75%;"></div>
                            <div style="flex: 1; background: #d8b4fe; border-radius: 12px 12px 0 0; height: 60%;"></div>
                            <div style="flex: 1; background: #fca5a5; border-radius: 12px 12px 0 0; height: 85%;"></div>
                            <div style="flex: 1; background: #1a1a1a; border-radius: 12px 12px 0 0; height: 100%;"></div>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-top: 0.75rem; padding: 0 0.25rem;">
                            <span style="font-size: 0.625rem; color: #9ca3af; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 600;">MON</span>
                            <span style="font-size: 0.625rem; color: #9ca3af; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 600;">TUE</span>
                            <span style="font-size: 0.625rem; color: #9ca3af; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 600;">WED</span>
                            <span style="font-size: 0.625rem; color: #9ca3af; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 600;">THU</span>
                            <span style="font-size: 0.625rem; color: #9ca3af; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 600;">FRI</span>
                            <span style="font-size: 0.625rem; color: #9ca3af; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 600;">SAT</span>
                            <span style="font-size: 0.625rem; color: #1a1a1a; font-family: 'Helvetica Rounded', 'Arial Rounded MT Bold', sans-serif; font-weight: 700;">SUN</span>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-admin-layout>