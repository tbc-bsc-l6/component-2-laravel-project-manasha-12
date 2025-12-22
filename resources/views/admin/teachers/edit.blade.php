<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Teacher
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div style="background-color: white; border-radius: 1rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                
                <form action="{{ route('admin.teachers.update', $teacher) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Teacher Name -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="name" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                            Full Name *
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $teacher->name) }}" required
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
                        <input type="email" name="email" id="email" value="{{ old('email', $teacher->email) }}" required
                            style="width: 100%; padding: 0.75rem; border: 1px solid {{ $errors->has('email') ? '#ef4444' : '#d1d5db' }}; border-radius: 0.5rem; font-size: 0.875rem;">
                        @error('email')
                            <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Info Box -->
                    <div style="background-color: #fef3c7; border-left: 4px solid #f59e0b; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                        <p style="font-size: 0.875rem; color: #92400e;">
                            <strong>Note:</strong> To change the password, the teacher should use the "Forgot Password" feature or you can reset it from the user profile.
                        </p>
                    </div>

                    <!-- Buttons -->
                    <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2rem;">
                        <a href="{{ route('admin.teachers.index') }}" 
                           style="padding: 0.75rem 1.5rem; background-color: #f3f4f6; color: #374151; font-weight: 500; border-radius: 0.5rem; text-decoration: none; display: inline-block;">
                            Cancel
                        </a>
                        <button type="submit" 
                                style="padding: 0.75rem 1.5rem; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; font-weight: 500; border-radius: 0.5rem; border: none; cursor: pointer;">
                            Update Teacher
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-admin-layout>