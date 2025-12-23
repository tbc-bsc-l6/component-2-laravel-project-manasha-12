<x-admin-layout>
    <x-slot name="header">
        <div style="display: flex; align-items: center; gap: 1rem;">
            <div style="width: 40px; height: 40px; background-color: var(--bg-tertiary, #f3f4f6); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                <svg style="width: 20px; height: 20px; color: var(--text-secondary, #6b7280);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div>
                <h2 style="font-size: 1.25rem; font-weight: 600; color: var(--text-primary, #111827); margin: 0;">Add New Teacher</h2>
                <p style="font-size: 0.875rem; color: var(--text-secondary, #6b7280); margin: 0;">Create a new teacher account for the system</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div style="background-color: var(--card-bg, white); border-radius: 1rem; padding: 2.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid var(--border-color, #e5e7eb);">
                
                <form action="{{ route('admin.teachers.store') }}" method="POST">
                    @csrf

                    <!-- Form Grid - 2 Columns -->
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 2rem; margin-bottom: 2rem;">
                        
                        <!-- Left Column -->
                        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                            
                            <!-- Full Name -->
                            <div>
                                <label for="name" style="display: block; font-size: 0.875rem; font-weight: 600; color: var(--text-primary, #111827); margin-bottom: 0.5rem;">
                                    Full Name *
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="John Doe"
                                    style="width: 100%; padding: 0.75rem 1rem; background-color: var(--input-bg, white); border: 1px solid {{ $errors->has('name') ? '#ef4444' : 'var(--input-border, #d1d5db)' }}; border-radius: 0.5rem; font-size: 0.875rem; color: var(--text-primary, #111827); transition: all 0.2s;"
                                    onfocus="this.style.borderColor='#a855f7'; this.style.boxShadow='0 0 0 3px rgba(168, 85, 247, 0.1)'"
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
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="john.doe@example.com"
                                    style="width: 100%; padding: 0.75rem 1rem; background-color: var(--input-bg, white); border: 1px solid {{ $errors->has('email') ? '#ef4444' : 'var(--input-border, #d1d5db)' }}; border-radius: 0.5rem; font-size: 0.875rem; color: var(--text-primary, #111827); transition: all 0.2s;"
                                    onfocus="this.style.borderColor='#a855f7'; this.style.boxShadow='0 0 0 3px rgba(168, 85, 247, 0.1)'"
                                    onblur="this.style.borderColor='var(--input-border, #d1d5db)'; this.style.boxShadow='none'">
                                @error('email')
                                    <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                                @enderror
                                <p style="margin-top: 0.5rem; font-size: 0.75rem; color: var(--text-secondary, #6b7280);">
                                    <svg style="width: 12px; height: 12px; display: inline; margin-right: 0.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    This will be used for login
                                </p>
                            </div>

                        </div>

                        <!-- Right Column -->
                        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                            
                            <!-- Password -->
                            <div>
                                <label for="password" style="display: block; font-size: 0.875rem; font-weight: 600; color: var(--text-primary, #111827); margin-bottom: 0.5rem;">
                                    Password *
                                </label>
                                <input type="password" name="password" id="password" required placeholder="••••••••"
                                    style="width: 100%; padding: 0.75rem 1rem; background-color: var(--input-bg, white); border: 1px solid {{ $errors->has('password') ? '#ef4444' : 'var(--input-border, #d1d5db)' }}; border-radius: 0.5rem; font-size: 0.875rem; color: var(--text-primary, #111827); transition: all 0.2s;"
                                    onfocus="this.style.borderColor='#a855f7'; this.style.boxShadow='0 0 0 3px rgba(168, 85, 247, 0.1)'"
                                    onblur="this.style.borderColor='var(--input-border, #d1d5db)'; this.style.boxShadow='none'">
                                @error('password')
                                    <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                                @enderror
                                <p style="margin-top: 0.5rem; font-size: 0.75rem; color: var(--text-secondary, #6b7280);">Minimum 8 characters required</p>
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation" style="display: block; font-size: 0.875rem; font-weight: 600; color: var(--text-primary, #111827); margin-bottom: 0.5rem;">
                                    Confirm Password *
                                </label>
                                <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="••••••••"
                                    style="width: 100%; padding: 0.75rem 1rem; background-color: var(--input-bg, white); border: 1px solid var(--input-border, #d1d5db); border-radius: 0.5rem; font-size: 0.875rem; color: var(--text-primary, #111827); transition: all 0.2s;"
                                    onfocus="this.style.borderColor='#a855f7'; this.style.boxShadow='0 0 0 3px rgba(168, 85, 247, 0.1)'"
                                    onblur="this.style.borderColor='var(--input-border, #d1d5db)'; this.style.boxShadow='none'">
                            </div>

                        </div>

                    </div>

                    <!-- Info Notice -->
                    <div style="padding: 1.25rem 1.5rem; background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); border-left: 4px solid #3b82f6; border-radius: 0.75rem; margin-bottom: 2rem;">
                        <div style="display: flex; gap: 1rem;">
                            <svg style="width: 20px; height: 20px; color: #3b82f6; flex-shrink: 0; margin-top: 0.125rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <p style="font-size: 0.875rem; font-weight: 600; color: #1e40af; margin: 0 0 0.25rem 0;">Teacher Account Information</p>
                                <p style="font-size: 0.875rem; color: #1e40af; margin: 0;">The teacher will be able to login with their email and password. They can update their profile and change their password after first login.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div style="display: flex; justify-content: flex-end; gap: 0.75rem; padding-top: 1.5rem; border-top: 1px solid var(--border-color, #e5e7eb);">
                        <a href="{{ route('admin.teachers.index') }}" 
                           style="padding: 0.75rem 1.5rem; background-color: var(--bg-tertiary, #f3f4f6); color: var(--text-primary, #374151); font-weight: 500; font-size: 0.875rem; border-radius: 0.5rem; text-decoration: none; display: inline-flex; align-items: center; transition: all 0.2s; border: 1px solid var(--border-color, #e5e7eb);"
                           onmouseover="this.style.backgroundColor='var(--bg-secondary, #e5e7eb)'"
                           onmouseout="this.style.backgroundColor='var(--bg-tertiary, #f3f4f6)'">
                            Cancel
                        </a>
                        <button type="submit" 
                                style="padding: 0.75rem 2rem; background: linear-gradient(135deg, #a855f7 0%, #9333ea 100%); color: white; font-weight: 600; font-size: 0.875rem; border-radius: 0.5rem; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; box-shadow: 0 2px 4px rgba(168, 85, 247, 0.2);"
                                onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 8px rgba(168, 85, 247, 0.3)'"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(168, 85, 247, 0.2)'">
                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Create Teacher
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-admin-layout>