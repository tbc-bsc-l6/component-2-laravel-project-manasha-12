<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Teacher
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div style="background-color: white; border-radius: 1rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                
                <form action="{{ route('admin.teachers.store') }}" method="POST">
                    @csrf

                    <!-- Teacher Name -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="name" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                            Full Name *
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            style="width: 100%; padding: 0.75rem; border: 1px solid {{ $errors->has('name') ? '#ef4444' : '#d1d5db' }}; border-radius: 0.5rem; font-size: 0.875rem;">
                        @error('name')
                            <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="email" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                            Email Address *
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            style="width: 100%; padding: 0.75rem; border: 1px solid {{ $errors->has('email') ? '#ef4444' : '#d1d5db' }}; border-radius: 0.5rem; font-size: 0.875rem;">
                        @error('email')
                            <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                        @enderror
                        <p style="margin-top: 0.5rem; font-size: 0.75rem; color: #6b7280;">This will be used for login</p>
                    </div>

                    <!-- Password -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="password" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                            Password *
                        </label>
                        <input type="password" name="password" id="password" required
                            style="width: 100%; padding: 0.75rem; border: 1px solid {{ $errors->has('password') ? '#ef4444' : '#d1d5db' }}; border-radius: 0.5rem; font-size: 0.875rem;">
                        @error('password')
                            <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                        @enderror
                        <p style="margin-top: 0.5rem; font-size: 0.75rem; color: #6b7280;">Minimum 8 characters</p>
                    </div>

                    <!-- Confirm Password -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="password_confirmation" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                            Confirm Password *
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;">
                    </div>

                    <!-- Info Box -->
                    <div style="background-color: #eff6ff; border-left: 4px solid #3b82f6; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                        <p style="font-size: 0.875rem; color: #1e40af;">
                            <strong>Note:</strong> The teacher will be able to login with their email and password. They can change their password after first login.
                        </p>
                    </div>

                    <!-- Buttons -->
                    <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2rem;">
                        <a href="{{ route('admin.teachers.index') }}" 
                           style="padding: 0.75rem 1.5rem; background-color: #f3f4f6; color: #374151; font-weight: 500; border-radius: 0.5rem; text-decoration: none; display: inline-block;">
                            Cancel
                        </a>
                        <button type="submit" 
                                style="padding: 0.75rem 1.5rem; background: linear-gradient(135deg, #a855f7 0%, #9333ea 100%); color: white; font-weight: 500; border-radius: 0.5rem; border: none; cursor: pointer;">
                            Create Teacher
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-admin-layout>