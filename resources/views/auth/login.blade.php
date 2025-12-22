<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name', 'EduManage') }}</title>
    
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
        
        /* Smooth gradient transition */
        .gradient-bg {
            transition: background 0.5s ease;
        }
    </style>
</head>
<body>
    <div style="display: flex; height: 100vh;">
        
        <!-- Left Side - Image/Branding (Dynamic Gradient) -->
        <div id="gradientSide" class="gradient-bg" style="flex: 1; background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #60a5fa 100%); position: relative; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 3rem; color: white;">
            
            <!-- Decorative Elements -->
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.1; background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            
            <!-- Logo -->
            <div style="position: absolute; top: 2rem; left: 2rem; display: flex; align-items: center; gap: 0.75rem;">
                <div style="background-color: white; width: 48px; height: 48px; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 15px rgba(0,0,0,0.2);">
                    <span id="logoText" style="color: #3b82f6; font-size: 1.5rem; font-weight: 700;">E</span>
                </div>
                <span style="font-size: 1.5rem; font-weight: 700;">EduManage</span>
            </div>

            <!-- Main Content -->
            <div style="z-index: 10; text-align: center; max-width: 500px;">
                <h1 id="mainHeading" style="font-size: 3rem; font-weight: 700; margin: 0 0 1.5rem 0; line-height: 1.2;">
                    Design your future, one blueprint at a time
                </h1>
                <p id="subHeading" style="font-size: 1.25rem; margin: 0; opacity: 0.9; line-height: 1.6;">
                    Join a community of educators and students shaping tomorrow
                </p>
            </div>

            <!-- Footer Text -->
            <div style="position: absolute; bottom: 2rem; left: 2rem; right: 2rem; text-align: center; opacity: 0.8;">
                <p id="footerText" style="font-size: 0.875rem; margin: 0;">
                    Education — Your gateway to excellence, at any level
                </p>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div style="flex: 1; background-color: #0a0a0a; display: flex; align-items: center; justify-content: center; padding: 2rem; position: relative; overflow-y: auto;">
            
            <!-- Form Container -->
            <div style="width: 100%; max-width: 440px;">
                
                <!-- Header -->
                <div style="margin-bottom: 2.5rem;">
                    <h2 style="font-size: 1.875rem; font-weight: 600; color: white; margin: 0 0 0.5rem 0;">
                        Welcome back
                    </h2>
                    <p style="font-size: 0.875rem; color: #9ca3af; margin: 0;">
                        Sign in to continue your learning journey
                    </p>
                </div>

                <!-- Role Selector Tabs -->
                <div style="display: flex; gap: 0.5rem; margin-bottom: 2rem; padding: 0.25rem; background-color: #1f2937; border-radius: 0.5rem;">
                    <button type="button" onclick="selectRole('admin')" id="tab-admin"
                        style="flex: 1; padding: 0.75rem 1rem; border: none; border-radius: 0.375rem; font-size: 0.875rem; font-weight: 500; cursor: pointer; transition: all 0.2s; background-color: #3b82f6; color: white;">
                        Admin
                    </button>
                    <button type="button" onclick="selectRole('teacher')" id="tab-teacher"
                        style="flex: 1; padding: 0.75rem 1rem; border: none; border-radius: 0.375rem; font-size: 0.875rem; font-weight: 500; cursor: pointer; transition: all 0.2s; background-color: transparent; color: #9ca3af;">
                        Teacher
                    </button>
                    <button type="button" onclick="selectRole('student')" id="tab-student"
                        style="flex: 1; padding: 0.75rem 1rem; border: none; border-radius: 0.375rem; font-size: 0.875rem; font-weight: 500; cursor: pointer; transition: all 0.2s; background-color: transparent; color: #9ca3af;">
                        Student
                    </button>
                </div>

                <!-- Login Form -->
                <form method="POST" id="loginForm" action="{{ route('login') }}">
                    @csrf
                    <input type="hidden" name="role" id="roleInput" value="{{ old('role', 'admin') }}">

                    <!-- Email -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="email" style="display: block; font-size: 0.875rem; font-weight: 500; color: #d1d5db; margin-bottom: 0.5rem;">
                            Email address
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            style="width: 100%; padding: 0.75rem 1rem; background-color: #1f2937; border: 1px solid #374151; border-radius: 0.5rem; color: white; font-size: 0.875rem; transition: all 0.2s;"
                            onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.1)'"
                            onblur="this.style.borderColor='#374151'; this.style.boxShadow='none'"
                            placeholder="your.email@example.com">
                        @error('email')
                            <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div style="margin-bottom: 1.5rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                            <label for="password" style="font-size: 0.875rem; font-weight: 500; color: #d1d5db;">
                                Password
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" style="font-size: 0.875rem; color: #60a5fa; text-decoration: none; transition: color 0.2s;"
                                   onmouseover="this.style.color='#93c5fd'"
                                   onmouseout="this.style.color='#60a5fa'">
                                    Forgot password?
                                </a>
                            @endif
                        </div>
                        <input id="password" type="password" name="password" required
                            style="width: 100%; padding: 0.75rem 1rem; background-color: #1f2937; border: 1px solid #374151; border-radius: 0.5rem; color: white; font-size: 0.875rem; transition: all 0.2s;"
                            onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.1)'"
                            onblur="this.style.borderColor='#374151'; this.style.boxShadow='none'"
                            placeholder="••••••••••">
                        @error('password')
                            <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div style="margin-bottom: 2rem;">
                        <label style="display: flex; align-items: center; cursor: pointer;">
                            <input type="checkbox" name="remember" 
                                style="width: 16px; height: 16px; border-radius: 0.25rem; border: 1px solid #374151; background-color: #1f2937; cursor: pointer;">
                            <span style="margin-left: 0.5rem; font-size: 0.875rem; color: #d1d5db;">
                                Remember me for 30 days
                            </span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="submitButton"
                        style="width: 100%; padding: 0.875rem; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; font-weight: 600; font-size: 0.875rem; border: none; border-radius: 0.5rem; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 6px rgba(59, 130, 246, 0.3);"
                        onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 10px 15px rgba(59, 130, 246, 0.4)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(59, 130, 246, 0.3)'">
                        Sign in as <span id="roleText">Admin</span>
                    </button>

                    <!-- Divider -->
                    <!-- <div style="position: relative; margin: 2rem 0;">
                        <div style="position: absolute; inset: 0; display: flex; align-items: center;">
                            <div style="width: 100%; border-top: 1px solid #374151;"></div>
                        </div>
                        <div style="position: relative; display: flex; justify-content: center; font-size: 0.875rem;">
                            <span style="background-color: #0a0a0a; padding: 0 1rem; color: #6b7280;">
                                New to EduManage?
                            </span>
                        </div>
                    </div> -->

                    <!-- Register Link -->
                    <!-- <div style="text-align: center;">
                        <a href="{{ route('login') }}" 
                           style="font-size: 0.875rem; color: #60a5fa; text-decoration: none; font-weight: 500; transition: color 0.2s;"
                           onmouseover="this.style.color='#93c5fd'"
                           onmouseout="this.style.color='#60a5fa'">
                            Create your account →
                        </a>
                    </div> -->
                </form>

                <!-- Footer -->
                <div style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid #1f2937; text-align: center;">
                    <p style="font-size: 0.75rem; color: #6b7280; margin: 0;">
                        By signing in, you agree to our 
                        <a href="#" style="color: #60a5fa; text-decoration: none;">Terms of Service</a> and 
                        <a href="#" style="color: #60a5fa; text-decoration: none;">Privacy Policy</a>
                    </p>
                </div>

            </div>
        </div>

    </div>

    <script>
        // Role configuration
        const roleConfig = {
            admin: {
                gradient: 'linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #60a5fa 100%)', // Blue
                buttonGradient: 'linear-gradient(135deg, #3b82f6 0%, #2563eb 100%)',
                logoColor: '#3b82f6',
                activeColor: '#3b82f6',
                heading: 'Manage your institution with excellence',
                subheading: 'Administrative dashboard for complete control',
                footer: 'Administration — Leading education to new heights'
            },
            teacher: {
                gradient: 'linear-gradient(135deg, #581c87 0%, #9333ea 50%, #c084fc 100%)', // Purple
                buttonGradient: 'linear-gradient(135deg, #9333ea 0%, #7e22ce 100%)',
                logoColor: '#9333ea',
                activeColor: '#9333ea',
                heading: 'Inspire minds, shape futures',
                subheading: 'Teaching platform for educators who make a difference',
                footer: 'Teaching — Empowering the next generation'
            },
            student: {
                gradient: 'linear-gradient(135deg, #065f46 0%, #10b981 50%, #6ee7b7 100%)', // Green
                buttonGradient: 'linear-gradient(135deg, #10b981 0%, #059669 100%)',
                logoColor: '#10b981',
                activeColor: '#10b981',
                heading: 'Your learning journey starts here',
                subheading: 'Student portal for academic excellence and growth',
                footer: 'Learning — Discover your potential every day'
            }
        };

        // Role selection function
        function selectRole(role) {
            // Update hidden input
            document.getElementById('roleInput').value = role;
            
            // Get configuration for selected role
            const config = roleConfig[role];
            
            // Update button text
            const roleTextMap = {
                'admin': 'Admin',
                'teacher': 'Teacher',
                'student': 'Student'
            };
            document.getElementById('roleText').textContent = roleTextMap[role];
            
            // Update gradient background
            document.getElementById('gradientSide').style.background = config.gradient;
            
            // Update logo color
            document.getElementById('logoText').style.color = config.logoColor;
            
            // Update headings
            document.getElementById('mainHeading').textContent = config.heading;
            document.getElementById('subHeading').textContent = config.subheading;
            document.getElementById('footerText').textContent = config.footer;
            
            // Update submit button gradient
            document.getElementById('submitButton').style.background = config.buttonGradient;
            
            // Update tab styles
            const tabs = ['admin', 'teacher', 'student'];
            tabs.forEach(tab => {
                const button = document.getElementById('tab-' + tab);
                if (tab === role) {
                    button.style.backgroundColor = config.activeColor;
                    button.style.color = 'white';
                } else {
                    button.style.backgroundColor = 'transparent';
                    button.style.color = '#9ca3af';
                }
            });
        }

        // Initialize with the old role value or default to admin
        const oldRole = 'admin';
        selectRole(oldRole);
    </script>
</body>
</html>