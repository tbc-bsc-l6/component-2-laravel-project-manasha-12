@extends('layouts.student-layout')

@section('content')

<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Welcome Message -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-6 mb-8 text-white shadow-lg">
            <h1 class="text-3xl font-bold mb-2">Welcome back, {{ $student->name }}!</h1>
            <p class="text-blue-100">Track your progress and manage your module enrollments</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            
            <!-- Current Enrollments -->
            <div class="bg-gradient-to-br from-blue-100 to-blue-50 rounded-xl p-6 border border-blue-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-blue-600 mb-1">Active Modules</p>
                        <p class="text-3xl font-bold text-blue-900">{{ $stats['current_enrollments'] }}/4</p>
                        <p class="text-xs text-blue-600 mt-1">Currently studying</p>
                    </div>
                    <div class="bg-blue-500 rounded-full p-4">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Available Slots -->
            <div class="bg-gradient-to-br from-green-100 to-green-50 rounded-xl p-6 border border-green-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-green-600 mb-1">Available Slots</p>
                        <p class="text-3xl font-bold text-green-900">{{ $stats['available_slots'] }}</p>
                        <p class="text-xs text-green-600 mt-1">
                            @if($stats['can_enroll'])
                                Can enroll more
                            @else
                                At maximum
                            @endif
                        </p>
                    </div>
                    <div class="bg-green-500 rounded-full p-4">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Completed -->
            <div class="bg-gradient-to-br from-purple-100 to-purple-50 rounded-xl p-6 border border-purple-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-purple-600 mb-1">Completed</p>
                        <p class="text-3xl font-bold text-purple-900">{{ $stats['total_completed'] }}</p>
                        <p class="text-xs text-purple-600 mt-1">Total finished</p>
                    </div>
                    <div class="bg-purple-500 rounded-full p-4">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Passed -->
            <div class="bg-gradient-to-br from-yellow-100 to-yellow-50 rounded-xl p-6 border border-yellow-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-yellow-600 mb-1">Passed</p>
                        <p class="text-3xl font-bold text-yellow-900">{{ $stats['total_passed'] }}</p>
                        <p class="text-xs text-yellow-600 mt-1">Successful</p>
                    </div>
                    <div class="bg-yellow-500 rounded-full p-4">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>
            </div>

        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                
                <!-- Enroll in Modules -->
                @if($stats['can_enroll'])
                    <a href="{{ route('student.modules.available') }}" 
                       class="group bg-gradient-to-br from-blue-500 to-blue-600 p-6 rounded-xl text-white hover:from-blue-600 hover:to-blue-700 transition-all duration-200 shadow-md hover:shadow-xl transform hover:-translate-y-1">
                        <div class="flex flex-col items-center text-center space-y-3">
                            <div class="bg-white/20 rounded-full p-3">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </div>
                            <span class="font-semibold text-base">Enroll in Modules</span>
                        </div>
                    </a>
                @else
                    <div class="bg-gray-200 p-6 rounded-xl text-gray-500 cursor-not-allowed">
                        <div class="flex flex-col items-center text-center space-y-3">
                            <div class="bg-gray-300 rounded-full p-3">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </div>
                            <span class="font-semibold text-base">At Max Capacity</span>
                        </div>
                    </div>
                @endif

                <!-- Current Modules -->
                <a href="{{ route('student.modules.current') }}" 
                   class="group bg-gradient-to-br from-green-500 to-green-600 p-6 rounded-xl text-white hover:from-green-600 hover:to-green-700 transition-all duration-200 shadow-md hover:shadow-xl transform hover:-translate-y-1">
                    <div class="flex flex-col items-center text-center space-y-3">
                        <div class="bg-white/20 rounded-full p-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <span class="font-semibold text-base">My Current Modules</span>
                    </div>
                </a>

                <!-- Module History -->
                <a href="{{ route('student.modules.history') }}" 
                   class="group bg-gradient-to-br from-purple-500 to-purple-600 p-6 rounded-xl text-white hover:from-purple-600 hover:to-purple-700 transition-all duration-200 shadow-md hover:shadow-xl transform hover:-translate-y-1">
                    <div class="flex flex-col items-center text-center space-y-3">
                        <div class="bg-white/20 rounded-full p-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="font-semibold text-base">Module History</span>
                    </div>
                </a>

                <!-- Dashboard -->
                <a href="{{ route('student.dashboard') }}" 
                   class="group bg-gradient-to-br from-orange-500 to-orange-600 p-6 rounded-xl text-white hover:from-orange-600 hover:to-orange-700 transition-all duration-200 shadow-md hover:shadow-xl transform hover:-translate-y-1">
                    <div class="flex flex-col items-center text-center space-y-3">
                        <div class="bg-white/20 rounded-full p-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </div>
                        <span class="font-semibold text-base">Dashboard</span>
                    </div>
                </a>

            </div>
        </div>

        <!-- Current Modules -->
        @if($currentModules->count() > 0)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8">
                <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-blue-200 rounded-t-xl">
                    <h2 class="text-lg font-semibold text-gray-900">Currently Studying</h2>
                    <p class="text-sm text-gray-600 mt-1">{{ $currentModules->count() }} active module(s)</p>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($currentModules as $enrollment)
                            <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg p-5 border border-gray-200 hover:border-blue-300 transition-all">
                                <div class="flex items-start gap-4">
                                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-3">
                                        <span class="text-white font-bold text-lg">{{ substr($enrollment->module->code, 0, 2) }}</span>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-900 mb-1">{{ $enrollment->module->name }}</h3>
                                        <p class="text-sm text-gray-600 mb-2">{{ $enrollment->module->code }}</p>
                                        <div class="flex items-center gap-2 text-xs text-gray-500">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            Enrolled {{ $enrollment->enrolled_at->format('M d, Y') }}
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">
                                        In Progress
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- Recent Completed Modules -->
        @if($completedModules->count() > 0)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-pink-50 border-b border-purple-200 rounded-t-xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">Recent Completed Modules</h2>
                            <p class="text-sm text-gray-600 mt-1">Your latest results</p>
                        </div>
                        <a href="{{ route('student.modules.history') }}" class="text-sm text-purple-600 hover:text-purple-800 font-medium">
                            View All →
                        </a>
                    </div>
                </div>

                <div class="p-6">
                    <div class="space-y-3">
                        @foreach($completedModules->take(5) as $enrollment)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <div class="flex items-center gap-4">
                                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-3">
                                        <span class="text-white font-bold">{{ substr($enrollment->module->code, 0, 2) }}</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">{{ $enrollment->module->name }}</h4>
                                        <p class="text-sm text-gray-600">{{ $enrollment->module->code }}</p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            Completed {{ $enrollment->completed_at->format('M d, Y') }}
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    @if(strtoupper(trim($enrollment->pass_status)) === 'PASS')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-green-100 text-green-800 border border-green-200">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            PASS
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-red-100 text-red-800 border border-red-200">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                            </svg>
                                            FAIL
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>

@endsection