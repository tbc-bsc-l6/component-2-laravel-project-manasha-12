<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name', 'SchoolTrack') }}</title>

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

        .gradient-bg {
            transition: background 0.5s ease;
        }
    </style>
</head>

<body>
    <!-- Toast Notifications -->
    @if (session('success') || session('error'))
    <div id="toast" style="position: fixed; top: 1rem; right: 1rem; z-index: 9999; min-width: 300px; max-width: 500px; animation: slideIn 0.3s ease-out;">
        @if (session('success'))
        <div style="display: flex; align-items: center; background-color: #d1fae5; border-left: 4px solid #10b981; padding: 1rem 1.5rem; border-radius: 0.5rem; box-shadow: 0 10px 15px rgba(0,0,0,0.2); cursor: pointer;">
            <svg style="width: 24px; height: 24px; color: #059669; margin-right: 0.75rem; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p style="color: #065f46; font-weight: 500; margin: 0;">{{ session('success') }}</p>
        </div>
        @endif

        @if (session('error'))
        <div style="display: flex; align-items: center; background-color: #fee2e2; border-left: 4px solid #ef4444; padding: 1rem 1.5rem; border-radius: 0.5rem; box-shadow: 0 10px 15px rgba(0,0,0,0.2); cursor: pointer;">
            <svg style="width: 24px; height: 24px; color: #dc2626; margin-right: 0.75rem; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p style="color: #991b1b; font-weight: 500; margin: 0;">{{ session('error') }}</p>
        </div>
        @endif
    </div>

    <style>
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
    </style>

    <script>
        setTimeout(() => {
            const toast = document.getElementById('toast');
            if (toast) {
                toast.style.animation = 'slideOut 0.3s ease-out';
                setTimeout(() => toast.remove(), 300);
            }
        }, 5000);

        document.getElementById('toast')?.addEventListener('click', function() {
            this.style.animation = 'slideOut 0.3s ease-out';
            setTimeout(() => this.remove(), 300);
        });
    </script>
    @endif

    <div style="display: flex; height: 100vh;">

        <!-- Left Side - Image/Branding (Dynamic Gradient) -->
        <div id="gradientSide" class="gradient-bg" style="flex: 1; background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #60a5fa 100%); position: relative; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 3rem; color: white;">

            <!-- Decorative Elements -->
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.1; background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

            <!-- Logo -->
            <div style="position: absolute; top: 2rem; left: 2rem; display: flex; align-items: center; gap: 0.75rem;">
                <span id="logoText" style="font-size: 1.5rem; font-weight: 700; color: #3b82f6;">SchoolTrack</span>
            </div>

            <!-- Main Content -->
            <div style="z-index: 10; text-align: center; max-width: 500px;">
                <h1 id="mainHeading" style="font-size: 3rem; font-weight: 700; margin: 0 0 1.5rem 0; line-height: 1.2;">
                    Manage your institution with excellence
                </h1>
                <p id="subHeading" style="font-size: 1.25rem; margin: 0; opacity: 0.9; line-height: 1.6;">
                    Administrative dashboard for complete control
                </p>
            </div>

            <!-- Footer Text -->
            <div style="position: absolute; bottom: 2rem; left: 2rem; right: 2rem; text-align: center; opacity: 0.8;">
                <p id="footerText" style="font-size: 0.875rem; margin: 0;">
                    Administration — Leading education to new heights
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
                            style="width: 100%; padding: 0.75rem 1rem; background-color: #1f2937; border: 1px solid {{ $errors->has('email') ? '#ef4444' : '#374151' }}; border-radius: 0.5rem; color: white; font-size: 0.875rem; transition: all 0.2s;"
                            onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.1)'"
                            onblur="this.style.borderColor='{{ $errors->has('email') ? '#ef4444' : '#374151' }}'; this.style.boxShadow='none'"
                            placeholder="your.email@example.com">
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
                            style="width: 100%; padding: 0.75rem 1rem; background-color: #1f2937; border: 1px solid #374151; border-radius: 0.5rem; color: white; font-size: 0.875rem; transition: all 0.2s;"
                            onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.1)'"
                            onblur="this.style.borderColor='#374151'; this.style.boxShadow='none'"
                            placeholder="••••••••••">
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

                    <div id="registerLink" style="display: none; margin-top: 1rem; text-align: center;">
                        <p style="font-size: 0.875rem; color: #9ca3af; margin: 0;">
                            Don't have an account?
                            <a href="{{ route('register') }}" style="color: #10b981; text-decoration: none; font-weight: 500;">
                                Register as Student
                            </a>
                        </p>
                    </div>
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
        const roleConfig = {
            admin: {
                gradient: 'linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #60a5fa 100%)',
                buttonGradient: 'linear-gradient(135deg, #3b82f6 0%, #2563eb 100%)',
                logoColor: 'white',
                activeColor: '#3b82f6',
                heading: 'Manage your institution with excellence',
                subheading: 'Administrative dashboard for complete control',
                footer: 'Administration — Leading education to new heights'
            },
            teacher: {
                gradient: 'linear-gradient(135deg, #581c87 0%, #9333ea 50%, #c084fc 100%)',
                buttonGradient: 'linear-gradient(135deg, #9333ea 0%, #7e22ce 100%)',
                logoColor: 'white',
                activeColor: '#9333ea',
                heading: 'Inspire minds, shape futures',
                subheading: 'Teaching platform for educators who make a difference',
                footer: 'Teaching — Empowering the next generation'
            },
            student: {
                gradient: 'linear-gradient(135deg, #065f46 0%, #10b981 50%, #6ee7b7 100%)',
                buttonGradient: 'linear-gradient(135deg, #10b981 0%, #059669 100%)',
                logoColor: 'white',
                activeColor: '#10b981',
                heading: 'Your learning journey starts here',
                subheading: 'Student portal for academic excellence and growth',
                footer: 'Learning — Discover your potential every day'
            }
        };

        function selectRole(role) {
            console.log('Selecting role:', role);

            // Update hidden input
            document.getElementById('roleInput').value = role;

            const config = roleConfig[role];
            const roleTextMap = {
                'admin': 'Admin',
                'teacher': 'Teacher',
                'student': 'Student'
            };

            // Update all UI elements
            document.getElementById('roleText').textContent = roleTextMap[role];
            document.getElementById('gradientSide').style.background = config.gradient;
            document.getElementById('logoText').style.color = config.logoColor;
            document.getElementById('mainHeading').textContent = config.heading;
            document.getElementById('subHeading').textContent = config.subheading;
            document.getElementById('footerText').textContent = config.footer;
            document.getElementById('submitButton').style.background = config.buttonGradient;

            // Show/hide register link for students only
            const registerLink = document.getElementById('registerLink');
            if (role === 'student') {
                registerLink.style.display = 'block';
            } else {
                registerLink.style.display = 'none';
            }

            // Update tab styles
            ['admin', 'teacher', 'student'].forEach(tab => {
                const button = document.getElementById('tab-' + tab);
                if (tab === role) {
                    button.style.backgroundColor = config.activeColor;
                    button.style.color = 'white';
                } else {
                    button.style.backgroundColor = 'transparent';
                    button.style.color = '#9ca3af';
                }
            });

            console.log('Role updated to:', role);
        }

        // Initialize with old role or default to admin - FIXED LINE
        const oldRole = "{{ old('role', 'admin') }}";
        console.log('Initial role:', oldRole);
        selectRole(oldRole);
    </script>
</body>

</html>