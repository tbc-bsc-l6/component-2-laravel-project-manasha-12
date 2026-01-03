<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verify Email - {{ config('app.name', 'SchoolTrack') }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            
            <!-- Card -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                
                <!-- Icon -->
                <div class="flex justify-center mb-6">
                    <div class="bg-yellow-100 rounded-full p-4">
                        <svg class="h-12 w-12 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>

                <!-- Title -->
                <h2 class="text-center text-3xl font-bold text-gray-900 mb-2">
                    Verify Your Email
                </h2>
                
                <!-- Message -->
                <p class="text-center text-gray-600 mb-6">
                    Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?
                </p>

                <!-- Success Message -->
                @if (session('success'))
                    <div class="mb-4 bg-green-50 border-l-4 border-green-500 p-4 rounded">
                        <p class="text-green-800 text-sm">{{ session('success') }}</p>
                    </div>
                @endif

                <!-- Resend Form -->
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold py-3 px-4 rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-200 shadow-md hover:shadow-lg mb-4">
                        Resend Verification Email
                    </button>
                </form>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-gray-600 hover:text-gray-900 text-sm font-medium">
                        Log Out
                    </button>
                </form>

            </div>

            <!-- Footer -->
            <p class="text-center text-sm text-gray-600">
                Didn't receive the email? Check your spam folder or click the button above to resend.
            </p>

        </div>
    </div>
</body>
</html>