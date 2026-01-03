<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Profile Settings') }}
            </h2>
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span class="text-sm text-gray-600">Manage your account</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Success Messages -->
            @if (session('status') === 'profile-updated')
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-green-700 font-medium">Profile updated successfully!</p>
                    </div>
                </div>
            @endif

            @if (session('status') === 'password-updated')
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-green-700 font-medium">Password updated successfully!</p>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Left Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <!-- User Avatar -->
                            <div class="text-center mb-6">
                                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 text-white text-3xl font-bold mb-3">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">{{ Auth::user()->name }}</h3>
                                <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                                
                                @if(Auth::guard('student')->check())
                                    <span class="inline-flex mt-3 px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">
                                        Active Student
                                    </span>
                                @elseif(Auth::guard('old_student')->check())
                                    <span class="inline-flex mt-3 px-3 py-1 bg-gray-100 text-gray-800 text-xs font-semibold rounded-full">
                                        Alumni
                                    </span>
                                @elseif(Auth::guard('teacher')->check())
                                    <span class="inline-flex mt-3 px-3 py-1 bg-purple-100 text-purple-800 text-xs font-semibold rounded-full">
                                        Teacher
                                    </span>
                                @elseif(Auth::guard('admin')->check())
                                    <span class="inline-flex mt-3 px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">
                                        Administrator
                                    </span>
                                @endif
                            </div>

                            <!-- Quick Stats -->
                            <div class="border-t border-gray-200 pt-6 space-y-3">
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600">Account Status</span>
                                    <span class="font-semibold text-green-600">Active</span>
                                </div>
                                @if(Auth::guard('student')->check() && Auth::user()->email_verified_at)
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-600">Email Verified</span>
                                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                @endif
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600">Member Since</span>
                                    <span class="font-medium text-gray-900">{{ Auth::user()->created_at->format('M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Update Profile Information -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 border-b border-gray-200">
                            <div class="flex items-center mb-1">
                                <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <h3 class="text-lg font-semibold text-gray-900">Profile Information</h3>
                            </div>
                            <p class="text-sm text-gray-600">Update your account's profile information and email address.</p>
                        </div>
                        
                        <div class="p-6">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Update Password -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 border-b border-gray-200">
                            <div class="flex items-center mb-1">
                                <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                <h3 class="text-lg font-semibold text-gray-900">Update Password</h3>
                            </div>
                            <p class="text-sm text-gray-600">Ensure your account is using a long, random password to stay secure.</p>
                        </div>
                        
                        <div class="p-6">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>