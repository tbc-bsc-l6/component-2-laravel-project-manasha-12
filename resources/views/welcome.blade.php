<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Educational Admin System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Impact&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow-x: hidden;
        }

        .font-impact {
            font-family: 'Impact', sans-serif;
            letter-spacing: 0.02em;
            line-height: 0.9;
        }

        .font-montserrat {
            font-family: 'Montserrat', sans-serif;
        }

        /* Lighter gradient overlay for better visibility */
        .hero-overlay {
            background: linear-gradient(90deg,
                    rgba(0, 0, 0, 0.65) 0%,
                    rgba(0, 0, 0, 0.45) 25%,
                    rgba(0, 0, 0, 0.25) 50%,
                    transparent 70%);
        }

        /* Button with arrow */
        .btn-arrow {
            position: relative;
            padding-right: 3.5rem;
        }

        .btn-arrow::after {
            content: '→';
            position: absolute;
            right: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.5rem;
            transition: transform 0.3s ease;
        }

        .btn-arrow:hover::after {
            transform: translateY(-50%) translateX(4px);
        }

        /* Ensure minimum 20px padding on all sides */
        .hero-content {
            padding: 20px;
        }

        @media (min-width: 640px) {
            .hero-content {
                padding: 20px 48px;
            }
        }

        @media (min-width: 1024px) {
            .hero-content {
                padding: 20px 64px;
            }
        }
    </style>
</head>

<body class="antialiased font-montserrat">


    <!-- Full-screen Hero Section -->
    <section class="relative min-h-screen flex items-start pt-32">

        <!-- Background Image - Full Screen -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero-image.jpg') }}"
                alt="Students studying"
                class="w-full h-full object-cover object-center">
            <div class="absolute inset-0 hero-overlay"></div>
        </div>

        <!-- Login Button - Top Right (NO WRAPPER DIV) -->
        <a href="{{ route('login') }}"
            class="absolute top-8 right-8 z-30 inline-block px-6 py-3 bg-gray-100/90 backdrop-blur-sm text-gray-700 font-normal text-sm rounded-md transition duration-300 shadow-lg font-montserrat border border-gray-200/50 hover:bg-gray-200/90">
            Login to access dashboard
        </a>

        <!-- Hero Content -->
        <div class="hero-content relative z-10 w-full">
            <div class="max-w-7xl mx-auto">
                <div class="max-w-3xl">

                    <!-- Main Heading -->
                    <h1 class="font-impact text-white uppercase mb-12"
                        style="font-size: clamp(3rem, 8vw, 6.5rem); line-height: 1;">
                        MANAGE<br>
                        YOUR DAILY<br>
                        RESOURCES
                    </h1>

                    <!-- Call to Action Button -->
                    <div class="mb-12">
                        <a href="{{ route('login') }}"
                            class="btn-arrow inline-block px-10 py-4 bg-white text-gray-800 font-semibold text-lg rounded-full hover:bg-gray-50 transition-all duration-300 shadow-lg hover:shadow-xl font-montserrat">
                            Access Dashboard
                        </a>
                    </div>

                    <!-- Description Text -->
                    <div class="max-w-xl">
                        <p class="text-gray-900 text-base leading-relaxed font-montserrat font-medium">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>

</body>

</html>