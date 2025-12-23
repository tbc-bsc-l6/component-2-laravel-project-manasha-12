<x-admin-layout>
    <x-slot name="header">
        <div style="display: flex; align-items: center; gap: 1rem;">
            <div style="width: 40px; height: 40px; background-color: var(--bg-tertiary, #f3f4f6); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                <svg style="width: 20px; height: 20px; color: var(--text-secondary, #6b7280);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <div>
                <h2 style="font-size: 1.25rem; font-weight: 600; color: var(--text-primary, #111827); margin: 0;">Add New Module</h2>
                <p style="font-size: 0.875rem; color: var(--text-secondary, #6b7280); margin: 0;">Create a new module for students to enroll</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div style="background-color: var(--card-bg, white); border-radius: 1rem; padding: 2.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid var(--border-color, #e5e7eb);">
                
                <form action="{{ route('admin.modules.store') }}" method="POST">
                    @csrf

                    <!-- Form Grid - 2 Columns -->
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 2rem; margin-bottom: 2rem;">
                        
                        <!-- Left Column -->
                        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                            
                            <!-- Module Code -->
                            <div>
                                <label for="code" style="display: block; font-size: 0.875rem; font-weight: 600; color: var(--text-primary, #111827); margin-bottom: 0.5rem;">
                                    Module Code *
                                </label>
                                <input type="text" name="code" id="code" value="{{ old('code') }}" required placeholder="e.g., CS101"
                                    style="width: 100%; padding: 0.75rem 1rem; background-color: var(--input-bg, white); border: 1px solid {{ $errors->has('code') ? '#ef4444' : 'var(--input-border, #d1d5db)' }}; border-radius: 0.5rem; font-size: 0.875rem; color: var(--text-primary, #111827); transition: all 0.2s;"
                                    onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.1)'"
                                    onblur="this.style.borderColor='var(--input-border, #d1d5db)'; this.style.boxShadow='none'">
                                @error('code')
                                    <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Module Name -->
                            <div>
                                <label for="name" style="display: block; font-size: 0.875rem; font-weight: 600; color: var(--text-primary, #111827); margin-bottom: 0.5rem;">
                                    Module Name *
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="e.g., Introduction to Computer Science"
                                    style="width: 100%; padding: 0.75rem 1rem; background-color: var(--input-bg, white); border: 1px solid {{ $errors->has('name') ? '#ef4444' : 'var(--input-border, #d1d5db)' }}; border-radius: 0.5rem; font-size: 0.875rem; color: var(--text-primary, #111827); transition: all 0.2s;"
                                    onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.1)'"
                                    onblur="this.style.borderColor='var(--input-border, #d1d5db)'; this.style.boxShadow='none'">
                                @error('name')
                                    <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Max Students -->
                            <div>
                                <label for="max_students" style="display: block; font-size: 0.875rem; font-weight: 600; color: var(--text-primary, #111827); margin-bottom: 0.5rem;">
                                    Maximum Students *
                                </label>
                                <input type="number" name="max_students" id="max_students" value="{{ old('max_students', 30) }}" min="1" max="100" required placeholder="30"
                                    style="width: 100%; padding: 0.75rem 1rem; background-color: var(--input-bg, white); border: 1px solid {{ $errors->has('max_students') ? '#ef4444' : 'var(--input-border, #d1d5db)' }}; border-radius: 0.5rem; font-size: 0.875rem; color: var(--text-primary, #111827); transition: all 0.2s;"
                                    onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.1)'"
                                    onblur="this.style.borderColor='var(--input-border, #d1d5db)'; this.style.boxShadow='none'">
                                @error('max_students')
                                    <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                                @enderror
                                <p style="margin-top: 0.5rem; font-size: 0.75rem; color: var(--text-secondary, #6b7280);">Number of students allowed to enroll</p>
                            </div>

                        </div>

                        <!-- Right Column -->
                        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                            
                            <!-- Description -->
                            <div style="flex: 1;">
                                <label for="description" style="display: block; font-size: 0.875rem; font-weight: 600; color: var(--text-primary, #111827); margin-bottom: 0.5rem;">
                                    Description
                                </label>
                                <textarea name="description" id="description" rows="9" placeholder="Describe the module objectives and content..."
                                    style="width: 100%; padding: 0.75rem 1rem; background-color: var(--input-bg, white); border: 1px solid {{ $errors->has('description') ? '#ef4444' : 'var(--input-border, #d1d5db)' }}; border-radius: 0.5rem; font-size: 0.875rem; color: var(--text-primary, #111827); resize: vertical; transition: all 0.2s;"
                                    onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.1)'"
                                    onblur="this.style.borderColor='var(--input-border, #d1d5db)'; this.style.boxShadow='none'">{{ old('description') }}</textarea>
                                @error('description')
                                    <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                    </div>

                    <!-- Availability Toggle -->
                    <div style="padding: 1.5rem; background-color: var(--bg-tertiary, #f9fafb); border-radius: 0.75rem; margin-bottom: 2rem; border: 1px solid var(--border-color, #e5e7eb);">
                        <label style="display: flex; align-items: center; cursor: pointer;">
                            <input type="checkbox" name="is_available" value="1" {{ old('is_available', true) ? 'checked' : '' }}
                                style="width: 20px; height: 20px; border-radius: 0.25rem; border: 1px solid var(--input-border, #d1d5db); cursor: pointer; accent-color: #3b82f6;">
                            <div style="margin-left: 0.75rem;">
                                <span style="font-size: 0.875rem; font-weight: 600; color: var(--text-primary, #111827); display: block;">Make module available immediately</span>
                                <span style="font-size: 0.75rem; color: var(--text-secondary, #6b7280);">Students can enroll in this module once created</span>
                            </div>
                        </label>
                    </div>

                    <!-- Action Buttons -->
                    <div style="display: flex; justify-content: flex-end; gap: 0.75rem; padding-top: 1.5rem; border-top: 1px solid var(--border-color, #e5e7eb);">
                        <a href="{{ route('admin.modules.index') }}" 
                           style="padding: 0.75rem 1.5rem; background-color: var(--bg-tertiary, #f3f4f6); color: var(--text-primary, #374151); font-weight: 500; font-size: 0.875rem; border-radius: 0.5rem; text-decoration: none; display: inline-flex; align-items: center; transition: all 0.2s; border: 1px solid var(--border-color, #e5e7eb);"
                           onmouseover="this.style.backgroundColor='var(--bg-secondary, #e5e7eb)'"
                           onmouseout="this.style.backgroundColor='var(--bg-tertiary, #f3f4f6)'">
                            Cancel
                        </a>
                        <button type="submit" 
                                style="padding: 0.75rem 2rem; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; font-weight: 600; font-size: 0.875rem; border-radius: 0.5rem; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; box-shadow: 0 2px 4px rgba(59, 130, 246, 0.2);"
                                onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 8px rgba(59, 130, 246, 0.3)'"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(59, 130, 246, 0.2)'">
                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Create Module
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-admin-layout>