<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User Management
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div style="margin-bottom: 1.5rem; background-color: #d1fae5; border-left: 4px solid #10b981; padding: 1rem; border-radius: 0.5rem;">
                    <p style="color: #065f46; font-weight: 500;">{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div style="margin-bottom: 1.5rem; background-color: #fee2e2; border-left: 4px solid #ef4444; padding: 1rem; border-radius: 0.5rem;">
                    <p style="color: #991b1b; font-weight: 500;">{{ session('error') }}</p>
                </div>
            @endif

            <!-- Stats Cards -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                <div style="background: linear-gradient(135deg, #fef3c7 0%, #fef9e7 100%); border: 1px solid #fde68a; border-radius: 1rem; padding: 1.5rem;">
                    <p style="font-size: 0.875rem; color: #d97706; font-weight: 500;">Administrators</p>
                    <p style="font-size: 2rem; font-weight: 700; color: #78350f;">
                        {{ $allUsers->where('role', 'admin')->count() }}
                    </p>
                </div>
                
                <div style="background: linear-gradient(135deg, #e9d5ff 0%, #f3e8ff 100%); border: 1px solid #d8b4fe; border-radius: 1rem; padding: 1.5rem;">
                    <p style="font-size: 0.875rem; color: #9333ea; font-weight: 500;">Teachers</p>
                    <p style="font-size: 2rem; font-weight: 700; color: #581c87;">
                        {{ $allUsers->where('role', 'teacher')->count() }}
                    </p>
                </div>
                
                <div style="background: linear-gradient(135deg, #dbeafe 0%, #eff6ff 100%); border: 1px solid #bfdbfe; border-radius: 1rem; padding: 1.5rem;">
                    <p style="font-size: 0.875rem; color: #1e40af; font-weight: 500;">Students</p>
                    <p style="font-size: 2rem; font-weight: 700; color: #1e3a8a;">
                        {{ $allUsers->where('role', 'student')->count() }}
                    </p>
                </div>
                
                <div style="background: linear-gradient(135deg, #d1d5db 0%, #e5e7eb 100%); border: 1px solid #9ca3af; border-radius: 1rem; padding: 1.5rem;">
                    <p style="font-size: 0.875rem; color: #4b5563; font-weight: 500;">Old Students</p>
                    <p style="font-size: 2rem; font-weight: 700; color: #1f2937;">
                        {{ $allUsers->where('role', 'old_student')->count() }}
                    </p>
                </div>
            </div>

            <!-- Search and Filter Section -->
            <div style="background-color: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 1.5rem;">
                <form method="GET" action="{{ route('admin.users.index') }}">
                    <div style="display: grid; grid-template-columns: 1fr auto auto; gap: 1rem; align-items: end;">
                        
                        <!-- Search Input -->
                        <div>
                            <label for="search" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                                Search Users
                            </label>
                            <div style="position: relative;">
                                <input type="text" 
                                       name="search" 
                                       id="search" 
                                       value="{{ request('search') }}"
                                       placeholder="Search by name or email..."
                                       style="width: 100%; padding: 0.75rem 0.75rem 0.75rem 2.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;">
                                <svg style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); width: 20px; height: 20px; color: #9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Sort Dropdown -->
                        <div>
                            <label for="sort" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                                Sort By
                            </label>
                            <select name="sort" 
                                    id="sort" 
                                    style="padding: 0.75rem 2.5rem 0.75rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; appearance: none; background-image: url('data:image/svg+xml,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 fill=%27none%27 viewBox=%270 0 20 20%27%3e%3cpath stroke=%27%236b7280%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%271.5%27 d=%27M6 8l4 4 4-4%27/%3e%3c/svg%3e'); background-position: right 0.5rem center; background-repeat: no-repeat; background-size: 1.5em 1.5em;">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                            </select>
                        </div>

                        <!-- Filter Button -->
                        <button type="submit" 
                                style="padding: 0.75rem 1.5rem; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; font-weight: 500; border-radius: 0.5rem; border: none; cursor: pointer; font-size: 0.875rem; display: flex; align-items: center; gap: 0.5rem;">
                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                            </svg>
                            Apply
                        </button>

                        <!-- Clear Filter Button -->
                        @if(request('search') || request('sort'))
                            <a href="{{ route('admin.users.index') }}" 
                               style="padding: 0.75rem 1.5rem; background-color: #f3f4f6; color: #374151; font-weight: 500; border-radius: 0.5rem; border: none; cursor: pointer; font-size: 0.875rem; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                                <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Results Info -->
            @if(request('search'))
                <div style="background-color: #eff6ff; border-left: 4px solid #3b82f6; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                    <p style="color: #1e40af; font-size: 0.875rem;">
                        <strong>Search Results:</strong> Found <strong>{{ $allUsers->count() }}</strong> user(s) matching "<strong>{{ request('search') }}</strong>"
                        @if($allUsers->count() === 0)
                            - Try a different search term
                        @endif
                    </p>
                </div>
            @endif

            <!-- Users Table -->
            <div style="background-color: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                
                @if($allUsers->count() > 0)
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background-color: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                                    <th style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: #374151;">Name</th>
                                    <th style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: #374151;">Email</th>
                                    <th style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: #374151;">Current Role</th>
                                    <th style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: #374151;">Joined</th>
                                    <th style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: #374151;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allUsers as $user)
                                    <tr style="border-bottom: 1px solid #e5e7eb;">
                                        <td style="padding: 1rem; font-size: 0.875rem; color: #111827; font-weight: 500;">
                                            {{ $user['name'] }}
                                        </td>
                                        <td style="padding: 1rem; font-size: 0.875rem; color: #6b7280;">
                                            {{ $user['email'] }}
                                        </td>
                                        <td style="padding: 1rem;">
                                            @php
                                                $roleBadgeColors = [
                                                    'admin' => ['bg' => '#fef3c7', 'text' => '#78350f'],
                                                    'teacher' => ['bg' => '#e9d5ff', 'text' => '#581c87'],
                                                    'student' => ['bg' => '#dbeafe', 'text' => '#1e3a8a'],
                                                    'old_student' => ['bg' => '#e5e7eb', 'text' => '#1f2937'],
                                                ];
                                                $colors = $roleBadgeColors[$user['role']] ?? ['bg' => '#e5e7eb', 'text' => '#6b7280'];
                                            @endphp
                                            <span style="display: inline-block; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; 
                                                         background-color: {{ $colors['bg'] }}; color: {{ $colors['text'] }};">
                                                {{ $user['role_display'] }}
                                            </span>
                                        </td>
                                        <td style="padding: 1rem; font-size: 0.875rem; color: #6b7280;">
                                            {{ $user['created_at']->format('M d, Y') }}
                                            <br>
                                            <span style="font-size: 0.75rem; color: #9ca3af;">{{ $user['created_at']->diffForHumans() }}</span>
                                        </td>
                                        <td style="padding: 1rem;">
                                            <button onclick="openRoleModal('{{ $user['id'] }}', '{{ $user['role'] }}', '{{ $user['name'] }}')"
                                                    style="color: #3b82f6; font-size: 0.875rem; font-weight: 500; background: none; border: none; cursor: pointer; padding: 0;">
                                                Change Role
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div style="text-align: center; padding: 3rem 0;">
                        <svg style="width: 64px; height: 64px; color: #d1d5db; margin: 0 auto 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <p style="color: #6b7280; font-size: 1.125rem; margin-bottom: 0.5rem;">No users found</p>
                        @if(request('search'))
                            <p style="color: #9ca3af; font-size: 0.875rem;">Try adjusting your search criteria</p>
                        @endif
                    </div>
                @endif

            </div>
        </div>
    </div>

    <!-- Role Change Modal -->
    <div id="roleModal" style="display: none; position: fixed; inset: 0; background-color: rgba(0, 0, 0, 0.5); z-index: 50; align-items: center; justify-content: center;">
        <div style="background-color: white; border-radius: 1rem; padding: 2rem; max-width: 500px; width: 90%; box-shadow: 0 20px 25px rgba(0, 0, 0, 0.15);">
            <h3 style="font-size: 1.25rem; font-weight: 600; color: #111827; margin-bottom: 1rem;">Change User Role</h3>
            <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 1.5rem;">
                Change role for: <strong id="modalUserName"></strong>
            </p>

            <form id="roleChangeForm" action="{{ route('admin.users.change-role') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" id="modalUserId">
                <input type="hidden" name="current_role" id="modalCurrentRole">

                <div style="margin-bottom: 1.5rem;">
                    <label for="new_role" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                        New Role *
                    </label>
                    <select name="new_role" id="new_role" required
                            style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;">
                        <option value="">Select a role...</option>
                        <option value="admin">Administrator</option>
                        <option value="teacher">Teacher</option>
                        <option value="student">Student</option>
                        <option value="old_student">Old Student</option>
                    </select>
                </div>

                <div style="background-color: #fef3c7; border-left: 4px solid #f59e0b; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                    <p style="font-size: 0.875rem; color: #92400e;">
                        <strong>Warning:</strong> Changing user roles will move data between tables and may affect their access and permissions.
                    </p>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 1rem;">
                    <button type="button" onclick="closeRoleModal()"
                            style="padding: 0.75rem 1.5rem; background-color: #f3f4f6; color: #374151; font-weight: 500; border-radius: 0.5rem; border: none; cursor: pointer;">
                        Cancel
                    </button>
                    <button type="submit"
                            style="padding: 0.75rem 1.5rem; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; font-weight: 500; border-radius: 0.5rem; border: none; cursor: pointer;">
                        Change Role
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openRoleModal(userId, currentRole, userName) {
            document.getElementById('modalUserId').value = userId;
            document.getElementById('modalCurrentRole').value = currentRole;
            document.getElementById('modalUserName').textContent = userName;
            document.getElementById('new_role').value = '';
            document.getElementById('roleModal').style.display = 'flex';
        }

        function closeRoleModal() {
            document.getElementById('roleModal').style.display = 'none';
        }

        // Close modal when clicking outside
        document.getElementById('roleModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeRoleModal();
            }
        });

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeRoleModal();
            }
        });
    </script>
</x-admin-layout>