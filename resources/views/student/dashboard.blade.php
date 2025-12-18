<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Student Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @auth('student')
                        <h3 class="text-2xl font-bold mb-4">Welcome, {{ Auth::guard('student')->user()->name }}!</h3>
                        <p>You are logged in as a Student.</p>
                    @endauth
                    
                    @auth('old_student')
                        <h3 class="text-2xl font-bold mb-4">Welcome, {{ Auth::guard('old_student')->user()->name }}!</h3>
                        <p>You are logged in as an Old Student.</p>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>