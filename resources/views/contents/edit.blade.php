<x-app-layout>
    <x-slot name="header">
        Edit Content: {{ $content->title }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form action="{{ route('contents.update', [$course->id, $content->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Content Title <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title"
                            value="{{ old('title', $content->title) }}" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
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
                            value="{{ old('order', $content->order) }}" 
                            required 
                            min="1"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
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
                        >{{ old('body', $content->body) }}</textarea>
                        <p class="text-gray-600 text-xs mt-1">Write your lesson content. You can use line breaks and basic formatting.</p>
                        @error('body')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="border-t pt-6 flex gap-4 items-center">
                        <button type="submit" class="btn-gradient text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                            Update Content
                        </button>
                        <a href="{{ route('contents.index', $course->id) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-8 py-3 rounded-lg font-semibold transition">
                            Cancel
                        </a>
                        
                        <!-- Delete Button - Sejajar dengan button lainnya -->
                        <div class="ml-auto">
                            <button type="button" onclick="document.getElementById('deleteForm').submit();" class="bg-red-500 hover:bg-red-600 text-white px-8 py-3 rounded-lg font-semibold transition">
                                Delete Content
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Delete Form - Hidden -->
                <form id="deleteForm" action="{{ route('contents.destroy', [$course->id, $content->id]) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>

            <!-- Info Card -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mt-6">
                <h4 class="font-bold text-yellow-900 mb-2">⚠️ Important</h4>
                <p class="text-sm text-yellow-800">
                    Changing the lesson order will affect the learning sequence for students. Students must complete lessons in order before proceeding to the next one.
                </p>
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