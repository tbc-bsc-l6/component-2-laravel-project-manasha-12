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
            
            <h1 class="text-3xl font-bold text-gray-900">Available Modules</h1>
            <p class="mt-2 text-sm text-gray-600">Enroll in modules to expand your learning</p>
        </div>

        <!-- Enrollment Status -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 mb-8 border border-blue-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="bg-blue-500 rounded-full p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Enrollment Status</h3>
                        <p class="text-sm text-gray-600">You are currently enrolled in <span class="font-bold text-blue-600">{{ $stats['current_enrollments'] }}</span> out of <span class="font-bold">4</span> modules</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-3xl font-bold text-blue-600">{{ $stats['available_slots'] }}</p>
                    <p class="text-sm text-gray-600">slots available</p>
                </div>
            </div>
            
            <!-- Progress Bar -->
            <div class="mt-4">
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-3 rounded-full transition-all duration-500" 
                         style="width: {{ ($stats['current_enrollments'] / 4) * 100 }}%"></div>
                </div>
                <p class="text-xs text-gray-500 mt-2">{{ $stats['current_enrollments'] }}/4 modules enrolled</p>
            </div>
        </div>

        @if($stats['available_slots'] > 0)
            <!-- Available Modules Grid -->
            @if($availableModules->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($availableModules as $module)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-200 transform hover:-translate-y-1">
                            
                            <!-- Module Header -->
                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 text-white">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="bg-white/20 rounded-lg p-3">
                                        <span class="text-white font-bold text-xl">{{ substr($module->code, 0, 2) }}</span>
                                    </div>
                                    @if($module->active_enrollments_count >= $module->max_students * 0.8)
                                        <span class="px-2 py-1 bg-red-500 text-white text-xs font-semibold rounded-full">
                                            Filling Fast
                                        </span>
                                    @else
                                        <span class="px-2 py-1 bg-green-500 text-white text-xs font-semibold rounded-full">
                                            Available
                                        </span>
                                    @endif
                                </div>
                                <h3 class="text-xl font-bold mb-2">{{ $module->name }}</h3>
                                <p class="text-sm text-blue-100">{{ $module->code }}</p>
                            </div>

                            <!-- Module Body -->
                            <div class="p-6">
                                <p class="text-sm text-gray-600 mb-4 line-clamp-3">{{ $module->description }}</p>
                                
                                <!-- Module Stats -->
                                <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-200">
                                    <div class="text-center">
                                        <p class="text-xs text-gray-500">Enrolled</p>
                                        <p class="text-lg font-bold text-gray-900">{{ $module->active_enrollments_count }}</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-xs text-gray-500">Max</p>
                                        <p class="text-lg font-bold text-gray-900">{{ $module->max_students }}</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-xs text-gray-500">Spots Left</p>
                                        <p class="text-lg font-bold text-green-600">{{ $module->max_students - $module->active_enrollments_count }}</p>
                                    </div>
                                </div>

                                <!-- Enroll Button -->
                                <form method="POST" action="{{ route('student.modules.enroll', $module) }}">
                                    @csrf
                                    <button type="submit" 
                                            onclick="return confirm('Enroll in {{ $module->name }}?')"
                                            class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold py-3 px-4 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                        <span class="flex items-center justify-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                            </svg>
                                            Enroll Now
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- No Available Modules -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                    <div class="bg-gray-100 rounded-full p-6 inline-block mb-4">
                        <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Available Modules</h3>
                    <p class="text-sm text-gray-600 mb-4">All modules are either full or you're already enrolled in them.</p>
                    <a href="{{ route('student.dashboard') }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Back to Dashboard
                    </a>
                </div>
            @endif
        @else
            <!-- At Maximum Capacity -->
            <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-xl shadow-sm border border-yellow-200 p-12 text-center">
                <div class="bg-yellow-100 rounded-full p-6 inline-block mb-4">
                    <svg class="h-12 w-12 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Maximum Enrollment Reached</h3>
                <p class="text-sm text-gray-600 mb-4">You are currently enrolled in the maximum of 4 modules.</p>
                <p class="text-sm text-gray-500 mb-6">Complete a module to free up a slot for new enrollments.</p>
                <a href="{{ route('student.modules.current') }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                    View My Current Modules
                </a>
            </div>
        @endif

    </div>
</div>

@endsection