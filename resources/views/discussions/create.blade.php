<x-app-layout>
    <x-slot name="header">
        Start New Discussion: {{ $course->name }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form action="{{ route('discussions.store', $course->id) }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Discussion Title <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title"
                            value="{{ old('title') }}" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                            placeholder="Enter a clear and descriptive title"
                        >
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-8">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="body">
                            Your Message <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            name="body" 
                            id="body"
                            rows="10" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                            placeholder="Explain your question or topic in detail..."
                        >{{ old('body') }}</textarea>
                        <p class="text-gray-600 text-xs mt-1">Provide as much detail as possible to get better responses</p>
                        @error('body')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-4 border-t pt-6">
                        <button type="submit" class="btn-gradient text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                            Post Discussion
                        </button>
                        <a href="{{ route('discussions.index', $course->id) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-8 py-3 rounded-lg font-semibold transition">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>

            <!-- Tips Card -->
            <div class="bg-green-50 border border-green-200 rounded-lg p-6 mt-6">
                <h4 class="font-bold text-green-900 mb-3">✅ Tips for Good Discussions</h4>
                <ul class="text-sm text-green-800 space-y-2">
                    <li>• <strong>Be specific:</strong> Include details about what you're trying to accomplish</li>
                    <li>• <strong>Show your work:</strong> If you're stuck, share what you've already tried</li>
                    <li>• <strong>Use examples:</strong> Concrete examples help others understand your question</li>
                    <li>• <strong>Stay focused:</strong> Keep one topic per discussion</li>
                    <li>• <strong>Be patient:</strong> Give others time to read and respond thoughtfully</li>
                </ul>
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