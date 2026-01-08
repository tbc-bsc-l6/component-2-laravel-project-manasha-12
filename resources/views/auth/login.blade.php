<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name', 'SchoolTrack') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            background-color: #fdfcfb;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 900;
            color: #1a1a1a;
            line-height: 1.1;
            letter-spacing: -0.03em;
            margin: 0;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.875rem;
            font-weight: 900;
            color: #1a1a1a;
            font-style: italic;
        }

        .form-input {
            width: 100%;
            padding: 0.875rem 1rem;
            background-color: white;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            color: #1a1a1a;
            font-size: 0.9375rem;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--active-color, #1a1a1a);
            box-shadow: 0 0 0 3px var(--active-color-light, rgba(26, 26, 26, 0.1));
        }

        .btn-primary {
            width: 100%;
            padding: 1rem;
            background-color: #1a1a1a;
            color: white;
            font-weight: 600;
            font-size: 0.9375rem;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(26, 26, 26, 0.2);
        }

        .role-tab {
            flex: 1;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            background-color: white;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            color: #6b7280;
        }

        .role-tab.active {
            color: white;
        }

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

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .delay-1 { animation-delay: 0.1s; opacity: 0; }
        .delay-2 { animation-delay: 0.2s; opacity: 0; }
        .delay-3 { animation-delay: 0.3s; opacity: 0; }
    </style>
</head>

<body>
    <!-- Toast Notifications -->
    @if (session('success') || session('error'))
    <div id="toast" style="position: fixed; top: 1rem; right: 1rem; z-index: 9999; min-width: 300px; max-width: 500px; animation: slideIn 0.3s ease-out;">
        @if (session('success'))
        <div style="display: flex; align-items: center; background-color: #d1fae5; border-left: 4px solid #10b981; padding: 1rem 1.5rem; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); cursor: pointer;">
            <svg style="width: 24px; height: 24px; color: #059669; margin-right: 0.75rem; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p style="color: #065f46; font-weight: 500; margin: 0;">{{ session('success') }}</p>
        </div>
        @endif

        @if (session('error'))
        <div style="display: flex; align-items: center; background-color: #fee2e2; border-left: 4px solid #ef4444; padding: 1rem 1.5rem; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); cursor: pointer;">
            <svg style="width: 24px; height: 24px; color: #dc2626; margin-right: 0.75rem; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p style="color: #991b1b; font-weight: 500; margin: 0;">{{ session('error') }}</p>
        </div>
        @endif
    </div>

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

    <div style="min-height: 100vh; display: flex; flex-direction: column;">

        <!-- Navigation -->
        <nav style="padding: 1.5rem 0; background-color: #fdfcfb; position: relative; z-index: 50;">
            <div style="max-width: 1280px; margin: 0 auto; padding: 0 2rem; display: flex; justify-content: space-between; align-items: center;">
                <a href="{{ route('welcome') }}" style="text-decoration: none;">
                    <span class="logo">s/t.</span>
                </a>
                <a href="{{ route('welcome') }}" style="font-size: 0.9375rem; font-weight: 500; color: #6b7280; text-decoration: none; transition: color 0.2s;"
                   onmouseover="this.style.color='#1a1a1a'"
                   onmouseout="this.style.color='#6b7280'">
                    ← Back to home
                </a>
            </div>
        </nav>

        <!-- Main Content -->
        <div style="flex: 1; display: flex; align-items: center; justify-content: center; padding: 2rem;">
            <div style="width: 100%; max-width: 480px;">

                <!-- Header -->
                <div class="fade-in-up delay-1" style="text-align: center; margin-bottom: 3rem;">
                    <h1 class="hero-title" id="mainHeading" style="margin-bottom: 0.75rem;">
                        Welcome back
                    </h1>
                    <p id="subHeading" style="font-size: 1.125rem; color: #6b7280; margin: 0;">
                        Sign in to continue your journey
                    </p>
                </div>

                <!-- Role Selector -->
                <div class="fade-in-up delay-2" style="display: flex; gap: 0.75rem; margin-bottom: 2.5rem;">
                    <button type="button" onclick="selectRole('admin')" id="tab-admin" class="role-tab active">
                        Admin
                    </button>
                    <button type="button" onclick="selectRole('teacher')" id="tab-teacher" class="role-tab">
                        Teacher
                    </button>
                    <button type="button" onclick="selectRole('student')" id="tab-student" class="role-tab">
                        Student
                    </button>
                </div>

                <!-- Login Form -->
                <form method="POST" id="loginForm" action="{{ route('login') }}" class="fade-in-up delay-3">
                    @csrf
                    <input type="hidden" name="role" id="roleInput" value="{{ old('role', 'admin') }}">

                    <!-- Email -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="email" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1a1a1a; margin-bottom: 0.5rem;">
                            Email address
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="form-input"
                            placeholder="your.email@example.com"
                            style="{{ $errors->has('email') ? 'border-color: #ef4444;' : '' }}">
                        @error('email')
                        <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="password" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1a1a1a; margin-bottom: 0.5rem;">
                            Password
                        </label>
                        <input id="password" type="password" name="password" required
                            class="form-input"
                            placeholder="••••••••••">
                    </div>

                    <!-- Remember Me -->
                    <div style="margin-bottom: 2rem;">
                        <label style="display: flex; align-items: center; cursor: pointer;">
                            <input type="checkbox" name="remember" id="rememberCheckbox"
                                style="width: 18px; height: 18px; border-radius: 4px; border: 2px solid #d1d5db; cursor: pointer; accent-color: #1a1a1a;">
                            <span style="margin-left: 0.625rem; font-size: 0.875rem; color: #6b7280; font-weight: 500;">
                                Remember me for 30 days
                            </span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="submitButton" class="btn-primary">
                        Sign in as <span id="roleText">Admin</span>
                    </button>

                    <!-- Register Link for Students -->
                    <div id="registerLink" style="display: none; margin-top: 1.5rem; text-align: center;">
                        <p style="font-size: 0.9375rem; color: #6b7280; margin: 0;">
                            Don't have an account?
                            <a href="{{ route('register') }}" id="registerLinkAnchor" style="color: #1a1a1a; text-decoration: none; font-weight: 600; border-bottom: 2px solid #1a1a1a; transition: opacity 0.2s;"
                               onmouseover="this.style.opacity='0.7'"
                               onmouseout="this.style.opacity='1'">
                                Register as Student
                            </a>
                        </p>
                    </div>
                </form>

                <!-- Footer -->
                <div style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid #e5e7eb; text-align: center;">
                    <p style="font-size: 0.8125rem; color: #9ca3af; margin: 0; line-height: 1.6;">
                        By signing in, you agree to our
                        <a href="#" style="color: #6b7280; text-decoration: underline; transition: color 0.2s;"
                           onmouseover="this.style.color='#1a1a1a'"
                           onmouseout="this.style.color='#6b7280'">Terms of Service</a> and
                        <a href="#" style="color: #6b7280; text-decoration: underline; transition: color 0.2s;"
                           onmouseover="this.style.color='#1a1a1a'"
                           onmouseout="this.style.color='#6b7280'">Privacy Policy</a>
                    </p>
                </div>

            </div>
        </div>

    </div>

    <script>
        const roleConfig = {
            admin: {
                heading: 'Welcome back',
                subheading: 'Sign in to manage your institution',
                color: '#fca5a5',           // Light pastel red
                colorDark: '#f87171',       // Darker for text
                colorLight: '#fecaca',      
                colorLighter: 'rgba(252, 165, 165, 0.15)',
                hoverShadow: 'rgba(252, 165, 165, 0.3)',
                borderColor: '#fca5a5'
            },
            teacher: {
                heading: 'Welcome back',
                subheading: 'Sign in to inspire your students',
                color: '#d8b4fe',           // Light pastel purple
                colorDark: '#c084fc',       // Darker for text
                colorLight: '#e9d5ff',      
                colorLighter: 'rgba(216, 180, 254, 0.15)',
                hoverShadow: 'rgba(216, 180, 254, 0.3)',
                borderColor: '#d8b4fe'
            },
            student: {
                heading: 'Welcome back',
                subheading: 'Sign in to continue learning',
                color: '#86efac',           // Light pastel green
                colorDark: '#4ade80',       // Darker for text
                colorLight: '#bbf7d0',      
                colorLighter: 'rgba(134, 239, 172, 0.15)',
                hoverShadow: 'rgba(134, 239, 172, 0.3)',
                borderColor: '#86efac'
            }
        };

        function selectRole(role) {
            // Update hidden input
            document.getElementById('roleInput').value = role;

            const config = roleConfig[role];
            const roleTextMap = {
                'admin': 'Admin',
                'teacher': 'Teacher',
                'student': 'Student'
            };

            // Update CSS variables for form inputs
            document.documentElement.style.setProperty('--active-color', config.colorDark);
            document.documentElement.style.setProperty('--active-color-light', config.colorLighter);

            // Update role text
            document.getElementById('roleText').textContent = roleTextMap[role];
            document.getElementById('mainHeading').textContent = config.heading;
            document.getElementById('subHeading').textContent = config.subheading;

            // Update button color
            const submitButton = document.getElementById('submitButton');
            submitButton.style.backgroundColor = config.color;
            submitButton.style.color = '#1a1a1a';
            submitButton.onmouseover = function() {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = `0 8px 20px ${config.hoverShadow}`;
                this.style.backgroundColor = config.colorDark;
            };
            submitButton.onmouseout = function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = 'none';
                this.style.backgroundColor = config.color;
            };

            // Update checkbox accent color
            document.getElementById('rememberCheckbox').style.accentColor = config.colorDark;

            // Update register link color
            const registerLinkAnchor = document.getElementById('registerLinkAnchor');
            if (registerLinkAnchor) {
                registerLinkAnchor.style.color = config.colorDark;
                registerLinkAnchor.style.borderBottomColor = config.colorDark;
            }

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
                const tabConfig = roleConfig[tab];
                
                if (tab === role) {
                    button.classList.add('active');
                    button.style.backgroundColor = config.color;
                    button.style.borderColor = config.borderColor;
                    button.style.color = '#1a1a1a';
                    
                    // Active tab hover - keep text visible
                    button.onmouseover = function() {
                        this.style.backgroundColor = config.colorDark;
                        this.style.borderColor = config.colorDark;
                        this.style.color = '#1a1a1a';
                    };
                    button.onmouseout = function() {
                        this.style.backgroundColor = config.color;
                        this.style.borderColor = config.borderColor;
                        this.style.color = '#1a1a1a';
                    };
                } else {
                    button.classList.remove('active');
                    button.style.backgroundColor = 'white';
                    button.style.borderColor = '#e5e7eb';
                    button.style.color = '#6b7280';
                    
                    // Inactive tab hover
                    button.onmouseover = function() {
                        this.style.borderColor = tabConfig.borderColor;
                        this.style.color = tabConfig.colorDark;
                        this.style.backgroundColor = tabConfig.colorLighter;
                    };
                    button.onmouseout = function() {
                        this.style.borderColor = '#e5e7eb';
                        this.style.color = '#6b7280';
                        this.style.backgroundColor = 'white';
                    };
                }
            });
        }

        // Initialize with old role or default to admin
        const oldRole = "{{ old('role', 'admin') }}";
        selectRole(oldRole);
    </script>
</body>

</html>