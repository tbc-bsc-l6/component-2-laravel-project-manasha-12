<nav style="background-color: #fdfcfb; border-bottom: 1px solid #e5e7eb; transition: all 0.3s ease;">
    <div style="max-width: 1280px; margin: 0 auto; padding: 0 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; height: 80px;">

            <!-- Logo & Navigation Links -->
            <div style="display: flex; align-items: center; gap: 3rem; flex: 1;">
                <!-- Logo (Text) -->
                <div style="flex-shrink: 0;">
                    <a href="{{ route('admin.dashboard') }}" style="text-decoration: none; display: flex; align-items: center;">
                        <span style="font-family: 'Playfair Display', serif; font-size: 1.875rem; font-weight: 900; color: #1a1a1a; font-style: italic;">s/t.</span>
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <div style="display: flex; align-items: center; gap: 2rem;">
                    <a href="{{ route('admin.dashboard') }}"
                        style="padding: 0.5rem 0; border-bottom: 2px solid {{ request()->routeIs('admin.dashboard') ? '#1a1a1a' : 'transparent' }}; font-size: 0.9375rem; font-weight: {{ request()->routeIs('admin.dashboard') ? '600' : '500' }}; color: {{ request()->routeIs('admin.dashboard') ? '#1a1a1a' : '#6b7280' }}; text-decoration: none; transition: all 0.2s; font-family: 'Inter', sans-serif;"
                        onmouseover="if (!'{{ request()->routeIs('admin.dashboard') }}') { this.style.color='#1a1a1a'; }"
                        onmouseout="if (!'{{ request()->routeIs('admin.dashboard') }}') { this.style.color='#6b7280'; }">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.modules.index') }}"
                        style="padding: 0.5rem 0; border-bottom: 2px solid {{ request()->routeIs('admin.modules.*') ? '#1a1a1a' : 'transparent' }}; font-size: 0.9375rem; font-weight: {{ request()->routeIs('admin.modules.*') ? '600' : '500' }}; color: {{ request()->routeIs('admin.modules.*') ? '#1a1a1a' : '#6b7280' }}; text-decoration: none; transition: all 0.2s; font-family: 'Inter', sans-serif;"
                        onmouseover="if (!'{{ request()->routeIs('admin.modules.*') }}') { this.style.color='#1a1a1a'; }"
                        onmouseout="if (!'{{ request()->routeIs('admin.modules.*') }}') { this.style.color='#6b7280'; }">
                        Modules
                    </a>
                    <a href="{{ route('admin.teachers.index') }}"
                        style="padding: 0.5rem 0; border-bottom: 2px solid {{ request()->routeIs('admin.teachers.*') ? '#1a1a1a' : 'transparent' }}; font-size: 0.9375rem; font-weight: {{ request()->routeIs('admin.teachers.*') ? '600' : '500' }}; color: {{ request()->routeIs('admin.teachers.*') ? '#1a1a1a' : '#6b7280' }}; text-decoration: none; transition: all 0.2s; font-family: 'Inter', sans-serif;"
                        onmouseover="if (!'{{ request()->routeIs('admin.teachers.*') }}') { this.style.color='#1a1a1a'; }"
                        onmouseout="if (!'{{ request()->routeIs('admin.teachers.*') }}') { this.style.color='#6b7280'; }">
                        Teachers
                    </a>
                    <a href="{{ route('admin.enrollments.index') }}"
                        style="padding: 0.5rem 0; border-bottom: 2px solid {{ request()->routeIs('admin.enrollments.*') ? '#1a1a1a' : 'transparent' }}; font-size: 0.9375rem; font-weight: {{ request()->routeIs('admin.enrollments.*') ? '600' : '500' }}; color: {{ request()->routeIs('admin.enrollments.*') ? '#1a1a1a' : '#6b7280' }}; text-decoration: none; transition: all 0.2s; font-family: 'Inter', sans-serif;"
                        onmouseover="if (!'{{ request()->routeIs('admin.enrollments.*') }}') { this.style.color='#1a1a1a'; }"
                        onmouseout="if (!'{{ request()->routeIs('admin.enrollments.*') }}') { this.style.color='#6b7280'; }">
                        Enrollments
                    </a>
                    <a href="{{ route('admin.users.index') }}"
                        style="padding: 0.5rem 0; border-bottom: 2px solid {{ request()->routeIs('admin.users.*') ? '#1a1a1a' : 'transparent' }}; font-size: 0.9375rem; font-weight: {{ request()->routeIs('admin.users.*') ? '600' : '500' }}; color: {{ request()->routeIs('admin.users.*') ? '#1a1a1a' : '#6b7280' }}; text-decoration: none; transition: all 0.2s; font-family: 'Inter', sans-serif;"
                        onmouseover="if (!'{{ request()->routeIs('admin.users.*') }}') { this.style.color='#1a1a1a'; }"
                        onmouseout="if (!'{{ request()->routeIs('admin.users.*') }}') { this.style.color='#6b7280'; }">
                        Users
                    </a>
                </div>
            </div>

            <!-- Right Side: Calendar Button + User Dropdown -->
            <div style="display: flex; align-items: center; gap: 1rem;">

                <!-- Calendar Button -->
                <button id="calendarButton" onclick="openCalendarModal()"
                    style="padding: 0.625rem 1.25rem; border-radius: 50px; background-color: white; border: 2px solid #e5e7eb; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem; font-weight: 600; color: #1a1a1a; font-family: 'Inter', sans-serif;"
                    onmouseover="this.style.backgroundColor='#f9fafb'; this.style.borderColor='#1a1a1a'"
                    onmouseout="this.style.backgroundColor='white'; this.style.borderColor='#e5e7eb'">
                    <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>Calendar</span>
                </button>

                <!-- User Dropdown -->
                <div style="position: relative;">
                    <button type="button" id="user-menu-button" onclick="toggleDropdown()"
                        style="display: inline-flex; align-items: center; gap: 0.75rem; padding: 0.5rem 1rem; background-color: white; border: 2px solid #e5e7eb; border-radius: 50px; font-size: 0.875rem; font-weight: 600; color: #1a1a1a; cursor: pointer; transition: all 0.2s; font-family: 'Inter', sans-serif;"
                        onmouseover="this.style.backgroundColor='#f9fafb'; this.style.borderColor='#1a1a1a'"
                        onmouseout="this.style.backgroundColor='white'; this.style.borderColor='#e5e7eb'">
                        <div style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #fca5a5 0%, #f87171 100%); display: flex; align-items: center; justify-content: center;">
                            <span style="color: #1a1a1a; font-size: 0.875rem; font-weight: 700;">{{ substr(auth('admin')->user()->name, 0, 1) }}</span>
                        </div>
                        <span>{{ auth('admin')->user()->name }}</span>
                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="user-menu"
                        style="display: none; position: absolute; right: 0; margin-top: 0.75rem; min-width: 240px; background-color: white; border-radius: 16px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); z-index: 50; border: 1px solid #e5e7eb; overflow: hidden;">
                        <div style="padding: 0.75rem;">
                            <div style="padding: 1rem; background: linear-gradient(135deg, #fef3f2 0%, #fee2e2 100%); border-radius: 12px; margin-bottom: 0.75rem;">
                                <p style="font-size: 0.9375rem; font-weight: 700; color: #1a1a1a; margin: 0 0 0.25rem 0; font-family: 'Inter', sans-serif;">{{ auth('admin')->user()->name }}</p>
                                <p style="font-size: 0.8125rem; color: #6b7280; margin: 0; font-family: 'Inter', sans-serif;">{{ auth('admin')->user()->email }}</p>
                            </div>
                            <a href="{{ route('profile.edit') }}"
                                style="display: flex; align-items: center; padding: 0.75rem 1rem; font-size: 0.875rem; font-weight: 500; color: #1a1a1a; text-decoration: none; border-radius: 10px; transition: all 0.2s; font-family: 'Inter', sans-serif;"
                                onmouseover="this.style.backgroundColor='#f9fafb'"
                                onmouseout="this.style.backgroundColor='transparent'">
                                <svg style="width: 18px; height: 18px; margin-right: 0.75rem; color: #6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Profile Settings
                            </a>
                            <div style="height: 1px; background-color: #e5e7eb; margin: 0.5rem 0;"></div>
                            <form method="POST" action="{{ route('logout') }}" style="margin: 0;" onsubmit="markLogout()">
                                @csrf
                                <button type="submit"
                                    style="display: flex; align-items: center; width: 100%; text-align: left; padding: 0.75rem 1rem; font-size: 0.875rem; font-weight: 500; color: #ef4444; background: none; border: none; cursor: pointer; border-radius: 10px; transition: all 0.2s; font-family: 'Inter', sans-serif;"

                                    onmouseover="this.style.backgroundColor='#fef2f2'"
                                    onmouseout="this.style.backgroundColor='transparent'">
                                    <svg style="width: 18px; height: 18px; margin-right: 0.75rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
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

<!-- Calendar Modal -->
<div id="calendarModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.4); z-index: 9999; overflow-y: auto;">
    <div style="display: flex; align-items: center; justify-content: center; min-height: 100%; padding: 2rem;">
        <div style="background-color: white; border-radius: 20px; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15); width: 100%; max-width: 1200px; position: relative;">

            <!-- Modal Header -->
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 2rem; border-bottom: 1px solid #e5e7eb;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <h2 style="font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 900; color: #1a1a1a; margin: 0;">Calendar</h2>
                    <div id="connectionStatus" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.375rem 1rem; background-color: #fef3c7; color: #92400e; border-radius: 50px; font-size: 0.8125rem; font-weight: 600;">
                        <div style="width: 8px; height: 8px; background-color: #f59e0b; border-radius: 50%;"></div>
                        <span>Not Connected</span>
                    </div>
                </div>
                <button onclick="closeCalendarModal()" style="padding: 0.5rem; border: none; background: none; cursor: pointer; color: #6b7280; transition: color 0.2s;"
                    onmouseover="this.style.color='#1a1a1a'"
                    onmouseout="this.style.color='#6b7280'">
                    <svg style="width: 28px; height: 28px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div style="padding: 2rem;">

                <!-- Google Sign In Section -->
                <div id="signInSection" style="text-align: center; padding: 4rem 2rem;">
                    <div style="width: 100px; height: 100px; margin: 0 auto 2rem; background: linear-gradient(135deg, #e0e7ff, #ddd6fe); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 50px; height: 50px; color: #6366f1;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 style="font-family: 'Playfair Display', serif; font-size: 1.75rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.75rem;">Connect to Google Calendar</h3>
                    <p style="color: #6b7280; font-size: 1rem; margin-bottom: 2.5rem; font-family: 'Inter', sans-serif;">Sign in with your Google account to sync events with your calendar</p>
                    <div id="googleSignInButton"></div>
                    <p style="margin-top: 1.5rem; font-size: 0.875rem; color: #9ca3af; font-family: 'Inter', sans-serif;">Your calendar data is securely synced with Google</p>
                </div>

                <!-- Calendar Section (Hidden until signed in) -->
                <div id="calendarSection" style="display: none;">
                    <div style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center;">
                        <button onclick="handleSignOut()"
                            style="padding: 0.625rem 1.25rem; background-color: white; color: #ef4444; border: 2px solid #fee2e2; border-radius: 50px; font-size: 0.875rem; font-weight: 600; cursor: pointer; transition: all 0.2s; font-family: 'Inter', sans-serif;"
                            onmouseover="this.style.backgroundColor='#fef2f2'; this.style.borderColor='#ef4444'"
                            onmouseout="this.style.backgroundColor='white'; this.style.borderColor='#fee2e2'">
                            Disconnect Google
                        </button>
                        <button onclick="showAddEventForm()"
                            style="padding: 0.875rem 1.75rem; background-color: #1a1a1a; color: white; border: none; border-radius: 50px; font-weight: 600; cursor: pointer; box-shadow: 0 4px 12px rgba(26, 26, 26, 0.15); transition: all 0.3s; font-family: 'Inter', sans-serif;"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(26, 26, 26, 0.2)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(26, 26, 26, 0.15)'">
                            + Add Event
                        </button>
                    </div>
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add/Edit Event Form Modal -->
<div id="eventFormModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.4); z-index: 10000; overflow-y: auto;">
    <div style="display: flex; align-items: center; justify-content: center; min-height: 100%; padding: 2rem;">
        <div style="background-color: white; border-radius: 20px; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15); width: 100%; max-width: 540px;">

            <div style="display: flex; justify-content: space-between; align-items: center; padding: 2rem; border-bottom: 1px solid #e5e7eb;">
                <h3 id="eventFormTitle" style="font-family: 'Playfair Display', serif; font-size: 1.5rem; font-weight: 700; color: #1a1a1a; margin: 0;">Add New Event</h3>
                <button onclick="closeEventFormModal()" style="padding: 0.5rem; border: none; background: none; cursor: pointer; color: #6b7280; transition: color 0.2s;"
                    onmouseover="this.style.color='#1a1a1a'"
                    onmouseout="this.style.color='#6b7280'">
                    <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form id="eventForm" onsubmit="saveEvent(event)" style="padding: 2rem;">
                <input type="hidden" id="eventId" value="">

                <div style="margin-bottom: 1.5rem;">
                    <label for="eventTitle" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1a1a1a; margin-bottom: 0.5rem; font-family: 'Inter', sans-serif;">
                        Event Title *
                    </label>
                    <input type="text" id="eventTitle" required
                        style="width: 100%; padding: 0.875rem 1rem; border: 2px solid #e5e7eb; border-radius: 12px; font-size: 0.9375rem; font-family: 'Inter', sans-serif; transition: all 0.2s;"
                        placeholder="Enter event title"
                        onfocus="this.style.borderColor='#1a1a1a'; this.style.boxShadow='0 0 0 3px rgba(26, 26, 26, 0.1)'"
                        onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'">
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label for="eventDescription" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1a1a1a; margin-bottom: 0.5rem; font-family: 'Inter', sans-serif;">
                        Description
                    </label>
                    <textarea id="eventDescription" rows="3"
                        style="width: 100%; padding: 0.875rem 1rem; border: 2px solid #e5e7eb; border-radius: 12px; font-size: 0.9375rem; resize: vertical; font-family: 'Inter', sans-serif; transition: all 0.2s;"
                        placeholder="Enter event description (optional)"
                        onfocus="this.style.borderColor='#1a1a1a'; this.style.boxShadow='0 0 0 3px rgba(26, 26, 26, 0.1)'"
                        onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'"></textarea>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label for="eventStart" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1a1a1a; margin-bottom: 0.5rem; font-family: 'Inter', sans-serif;">
                        Start Date & Time *
                    </label>
                    <input type="datetime-local" id="eventStart" required
                        style="width: 100%; padding: 0.875rem 1rem; border: 2px solid #e5e7eb; border-radius: 12px; font-size: 0.9375rem; font-family: 'Inter', sans-serif; transition: all 0.2s;"
                        onfocus="this.style.borderColor='#1a1a1a'; this.style.boxShadow='0 0 0 3px rgba(26, 26, 26, 0.1)'"
                        onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'">
                </div>

                <div style="margin-bottom: 2rem;">
                    <label for="eventEnd" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1a1a1a; margin-bottom: 0.5rem; font-family: 'Inter', sans-serif;">
                        End Date & Time *
                    </label>
                    <input type="datetime-local" id="eventEnd" required
                        style="width: 100%; padding: 0.875rem 1rem; border: 2px solid #e5e7eb; border-radius: 12px; font-size: 0.9375rem; font-family: 'Inter', sans-serif; transition: all 0.2s;"
                        onfocus="this.style.borderColor='#1a1a1a'; this.style.boxShadow='0 0 0 3px rgba(26, 26, 26, 0.1)'"
                        onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'">
                </div>

                <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                    <button type="button" onclick="closeEventFormModal()"
                        style="padding: 0.875rem 1.5rem; background-color: white; color: #6b7280; border: 2px solid #e5e7eb; border-radius: 50px; font-weight: 600; cursor: pointer; font-family: 'Inter', sans-serif; transition: all 0.2s;"
                        onmouseover="this.style.borderColor='#1a1a1a'; this.style.color='#1a1a1a'"
                        onmouseout="this.style.borderColor='#e5e7eb'; this.style.color='#6b7280'">
                        Cancel
                    </button>
                    <button type="submit"
                        style="padding: 0.875rem 1.75rem; background-color: #1a1a1a; color: white; border: none; border-radius: 50px; font-weight: 600; cursor: pointer; font-family: 'Inter', sans-serif; transition: all 0.3s;"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(26, 26, 26, 0.2)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        Save Event
                    </button>
                    <button type="button" id="deleteEventBtn" onclick="deleteEvent()" style="display: none; padding: 0.875rem 1.5rem; background-color: #fee2e2; color: #ef4444; border: 2px solid #fecaca; border-radius: 50px; font-weight: 600; cursor: pointer; font-family: 'Inter', sans-serif; transition: all 0.2s;"
                        onmouseover="this.style.backgroundColor='#fecaca'; this.style.borderColor='#ef4444'"
                        onmouseout="this.style.backgroundColor='#fee2e2'; this.style.borderColor='#fecaca'">
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Google API & FullCalendar -->
<script src="https://accounts.google.com/gsi/client" async defer></script>
<script src="https://apis.google.com/js/api.js" async defer></script>
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/google-calendar@6.1.10/index.global.min.js"></script>

<style>
    /* Calendar Container */
    .fc {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #fef3f2 0%, #fef3c7 50%, #ecfdf5 100%);
        padding: 1.5rem;
        border-radius: 16px;
    }

    /* Toolbar Styling */
    .fc .fc-toolbar {
        gap: 1rem !important;
        margin-bottom: 1.5rem !important;
        flex-wrap: wrap;
    }

    .fc .fc-toolbar-chunk {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    /* Navigation Buttons (Prev/Next/Today) */
    .fc .fc-button-group {
        display: flex;
        gap: 0.5rem !important;
    }

    .fc-button-primary {
        background-color: white !important;
        border: 2px solid #e5e7eb !important;
        color: #1a1a1a !important;
        border-radius: 10px !important;
        font-weight: 600 !important;
        padding: 0.625rem 1rem !important;
        transition: all 0.2s !important;
        box-shadow: none !important;
    }

    .fc-button-primary:hover {
        background-color: #f9fafb !important;
        border-color: #1a1a1a !important;
        transform: translateY(-1px);
    }

    .fc-button-primary:active,
    .fc-button-primary:focus {
        background-color: #1a1a1a !important;
        color: white !important;
        box-shadow: none !important;
    }

    .fc-button-primary:disabled {
        opacity: 0.5 !important;
        cursor: not-allowed !important;
    }

    /* View Buttons (Month/Week/Day) */
    .fc-button-group>.fc-button {
        margin: 0 !important;
    }

    .fc-button-active {
        background-color: #1a1a1a !important;
        border-color: #1a1a1a !important;
        color: white !important;
    }

    .fc-button-active:hover {
        background-color: #374151 !important;
        border-color: #374151 !important;
    }

    /* Title */
    .fc .fc-toolbar-title {
        font-family: 'Playfair Display', serif !important;
        font-size: 1.5rem !important;
        font-weight: 700 !important;
        color: #1a1a1a !important;
    }

    /* Calendar Grid */
    .fc-theme-standard td,
    .fc-theme-standard th {
        border-color: #e5e7eb !important;
    }

    /* Header Cells */
    .fc-col-header-cell {
        background: white !important;
        font-weight: 600 !important;
        padding: 0.75rem !important;
        border: none !important;
    }

    .fc-col-header-cell-cushion {
        color: #6b7280 !important;
        font-size: 0.875rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
    }

    /* Day Cells */
    .fc-daygrid-day {
        background: white !important;
        transition: all 0.2s;
    }

    .fc-daygrid-day:hover {
        background: #f9fafb !important;
    }

    .fc-daygrid-day-number {
        color: #1a1a1a !important;
        font-weight: 500 !important;
        padding: 0.5rem !important;
    }

    /* Today's Date */
    .fc-daygrid-day.fc-day-today {
        background: linear-gradient(135deg, #fef3f2 0%, #fee2e2 100%) !important;
    }

    .fc-day-today .fc-daygrid-day-number {
        background: #fca5a5;
        color: #1a1a1a !important;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex !important;
        align-items: center;
        justify-content: center;
        font-weight: 700 !important;
    }

    /* Events */
    .fc-event {
        cursor: pointer !important;
        border-radius: 8px !important;
        border: none !important;
        padding: 4px 8px !important;
        margin: 2px 4px !important;
        font-weight: 500 !important;
        transition: all 0.2s !important;
    }

    .fc-event:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;
    }

    .fc-event-title {
        font-weight: 600 !important;
        font-size: 0.8125rem !important;
    }

    /* More Events Link */
    .fc-daygrid-more-link {
        color: #6b7280 !important;
        font-weight: 600 !important;
        font-size: 0.75rem !important;
        padding: 0.25rem 0.5rem !important;
        background: #f3f4f6 !important;
        border-radius: 4px !important;
        margin: 2px 4px !important;
    }

    .fc-daygrid-more-link:hover {
        background: #e5e7eb !important;
        color: #1a1a1a !important;
    }

    /* Scrollbar for Time Grid */
    .fc-scroller::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    .fc-scroller::-webkit-scrollbar-track {
        background: #f3f4f6;
        border-radius: 4px;
    }

    .fc-scroller::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 4px;
    }

    .fc-scroller::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }
</style>

<script>
    // Google Calendar Configuration
    const CLIENT_ID = '976561144488-ap43kuo16i7taf55fc3j223lh3vpnnqm.apps.googleusercontent.com';
    const API_KEY = 'AIzaSyD6WeSgt1SGrdfyEUAzT7A5wPy8RrZRioE';
    const DISCOVERY_DOC = 'https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest';
    const SCOPES = 'https://www.googleapis.com/auth/calendar';

    let tokenClient;
    let gapiInited = false;
    let gisInited = false;
    let calendar;
    let accessToken = null;

    // Pastel color palette for events
    const pastelColors = [
        '#fca5a5', '#d8b4fe', '#86efac', '#fcd34d',
        '#93c5fd', '#fda4af', '#a7f3d0', '#fde68a'
    ];

    // ✅ FIX 1: Clear calendar storage on page load if user logged out
    window.addEventListener('load', () => {
        // Check if this is a fresh login (no user session before)
        const wasLoggedOut = sessionStorage.getItem('wasLoggedOut');
        if (wasLoggedOut) {
            // User just logged in after logout - clear old calendar token
            localStorage.removeItem('google_access_token');
            sessionStorage.removeItem('wasLoggedOut');
        }

        // Initialize Google APIs
        if (typeof gapi !== 'undefined') gapiLoaded();
        if (typeof google !== 'undefined') gisLoaded();
    });

    // ✅ FIX 2: Mark logout in sessionStorage
    // Add this to your logout form (call before logout)
    function markLogout() {
        sessionStorage.setItem('wasLoggedOut', 'true');
        localStorage.removeItem('google_access_token');
    }

    // Initialize Google API
    function gapiLoaded() {
        gapi.load('client', initializeGapiClient);
    }

    async function initializeGapiClient() {
        await gapi.client.init({
            apiKey: API_KEY,
            discoveryDocs: [DISCOVERY_DOC],
        });
        gapiInited = true;
        maybeEnableButtons();
    }

    function gisLoaded() {
        tokenClient = google.accounts.oauth2.initTokenClient({
            client_id: CLIENT_ID,
            scope: SCOPES,
            callback: '',
        });
        gisInited = true;
        maybeEnableButtons();
    }

    function maybeEnableButtons() {
        if (gapiInited && gisInited) {
            // ✅ FIX 3: Validate stored token before using it
            const storedToken = localStorage.getItem('google_access_token');
            if (storedToken) {
                // Validate token is still valid
                validateAndUseToken(storedToken);
            } else {
                updateSignInStatus(false);
                renderSignInButton();
            }
        }
    }

    // ✅ FIX 4: Validate token before using
    async function validateAndUseToken(token) {
        try {
            // Set token temporarily
            gapi.client.setToken({
                access_token: token
            });

            // Try to fetch calendar list to validate token
            const response = await gapi.client.calendar.calendarList.list({
                maxResults: 1
            });

            // Token is valid
            accessToken = token;
            updateSignInStatus(true);
        } catch (error) {
            console.log('Stored token invalid:', error);
            // Token invalid - clear it and show sign in
            localStorage.removeItem('google_access_token');
            gapi.client.setToken(null);
            accessToken = null;
            updateSignInStatus(false);
            renderSignInButton();
        }
    }

    function renderSignInButton() {
        // ✅ FIX 5: Clear button container first
        const buttonContainer = document.getElementById('googleSignInButton');
        if (!buttonContainer) return;

        buttonContainer.innerHTML = ''; // Clear existing content

        // Small delay to ensure container is ready
        setTimeout(() => {
            google.accounts.id.initialize({
                client_id: CLIENT_ID,
                callback: handleCredentialResponse
            });

            google.accounts.id.renderButton(
                buttonContainer, {
                    theme: 'filled_blue',
                    size: 'large',
                    text: 'signin_with',
                    shape: 'pill',
                    logo_alignment: 'left'
                }
            );
        }, 100);
    }

    function handleCredentialResponse(response) {
        tokenClient.callback = async (resp) => {
            if (resp.error !== undefined) {
                console.error('OAuth error:', resp.error);
                showToast('Failed to connect to Google Calendar', 'error');
                return;
            }
            accessToken = resp.access_token;
            localStorage.setItem('google_access_token', accessToken);

            // ✅ FIX 6: Set token in gapi client
            gapi.client.setToken({
                access_token: accessToken
            });

            updateSignInStatus(true);
            initializeCalendar();
            showToast('Connected to Google Calendar!', 'success');
        };

        if (gapi.client.getToken() === null) {
            tokenClient.requestAccessToken({
                prompt: 'consent'
            });
        } else {
            tokenClient.requestAccessToken({
                prompt: ''
            });
        }
    }

    function handleSignOut() {
        if (confirm('Disconnect from Google Calendar?')) {
            const token = gapi.client.getToken();
            if (token !== null) {
                google.accounts.oauth2.revoke(token.access_token);
                gapi.client.setToken(null);
            }

            // ✅ FIX 7: Complete cleanup
            accessToken = null;
            localStorage.removeItem('google_access_token');

            // Destroy calendar instance
            if (calendar) {
                calendar.destroy();
                calendar = null;
            }

            updateSignInStatus(false);

            // ✅ FIX 8: Force re-render sign-in button
            setTimeout(() => {
                renderSignInButton();
            }, 300);

            showToast('Disconnected from Google Calendar', 'success');
        }
    }

    function updateSignInStatus(isSignedIn) {
        const signInSection = document.getElementById('signInSection');
        const calendarSection = document.getElementById('calendarSection');
        const statusElement = document.getElementById('connectionStatus');

        if (isSignedIn) {
            signInSection.style.display = 'none';
            calendarSection.style.display = 'block';
            statusElement.innerHTML = `
                <div style="width: 8px; height: 8px; background-color: #10b981; border-radius: 50%;"></div>
                <span>Connected</span>
            `;
            statusElement.style.backgroundColor = '#d1fae5';
            statusElement.style.color = '#065f46';

            // ✅ FIX 9: Only initialize calendar if not already initialized
            if (!calendar) {
                initializeCalendar();
            }
        } else {
            signInSection.style.display = 'block';
            calendarSection.style.display = 'none';
            statusElement.innerHTML = `
                <div style="width: 8px; height: 8px; background-color: #f59e0b; border-radius: 50%;"></div>
                <span>Not Connected</span>
            `;
            statusElement.style.backgroundColor = '#fef3c7';
            statusElement.style.color = '#92400e';

            if (calendar) {
                calendar.destroy();
                calendar = null;
            }
        }
    }

    function initializeCalendar() {
        if (!accessToken) return;

        const calendarEl = document.getElementById('calendar');
        if (!calendarEl) return;

        // ✅ FIX 10: Destroy existing calendar before creating new one
        if (calendar) {
            calendar.destroy();
        }

        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            googleCalendarApiKey: API_KEY,
            events: async function(info, successCallback, failureCallback) {
                try {
                    const events = await listUpcomingEvents(info.start, info.end);
                    successCallback(events);
                } catch (error) {
                    console.error('Error loading events:', error);
                    failureCallback(error);
                }
            },
            editable: true,
            selectable: true,
            selectMirror: true,
            dayMaxEvents: true,
            height: 'auto',
            dateClick: function(info) {
                showAddEventForm(info.dateStr);
            },
            eventClick: function(info) {
                editEvent(info.event);
            },
            eventDrop: async function(info) {
                await updateGoogleEvent(info.event);
            },
            eventResize: async function(info) {
                await updateGoogleEvent(info.event);
            }
        });

        calendar.render();
    }

    async function listUpcomingEvents(timeMin, timeMax) {
        const response = await gapi.client.calendar.events.list({
            'calendarId': 'primary',
            'timeMin': timeMin.toISOString(),
            'timeMax': timeMax.toISOString(),
            'showDeleted': false,
            'singleEvents': true,
            'orderBy': 'startTime'
        });

        const events = response.result.items;
        return events.map((event, index) => ({
            id: event.id,
            title: event.summary,
            start: event.start.dateTime || event.start.date,
            end: event.end.dateTime || event.end.date,
            description: event.description || '',
            backgroundColor: pastelColors[index % pastelColors.length],
            borderColor: pastelColors[index % pastelColors.length],
            textColor: '#1a1a1a',
            extendedProps: {
                description: event.description || ''
            }
        }));
    }

    async function addGoogleEvent(eventData) {
        const event = {
            'summary': eventData.title,
            'description': eventData.description,
            'start': {
                'dateTime': new Date(eventData.start).toISOString(),
                'timeZone': Intl.DateTimeFormat().resolvedOptions().timeZone
            },
            'end': {
                'dateTime': new Date(eventData.end).toISOString(),
                'timeZone': Intl.DateTimeFormat().resolvedOptions().timeZone
            }
        };

        const response = await gapi.client.calendar.events.insert({
            'calendarId': 'primary',
            'resource': event
        });

        return response.result;
    }

    async function updateGoogleEvent(event) {
        const eventData = {
            'summary': event.title,
            'description': event.extendedProps?.description || '',
            'start': {
                'dateTime': event.start.toISOString(),
                'timeZone': Intl.DateTimeFormat().resolvedOptions().timeZone
            },
            'end': {
                'dateTime': (event.end || event.start).toISOString(),
                'timeZone': Intl.DateTimeFormat().resolvedOptions().timeZone
            }
        };

        await gapi.client.calendar.events.update({
            'calendarId': 'primary',
            'eventId': event.id,
            'resource': eventData
        });

        showToast('Event updated in Google Calendar', 'success');
    }

    async function deleteGoogleEvent(eventId) {
        await gapi.client.calendar.events.delete({
            'calendarId': 'primary',
            'eventId': eventId
        });

        showToast('Event deleted from Google Calendar', 'success');
    }

    function showAddEventForm(dateStr = null) {
        document.getElementById('eventFormTitle').textContent = 'Add New Event';
        document.getElementById('eventForm').reset();
        document.getElementById('eventId').value = '';
        document.getElementById('deleteEventBtn').style.display = 'none';

        if (dateStr) {
            const date = new Date(dateStr);
            document.getElementById('eventStart').value = new Date(date.getTime() - date.getTimezoneOffset() * 60000).toISOString().slice(0, 16);
            const endDate = new Date(date.getTime() + 3600000);
            document.getElementById('eventEnd').value = new Date(endDate.getTime() - endDate.getTimezoneOffset() * 60000).toISOString().slice(0, 16);
        }

        document.getElementById('eventFormModal').style.display = 'block';
    }

    function editEvent(event) {
        document.getElementById('eventFormTitle').textContent = 'Edit Event';
        document.getElementById('eventId').value = event.id;
        document.getElementById('eventTitle').value = event.title;
        document.getElementById('eventDescription').value = event.extendedProps.description || '';

        const startDate = new Date(event.start);
        document.getElementById('eventStart').value = new Date(startDate.getTime() - startDate.getTimezoneOffset() * 60000).toISOString().slice(0, 16);

        const endDate = event.end ? new Date(event.end) : new Date(event.start);
        document.getElementById('eventEnd').value = new Date(endDate.getTime() - endDate.getTimezoneOffset() * 60000).toISOString().slice(0, 16);

        document.getElementById('deleteEventBtn').style.display = 'block';
        document.getElementById('eventFormModal').style.display = 'block';
    }

    async function saveEvent(e) {
        e.preventDefault();

        const eventId = document.getElementById('eventId').value;
        const eventData = {
            title: document.getElementById('eventTitle').value,
            description: document.getElementById('eventDescription').value,
            start: document.getElementById('eventStart').value,
            end: document.getElementById('eventEnd').value
        };

        try {
            if (eventId) {
                await updateGoogleEvent({
                    id: eventId,
                    title: eventData.title,
                    start: new Date(eventData.start),
                    end: new Date(eventData.end),
                    extendedProps: {
                        description: eventData.description
                    }
                });
                showToast('Event updated!', 'success');
            } else {
                await addGoogleEvent(eventData);
                showToast('Event created!', 'success');
            }

            calendar.refetchEvents();
            closeEventFormModal();
        } catch (error) {
            console.error('Error saving event:', error);
            showToast('Error saving event', 'error');
        }
    }

    async function deleteEvent() {
        if (confirm('Delete this event from Google Calendar?')) {
            const eventId = document.getElementById('eventId').value;

            try {
                await deleteGoogleEvent(eventId);
                calendar.refetchEvents();
                closeEventFormModal();
            } catch (error) {
                console.error('Error deleting event:', error);
                showToast('Error deleting event', 'error');
            }
        }
    }

    function closeEventFormModal() {
        document.getElementById('eventFormModal').style.display = 'none';
    }

    function toggleDropdown() {
        const menu = document.getElementById('user-menu');
        menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
    }

    function openCalendarModal() {
        document.getElementById('calendarModal').style.display = 'block';
        document.body.style.overflow = 'hidden';

        // ✅ FIX 11: Re-check connection status when modal opens
        if (!accessToken && gapiInited && gisInited) {
            renderSignInButton();
        }
    }

    function closeCalendarModal() {
        document.getElementById('calendarModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        const bgColor = type === 'success' ? '#d1fae5' : '#fee2e2';
        const textColor = type === 'success' ? '#065f46' : '#991b1b';
        const borderColor = type === 'success' ? '#10b981' : '#ef4444';

        toast.style.cssText = `
            position: fixed; top: 24px; right: 24px;
            background-color: ${bgColor};
            color: ${textColor};
            padding: 1rem 1.5rem;
            border-radius: 12px;
            border-left: 4px solid ${borderColor};
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            z-index: 10001;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            animation: slideIn 0.3s ease-out;
        `;
        toast.textContent = message;
        document.body.appendChild(toast);
        setTimeout(() => {
            toast.style.animation = 'slideOut 0.3s ease-out';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    // Event listeners
    document.addEventListener('click', function(event) {
        const button = document.getElementById('user-menu-button');
        const menu = document.getElementById('user-menu');
        if (menu && button && !button.contains(event.target) && !menu.contains(event.target)) {
            menu.style.display = 'none';
        }
    });

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const menu = document.getElementById('user-menu');
            if (menu) menu.style.display = 'none';
            if (document.getElementById('calendarModal').style.display === 'block') closeCalendarModal();
            if (document.getElementById('eventFormModal').style.display === 'block') closeEventFormModal();
        }
    });
</script>

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