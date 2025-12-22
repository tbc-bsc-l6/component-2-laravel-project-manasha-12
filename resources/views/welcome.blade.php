<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SchoolTrack - Student Management System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        /* Gradient background */
        .gradient-bg {
            background: linear-gradient(180deg, 
                #ffffff 0%, 
                #fef3f2 25%,
                #fde4e1 50%, 
                #fdd4cf 75%,
                #fcc5bd 100%);
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

        /* Button hover effect */
        .btn-primary {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .btn-primary::after {
            content: '→';
            position: absolute;
            right: 1.5rem;
            transition: transform 0.3s ease;
        }

        .btn-primary:hover::after {
            transform: translateX(4px);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        /* Card with floating effect */
        .floating-card {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        /* Dashboard preview styles */
        .dashboard-preview {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 24px;
            padding: 2rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .preview-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Navigation */
        .nav-link {
            transition: color 0.2s ease;
        }

        .nav-link:hover {
            color: #667eea;
        }
    </style>
</head>

<body class="antialiased">

    <div class="gradient-bg">
        
        <!-- Navigation -->
        <nav style="padding: 1.5rem 0; position: relative; z-index: 50;">
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem; display: flex; justify-content: space-between; align-items: center;">
                
                <!-- Logo -->
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); width: 40px; height: 40px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                        <span style="color: white; font-weight: 700; font-size: 1.25rem;">S</span>
                    </div>
                    <span style="font-size: 1.25rem; font-weight: 700; color: #1f2937;">SchoolTrack</span>
                </div>

                <!-- Navigation Links -->
                <div style="display: flex; align-items: center; gap: 2.5rem;">
                    <a href="#features" class="nav-link" style="font-size: 0.9375rem; font-weight: 500; color: #4b5563; text-decoration: none;">Features</a>
                    <a href="#about" class="nav-link" style="font-size: 0.9375rem; font-weight: 500; color: #4b5563; text-decoration: none;">About</a>
                    <a href="#contact" class="nav-link" style="font-size: 0.9375rem; font-weight: 500; color: #4b5563; text-decoration: none;">Contact</a>
                    <a href="{{ route('login') }}" 
                       style="padding: 0.625rem 1.5rem; background-color: #1f2937; color: white; font-weight: 500; font-size: 0.875rem; border-radius: 9999px; text-decoration: none; transition: all 0.2s; display: inline-block; border: 2px solid #1f2937;"
                       onmouseover="this.style.backgroundColor='white'; this.style.color='#1f2937'"
                       onmouseout="this.style.backgroundColor='#1f2937'; this.style.color='white'">
                        Login
                    </a>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section style="padding: 6rem 2rem 4rem 2rem; position: relative;">
            <div style="max-width: 1200px; margin: 0 auto;">
                
                <!-- Text Content -->
                <div style="text-align: center; margin-bottom: 4rem;">
                    
                    <!-- Subtitle -->
                    <p class="fade-in-up delay-1" style="font-size: 1rem; color: #6b7280; margin-bottom: 1.5rem; font-weight: 500; letter-spacing: 0.05em;">
                        Your Day, in Perfect Rhythm.
                    </p>

                    <!-- Main Heading -->
                    <h1 class="fade-in-up delay-2" style="font-size: clamp(2.5rem, 6vw, 5rem); font-weight: 800; color: #111827; line-height: 1.1; margin-bottom: 1.5rem; letter-spacing: -0.02em;">
                        Manage Smarter,<br>
                        Not Harder
                    </h1>

                    <!-- Description -->
                    <p class="fade-in-up delay-3" style="font-size: 1.125rem; color: #6b7280; max-width: 600px; margin: 0 auto 2.5rem auto; line-height: 1.7;">
                        Take control of your educational institution with our all-in-one platform. 
                        Organize students, track progress, and focus on what matters—without the overwhelm.
                    </p>

                    <!-- CTA Button -->
                    <div class="fade-in-up delay-4">
                        <a href="{{ route('login') }}" class="btn-primary"
                           style="display: inline-block; padding: 1rem 2.5rem; background-color: #1f2937; color: white; font-weight: 600; font-size: 0.9375rem; border-radius: 9999px; text-decoration: none; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding-right: 3.5rem;">
                            Get Started Free
                        </a>
                    </div>

                </div>

                <!-- Dashboard Preview -->
                <div class="fade-in-up delay-4 floating-card" style="max-width: 900px; margin: 0 auto;">
                    <div class="dashboard-preview">
                        
                        <!-- Dashboard Header -->
                        <div style="background: rgba(255, 255, 255, 0.2); border-radius: 12px; padding: 1rem 1.5rem; margin-bottom: 1.5rem; backdrop-filter: blur(10px);">
                            <div style="display: flex; gap: 0.5rem; margin-bottom: 0.75rem;">
                                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #ef4444;"></div>
                                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #fbbf24;"></div>
                                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #10b981;"></div>
                            </div>
                            <div style="height: 8px; background: rgba(255, 255, 255, 0.3); border-radius: 4px; width: 60%;"></div>
                        </div>

                        <!-- Dashboard Content -->
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                            
                            <!-- Card 1 -->
                            <div class="preview-card">
                                <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); border-radius: 8px; margin-bottom: 1rem;"></div>
                                <div style="height: 6px; background: #e5e7eb; border-radius: 3px; width: 80%; margin-bottom: 0.5rem;"></div>
                                <div style="height: 6px; background: #e5e7eb; border-radius: 3px; width: 60%;"></div>
                            </div>

                            <!-- Card 2 -->
                            <div class="preview-card">
                                <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #a855f7 0%, #9333ea 100%); border-radius: 8px; margin-bottom: 1rem;"></div>
                                <div style="height: 6px; background: #e5e7eb; border-radius: 3px; width: 80%; margin-bottom: 0.5rem;"></div>
                                <div style="height: 6px; background: #e5e7eb; border-radius: 3px; width: 60%;"></div>
                            </div>

                            <!-- Card 3 -->
                            <div class="preview-card">
                                <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 8px; margin-bottom: 1rem;"></div>
                                <div style="height: 6px; background: #e5e7eb; border-radius: 3px; width: 80%; margin-bottom: 0.5rem;"></div>
                                <div style="height: 6px; background: #e5e7eb; border-radius: 3px; width: 60%;"></div>
                            </div>

                        </div>

                        <!-- List Items -->
                        <div class="preview-card" style="margin-top: 1rem;">
                            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.75rem;">
                                <div style="width: 32px; height: 32px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-radius: 50%;"></div>
                                <div style="flex: 1;">
                                    <div style="height: 6px; background: #e5e7eb; border-radius: 3px; width: 70%; margin-bottom: 0.5rem;"></div>
                                    <div style="height: 4px; background: #f3f4f6; border-radius: 2px; width: 40%;"></div>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <div style="width: 32px; height: 32px; background: linear-gradient(135deg, #ec4899 0%, #db2777 100%); border-radius: 50%;"></div>
                                <div style="flex: 1;">
                                    <div style="height: 6px; background: #e5e7eb; border-radius: 3px; width: 60%; margin-bottom: 0.5rem;"></div>
                                    <div style="height: 4px; background: #f3f4f6; border-radius: 2px; width: 35%;"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>

        <!-- Features Section -->
        <section id="features" style="padding: 4rem 2rem; background: rgba(255, 255, 255, 0.5); backdrop-filter: blur(10px);">
            <div style="max-width: 1200px; margin: 0 auto; text-align: center;">
                <h2 style="font-size: 2.5rem; font-weight: 700; color: #111827; margin-bottom: 3rem;">
                    Everything you need to succeed
                </h2>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem;">
                    
                    <!-- Feature 1 -->
                    <div style="padding: 2rem; text-align: left;">
                        <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-radius: 12px; margin-bottom: 1rem; display: flex; align-items: center; justify-content: center;">
                            <svg style="width: 24px; height: 24px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <h3 style="font-size: 1.25rem; font-weight: 600; color: #111827; margin-bottom: 0.75rem;">Student Management</h3>
                        <p style="color: #6b7280; line-height: 1.6;">Easily manage student records, enrollments, and track their academic progress all in one place.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div style="padding: 2rem; text-align: left;">
                        <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #a855f7 0%, #9333ea 100%); border-radius: 12px; margin-bottom: 1rem; display: flex; align-items: center; justify-content: center;">
                            <svg style="width: 24px; height: 24px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <h3 style="font-size: 1.25rem; font-weight: 600; color: #111827; margin-bottom: 0.75rem;">Module Organization</h3>
                        <p style="color: #6b7280; line-height: 1.6;">Create and organize courses, assign teachers, and manage module availability with ease.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div style="padding: 2rem; text-align: left;">
                        <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 12px; margin-bottom: 1rem; display: flex; align-items: center; justify-content: center;">
                            <svg style="width: 24px; height: 24px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <h3 style="font-size: 1.25rem; font-weight: 600; color: #111827; margin-bottom: 0.75rem;">Real-time Analytics</h3>
                        <p style="color: #6b7280; line-height: 1.6;">Get insights into enrollment trends, student performance, and institutional metrics instantly.</p>
                    </div>

                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer style="padding: 2rem; text-align: center; background: rgba(255, 255, 255, 0.5);">
            <p style="color: #6b7280; font-size: 0.875rem;">
                © 2024 EduManage. All rights reserved.
            </p>
        </footer>

    </div>

</body>

</html>