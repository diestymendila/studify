<x-app-layout>
    <x-slot name="header">
        Add New Content: {{ $course->name }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form action="{{ route('contents.store', $course->id) }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Content Title <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title"
                            value="{{ old('title') }}" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                            placeholder="e.g., Introduction to Laravel"
                        >
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="order">
                            Lesson Order <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="number" 
                            name="order" 
                            id="order"
                            value="{{ old('order', 1) }}" 
                            required 
                            min="1"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                            placeholder="1"
                        >
                        <p class="text-gray-600 text-xs mt-1">This determines the sequence of lessons (1, 2, 3, ...)</p>
                        @error('order')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-8">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="body">
                            Content Body <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            name="body" 
                            id="body"
                            rows="15" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent font-mono text-sm"
                            placeholder="Enter the lesson content here. You can use plain text or HTML formatting."
                        >{{ old('body') }}</textarea>
                        <p class="text-gray-600 text-xs mt-1">Write your lesson content. You can use line breaks and basic formatting.</p>
                        @error('body')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="border-t pt-6 flex gap-4">
                        <button type="submit" class="btn-gradient text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                            Create Content
                        </button>
                        <a href="{{ route('contents.index', $course->id) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-8 py-3 rounded-lg font-semibold transition">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer style="background: linear-gradient(135deg, #1e7ac4 0%, #2a9df4 100%);" 
        class="text-white py-2 fixed inset-x-0 bottom-0 z-50">
    <div class="max-w-7xl mx-auto px-8 text-center">
        <p class="text-sm">&copy; 2025 Studify. All rights reserved.</p>
    </div>
    </footer>
</x-app-layout>

<style>
    .btn-gradient {
        background: linear-gradient(135deg, #2a9df4 0%, #1e7ac4 100%);
    }
    .btn-gradient:hover {
        background: linear-gradient(135deg, #1e7ac4 0%, #2a9df4 100%);
    }
</style>