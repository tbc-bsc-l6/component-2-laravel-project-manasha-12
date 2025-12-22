<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js for dropdown functionality -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.admin-navigation')

        @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <main>
            {{ $slot }}
        </main>
    </div>
    <!-- Toast Notifications -->
    @if (session('success') || session('error'))
    <div id="toast" style="position: fixed; top: 1rem; right: 1rem; z-index: 9999; min-width: 300px; max-width: 500px; padding: 1rem 1.5rem; border-radius: 0.5rem; box-shadow: 0 10px 15px rgba(0,0,0,0.2); animation: slideIn 0.3s ease-out;">
        @if (session('success'))
        <div style="display: flex; align-items: center; background-color: #d1fae5; border-left: 4px solid #10b981; padding: 1rem; border-radius: 0.5rem;">
            <svg style="width: 24px; height: 24px; color: #059669; margin-right: 0.75rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p style="color: #065f46; font-weight: 500; margin: 0;">{{ session('success') }}</p>
        </div>
        @endif

        @if (session('error'))
        <div style="display: flex; align-items: center; background-color: #fee2e2; border-left: 4px solid #ef4444; padding: 1rem; border-radius: 0.5rem;">
            <svg style="width: 24px; height: 24px; color: #dc2626; margin-right: 0.75rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        // Auto-hide toast after 5 seconds
        setTimeout(() => {
            const toast = document.getElementById('toast');
            if (toast) {
                toast.style.animation = 'slideOut 0.3s ease-out';
                setTimeout(() => toast.remove(), 300);
            }
        }, 5000);

        // Click to dismiss
        document.getElementById('toast')?.addEventListener('click', function() {
            this.style.animation = 'slideOut 0.3s ease-out';
            setTimeout(() => this.remove(), 300);
        });
    </script>
    @endif
</body>

</html>