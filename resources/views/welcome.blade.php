<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SchoolTrack - Student Management System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            background-color: #fdfcfb;
        }

        /* Simple clean background */
        .clean-bg {
            background-color: #fdfcfb;
            min-height: 100vh;
        }

        /* Hero content animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .delay-1 { animation-delay: 0.1s; opacity: 0; }
        .delay-2 { animation-delay: 0.2s; opacity: 0; }
        .delay-3 { animation-delay: 0.3s; opacity: 0; }
        .delay-4 { animation-delay: 0.4s; opacity: 0; }

        /* Typography */
        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(3rem, 8vw, 7rem);
            font-weight: 900;
            color: #1a1a1a;
            line-height: 1;
            letter-spacing: -0.03em;
            margin: 0;
        }

        .hero-subtitle {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 5vw, 4.5rem);
            font-weight: 700;
            color: #1a1a1a;
            line-height: 1.1;
            margin: 0;
        }

        /* Button styles */
        .btn-primary {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            background-color: #1a1a1a;
            color: white;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9375rem;
            text-decoration: none;
            display: inline-block;
            border: 2px solid #1a1a1a;
        }

        .btn-primary:hover {
            background-color: white;
            color: #1a1a1a;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .btn-secondary {
            background-color: transparent;
            color: #1a1a1a;
            padding: 0.875rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9375rem;
            text-decoration: none;
            display: inline-block;
            border: 2px solid #1a1a1a;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #1a1a1a;
            color: white;
            transform: translateY(-2px);
        }

        /* Navigation */
        .nav-link {
            transition: color 0.2s ease;
            font-size: 0.9375rem;
            font-weight: 500;
            color: #4b5563;
            text-decoration: none;
        }

        .nav-link:hover {
            color: #1a1a1a;
        }

        /* Logo styling */
        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.875rem;
            font-weight: 900;
            color: #1a1a1a;
            font-style: italic;
        }

        /* Tag styling */
        .tag {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: #e0f2fe;
            color: #0369a1;
            border-radius: 50px;
            font-size: 0.8125rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        /* Feature badge */
        .feature-badge {
            display: inline-block;
            padding: 0.5rem 1.25rem;
            background-color: #dcfce7;
            color: #166534;
            border-radius: 50px;
            font-size: 0.8125rem;
            font-weight: 600;
            margin-right: 0.75rem;
            margin-bottom: 0.75rem;
        }

        /* Card styles */
        .feature-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 2rem;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
        }

        /* Decorative elements */
        .decorative-circle {
            position: absolute;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #a855f7, #ec4899);
            opacity: 0.1;
            z-index: 0;
        }
    </style>
</head>

<body class="antialiased">

    <div class="clean-bg">
        
        <!-- Navigation -->
        <nav style="padding: 1.5rem 0; position: relative; z-index: 50; background-color: #fdfcfb;">
            <div style="max-width: 1280px; margin: 0 auto; padding: 0 2rem; display: flex; justify-content: space-between; align-items: center;">
                
                <!-- Logo -->
                <div style="display: flex; align-items: center;">
                    <span class="logo">SchoolTrack</span>
                </div>

                <!-- Navigation Links -->
                <div style="display: flex; align-items: center; gap: 2.5rem;">
                    <a href="#features" class="nav-link">FEATURES</a>
                    <a href="#about" class="nav-link">ABOUT</a>
                    <a href="#contact" class="nav-link">CONTACT</a>
                    <a href="{{ route('login') }}" class="btn-secondary">
                        Login
                    </a>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section style="padding: 4rem 2rem 6rem 2rem; position: relative; overflow: hidden;">
            
            <!-- Decorative elements -->
            <div class="decorative-circle" style="top: 10%; left: 5%;"></div>
            <div class="decorative-circle" style="top: 60%; right: 10%; background: linear-gradient(135deg, #3b82f6, #10b981);"></div>
            
            <div style="max-width: 1280px; margin: 0 auto; position: relative; z-index: 1;">
                
                <!-- Text Content -->
                <div style="text-align: center; margin-bottom: 4rem;">
                    
                    <!-- Tag -->
                    <div class="fade-in-up delay-1">
                        <span class="tag">JOIN THE MOVEMENT FOR BETTER EDUCATION</span>
                    </div>

                    <!-- Main Heading -->
                    <div class="fade-in-up delay-2" style="margin-bottom: 2rem;">
                        <h1 class="hero-title">the community</h1>
                        <h2 class="hero-subtitle" style="margin-top: 0.5rem;">for educational</h2>
                        <h2 class="hero-subtitle">management</h2>
                    </div>

                    <!-- CTA Button -->
                    <div class="fade-in-up delay-3">
                        <a href="{{ route('login') }}" class="btn-primary">
                            Join The Platform
                        </a>
                    </div>

                </div>

                <!-- Feature Tags Section -->
                <div class="fade-in-up delay-4" style="text-align: center; margin-top: 4rem; padding: 2rem; background: white; border-radius: 16px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);">
                    <span class="feature-badge">STUDENT RECORDS</span>
                    <span class="feature-badge">MODULE MANAGEMENT</span>
                    <span class="feature-badge">TEACHER TRACKING</span>
                    <span class="feature-badge">ANALYTICS & INSIGHTS</span>
                    <span class="feature-badge">ENROLLMENT SYSTEM</span>
                    <span class="feature-badge">PROGRESS MONITORING</span>
                    <span class="feature-badge">AUTOMATED REPORTING</span>
                    <span class="feature-badge">REAL-TIME UPDATES</span>
                </div>

            </div>
        </section>

        <!-- Features Section -->
        <section id="features" style="padding: 6rem 2rem; background-color: #f9fafb;">
            <div style="max-width: 1280px; margin: 0 auto;">
                
                <div style="text-align: center; margin-bottom: 4rem;">
                    <h2 class="hero-subtitle" style="margin-bottom: 1rem;">Everything you need</h2>
                    <p style="font-size: 1.125rem; color: #6b7280; max-width: 600px; margin: 0 auto;">
                        Comprehensive tools designed to streamline your educational institution's daily operations.
                    </p>
                </div>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem;">
                    
                    <!-- Feature 1 -->
                    <div class="feature-card">
                        <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-radius: 12px; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg style="width: 28px; height: 28px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <h3 style="font-size: 1.375rem; font-weight: 700; color: #1a1a1a; margin-bottom: 1rem;">Student Management</h3>
                        <p style="color: #6b7280; line-height: 1.7; font-size: 0.9375rem;">Easily manage student records, enrollments, and track their academic progress all in one centralized platform.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="feature-card">
                        <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #a855f7 0%, #9333ea 100%); border-radius: 12px; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg style="width: 28px; height: 28px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <h3 style="font-size: 1.375rem; font-weight: 700; color: #1a1a1a; margin-bottom: 1rem;">Module Organization</h3>
                        <p style="color: #6b7280; line-height: 1.7; font-size: 0.9375rem;">Create and organize courses, assign teachers, and manage module availability with intuitive controls.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="feature-card">
                        <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 12px; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg style="width: 28px; height: 28px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <h3 style="font-size: 1.375rem; font-weight: 700; color: #1a1a1a; margin-bottom: 1rem;">Real-time Analytics</h3>
                        <p style="color: #6b7280; line-height: 1.7; font-size: 0.9375rem;">Get powerful insights into enrollment trends, student performance, and institutional metrics instantly.</p>
                    </div>

                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section style="padding: 6rem 2rem; background-color: #fdfcfb; text-align: center;">
            <div style="max-width: 800px; margin: 0 auto;">
                <h2 class="hero-subtitle" style="margin-bottom: 1.5rem;">Ready to transform your institution?</h2>
                <p style="font-size: 1.125rem; color: #6b7280; margin-bottom: 2.5rem; line-height: 1.7;">
                    Join thousands of educators who are already managing smarter, not harder.
                </p>
                <a href="{{ route('login') }}" class="btn-primary">
                    Get Started Today
                </a>
            </div>
        </section>

        <!-- Footer -->
        <footer style="padding: 3rem 2rem; text-align: center; background-color: #f9fafb; border-top: 1px solid #e5e7eb;">
            <p style="color: #6b7280; font-size: 0.875rem; margin: 0;">
                © 2025 SchoolTrack. All rights reserved.
            </p>
        </footer>

    </div>

</body>

</html>