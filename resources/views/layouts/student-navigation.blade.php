<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            <!-- Left: Logo & Navigation -->
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <a href="{{ route('student.dashboard') }}" class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-sm">E</span>
                    </div>
                    <span class="text-xl font-bold text-gray-900">Student Portal</span>
                </a>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('student.dashboard') }}" 
                       class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('student.dashboard') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        Dashboard
                    </a>

                    @if(Auth::guard('student')->check())
                        <a href="{{ route('student.modules.available') }}" 
                           class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('student.modules.available') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                            Browse Modules
                        </a>

                        <a href="{{ route('student.modules.current') }}" 
                           class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('student.modules.current') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                            My Modules
                        </a>
                    @endif

                    <a href="{{ route('student.modules.history') }}" 
                       class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('student.modules.history') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        History
                    </a>
                </div>
            </div>

            <!-- Right: User Info & Logout -->
            <div class="flex items-center space-x-4">
                <!-- User Badge -->
                @if(Auth::guard('old_student')->check())
                    <span class="px-3 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded-full">
                        Alumni
                    </span>
                @else
                    <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">
                        Active Student
                    </span>
                @endif

                <!-- User Name -->
                <span class="text-sm font-medium text-gray-700">
                    @if(Auth::guard('student')->check())
                        {{ auth('student')->user()->name }}
                    @else
                        {{ auth('old_student')->user()->name }}
                    @endif
                </span>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 transition-colors">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>