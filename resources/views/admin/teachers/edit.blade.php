<x-admin-layout>
    <x-slot name="header">
        <div style="display: flex; align-items: center; gap: 1rem;">
            <div style="width: 40px; height: 40px; background-color: var(--bg-tertiary, #f3f4f6); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                <svg style="width: 20px; height: 20px; color: var(--text-secondary, #6b7280);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <div>
                <h2 style="font-size: 1.25rem; font-weight: 600; color: var(--text-primary, #111827); margin: 0;">Edit Teacher</h2>
                <p style="font-size: 0.875rem; color: var(--text-secondary, #6b7280); margin: 0;">Update teacher account information</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div style="background-color: var(--card-bg, white); border-radius: 1rem; padding: 2.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid var(--border-color, #e5e7eb);">
                
                <form action="{{ route('admin.teachers.update', $teacher) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Form Grid - 2 Columns -->
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 2rem; margin-bottom: 2rem;">
                        
                        <!-- Left Column -->
                        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                            
                            <!-- Full Name -->
                            <div>
                                <label for="name" style="display: block; font-size: 0.875rem; font-weight: 600; color: var(--text-primary, #111827); margin-bottom: 0.5rem;">
                                    Full Name *
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name', $teacher->name) }}" required
                                    style="width: 100%; padding: 0.75rem 1rem; background-color: var(--input-bg, white); border: 1px solid {{ $errors->has('name') ? '#ef4444' : 'var(--input-border, #d1d5db)' }}; border-radius: 0.5rem; font-size: 0.875rem; color: var(--text-primary, #111827); transition: all 0.2s;"
                                    onfocus="this.style.borderColor='#f59e0b'; this.style.boxShadow='0 0 0 3px rgba(245, 158, 11, 0.1)'"
                                    onblur="this.style.borderColor='var(--input-border, #d1d5db)'; this.style.boxShadow='none'">
                                @error('name')
                                    <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email Address -->
                            <div>
                                <label for="email" style="display: block; font-size: 0.875rem; font-weight: 600; color: var(--text-primary, #111827); margin-bottom: 0.5rem;">
                                    Email Address *
                                </label>
                                <input type="email" name="email" id="email" value="{{ old('email', $teacher->email) }}" required
                                    style="width: 100%; padding: 0.75rem 1rem; background-color: var(--input-bg, white); border: 1px solid {{ $errors->has('email') ? '#ef4444' : 'var(--input-border, #d1d5db)' }}; border-radius: 0.5rem; font-size: 0.875rem; color: var(--text-primary, #111827); transition: all 0.2s;"
                                    onfocus="this.style.borderColor='#f59e0b'; this.style.boxShadow='0 0 0 3px rgba(245, 158, 11, 0.1)'"
                                    onblur="this.style.borderColor='var(--input-border, #d1d5db)'; this.style.boxShadow='none'">
                                @error('email')
                                    <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Teacher Stats -->
                            <div style="padding: 1.25rem; background-color: var(--bg-tertiary, #f9fafb); border-radius: 0.75rem; border: 1px solid var(--border-color, #e5e7eb);">
                                <p style="font-size: 0.75rem; font-weight: 600; color: var(--text-secondary, #6b7280); margin: 0 0 0.75rem 0; text-transform: uppercase; letter-spacing: 0.05em;">Teacher Statistics</p>
                                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
                                    <div>
                                        <p style="font-size: 0.75rem; color: var(--text-secondary, #6b7280); margin: 0;">Assigned Modules</p>
                                        <p style="font-size: 1.5rem; font-weight: 700; color: var(--text-primary, #111827); margin: 0;">{{ $teacher->modules->count() }}</p>
                                    </div>
                                    <div>
                                        <p style="font-size: 0.75rem; color: var(--text-secondary, #6b7280); margin: 0;">Member Since</p>
                                        <p style="font-size: 1rem; font-weight: 600; color: var(--text-primary, #111827); margin: 0;">{{ $teacher->created_at->format('M Y') }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Right Column -->
                        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                            
                            <!-- Info Notice -->
                            <div style="padding: 1.25rem 1.5rem; background: linear-gradient(135deg, #fef3c7 0%, #fef9e7 100%); border-left: 4px solid #f59e0b; border-radius: 0.75rem;">
                                <div style="display: flex; gap: 1rem;">
                                    <svg style="width: 20px; height: 20px; color: #f59e0b; flex-shrink: 0; margin-top: 0.125rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                    <div>
                                        <p style="font-size: 0.875rem; font-weight: 600; color: #92400e; margin: 0 0 0.5rem 0;">Password Management</p>
                                        <p style="font-size: 0.875rem; color: #92400e; margin: 0; line-height: 1.5;">To change the password, the teacher should use the "Forgot Password" feature or you can reset it from the user profile settings.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Account Status -->
                            <div style="padding: 1.25rem 1.5rem; background-color: var(--bg-tertiary, #f9fafb); border-radius: 0.75rem; border: 1px solid var(--border-color, #e5e7eb);">
                                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.75rem;">
                                    <p style="font-size: 0.875rem; font-weight: 600; color: var(--text-primary, #111827); margin: 0;">Account Status</p>
                                    <span style="padding: 0.25rem 0.75rem; background-color: #d1fae5; color: #065f46; font-size: 0.75rem; font-weight: 600; border-radius: 9999px;">Active</span>
                                </div>
                                <p style="font-size: 0.875rem; color: var(--text-secondary, #6b7280); margin: 0; line-height: 1.5;">This teacher account is active and can access the system.</p>
                            </div>

                        </div>

                    </div>

                    <!-- Action Buttons -->
                    <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 1.5rem; border-top: 1px solid var(--border-color, #e5e7eb);">
                        <div style="display: flex; gap: 0.75rem;">
                            <a href="{{ route('admin.teachers.index') }}" 
                               style="padding: 0.75rem 1.5rem; background-color: var(--bg-tertiary, #f3f4f6); color: var(--text-primary, #374151); font-weight: 500; font-size: 0.875rem; border-radius: 0.5rem; text-decoration: none; display: inline-flex; align-items: center; transition: all 0.2s; border: 1px solid var(--border-color, #e5e7eb);"
                               onmouseover="this.style.backgroundColor='var(--bg-secondary, #e5e7eb)'"
                               onmouseout="this.style.backgroundColor='var(--bg-tertiary, #f3f4f6)'">
                                Cancel
                            </a>
                            <button type="submit" 
                                    style="padding: 0.75rem 2rem; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; font-weight: 600; font-size: 0.875rem; border-radius: 0.5rem; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; box-shadow: 0 2px 4px rgba(245, 158, 11, 0.2);"
                                    onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 8px rgba(245, 158, 11, 0.3)'"
                                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(245, 158, 11, 0.2)'">
                                <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Update Teacher
                            </button>
                        </div>
                        <a href="{{ route('admin.teachers.show', $teacher) }}" 
                           style="padding: 0.75rem 1.5rem; background-color: var(--bg-tertiary, #f3f4f6); color: #f59e0b; font-weight: 500; font-size: 0.875rem; border-radius: 0.5rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; border: 1px solid var(--border-color, #e5e7eb);"
                           onmouseover="this.style.backgroundColor='var(--bg-secondary, #e5e7eb)'"
                           onmouseout="this.style.backgroundColor='var(--bg-tertiary, #f3f4f6)'">
                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            View Details
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-admin-layout>