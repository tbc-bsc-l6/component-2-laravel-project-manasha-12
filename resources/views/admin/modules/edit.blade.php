<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Module
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div style="background-color: white; border-radius: 1rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                
                <form action="{{ route('admin.modules.update', $module) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Module Code -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="code" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                            Module Code *
                        </label>
                        <input type="text" name="code" id="code" value="{{ old('code', $module->code) }}" required
                            style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; @error('code') border-color: #ef4444; @enderror">
                        @error('code')
                            <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Module Name -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="name" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                            Module Name *
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $module->name) }}" required
                            style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; @error('name') border-color: #ef4444; @enderror">
                        @error('name')
                            <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="description" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                            Description
                        </label>
                        <textarea name="description" id="description" rows="4"
                            style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; @error('description') border-color: #ef4444; @enderror">{{ old('description', $module->description) }}</textarea>
                        @error('description')
                            <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Max Students -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="max_students" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                            Maximum Students *
                        </label>
                        <input type="number" name="max_students" id="max_students" value="{{ old('max_students', $module->max_students) }}" min="1" max="100" required
                            style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; @error('max_students') border-color: #ef4444; @enderror">
                        @error('max_students')
                            <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #ef4444;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2rem;">
                        <a href="{{ route('admin.modules.index') }}" 
                           style="padding: 0.75rem 1.5rem; background-color: #f3f4f6; color: #374151; font-weight: 500; border-radius: 0.5rem; text-decoration: none; display: inline-block;">
                            Cancel
                        </a>
                        <button type="submit" 
                                style="padding: 0.75rem 1.5rem; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; font-weight: 500; border-radius: 0.5rem; border: none; cursor: pointer;">
                            Update Module
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-admin-layout>