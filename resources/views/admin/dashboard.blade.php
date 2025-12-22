<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded">
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Stats Grid with Icons and Colors -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                
                <!-- Total Modules - Yellow -->
                <div class="bg-gradient-to-br from-yellow-100 to-yellow-50 overflow-hidden shadow-sm sm:rounded-xl p-6 border border-yellow-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-yellow-600 mb-1">Total Modules</p>
                            <p class="text-3xl font-bold text-yellow-900">{{ $stats['total_modules'] }}</p>
                            <p class="text-xs text-yellow-600 mt-1">+24% from last month</p>
                        </div>
                        <div class="bg-yellow-500 rounded-full p-4">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Active Modules - Purple -->
                <div class="bg-gradient-to-br from-purple-100 to-purple-50 overflow-hidden shadow-sm sm:rounded-xl p-6 border border-purple-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-purple-600 mb-1">Active Modules</p>
                            <p class="text-3xl font-bold text-purple-900">{{ $stats['active_modules'] }}</p>
                            <p class="text-xs text-purple-600 mt-1">Available now</p>
                        </div>
                        <div class="bg-purple-500 rounded-full p-4">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Teachers - Green -->
                <div class="bg-gradient-to-br from-green-100 to-green-50 overflow-hidden shadow-sm sm:rounded-xl p-6 border border-green-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-green-600 mb-1">Total Teachers</p>
                            <p class="text-3xl font-bold text-green-900">{{ $stats['total_teachers'] }}</p>
                            <p class="text-xs text-green-600 mt-1">+44% active</p>
                        </div>
                        <div class="bg-green-500 rounded-full p-4">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Students - Red/Pink -->
                <div class="bg-gradient-to-br from-red-100 to-red-50 overflow-hidden shadow-sm sm:rounded-xl p-6 border border-red-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-red-600 mb-1">Total Students</p>
                            <p class="text-3xl font-bold text-red-900">{{ $stats['total_students'] }}</p>
                            <p class="text-xs text-red-600 mt-1">Enrolled students</p>
                        </div>
                        <div class="bg-red-500 rounded-full p-4">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Quick Actions Section with Grid -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                    <span class="text-sm text-gray-500">Manage your system</span>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    
                    <!-- Add Module -->
                    <a href="{{ route('admin.modules.create') }}" 
                       class="group bg-gradient-to-br from-blue-500 to-blue-600 p-6 rounded-xl text-white hover:from-blue-600 hover:to-blue-700 transition-all duration-200 shadow-md hover:shadow-xl transform hover:-translate-y-1">
                        <div class="flex flex-col items-center text-center space-y-3">
                            <div class="bg-white/20 rounded-full p-3">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </div>
                            <span class="font-semibold text-base">Add Module</span>
                        </div>
                    </a>

                    <!-- Add Teacher -->
                    <a href="{{ route('admin.teachers.create') }}" 
                       class="group bg-gradient-to-br from-purple-500 to-purple-600 p-6 rounded-xl text-white hover:from-purple-600 hover:to-purple-700 transition-all duration-200 shadow-md hover:shadow-xl transform hover:-translate-y-1">
                        <div class="flex flex-col items-center text-center space-y-3">
                            <div class="bg-white/20 rounded-full p-3">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                </svg>
                            </div>
                            <span class="font-semibold text-base">Add Teacher</span>
                        </div>
                    </a>

                    <!-- Manage Modules -->
                    <a href="{{ route('admin.modules.index') }}" 
                       class="group bg-gradient-to-br from-green-500 to-green-600 p-6 rounded-xl text-white hover:from-green-600 hover:to-green-700 transition-all duration-200 shadow-md hover:shadow-xl transform hover:-translate-y-1">
                        <div class="flex flex-col items-center text-center space-y-3">
                            <div class="bg-white/20 rounded-full p-3">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                </svg>
                            </div>
                            <span class="font-semibold text-base">View Modules</span>
                        </div>
                    </a>

                    <!-- Manage Users -->
                    <a href="{{ route('admin.users.index') }}" 
                       class="group bg-gradient-to-br from-orange-500 to-orange-600 p-6 rounded-xl text-white hover:from-orange-600 hover:to-orange-700 transition-all duration-200 shadow-md hover:shadow-xl transform hover:-translate-y-1">
                        <div class="flex flex-col items-center text-center space-y-3">
                            <div class="bg-white/20 rounded-full p-3">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <span class="font-semibold text-base">Manage Users</span>
                        </div>
                    </a>

                </div>
            </div>

            <!-- Recent Activity Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                <!-- Active Enrollments -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Enrollments</h3>
                        <a href="{{ route('admin.enrollments.index') }}" class="text-sm text-blue-600 hover:text-blue-800">View all →</a>
                    </div>
                    <div class="flex items-center justify-center py-8">
                        <div class="text-center">
                            <div class="bg-indigo-100 rounded-full p-6 inline-block mb-4">
                                <svg class="h-12 w-12 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <p class="text-4xl font-bold text-gray-900 mb-2">{{ $stats['active_enrollments'] }}</p>
                            <p class="text-sm text-gray-600">Active enrollments</p>
                        </div>
                    </div>
                </div>

                <!-- System Overview -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">System Overview</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <span class="text-sm font-medium text-gray-700">Available Modules</span>
                            <span class="text-lg font-bold text-green-600">{{ $stats['active_modules'] }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <span class="text-sm font-medium text-gray-700">Total Teachers</span>
                            <span class="text-lg font-bold text-purple-600">{{ $stats['total_teachers'] }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <span class="text-sm font-medium text-gray-700">Total Students</span>
                            <span class="text-lg font-bold text-blue-600">{{ $stats['total_students'] }}</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-admin-layout>