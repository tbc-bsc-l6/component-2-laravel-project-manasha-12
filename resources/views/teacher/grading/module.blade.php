@extends('layouts.teacher-layout')

@section('content')

<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Back Button & Header -->
        <div class="mb-6">
            <a href="{{ route('teacher.grading.index') }}"
                class="inline-flex items-center text-sm font-medium text-purple-600 hover:text-purple-800 mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to All Modules
            </a>

            <div class="flex items-start justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $module->name }}</h1>
                    <p class="mt-2 text-sm text-gray-600">{{ $module->code }} • Grade students enrolled in this module</p>
                </div>
                <div class="bg-gradient-to-br from-purple-100 to-purple-50 px-4 py-2 rounded-lg border border-purple-200">
                    <span class="text-sm font-semibold text-purple-900">Max: {{ $module->max_students }} students</span>
                </div>
            </div>
        </div>

        <!-- Module Statistics -->
        <div class="grid grid-cols-2 md:grid-cols-6 gap-4 mb-8">

            <div class="bg-gradient-to-br from-blue-100 to-blue-50 rounded-lg p-4 border border-blue-200">
                <p class="text-xs font-medium text-blue-600 mb-1">Total</p>
                <p class="text-2xl font-bold text-blue-900">{{ $stats['total'] }}</p>
            </div>

            <div class="bg-gradient-to-br from-orange-100 to-orange-50 rounded-lg p-4 border border-orange-200">
                <p class="text-xs font-medium text-orange-600 mb-1">Pending</p>
                <p class="text-2xl font-bold text-orange-900">{{ $stats['pending'] }}</p>
            </div>

            <div class="bg-gradient-to-br from-gray-100 to-gray-50 rounded-lg p-4 border border-gray-200">
                <p class="text-xs font-medium text-gray-600 mb-1">Completed</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['completed'] }}</p>
            </div>

            <div class="bg-gradient-to-br from-green-100 to-green-50 rounded-lg p-4 border border-green-200">
                <p class="text-xs font-medium text-green-600 mb-1">Passed</p>
                <p class="text-2xl font-bold text-green-900">{{ $stats['passed'] }}</p>
            </div>

            <div class="bg-gradient-to-br from-red-100 to-red-50 rounded-lg p-4 border border-red-200">
                <p class="text-xs font-medium text-red-600 mb-1">Failed</p>
                <p class="text-2xl font-bold text-red-900">{{ $stats['failed'] }}</p>
            </div>

            <div class="bg-gradient-to-br from-purple-100 to-purple-50 rounded-lg p-4 border border-purple-200">
                <p class="text-xs font-medium text-purple-600 mb-1">Pass Rate</p>
                <p class="text-2xl font-bold text-purple-900">{{ $stats['pass_rate'] }}%</p>
            </div>

        </div>

        <!-- Pending Students Section -->
        @if($pendingStudents->count() > 0)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8">
            <div class="px-6 py-4 bg-gradient-to-r from-orange-50 to-yellow-50 border-b border-orange-200 rounded-t-xl">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="bg-orange-500 rounded-lg p-2">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">Students Pending Evaluation</h2>
                            <p class="text-sm text-gray-600">{{ $pendingStudents->count() }} student(s) waiting for grades</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Student</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Module</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Enrolled</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($pendingStudents as $enrollment)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-full h-10 w-10 flex items-center justify-center">
                                        <span class="text-white font-semibold text-sm">{{ substr($enrollment->student->name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">{{ $enrollment->student->name }}</p>
                                        <p class="text-xs text-gray-500">ID: {{ $enrollment->student->id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-900">{{ $enrollment->student->email }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="bg-purple-100 rounded px-2 py-1">
                                        <span class="text-xs font-semibold text-purple-700">{{ $module->code }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-600">{{ $enrollment->enrolled_at->format('M d, Y') }}</p>
                                <p class="text-xs text-gray-500">{{ $enrollment->enrolled_at->diffForHumans() }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- PASS Button -->
                                    <form method="POST" action="{{ route('teacher.grading.grade', $enrollment) }}" class="inline">
                                        @csrf
                                        <input type="hidden" name="pass_status" value="PASS">
                                        <button type="submit"
                                            onclick="return confirm('Mark {{ $enrollment->student->name }} as PASS?')"
                                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white text-xs font-semibold rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-200 shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            PASS
                                        </button>
                                    </form>

                                    <!-- FAIL Button -->
                                    <form method="POST" action="{{ route('teacher.grading.grade', $enrollment) }}" class="inline">
                                        @csrf
                                        <input type="hidden" name="pass_status" value="FAIL">
                                        <button type="submit"
                                            onclick="return confirm('Mark {{ $enrollment->student->name }} as FAIL?')"
                                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white text-xs font-semibold rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-200 shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            FAIL
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center mb-8">
            <div class="bg-green-100 rounded-full p-6 inline-block mb-4">
                <svg class="h-12 w-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <p class="text-lg font-semibold text-gray-900 mb-2">All Students Evaluated!</p>
            <p class="text-sm text-gray-600">There are no pending evaluations for this module.</p>
        </div>
        @endif
        <!-- Completed Students Section -->
        @if($completedStudents->count() > 0)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-blue-200 rounded-t-xl">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-500 rounded-lg p-2">
                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Completed Evaluations</h2>
                        <p class="text-sm text-gray-600">{{ $completedStudents->count() }} student(s) already graded</p>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Student</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Module</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Completed</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Result</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($completedStudents as $enrollment)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="bg-gradient-to-br from-gray-400 to-gray-500 rounded-full h-10 w-10 flex items-center justify-center">
                                        <span class="text-white font-semibold text-sm">{{ substr($enrollment->student->name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">{{ $enrollment->student->name }}</p>
                                        <p class="text-xs text-gray-500">ID: {{ $enrollment->student->id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-900">{{ $enrollment->student->email }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="bg-purple-100 rounded px-2 py-1">
                                        <span class="text-xs font-semibold text-purple-700">{{ $module->code }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-600">{{ $enrollment->completed_at ? $enrollment->completed_at->format('M d, Y H:i') : 'N/A' }}</p>
                                <p class="text-xs text-gray-500">{{ $enrollment->completed_at ? $enrollment->completed_at->diffForHumans() : '' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center">
                                    @if(strtoupper(trim($enrollment->pass_status)) === 'PASS')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        PASS
                                    </span>
                                    @elseif(strtoupper(trim($enrollment->pass_status)) === 'FAIL')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 border border-red-200">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                        FAIL
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800 border border-yellow-200">
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
        </div>
        @endif

    </div>
</div>

@endsection