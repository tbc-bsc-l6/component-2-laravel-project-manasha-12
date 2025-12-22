<nav style="background-color: white; border-bottom: 1px solid #e5e7eb;">
    <div style="max-width: 1280px; margin: 0 auto; padding: 0 1rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; height: 64px;">
            
            <!-- Logo & Navigation Links -->
            <div style="display: flex; align-items: center; gap: 2rem; flex: 1;">
                <!-- Logo (Text) -->
                <div style="flex-shrink: 0;">
                    <a href="{{ route('admin.dashboard') }}" style="text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                        <div style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); width: 32px; height: 32px; border-radius: 0.375rem; display: flex; align-items: center; justify-content: center;">
                            <span style="color: white; font-weight: 700; font-size: 1rem;">S</span>
                        </div>
                        <span style="font-size: 1.125rem; font-weight: 700; color: #111827;">SchoolTrack</span>
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <div style="display: flex; align-items: center; gap: 1.5rem;">
                    <a href="{{ route('admin.dashboard') }}" 
                       style="padding: 0.5rem 0.75rem; border-bottom: 2px solid {{ request()->routeIs('admin.dashboard') ? '#3b82f6' : 'transparent' }}; font-size: 0.875rem; font-weight: 500; color: {{ request()->routeIs('admin.dashboard') ? '#3b82f6' : '#6b7280' }}; text-decoration: none; transition: all 0.2s;"
                       onmouseover="if (!this.style.borderBottomColor.includes('59, 130, 246')) this.style.color='#111827'"
                       onmouseout="if (!this.style.borderBottomColor.includes('59, 130, 246')) this.style.color='#6b7280'">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.modules.index') }}" 
                       style="padding: 0.5rem 0.75rem; border-bottom: 2px solid {{ request()->routeIs('admin.modules.*') ? '#3b82f6' : 'transparent' }}; font-size: 0.875rem; font-weight: 500; color: {{ request()->routeIs('admin.modules.*') ? '#3b82f6' : '#6b7280' }}; text-decoration: none; transition: all 0.2s;"
                       onmouseover="if (!this.style.borderBottomColor.includes('59, 130, 246')) this.style.color='#111827'"
                       onmouseout="if (!this.style.borderBottomColor.includes('59, 130, 246')) this.style.color='#6b7280'">
                        Modules
                    </a>
                    <a href="{{ route('admin.teachers.index') }}" 
                       style="padding: 0.5rem 0.75rem; border-bottom: 2px solid {{ request()->routeIs('admin.teachers.*') ? '#3b82f6' : 'transparent' }}; font-size: 0.875rem; font-weight: 500; color: {{ request()->routeIs('admin.teachers.*') ? '#3b82f6' : '#6b7280' }}; text-decoration: none; transition: all 0.2s;"
                       onmouseover="if (!this.style.borderBottomColor.includes('59, 130, 246')) this.style.color='#111827'"
                       onmouseout="if (!this.style.borderBottomColor.includes('59, 130, 246')) this.style.color='#6b7280'">
                        Teachers
                    </a>
                    <a href="{{ route('admin.enrollments.index') }}" 
                       style="padding: 0.5rem 0.75rem; border-bottom: 2px solid {{ request()->routeIs('admin.enrollments.*') ? '#3b82f6' : 'transparent' }}; font-size: 0.875rem; font-weight: 500; color: {{ request()->routeIs('admin.enrollments.*') ? '#3b82f6' : '#6b7280' }}; text-decoration: none; transition: all 0.2s;"
                       onmouseover="if (!this.style.borderBottomColor.includes('59, 130, 246')) this.style.color='#111827'"
                       onmouseout="if (!this.style.borderBottomColor.includes('59, 130, 246')) this.style.color='#6b7280'">
                        Enrollments
                    </a>
                    <a href="{{ route('admin.users.index') }}" 
                       style="padding: 0.5rem 0.75rem; border-bottom: 2px solid {{ request()->routeIs('admin.users.*') ? '#3b82f6' : 'transparent' }}; font-size: 0.875rem; font-weight: 500; color: {{ request()->routeIs('admin.users.*') ? '#3b82f6' : '#6b7280' }}; text-decoration: none; transition: all 0.2s;"
                       onmouseover="if (!this.style.borderBottomColor.includes('59, 130, 246')) this.style.color='#111827'"
                       onmouseout="if (!this.style.borderBottomColor.includes('59, 130, 246')) this.style.color='#6b7280'">
                        Users
                    </a>
                </div>
            </div>

            <!-- User Dropdown -->
            <div style="display: flex; align-items: center;">
                <div style="position: relative;">
                    <!-- Dropdown Button -->
                    <button type="button" id="user-menu-button" onclick="toggleDropdown()" 
                            style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background-color: white; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; font-weight: 500; color: #374151; cursor: pointer; transition: all 0.2s;"
                            onmouseover="this.style.backgroundColor='#f9fafb'; this.style.borderColor='#9ca3af'"
                            onmouseout="this.style.backgroundColor='white'; this.style.borderColor='#d1d5db'">
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
                         style="display: none; position: absolute; right: 0; margin-top: 0.5rem; width: 200px; background-color: white; border-radius: 0.5rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); z-index: 50; border: 1px solid #e5e7eb;">
                        <div style="padding: 0.5rem;">
                            <!-- User Info -->
                            <div style="padding: 0.5rem 0.75rem; border-bottom: 1px solid #e5e7eb; margin-bottom: 0.5rem;">
                                <p style="font-size: 0.875rem; font-weight: 600; color: #111827; margin: 0;">{{ auth('admin')->user()->name }}</p>
                                <p style="font-size: 0.75rem; color: #6b7280; margin: 0.25rem 0 0 0;">{{ auth('admin')->user()->email }}</p>
                            </div>

                            <!-- Profile Link -->
                            <a href="{{ route('profile.edit') }}" 
                               style="display: flex; align-items: center; padding: 0.5rem 0.75rem; font-size: 0.875rem; color: #374151; text-decoration: none; border-radius: 0.375rem; transition: background-color 0.15s;"
                               onmouseover="this.style.backgroundColor='#f3f4f6'" 
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

<script>
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
</script>