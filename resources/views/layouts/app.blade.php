<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen">
            
            <!-- Navigation -->
            <nav class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        
                        <!-- Left Side: Logo & Brand -->
                        <div class="flex items-center">
                            <!-- Logo -->
                            <a href="" class="flex items-center space-x-3 group">
                                
                                <div>
                                    <span class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">SchoolTrack</span>
                                   
                                </div>
                            </a>

                            <!-- Navigation Links (Desktop) -->
                            <div class="hidden md:flex items-center ml-10 space-x-1">
                                @if(Auth::guard('admin')->check())
                                    <a href="{{ route('admin.dashboard') }}" 
                                       class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }} transition-all">
                                        Dashboard
                                    </a>
                                    <a href="{{ route('admin.modules.index') }}" 
                                       class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.modules.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }} transition-all">
                                        Modules
                                    </a>
                                    <a href="{{ route('admin.users.index') }}" 
                                       class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.users.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }} transition-all">
                                        Users
                                    </a>
                                @elseif(Auth::guard('teacher')->check())
                                    <a href="{{ route('teacher.dashboard') }}" 
                                       class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('teacher.dashboard') ? 'bg-purple-50 text-purple-700' : 'text-gray-700 hover:bg-gray-50' }} transition-all">
                                        Dashboard
                                    </a>
                                    <a href="{{ route('teacher.modules.index') }}" 
                                       class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('teacher.modules.*') ? 'bg-purple-50 text-purple-700' : 'text-gray-700 hover:bg-gray-50' }} transition-all">
                                        My Modules
                                    </a>
                                @elseif(Auth::guard('student')->check())
                                    <a href="{{ route('student.dashboard') }}" 
                                       class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('student.dashboard') ? 'bg-green-50 text-green-700' : 'text-gray-700 hover:bg-gray-50' }} transition-all">
                                        Dashboard
                                    </a>
                                    <a href="{{ route('student.modules.available') }}" 
                                       class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('student.modules.available') ? 'bg-green-50 text-green-700' : 'text-gray-700 hover:bg-gray-50' }} transition-all">
                                        Browse Modules
                                    </a>
                                    <a href="{{ route('student.modules.current') }}" 
                                       class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('student.modules.current') ? 'bg-green-50 text-green-700' : 'text-gray-700 hover:bg-gray-50' }} transition-all">
                                        My Modules
                                    </a>
                                @elseif(Auth::guard('old_student')->check())
                                    <a href="{{ route('student.dashboard') }}" 
                                       class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('student.dashboard') ? 'bg-gray-50 text-gray-700' : 'text-gray-700 hover:bg-gray-50' }} transition-all">
                                        Dashboard
                                    </a>
                                    <a href="{{ route('student.modules.history') }}" 
                                       class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('student.modules.history') ? 'bg-gray-50 text-gray-700' : 'text-gray-700 hover:bg-gray-50' }} transition-all">
                                        History
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Right Side: User Menu -->
                        <div class="flex items-center space-x-4">
                            
                            <!-- Role Badge -->
                            @if(Auth::guard('admin')->check())
                                <span class="hidden sm:inline-flex px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">
                                    Administrator
                                </span>
                            @elseif(Auth::guard('teacher')->check())
                                <span class="hidden sm:inline-flex px-3 py-1 bg-purple-100 text-purple-800 text-xs font-semibold rounded-full">
                                    Teacher
                                </span>
                            @elseif(Auth::guard('student')->check())
                                <span class="hidden sm:inline-flex px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">
                                    Active Student
                                </span>
                            @elseif(Auth::guard('old_student')->check())
                                <span class="hidden sm:inline-flex px-3 py-1 bg-gray-100 text-gray-800 text-xs font-semibold rounded-full">
                                    Alumni
                                </span>
                            @endif

                            <!-- User Dropdown -->
                            <div class="relative" x-data="{ open: false }">
                                <!-- Dropdown Button -->
                                <button @click="open = !open" 
                                        type="button" 
                                        class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-50 transition-all focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <!-- Avatar -->
                                    <div class="w-9 h-9 rounded-full bg-gradient-to-br 
                                        @if(Auth::guard('admin')->check()) from-blue-500 to-blue-600
                                        @elseif(Auth::guard('teacher')->check()) from-purple-500 to-purple-600
                                        @elseif(Auth::guard('student')->check()) from-green-500 to-green-600
                                        @else from-gray-500 to-gray-600
                                        @endif
                                        flex items-center justify-center text-white font-bold text-sm shadow-md">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    
                                    <!-- User Name (Hidden on mobile) -->
                                    <div class="hidden md:block text-left">
                                        <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                                        <p class="text-xs text-gray-500">View Profile</p>
                                    </div>
                                    
                                    <!-- Chevron -->
                                    <svg class="w-4 h-4 text-gray-500" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>

                                <!-- Dropdown Menu -->
                                <div x-show="open" 
                                     @click.away="open = false"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 scale-100"
                                     x-transition:leave-end="opacity-0 scale-95"
                                     class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50"
                                     style="display: none;">
                                    
                                    <!-- User Info Header -->
                                    <div class="px-4 py-3 border-b border-gray-200">
                                        <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                                        <p class="text-xs text-gray-500 mt-0.5">{{ Auth::user()->email }}</p>
                                    </div>

                                    <!-- Menu Items -->
                                    <div class="py-2">
                                        <!-- Profile -->
                                        <a href="{{ route('profile.edit') }}" 
                                           class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors {{ request()->routeIs('profile.edit') ? 'bg-blue-50 text-blue-700 font-medium' : '' }}">
                                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('profile.edit') ? 'text-blue-600' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            Profile Settings
                                        </a>

                                        <!-- Dashboard -->
                                        @if(Auth::guard('admin')->check())
                                            <a href="{{ route('admin.dashboard') }}" 
                                               class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                                </svg>
                                                Admin Dashboard
                                            </a>
                                        @elseif(Auth::guard('teacher')->check())
                                            <a href="{{ route('teacher.dashboard') }}" 
                                               class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                                </svg>
                                                Teacher Dashboard
                                            </a>
                                        @elseif(Auth::guard('student')->check() || Auth::guard('old_student')->check())
                                            <a href="{{ route('student.dashboard') }}" 
                                               class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                                </svg>
                                                Student Dashboard
                                            </a>
                                        @endif
                                    </div>

                                    <!-- Logout -->
                                    <div class="border-t border-gray-200 pt-2">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" 
                                                    class="flex items-center w-full px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                                </svg>
                                                Log Out
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow-sm border-b border-gray-200">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Alpine.js for dropdown -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </body>
</html>