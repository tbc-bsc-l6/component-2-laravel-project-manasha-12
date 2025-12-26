<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Teacher Portal</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" style="background-color: var(--bg-primary); color: var(--text-primary);">
        <div style="min-height: 100vh; background-color: var(--bg-secondary);">
            @include('layouts.teacher-navigation')

            <!-- Page Header -->
            @if(isset($header))
                <header style="background-color: var(--card-bg); box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                    <div style="max-width: 1280px; margin: 0 auto; padding: 1.5rem 1rem;">
                        {!! $header !!}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>

        <!-- Toast Notifications -->
        @if (session('success') || session('error'))
            <div id="toast" style="position: fixed; top: 1rem; right: 1rem; z-index: 9999; min-width: 300px; max-width: 500px; animation: slideIn 0.3s ease-out;">
                @if (session('success'))
                    <div style="display: flex; align-items: center; background-color: #d1fae5; border-left: 4px solid #10b981; padding: 1rem 1.5rem; border-radius: 0.5rem; box-shadow: 0 10px 15px rgba(0,0,0,0.2); cursor: pointer;">
                        <svg style="width: 24px; height: 24px; color: #059669; margin-right: 0.75rem; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p style="color: #065f46; font-weight: 500; margin: 0;">{{ session('success') }}</p>
                    </div>
                @endif

                @if (session('error'))
                    <div style="display: flex; align-items: center; background-color: #fee2e2; border-left: 4px solid #ef4444; padding: 1rem 1.5rem; border-radius: 0.5rem; box-shadow: 0 10px 15px rgba(0,0,0,0.2); cursor: pointer;">
                        <svg style="width: 24px; height: 24px; color: #dc2626; margin-right: 0.75rem; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p style="color: #991b1b; font-weight: 500; margin: 0;">{{ session('error') }}</p>
                    </div>
                @endif
            </div>

            <style>
                @keyframes slideIn {
                    from { transform: translateX(100%); opacity: 0; }
                    to { transform: translateX(0); opacity: 1; }
                }
                @keyframes slideOut {
                    from { transform: translateX(0); opacity: 1; }
                    to { transform: translateX(100%); opacity: 0; }
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
    </body>
</html>
