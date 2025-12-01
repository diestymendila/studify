<x-app-layout>
    <x-slot name="header">
        Edit Course: {{ $course->name }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form action="{{ route('courses.update', $course) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                            Course Name <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name"
                            value="{{ old('name', $course->name) }}" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                        >
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                            Description <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            name="description" 
                            id="description"
                            rows="5" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                        >{{ old('description', $course->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="start_date">
                                Start Date <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="date" 
                                name="start_date" 
                                id="start_date"
                                value="{{ old('start_date', $course->start_date->format('Y-m-d')) }}" 
                                required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                            >
                            @error('start_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="end_date">
                                End Date <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="date" 
                                name="end_date" 
                                id="end_date"
                                value="{{ old('end_date', $course->end_date->format('Y-m-d')) }}" 
                                required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                            >
                            @error('end_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="category_id">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select 
                            name="category_id" 
                            id="category_id"
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                        >
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="teacher_id">
                            Teacher <span class="text-red-500">*</span>
                        </label>
                        <select 
                            name="teacher_id" 
                            id="teacher_id"
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                        >
                            <option value="">Select Teacher</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('teacher_id', $course->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('teacher_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-8">
                        <label class="flex items-center">
                            <input 
                                type="checkbox" 
                                name="is_active" 
                                value="1" 
                                {{ old('is_active', $course->is_active) ? 'checked' : '' }} 
                                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                            >
                            <span class="ml-2 text-sm font-bold text-gray-700">Active (Course is available for enrollment)</span>
                        </label>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="btn-gradient text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                            Update Course
                        </button>
                        <a href="{{ route('courses.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-8 py-3 rounded-lg font-semibold transition">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .btn-gradient {
        background: linear-gradient(135deg, #2a9df4 0%, #1e7ac4 100%);
    }
    .btn-gradient:hover {
        background: linear-gradient(135deg, #1e7ac4 0%, #2a9df4 100%);
    }
</style>