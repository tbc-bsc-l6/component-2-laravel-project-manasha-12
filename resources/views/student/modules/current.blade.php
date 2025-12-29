@extends('layouts.student-layout')

@section('content')

<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Page Header -->
        <div class="mb-8">
            <a href="{{ route('student.dashboard') }}" 
               class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Dashboard
            </a>
            
            <h1 class="text-3xl font-bold text-gray-900">My Current Modules</h1>
            <p class="mt-2 text-sm text-gray-600">Modules you are actively studying</p>
        </div>

        <!-- Enrollment Summary -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            
            <!-- Active Enrollments -->
            <div class="bg-gradient-to-br from-blue-100 to-blue-50 rounded-xl p-6 border border-blue-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-blue-600 mb-1">Active Modules</p>
                        <p class="text-4xl font-bold text-blue-900">{{ $stats['current_enrollments'] }}</p>
                        <p class="text-xs text-blue-600 mt-2">Currently studying</p>
                    </div>
                    <div class="bg-blue-500 rounded-full p-4">
                        <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <p class="text-4xl font-bold text-green-900">{{ $stats['available_slots'] }}</p>
                        <p class="text-xs text-green-600 mt-2">
                            @if($stats['available_slots'] > 0)
                                Can enroll in more
                            @else
                                At maximum capacity
                            @endif
                        </p>
                    </div>
                    <div class="bg-green-500 rounded-full p-4">
                        <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

        </div>

        <!-- Current Modules List -->
        @if($currentModules->count() > 0)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-blue-200 rounded-t-xl">
                    <h2 class="text-lg font-semibold text-gray-900">Active Enrollments</h2>
                    <p class="text-sm text-gray-600 mt-1">{{ $currentModules->count() }} module(s) in progress</p>
                </div>

                <div class="divide-y divide-gray-200">
                    @foreach($currentModules as $enrollment)
                        <div class="p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start justify-between">
                                
                                <!-- Module Info -->
                                <div class="flex items-start gap-4 flex-1">
                                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-4 shadow-md">
                                        <span class="text-white font-bold text-2xl">{{ substr($enrollment->module->code, 0, 2) }}</span>
                                    </div>
                                    
                                    <div class="flex-1">
                                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $enrollment->module->name }}</h3>
                                        <p class="text-sm text-gray-600 mb-3">{{ $enrollment->module->description }}</p>
                                        
                                        <div class="flex items-center gap-6 text-sm">
                                            <div class="flex items-center gap-2 text-gray-600">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                                </svg>
                                                <span class="font-medium">{{ $enrollment->module->code }}</span>
                                            </div>
                                            
                                            <div class="flex items-center gap-2 text-gray-600">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                <span>Enrolled {{ $enrollment->enrolled_at->format('M d, Y') }}</span>
                                            </div>

                                            <div class="flex items-center gap-2 text-gray-600">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                <span>{{ $enrollment->enrolled_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Badge -->
                                <div>
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-yellow-100 text-yellow-800 border border-yellow-200">
                                        <svg class="w-4 h-4 mr-2 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                        </svg>
                                        In Progress
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            @if($stats['available_slots'] > 0)
                <!-- Enroll More CTA -->
                <div class="mt-8 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-6 border border-green-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">Ready for More?</h3>
                            <p class="text-sm text-gray-600">You have {{ $stats['available_slots'] }} slot(s) available for new enrollments.</p>
                        </div>
                        <a href="{{ route('student.modules.available') }}" 
                           class="px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-200 shadow-md hover:shadow-lg">
                            Browse Available Modules
                        </a>
                    </div>
                </div>
            @endif
        @else
            <!-- No Current Modules -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                <div class="bg-blue-100 rounded-full p-6 inline-block mb-4">
                    <svg class="h-12 w-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No Active Enrollments</h3>
                <p class="text-sm text-gray-600 mb-6">You are not currently enrolled in any modules. Start your learning journey today!</p>
                <a href="{{ route('student.modules.available') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-200 shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Enroll in Modules
                </a>
            </div>
        @endif

    </div>
</div>

@endsection