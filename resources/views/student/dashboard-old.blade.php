@extends('layouts.student-layout')

@section('content')

<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Welcome Message -->
        <div class="bg-gradient-to-r from-gray-700 to-gray-800 rounded-xl p-6 mb-8 text-white shadow-lg">
            <h1 class="text-3xl font-bold mb-2">Welcome back, {{ $student->name }}!</h1>
            <p class="text-gray-300">Alumni Portal - View your completed module history</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            
            <!-- Total Completed -->
            <div class="bg-gradient-to-br from-blue-100 to-blue-50 rounded-xl p-6 border border-blue-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-blue-600 mb-1">Total Completed</p>
                        <p class="text-3xl font-bold text-blue-900">{{ $stats['total_completed'] }}</p>
                    </div>
                    <div class="bg-blue-500 rounded-full p-4">
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
                    <div class="bg-green-500 rounded-full p-4">
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
                    <div class="bg-red-500 rounded-full p-4">
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
                    <div class="bg-purple-500 rounded-full p-4">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                </div>
            </div>

        </div>

        <!-- Completed Modules -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200 rounded-t-xl">
                <h2 class="text-lg font-semibold text-gray-900">Your Module History</h2>
                <p class="text-sm text-gray-600 mt-1">Complete record of your academic performance</p>
            </div>

            @if($completedModules->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Module</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Code</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Completed</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Result</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($completedModules as $enrollment)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="bg-gradient-to-br from-gray-500 to-gray-600 rounded-lg p-3">
                                                <span class="text-white font-bold">{{ substr($enrollment->module->code, 0, 2) }}</span>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-900">{{ $enrollment->module->name }}</p>
                                                <p class="text-sm text-gray-600">{{ $enrollment->module->description }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded">
                                            {{ $enrollment->module->code }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm text-gray-900">{{ $enrollment->completed_at->format('M d, Y') }}</p>
                                        <p class="text-xs text-gray-500">{{ $enrollment->completed_at->diffForHumans() }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-center">
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
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-12 text-center">
                    <div class="bg-gray-100 rounded-full p-6 inline-block mb-4">
                        <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <p class="text-lg font-semibold text-gray-900">No Module History</p>
                    <p class="text-sm text-gray-600 mt-2">No completed modules found in your records.</p>
                </div>
            @endif
        </div>

    </div>
</div>

@endsection