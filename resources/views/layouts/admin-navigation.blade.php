<nav style="background-color: var(--nav-bg, #ffffff); border-bottom: 1px solid var(--border-color, #e5e7eb); transition: all 0.3s ease;">
    <div style="max-width: 1280px; margin: 0 auto; padding: 0 1rem;">
        <div style="display: flex; justify-content: space-between; height: 64px;">
            
            <!-- Logo & Navigation Links -->
            <div style="display: flex; align-items: center; gap: 2rem; flex: 1;">
                <!-- Logo (Text) -->
                <div style="flex-shrink: 0;">
                    <a href="{{ route('admin.dashboard') }}" style="text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                        <span style="font-size: 1.125rem; font-weight: 700; color: var(--text-primary, #111827); transition: color 0.3s ease;">SchoolTrack</span>
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

            <!-- Right Side: Calendar Button + User Dropdown -->
            <div style="display: flex; align-items: center; gap: 1rem;">
                
                <!-- Calendar Button -->
                <button id="calendarButton" onclick="openCalendarModal()" 
                        style="padding: 0.5rem 1rem; border-radius: 0.5rem; background-color: #f3f4f6; border: 1px solid #e5e7eb; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem; font-weight: 500; color: #374151;"
                        onmouseover="this.style.backgroundColor='#e5e7eb'; this.style.borderColor='#3b82f6'"
                        onmouseout="this.style.backgroundColor='#f3f4f6'; this.style.borderColor='#e5e7eb'">
                    <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>Calendar</span>
                </button>

                <!-- User Dropdown -->
                <div style="position: relative;">
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

                    <div id="user-menu" 
                         style="display: none; position: absolute; right: 0; margin-top: 0.5rem; width: 200px; background-color: var(--card-bg, white); border-radius: 0.5rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); z-index: 50; border: 1px solid var(--border-color, #e5e7eb);">
                        <div style="padding: 0.5rem;">
                            <div style="padding: 0.5rem 0.75rem; border-bottom: 1px solid var(--border-color, #e5e7eb); margin-bottom: 0.5rem;">
                                <p style="font-size: 0.875rem; font-weight: 600; color: var(--text-primary, #111827); margin: 0;">{{ auth('admin')->user()->name }}</p>
                                <p style="font-size: 0.75rem; color: var(--text-secondary, #6b7280); margin: 0.25rem 0 0 0;">{{ auth('admin')->user()->email }}</p>
                            </div>
                            <a href="{{ route('profile.edit') }}" 
                               style="display: flex; align-items: center; padding: 0.5rem 0.75rem; font-size: 0.875rem; color: var(--text-primary, #374151); text-decoration: none; border-radius: 0.375rem; transition: background-color 0.15s;"
                               onmouseover="this.style.backgroundColor='var(--bg-tertiary, #f3f4f6)'" 
                               onmouseout="this.style.backgroundColor='transparent'">
                                <svg style="width: 16px; height: 16px; margin-right: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Profile
                            </a>
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

<!-- Calendar Modal -->
<div id="calendarModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 9999; overflow-y: auto;">
    <div style="display: flex; align-items: center; justify-content: center; min-height: 100%; padding: 2rem;">
        <div style="background-color: white; border-radius: 1rem; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); width: 100%; max-width: 1200px; position: relative;">
            
            <!-- Modal Header -->
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 1.5rem 2rem; border-bottom: 1px solid #e5e7eb;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <h2 style="font-size: 1.5rem; font-weight: 700; color: #111827; margin: 0;">Google Calendar</h2>
                    <div id="connectionStatus" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.25rem 0.75rem; background-color: #fef3c7; color: #92400e; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">
                        <div style="width: 6px; height: 6px; background-color: #f59e0b; border-radius: 50%;"></div>
                        <span>Not Connected</span>
                    </div>
                </div>
                <button onclick="closeCalendarModal()" style="padding: 0.5rem; border: none; background: none; cursor: pointer; color: #6b7280; transition: color 0.2s;"
                        onmouseover="this.style.color='#111827'"
                        onmouseout="this.style.color='#6b7280'">
                    <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div style="padding: 2rem;">
                
                <!-- Google Sign In Section -->
                <div id="signInSection" style="text-align: center; padding: 3rem 0;">
                    <svg style="width: 80px; height: 80px; margin: 0 auto 1.5rem; color: #3b82f6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <h3 style="font-size: 1.25rem; font-weight: 600; color: #111827; margin-bottom: 0.5rem;">Connect to Google Calendar</h3>
                    <p style="color: #6b7280; margin-bottom: 2rem;">Sign in with your Google account to sync events with your calendar</p>
                    <div id="googleSignInButton"></div>
                    <p style="margin-top: 1rem; font-size: 0.875rem; color: #9ca3af;">Your calendar data is securely synced with Google</p>
                </div>

                <!-- Calendar Section (Hidden until signed in) -->
                <div id="calendarSection" style="display: none;">
                    <div style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
                        <button onclick="handleSignOut()" 
                                style="padding: 0.5rem 1rem; background-color: #fee2e2; color: #991b1b; border: none; border-radius: 0.5rem; font-size: 0.875rem; font-weight: 500; cursor: pointer; transition: all 0.2s;"
                                onmouseover="this.style.backgroundColor='#fecaca'"
                                onmouseout="this.style.backgroundColor='#fee2e2'">
                            Disconnect Google
                        </button>
                        <button onclick="showAddEventForm()" 
                                style="padding: 0.75rem 1.5rem; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; border: none; border-radius: 0.5rem; font-weight: 600; cursor: pointer; box-shadow: 0 4px 6px rgba(59, 130, 246, 0.3); transition: all 0.2s;"
                                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 15px rgba(59, 130, 246, 0.4)'"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(59, 130, 246, 0.3)'">
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
<div id="eventFormModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 10000; overflow-y: auto;">
    <div style="display: flex; align-items: center; justify-content: center; min-height: 100%; padding: 2rem;">
        <div style="background-color: white; border-radius: 1rem; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); width: 100%; max-width: 500px;">
            
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 1.5rem 2rem; border-bottom: 1px solid #e5e7eb;">
                <h3 id="eventFormTitle" style="font-size: 1.25rem; font-weight: 700; color: #111827; margin: 0;">Add New Event</h3>
                <button onclick="closeEventFormModal()" style="padding: 0.5rem; border: none; background: none; cursor: pointer; color: #6b7280;">
                    <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form id="eventForm" onsubmit="saveEvent(event)" style="padding: 2rem;">
                <input type="hidden" id="eventId" value="">

                <div style="margin-bottom: 1.5rem;">
                    <label for="eventTitle" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                        Event Title *
                    </label>
                    <input type="text" id="eventTitle" required
                           style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;"
                           placeholder="Enter event title">
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label for="eventDescription" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                        Description
                    </label>
                    <textarea id="eventDescription" rows="3"
                              style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; resize: vertical;"
                              placeholder="Enter event description (optional)"></textarea>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label for="eventStart" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                        Start Date & Time *
                    </label>
                    <input type="datetime-local" id="eventStart" required
                           style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;">
                </div>

                <div style="margin-bottom: 2rem;">
                    <label for="eventEnd" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                        End Date & Time *
                    </label>
                    <input type="datetime-local" id="eventEnd" required
                           style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;">
                </div>

                <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                    <button type="button" onclick="closeEventFormModal()"
                            style="padding: 0.75rem 1.5rem; background-color: #f3f4f6; color: #374151; border: none; border-radius: 0.5rem; font-weight: 500; cursor: pointer;">
                        Cancel
                    </button>
                    <button type="submit"
                            style="padding: 0.75rem 1.5rem; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; border: none; border-radius: 0.5rem; font-weight: 600; cursor: pointer;">
                        Save Event
                    </button>
                    <button type="button" id="deleteEventBtn" onclick="deleteEvent()" style="display: none; padding: 0.75rem 1.5rem; background-color: #ef4444; color: white; border: none; border-radius: 0.5rem; font-weight: 500; cursor: pointer;">
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
    .fc { font-family: 'Figtree', sans-serif; }
    .fc-button-primary { background-color: #3b82f6 !important; border-color: #3b82f6 !important; }
    .fc-button-primary:hover { background-color: #2563eb !important; }
    .fc-event { cursor: pointer; border-radius: 0.25rem; }
    .fc-daygrid-day.fc-day-today { background-color: rgba(59, 130, 246, 0.1) !important; }
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
            callback: '', // defined later
        });
        gisInited = true;
        maybeEnableButtons();
    }

    function maybeEnableButtons() {
        if (gapiInited && gisInited) {
            // Check if already signed in
            const storedToken = localStorage.getItem('google_access_token');
            if (storedToken) {
                accessToken = storedToken;
                updateSignInStatus(true);
            } else {
                renderSignInButton();
            }
        }
    }

    function renderSignInButton() {
        google.accounts.id.initialize({
            client_id: CLIENT_ID,
            callback: handleCredentialResponse
        });

        google.accounts.id.renderButton(
            document.getElementById('googleSignInButton'),
            {
                theme: 'filled_blue',
                size: 'large',
                text: 'signin_with',
                shape: 'rectangular',
                logo_alignment: 'left'
            }
        );
    }

    function handleCredentialResponse(response) {
        // Handle OAuth2 flow
        tokenClient.callback = async (resp) => {
            if (resp.error !== undefined) {
                throw (resp);
            }
            accessToken = resp.access_token;
            localStorage.setItem('google_access_token', accessToken);
            updateSignInStatus(true);
            initializeCalendar();
            showToast('Connected to Google Calendar!', 'success');
        };

        if (gapi.client.getToken() === null) {
            tokenClient.requestAccessToken({prompt: 'consent'});
        } else {
            tokenClient.requestAccessToken({prompt: ''});
        }
    }

    function handleSignOut() {
        if (confirm('Disconnect from Google Calendar?')) {
            const token = gapi.client.getToken();
            if (token !== null) {
                google.accounts.oauth2.revoke(token.access_token);
                gapi.client.setToken('');
            }
            accessToken = null;
            localStorage.removeItem('google_access_token');
            updateSignInStatus(false);
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
                <div style="width: 6px; height: 6px; background-color: #10b981; border-radius: 50%;"></div>
                <span>Connected</span>
            `;
            statusElement.style.backgroundColor = '#d1fae5';
            statusElement.style.color = '#065f46';
            initializeCalendar();
        } else {
            signInSection.style.display = 'block';
            calendarSection.style.display = 'none';
            statusElement.innerHTML = `
                <div style="width: 6px; height: 6px; background-color: #f59e0b; border-radius: 50%;"></div>
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

    // Initialize FullCalendar with Google Calendar
    function initializeCalendar() {
        if (!accessToken) return;

        const calendarEl = document.getElementById('calendar');
        
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

    // Get events from Google Calendar
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
        return events.map(event => ({
            id: event.id,
            title: event.summary,
            start: event.start.dateTime || event.start.date,
            end: event.end.dateTime || event.end.date,
            description: event.description || '',
            backgroundColor: getColorFromColorId(event.colorId),
            extendedProps: {
                description: event.description || ''
            }
        }));
    }

    function getColorFromColorId(colorId) {
        const colors = {
            '1': '#a4bdfc', '2': '#7ae7bf', '3': '#dbadff',
            '4': '#ff887c', '5': '#fbd75b', '6': '#ffb878',
            '7': '#46d6db', '8': '#e1e1e1', '9': '#5484ed',
            '10': '#51b749', '11': '#dc2127'
        };
        return colors[colorId] || '#3b82f6';
    }

    // Add event to Google Calendar
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

    // Update event in Google Calendar
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

    // Delete event from Google Calendar
    async function deleteGoogleEvent(eventId) {
        await gapi.client.calendar.events.delete({
            'calendarId': 'primary',
            'eventId': eventId
        });

        showToast('Event deleted from Google Calendar', 'success');
    }

    // Form handlers
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
                    extendedProps: { description: eventData.description }
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
    }

    function closeCalendarModal() {
        document.getElementById('calendarModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.style.cssText = `
            position: fixed; top: 20px; right: 20px;
            background-color: ${type === 'success' ? '#10b981' : '#ef4444'};
            color: white; padding: 1rem 1.5rem; border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); z-index: 10001;
        `;
        toast.textContent = message;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
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
            document.getElementById('user-menu').style.display = 'none';
            if (document.getElementById('calendarModal').style.display === 'block') closeCalendarModal();
            if (document.getElementById('eventFormModal').style.display === 'block') closeEventFormModal();
        }
    });

    // Load Google APIs
    window.addEventListener('load', () => {
        if (typeof gapi !== 'undefined') gapiLoaded();
        if (typeof google !== 'undefined') gisLoaded();
    });
</script>