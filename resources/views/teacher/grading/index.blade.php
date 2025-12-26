@extends('layouts.teacher-layout')

@section('content')

<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Grade Students</h1>
            <p class="mt-2 text-sm text-gray-600">Evaluate student performance across all your modules</p>
        </div>

        <!-- Statistics Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            
            <!-- Pending -->
            <div class="bg-gradient-to-br from-orange-100 to-orange-50 rounded-xl p-6 border border-orange-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-orange-600 mb-1">Pending</p>
                        <p class="text-3xl font-bold text-orange-900">{{ $stats['total_pending'] }}</p>
                    </div>
                    <div class="bg-orange-500 rounded-full p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Completed -->
            <div class="bg-gradient-to-br from-blue-100 to-blue-50 rounded-xl p-6 border border-blue-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-blue-600 mb-1">Completed</p>
                        <p class="text-3xl font-bold text-blue-900">{{ $stats['total_completed'] }}</p>
                    </div>
                    <div class="bg-blue-500 rounded-full p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Passed -->
            <div class="bg-gradient-to-br from-green-100 to-green-50 rounded-xl p-6 border border-green-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-green-600 mb-1">Passed</p>
                        <p class="text-3xl font-bold text-green-900">{{ $stats['total_passed'] }}</p>
                    </div>
                    <div class="bg-green-500 rounded-full p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Failed -->
            <div class="bg-gradient-to-br from-red-100 to-red-50 rounded-xl p-6 border border-red-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-red-600 mb-1">Failed</p>
                        <p class="text-3xl font-bold text-red-900">{{ $stats['total_failed'] }}</p>
                    </div>
                    <div class="bg-red-500 rounded-full p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                </div>
            </div>

        </div>

        <!-- Modules List -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Your Modules</h2>
                <p class="text-sm text-gray-600 mt-1">Click on a module to grade students</p>
            </div>

            @if($modules->count() > 0)
                <div class="divide-y divide-gray-200">
                    @foreach($modules as $module)
                        <a href="{{ route('teacher.grading.module', $module) }}" 
                           class="block px-6 py-5 hover:bg-gray-50 transition-colors duration-150">
                            
                            <div class="flex items-center justify-between">
                                
                                <!-- Module Info -->
                                <div class="flex items-center gap-4 flex-1">
                                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-3">
                                        <span class="text-white font-bold text-lg">{{ substr($module->code, 0, 2) }}</span>
                                    </div>
                                    <div>
                                        <h3 class="text-base font-semibold text-gray-900">{{ $module->name }}</h3>
                                        <p class="text-sm text-gray-600">{{ $module->code }}</p>
                                    </div>
                                </div>

                                <!-- Stats -->
                                <div class="flex items-center gap-6">
                                    <div class="text-center">
                                        <p class="text-xs text-gray-600">Pending</p>
                                        <p class="text-xl font-bold text-orange-600">{{ $module->pending_students }}</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-xs text-gray-600">Passed</p>
                                        <p class="text-xl font-bold text-green-600">{{ $module->passed_students }}</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-xs text-gray-600">Failed</p>
                                        <p class="text-xl font-bold text-red-600">{{ $module->failed_students }}</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-xs text-gray-600">Total</p>
                                        <p class="text-xl font-bold text-blue-600">{{ $module->total_students }}</p>
                                    </div>
                                    
                                    <!-- Arrow -->
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </div>
                            </div>

                        </a>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="px-6 py-12 text-center">
                    <div class="bg-purple-100 rounded-full p-6 inline-block mb-4">
                        <svg class="h-12 w-12 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <p class="text-lg font-semibold text-gray-900 mb-2">No Modules Assigned</p>
                    <p class="text-sm text-gray-600">Contact your administrator to get modules assigned.</p>
                </div>
            @endif
        </div>

    </div>
</div>

@endsection