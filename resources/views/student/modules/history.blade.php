@extends('layouts.student-layout')

@section('content')

<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Page Header -->
        <div class="mb-8">
            <a href="{{ route('student.dashboard') }}" 
               class="inline-flex items-center text-sm font-medium text-purple-600 hover:text-purple-800 mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Dashboard
            </a>
            
            <h1 class="text-3xl font-bold text-gray-900">Module History</h1>
            <p class="mt-2 text-sm text-gray-600">Complete record of your academic performance</p>
        </div>

        <!-- Statistics Summary -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            
            <!-- Total Completed -->
            <div class="bg-gradient-to-br from-blue-100 to-blue-50 rounded-xl p-6 border border-blue-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-blue-600 mb-1">Completed</p>
                        <p class="text-3xl font-bold text-blue-900">{{ $stats['total_completed'] }}</p>
                    </div>
                    <div class="bg-blue-500 rounded-full p-3">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pass Rate -->
            <div class="bg-gradient-to-br from-purple-100 to-purple-50 rounded-xl p-6 border border-purple-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-purple-600 mb-1">Pass Rate</p>
                        <p class="text-3xl font-bold text-purple-900">{{ $stats['pass_rate'] }}%</p>
                    </div>
                    <div class="bg-purple-500 rounded-full p-3">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                </div>
            </div>

        </div>

        <!-- Module History Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-pink-50 border-b border-purple-200 rounded-t-xl">
                <h2 class="text-lg font-semibold text-gray-900">Completed Modules</h2>
                <p class="text-sm text-gray-600 mt-1">Your academic performance history</p>
            </div>

            @if($completedModules->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Module</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Code</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Enrolled</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Completed</th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Result</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($completedModules as $enrollment)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-3 shadow-md">
                                                <span class="text-white font-bold text-lg">{{ substr($enrollment->module->code, 0, 2) }}</span>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-900">{{ $enrollment->module->name }}</p>
                                                <p class="text-sm text-gray-600">{{ $enrollment->module->description }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 bg-purple-100 text-purple-700 text-sm font-semibold rounded-lg">
                                            {{ $enrollment->module->code }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm text-gray-900">{{ $enrollment->enrolled_at->format('M d, Y') }}</p>
                                        <p class="text-xs text-gray-500">{{ $enrollment->enrolled_at->diffForHumans() }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm text-gray-900">{{ $enrollment->completed_at ? $enrollment->completed_at->format('M d, Y') : 'N/A' }}</p>
                                        <p class="text-xs text-gray-500">{{ $enrollment->completed_at ? $enrollment->completed_at->diffForHumans() : '' }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center">
                                            @if(strtoupper(trim($enrollment->pass_status)) === 'PASS')
                                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-green-100 text-green-800 border border-green-200 shadow-sm">
                                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                    </svg>
                                                    PASS
                                                </span>
                                            @elseif(strtoupper(trim($enrollment->pass_status)) === 'FAIL')
                                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-red-100 text-red-800 border border-red-200 shadow-sm">
                                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                                    </svg>
                                                    FAIL
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                    PENDING
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Performance Summary -->
                @if(!$isOldStudent && $stats['total_completed'] > 0)
                    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Overall Performance</p>
                                <p class="text-xs text-gray-600 mt-1">Based on {{ $stats['total_completed'] }} completed module(s)</p>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="text-right">
                                    <p class="text-2xl font-bold text-green-600">{{ $stats['total_passed'] }}</p>
                                    <p class="text-xs text-gray-600">Passed</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-2xl font-bold text-red-600">{{ $stats['total_failed'] }}</p>
                                    <p class="text-xs text-gray-600">Failed</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-2xl font-bold text-purple-600">{{ $stats['pass_rate'] }}%</p>
                                    <p class="text-xs text-gray-600">Success Rate</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <!-- No History -->
                <div class="p-12 text-center">
                    <div class="bg-purple-100 rounded-full p-6 inline-block mb-4">
                        <svg class="h-12 w-12 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Completed Modules</h3>
                    <p class="text-sm text-gray-600 mb-6">You haven't completed any modules yet. Start learning to build your history!</p>
                    @if(!$isOldStudent)
                        <a href="{{ route('student.modules.available') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-500 to-purple-600 text-white font-semibold rounded-lg hover:from-purple-600 hover:to-purple-700 transition-all duration-200 shadow-md hover:shadow-lg">
                            Browse Available Modules
                        </a>
                    @endif
                </div>
            @endif
        </div>

    </div>
</div>

@endsection