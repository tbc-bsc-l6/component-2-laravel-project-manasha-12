@extends('layouts.teacher-layout')

@section('content')

<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded">
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Stats Grid with Icons and Colors (Matching Admin) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            
            <!-- Assigned Modules - Purple -->
            <div class="bg-gradient-to-br from-purple-100 to-purple-50 overflow-hidden shadow-sm sm:rounded-xl p-6 border border-purple-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-purple-600 mb-1">Assigned Modules</p>
                        <p class="text-3xl font-bold text-purple-900">{{ $stats['total_modules'] ?? 0 }}</p>
                        <p class="text-xs text-purple-600 mt-1">Your teaching modules</p>
                    </div>
                    <div class="bg-purple-500 rounded-full p-4">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Students - Blue -->
            <div class="bg-gradient-to-br from-blue-100 to-blue-50 overflow-hidden shadow-sm sm:rounded-xl p-6 border border-blue-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-blue-600 mb-1">Total Students</p>
                        <p class="text-3xl font-bold text-blue-900">{{ $stats['total_students'] ?? 0 }}</p>
                        <p class="text-xs text-blue-600 mt-1">Across all modules</p>
                    </div>
                    <div class="bg-blue-500 rounded-full p-4">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pending Evaluations - Orange -->
            <div class="bg-gradient-to-br from-orange-100 to-orange-50 overflow-hidden shadow-sm sm:rounded-xl p-6 border border-orange-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-orange-600 mb-1">Pending Evaluations</p>
                        <p class="text-3xl font-bold text-orange-900">{{ $stats['pending_evaluations'] ?? 0 }}</p>
                        <p class="text-xs text-orange-600 mt-1">Need grading</p>
                    </div>
                    <div class="bg-orange-500 rounded-full p-4">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Completed Evaluations - Green -->
            <div class="bg-gradient-to-br from-green-100 to-green-50 overflow-hidden shadow-sm sm:rounded-xl p-6 border border-green-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-green-600 mb-1">Completed</p>
                        <p class="text-3xl font-bold text-green-900">{{ $stats['completed_evaluations'] ?? 0 }}</p>
                        <p class="text-xs text-green-600 mt-1">Successfully graded</p>
                    </div>
                    <div class="bg-green-500 rounded-full p-4">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

        </div>

        <!-- Quick Actions Section with Grid -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                <span class="text-sm text-gray-500">Manage your teaching</span>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                
                <!-- View All Modules -->
                <a href="{{ route('teacher.modules.index') }}" 
                   class="group bg-gradient-to-br from-purple-500 to-purple-600 p-6 rounded-xl text-white hover:from-purple-600 hover:to-purple-700 transition-all duration-200 shadow-md hover:shadow-xl transform hover:-translate-y-1">
                    <div class="flex flex-col items-center text-center space-y-3">
                        <div class="bg-white/20 rounded-full p-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                            </svg>
                        </div>
                        <span class="font-semibold text-base">My Modules</span>
                    </div>
                </a>

                <!-- Grade Students -->
                <a href="{{ route('teacher.grading.index') }}" 
                   class="group bg-gradient-to-br from-blue-500 to-blue-600 p-6 rounded-xl text-white hover:from-blue-600 hover:to-blue-700 transition-all duration-200 shadow-md hover:shadow-xl transform hover:-translate-y-1">
                    <div class="flex flex-col items-center text-center space-y-3">
                        <div class="bg-white/20 rounded-full p-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                        </div>
                        <span class="font-semibold text-base">Grade Students</span>
                    </div>
                </a>

                <!-- View Dashboard -->
                <a href="{{ route('teacher.dashboard') }}" 
                   class="group bg-gradient-to-br from-green-500 to-green-600 p-6 rounded-xl text-white hover:from-green-600 hover:to-green-700 transition-all duration-200 shadow-md hover:shadow-xl transform hover:-translate-y-1">
                    <div class="flex flex-col items-center text-center space-y-3">
                        <div class="bg-white/20 rounded-full p-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <span class="font-semibold text-base">Dashboard</span>
                    </div>
                </a>

            </div>
        </div>

        <!-- My Modules Section -->
        @if($modules->count() > 0)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">My Teaching Modules</h3>
                    <a href="{{ route('teacher.modules.index') }}" class="text-sm text-purple-600 hover:text-purple-800">View all →</a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($modules->take(6) as $module)
                        <a href="{{ route('teacher.modules.show', $module) }}" 
                           class="group block bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 border border-gray-200 hover:border-purple-300 hover:shadow-lg transition-all duration-200 transform hover:-translate-y-1">
                            
                            <div class="flex items-center gap-4 mb-4">
                                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-3 group-hover:from-purple-600 group-hover:to-purple-700 transition-all">
                                    <span class="text-white font-bold text-lg">{{ substr($module->code, 0, 2) }}</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-gray-900 truncate group-hover:text-purple-600 transition-colors">
                                        {{ $module->name }}
                                    </h4>
                                    <p class="text-sm text-gray-600">{{ $module->code }}</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-4 pt-4 border-t border-gray-200">
                                <div class="text-center">
                                    <p class="text-xs text-gray-600 mb-1">Active</p>
                                    <p class="text-xl font-bold text-orange-600">{{ $module->pending_count ?? 0 }}</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs text-gray-600 mb-1">Done</p>
                                    <p class="text-xl font-bold text-green-600">{{ $module->completed_count ?? 0 }}</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs text-gray-600 mb-1">Total</p>
                                    <p class="text-xl font-bold text-blue-600">{{ ($module->pending_count ?? 0) + ($module->completed_count ?? 0) }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6">
                <div class="flex items-center justify-center py-8">
                    <div class="text-center">
                        <div class="bg-purple-100 rounded-full p-6 inline-block mb-4">
                            <svg class="h-12 w-12 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <p class="text-xl font-semibold text-gray-900 mb-2">No Modules Assigned Yet</p>
                        <p class="text-sm text-gray-600">Contact your administrator to get modules assigned to you.</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Performance Overview -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <!-- Statistics Overview -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Teaching Overview</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-700">Assigned Modules</span>
                        <span class="text-lg font-bold text-purple-600">{{ $stats['total_modules'] ?? 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-700">Total Students</span>
                        <span class="text-lg font-bold text-blue-600">{{ $stats['total_students'] ?? 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-orange-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-700">Pending Evaluations</span>
                        <span class="text-lg font-bold text-orange-600">{{ $stats['pending_evaluations'] ?? 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-700">Completed</span>
                        <span class="text-lg font-bold text-green-600">{{ $stats['completed_evaluations'] ?? 0 }}</span>
                    </div>
                </div>
            </div>

            <!-- Recent Activity / Tips -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Tips</h3>
                <div class="space-y-4">
                    <div class="flex gap-3 p-3 bg-gray-50 rounded-lg">
                        <div class="bg-purple-100 rounded-full p-2 h-fit">
                            <svg class="h-5 w-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Grade Students</p>
                            <p class="text-xs text-gray-600 mt-1">Click on any module to view and grade students</p>
                        </div>
                    </div>
                    
                    <div class="flex gap-3 p-3 bg-gray-50 rounded-lg">
                        <div class="bg-blue-100 rounded-full p-2 h-fit">
                            <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Evaluation Status</p>
                            <p class="text-xs text-gray-600 mt-1">Mark students as PASS or FAIL after evaluation</p>
                        </div>
                    </div>
                    
                    <div class="flex gap-3 p-3 bg-gray-50 rounded-lg">
                        <div class="bg-green-100 rounded-full p-2 h-fit">
                            <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Track Progress</p>
                            <p class="text-xs text-gray-600 mt-1">Monitor completed evaluations with timestamps</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection