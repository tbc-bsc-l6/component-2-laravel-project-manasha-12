<nav style="background-color: var(--nav-bg, #ffffff); border-bottom: 1px solid var(--border-color, #e5e7eb); transition: all 0.3s ease;">
    <div style="max-width: 1280px; margin: 0 auto; padding: 0 1rem;">
        <div style="display: flex; justify-content: space-between; height: 64px;">
            
            <!-- Logo & Navigation Links -->
            <div style="display: flex; align-items: center; gap: 2rem; flex: 1;">
                <!-- Logo (Text) -->
                <div style="flex-shrink: 0;">
                    <a href="{{ route('admin.dashboard') }}" style="text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                        <div style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); width: 32px; height: 32px; border-radius: 0.375rem; display: flex; align-items: center; justify-content: center;">
                            <span style="color: white; font-weight: 700; font-size: 1rem;">E</span>
                        </div>
                        <span style="font-size: 1.125rem; font-weight: 700; color: var(--text-primary, #111827); transition: color 0.3s ease;">EduManage</span>
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <div style="display: flex; align-items: center; gap: 1.5rem;">
                    <a href="{{ route('admin.dashboard') }}" 
                       style="padding: 0.5rem 0.75rem; border-bottom: 2px solid {{ request()->routeIs('admin.dashboard') ? '#3b82f6' : 'transparent' }}; font-size: 0.875rem; font-weight: 500; color: {{ request()->routeIs('admin.dashboard') ? '#3b82f6' : 'var(--nav-text, #6b7280)' }}; text-decoration: none; transition: all 0.2s;"
                       onmouseover="if (!this.style.borderBottomColor.includes('59, 130, 246')) this.style.color='var(--text-primary, #111827)'"
                       onmouseout="if (!this.style.borderBottomColor.includes('59, 130, 246')) this.style.color='var(--nav-text, #6b7280)'">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.modules.index') }}" 
                       style="padding: 0.5rem 0.75rem; border-bottom: 2px solid {{ request()->routeIs('admin.modules.*') ? '#3b82f6' : 'transparent' }}; font-size: 0.875rem; font-weight: 500; color: {{ request()->routeIs('admin.modules.*') ? '#3b82f6' : 'var(--nav-text, #6b7280)' }}; text-decoration: none; transition: all 0.2s;"
                       onmouseover="if (!this.style.borderBottomColor.includes('59, 130, 246')) this.style.color='var(--text-primary, #111827)'"
                       onmouseout="if (!this.style.borderBottomColor.includes('59, 130, 246')) this.style.color='var(--nav-text, #6b7280)'">
                        Modules
                    </a>
                    <a href="{{ route('admin.teachers.index') }}" 
                       style="padding: 0.5rem 0.75rem; border-bottom: 2px solid {{ request()->routeIs('admin.teachers.*') ? '#3b82f6' : 'transparent' }}; font-size: 0.875rem; font-weight: 500; color: {{ request()->routeIs('admin.teachers.*') ? '#3b82f6' : 'var(--nav-text, #6b7280)' }}; text-decoration: none; transition: all 0.2s;"
                       onmouseover="if (!this.style.borderBottomColor.includes('59, 130, 246')) this.style.color='var(--text-primary, #111827)'"
                       onmouseout="if (!this.style.borderBottomColor.includes('59, 130, 246')) this.style.color='var(--nav-text, #6b7280)'">
                        Teachers
                    </a>
                    <a href="{{ route('admin.enrollments.index') }}" 
                       style="padding: 0.5rem 0.75rem; border-bottom: 2px solid {{ request()->routeIs('admin.enrollments.*') ? '#3b82f6' : 'transparent' }}; font-size: 0.875rem; font-weight: 500; color: {{ request()->routeIs('admin.enrollments.*') ? '#3b82f6' : 'var(--nav-text, #6b7280)' }}; text-decoration: none; transition: all 0.2s;"
                       onmouseover="if (!this.style.borderBottomColor.includes('59, 130, 246')) this.style.color='var(--text-primary, #111827)'"
                       onmouseout="if (!this.style.borderBottomColor.includes('59, 130, 246')) this.style.color='var(--nav-text, #6b7280)'">
                        Enrollments
                    </a>
                    <a href="{{ route('admin.users.index') }}" 
                       style="padding: 0.5rem 0.75rem; border-bottom: 2px solid {{ request()->routeIs('admin.users.*') ? '#3b82f6' : 'transparent' }}; font-size: 0.875rem; font-weight: 500; color: {{ request()->routeIs('admin.users.*') ? '#3b82f6' : 'var(--nav-text, #6b7280)' }}; text-decoration: none; transition: all 0.2s;"
                       onmouseover="if (!this.style.borderBottomColor.includes('59, 130, 246')) this.style.color='var(--text-primary, #111827)'"
                       onmouseout="if (!this.style.borderBottomColor.includes('59, 130, 246')) this.style.color='var(--nav-text, #6b7280)'">
                        Users
                    </a>
                </div>
            </div>

            <!-- Right Side: Dark Mode Toggle + User Dropdown -->
            <div style="display: flex; align-items: center; gap: 1rem;">
                
                <!-- Dark Mode Toggle Button -->
                <button id="darkModeToggle" onclick="toggleDarkMode()" 
                        style="padding: 0.5rem; border-radius: 0.5rem; background-color: var(--input-bg, #f3f4f6); border: 1px solid var(--border-color, #e5e7eb); cursor: pointer; transition: all 0.2s; display: flex; align-items: center; justify-content: center;"
                        onmouseover="this.style.backgroundColor='var(--bg-tertiary, #e5e7eb)'"
                        onmouseout="this.style.backgroundColor='var(--input-bg, #f3f4f6)'">
                    <!-- Sun Icon (Light Mode) -->
                    <svg id="sunIcon" style="width: 20px; height: 20px; color: var(--text-primary, #111827); display: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <!-- Moon Icon (Dark Mode) -->
                    <svg id="moonIcon" style="width: 20px; height: 20px; color: var(--text-primary, #111827); display: block;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                </button>

                <!-- User Dropdown -->
                <div style="position: relative;">
                    <!-- Dropdown Button -->
                    <button type="button" id="user-menu-button" onclick="toggleDropdown()" 
                            style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background-color: var(--card-bg, white); border: 1px solid var(--border-color, #d1d5db); border-radius: 0.5rem; font-size: 0.875rem; font-weight: 500; color: var(--text-primary, #374151); cursor: pointer; transition: all 0.2s;"
                            onmouseover="this.style.backgroundColor='var(--bg-tertiary, #f9fafb)'; this.style.borderColor='var(--text-tertiary, #9ca3af)'"
                            onmouseout="this.style.backgroundColor='var(--card-bg, white)'; this.style.borderColor='var(--border-color, #d1d5db)'">
                        <div style="width: 24px; height: 24px; border-radius: 50%; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); display: flex; align-items: center; justify-content: center; margin-right: 0.5rem;">
                            <span style="color: white; font-size: 0.75rem; font-weight: 600;">{{ substr(auth('admin')->user()->name, 0, 1) }}</span>
                        </div>
                        <span>{{ auth('admin')->user()->name }}</span>
                        <svg style="width: 16px; height: 16px; margin-left: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="user-menu" 
                         style="display: none; position: absolute; right: 0; margin-top: 0.5rem; width: 200px; background-color: var(--card-bg, white); border-radius: 0.5rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); z-index: 50; border: 1px solid var(--border-color, #e5e7eb);">
                        <div style="padding: 0.5rem;">
                            <!-- User Info -->
                            <div style="padding: 0.5rem 0.75rem; border-bottom: 1px solid var(--border-color, #e5e7eb); margin-bottom: 0.5rem;">
                                <p style="font-size: 0.875rem; font-weight: 600; color: var(--text-primary, #111827); margin: 0;">{{ auth('admin')->user()->name }}</p>
                                <p style="font-size: 0.75rem; color: var(--text-secondary, #6b7280); margin: 0.25rem 0 0 0;">{{ auth('admin')->user()->email }}</p>
                            </div>

                            <!-- Profile Link -->
                            <a href="{{ route('profile.edit') }}" 
                               style="display: flex; align-items: center; padding: 0.5rem 0.75rem; font-size: 0.875rem; color: var(--text-primary, #374151); text-decoration: none; border-radius: 0.375rem; transition: background-color 0.15s;"
                               onmouseover="this.style.backgroundColor='var(--bg-tertiary, #f3f4f6)'" 
                               onmouseout="this.style.backgroundColor='transparent'">
                                <svg style="width: 16px; height: 16px; margin-right: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Profile
                            </a>
                            
                            <!-- Logout Form -->
                            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                @csrf
                                <button type="submit" 
                                        style="display: flex; align-items: center; width: 100%; text-align: left; padding: 0.5rem 0.75rem; font-size: 0.875rem; color: #ef4444; background: none; border: none; cursor: pointer; border-radius: 0.375rem; transition: background-color 0.15s;"
                                        onmouseover="this.style.backgroundColor='#fef2f2'" 
                                        onmouseout="this.style.backgroundColor='transparent'">
                                    <svg style="width: 16px; height: 16px; margin-right: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Dark Mode Styles -->
<style>
    /* CSS Variables for Dark Mode */
    :root {
        --bg-primary: #ffffff;
        --bg-secondary: #f9fafb;
        --bg-tertiary: #f3f4f6;
        --text-primary: #111827;
        --text-secondary: #6b7280;
        --text-tertiary: #9ca3af;
        --border-color: #e5e7eb;
        --card-bg: #ffffff;
        --nav-bg: #ffffff;
        --nav-text: #6b7280;
        --input-bg: #ffffff;
        --input-border: #d1d5db;
    }

    [data-theme="dark"] {
        --bg-primary: #0a0a0a;
        --bg-secondary: #111827;
        --bg-tertiary: #1f2937;
        --text-primary: #f9fafb;
        --text-secondary: #d1d5db;
        --text-tertiary: #9ca3af;
        --border-color: #374151;
        --card-bg: #1f2937;
        --nav-bg: #111827;
        --nav-text: #d1d5db;
        --input-bg: #1f2937;
        --input-border: #374151;
    }

    /* Smooth transitions */
    * {
        transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    }

    body {
        background-color: var(--bg-secondary);
        color: var(--text-primary);
    }

    /* Dark mode for common elements */
    [data-theme="dark"] .bg-white {
        background-color: var(--card-bg) !important;
    }

    [data-theme="dark"] .text-gray-900,
    [data-theme="dark"] .text-gray-800 {
        color: var(--text-primary) !important;
    }

    [data-theme="dark"] .text-gray-600,
    [data-theme="dark"] .text-gray-500,
    [data-theme="dark"] .text-gray-700 {
        color: var(--text-secondary) !important;
    }

    [data-theme="dark"] .border-gray-200,
    [data-theme="dark"] .border-gray-300 {
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] input,
    [data-theme="dark"] textarea,
    [data-theme="dark"] select {
        background-color: var(--input-bg) !important;
        border-color: var(--input-border) !important;
        color: var(--text-primary) !important;
    }

    [data-theme="dark"] table {
        background-color: var(--card-bg) !important;
    }

    [data-theme="dark"] tbody tr {
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .shadow-sm {
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.3) !important;
    }
</style>

<script>
    // Dark mode toggle function
    function toggleDarkMode() {
        const html = document.documentElement;
        const currentTheme = html.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        
        // Update theme
        html.setAttribute('data-theme', newTheme);
        
        // Save preference
        localStorage.setItem('theme', newTheme);
        
        // Update icons
        updateDarkModeIcons(newTheme);
    }

    // Update icon visibility
    function updateDarkModeIcons(theme) {
        const sunIcon = document.getElementById('sunIcon');
        const moonIcon = document.getElementById('moonIcon');
        
        if (theme === 'dark') {
            sunIcon.style.display = 'block';
            moonIcon.style.display = 'none';
        } else {
            sunIcon.style.display = 'none';
            moonIcon.style.display = 'block';
        }
    }

    // Initialize theme on page load
    function initializeTheme() {
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
        updateDarkModeIcons(savedTheme);
    }

    // Dropdown toggle function
    function toggleDropdown() {
        const menu = document.getElementById('user-menu');
        if (menu.style.display === 'none' || menu.style.display === '') {
            menu.style.display = 'block';
        } else {
            menu.style.display = 'none';
        }
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const button = document.getElementById('user-menu-button');
        const menu = document.getElementById('user-menu');
        
        if (menu && button) {
            const isClickInside = button.contains(event.target) || menu.contains(event.target);
            
            if (!isClickInside && menu.style.display === 'block') {
                menu.style.display = 'none';
            }
        }
    });

    // Close dropdown on Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const menu = document.getElementById('user-menu');
            if (menu) {
                menu.style.display = 'none';
            }
        }
    });

    // Listen for storage changes (sync across tabs)
    window.addEventListener('storage', function(e) {
        if (e.key === 'theme') {
            const newTheme = e.newValue || 'light';
            document.documentElement.setAttribute('data-theme', newTheme);
            updateDarkModeIcons(newTheme);
        }
    });

    // Initialize theme when script loads
    initializeTheme();
</script>