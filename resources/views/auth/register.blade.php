<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Student Registration - {{ config('app.name', 'SchoolTrack') }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Figtree', sans-serif;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div style="display: flex; height: 100vh;">
        
        <!-- Left Side - Branding -->
        <div style="flex: 1; background: linear-gradient(135deg, #065f46 0%, #10b981 50%, #6ee7b7 100%); position: relative; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 3rem; color: white;">
            
            <!-- Decorative Elements -->
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.1; background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            
            <!-- Logo -->
            <div style="position: absolute; top: 2rem; left: 2rem;">
                <span style="font-size: 1.5rem; font-weight: 700; color: white;">SchoolTrack</span>
            </div>

            <!-- Main Content -->
            <div style="z-index: 10; text-align: center; max-width: 500px;">
                <h1 style="font-size: 3rem; font-weight: 700; margin: 0 0 1.5rem 0; line-height: 1.2;">
                    Start Your Learning Journey
                </h1>
                <p style="font-size: 1.25rem; margin: 0; opacity: 0.9; line-height: 1.6;">
                    Join thousands of students achieving their educational goals
                </p>
            </div>

            <!-- Footer Text -->
            <div style="position: absolute; bottom: 2rem; text-align: center; opacity: 0.8;">
                <p style="font-size: 0.875rem; margin: 0;">
                    Student Registration — Your gateway to excellence
                </p>
            </div>
        </div>

        <!-- Right Side - Registration Form -->
        <div style="flex: 1; background-color: #0a0a0a; display: flex; align-items: center; justify-content: center; padding: 2rem; position: relative; overflow-y: auto;">
            
            <!-- Form Container -->
            <div style="width: 100%; max-width: 440px;">
                
                <!-- Header -->
                <div style="margin-bottom: 2.5rem;">
                    <h2 style="font-size: 1.875rem; font-weight: 600; color: white; margin: 0 0 0.5rem 0;">
                        Create Student Account
                    </h2>
                    <p style="font-size: 0.875rem; color: #9ca3af; margin: 0;">
                        Register to access courses and start learning
                    </p>
                </div>

                <!-- Registration Form -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="name" style="display: block; font-size: 0.875rem; font-weight: 500; color: #d1d5db; margin-bottom: 0.5rem;">
                            Full Name
                        </label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                            style="width: 100%; padding: 0.75rem 1rem; background-color: #1f2937; border: 1px solid {{ $errors->has('name') ? '#ef4444' : '#374151' }}; border-radius: 0.5rem; color: white; font-size: 0.875rem; transition: all 0.2s;"
                            onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 0 0 3px rgba(16, 185, 129, 0.1)'"
                            onblur="this.style.borderColor='{{ $errors->has('name') ? '#ef4444' : '#374151' }}'; this.style.boxShadow='none'"
                            placeholder="John Doe">
                        @error('name')
                            <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="email" style="display: block; font-size: 0.875rem; font-weight: 500; color: #d1d5db; margin-bottom: 0.5rem;">
                            Email Address
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            style="width: 100%; padding: 0.75rem 1rem; background-color: #1f2937; border: 1px solid {{ $errors->has('email') ? '#ef4444' : '#374151' }}; border-radius: 0.5rem; color: white; font-size: 0.875rem; transition: all 0.2s;"
                            onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 0 0 3px rgba(16, 185, 129, 0.1)'"
                            onblur="this.style.borderColor='{{ $errors->has('email') ? '#ef4444' : '#374151' }}'; this.style.boxShadow='none'"
                            placeholder="student@example.com">
                        @error('email')
                            <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="password" style="display: block; font-size: 0.875rem; font-weight: 500; color: #d1d5db; margin-bottom: 0.5rem;">
                            Password
                        </label>
                        <input id="password" type="password" name="password" required
                            style="width: 100%; padding: 0.75rem 1rem; background-color: #1f2937; border: 1px solid {{ $errors->has('password') ? '#ef4444' : '#374151' }}; border-radius: 0.5rem; color: white; font-size: 0.875rem; transition: all 0.2s;"
                            onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 0 0 3px rgba(16, 185, 129, 0.1)'"
                            onblur="this.style.borderColor='{{ $errors->has('password') ? '#ef4444' : '#374151' }}'; this.style.boxShadow='none'"
                            placeholder="••••••••••">
                        @error('password')
                            <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                        @enderror
                        <p style="margin-top: 0.5rem; font-size: 0.75rem; color: #9ca3af;">
                            Must be at least 8 characters
                        </p>
                    </div>

                    <!-- Confirm Password -->
                    <div style="margin-bottom: 2rem;">
                        <label for="password_confirmation" style="display: block; font-size: 0.875rem; font-weight: 500; color: #d1d5db; margin-bottom: 0.5rem;">
                            Confirm Password
                        </label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            style="width: 100%; padding: 0.75rem 1rem; background-color: #1f2937; border: 1px solid #374151; border-radius: 0.5rem; color: white; font-size: 0.875rem; transition: all 0.2s;"
                            onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 0 0 3px rgba(16, 185, 129, 0.1)'"
                            onblur="this.style.borderColor='#374151'; this.style.boxShadow='none'"
                            placeholder="••••••••••">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        style="width: 100%; padding: 0.875rem; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; font-weight: 600; font-size: 0.875rem; border: none; border-radius: 0.5rem; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 6px rgba(16, 185, 129, 0.3); margin-bottom: 1rem;"
                        onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 10px 15px rgba(16, 185, 129, 0.4)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(16, 185, 129, 0.3)'">
                        Create Account
                    </button>

                    <!-- Login Link -->
                    <p style="text-align: center; font-size: 0.875rem; color: #9ca3af; margin: 0;">
                        Already have an account? 
                        <a href="{{ route('login') }}" style="color: #10b981; text-decoration: none; font-weight: 500;">
                            Sign in
                        </a>
                    </p>
                </form>

                <!-- Footer -->
                <div style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid #1f2937; text-align: center;">
                    <p style="font-size: 0.75rem; color: #6b7280; margin: 0;">
                        By registering, you agree to our 
                        <a href="#" style="color: #10b981; text-decoration: none;">Terms of Service</a> and 
                        <a href="#" style="color: #10b981; text-decoration: none;">Privacy Policy</a>
                    </p>
                </div>

            </div>
        </div>

    </div>
</body>
</html>