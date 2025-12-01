<x-app-layout>
    <x-slot name="header">
        Manage Contents: {{ $course->name }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 relative">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 relative">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-semibold">Course Contents</h3>
                        <p class="text-gray-600 text-sm mt-1">{{ $course->contents->count() }} contents total</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('contents.create', $course->id) }}" class="btn-gradient text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                            Add New Content
                        </a>
                        <a href="{{ route('courses.show', $course->id) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold transition">
                            Back to Course
                        </a>
                    </div>
                </div>
            </div>

            @if($course->contents->count() > 0)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preview</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created By</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($course->contents as $content)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 text-blue-800 font-bold">
                                    {{ $content->order }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $content->title }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-600">
                                    {{ Str::limit(strip_tags($content->body), 80) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-600">
                                    {{ $content->creator ? $content->creator->name : 'Admin' }}
                                    @if($content->creator)
                                        <span class="text-xs block {{ $content->creator->isAdmin() ? 'text-purple-600' : 'text-green-600' }}">
                                            {{ $content->creator->isAdmin() ? 'Admin' : 'Teacher' }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('contents.edit', [$course->id, $content->id]) }}" class="text-indigo-600 hover:text-indigo-900">
                                        Edit
                                    </a>
                                    
                                    @php
                                        $user = auth()->user();
                                        // Admin bisa hapus semua content
                                        // Teacher HANYA bisa hapus content yang DIA BUAT (bukan yang dibuat admin)
                                        $canDelete = $user->isAdmin() || ($content->created_by === $user->id);
                                    @endphp
                                    
                                    {{-- Tombol Delete HANYA muncul jika user punya hak hapus --}}
                                    @if($canDelete)
                                        <form action="{{ route('contents.destroy', [$course->id, $content->id]) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure you want to delete this content?')" class="text-red-600 hover:text-red-900">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-12 text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No contents yet</h3>
                <p class="text-gray-500 mb-6">Start by adding your first lesson content for this course.</p>
                <a href="{{ route('contents.create', $course->id) }}" class="inline-block btn-gradient text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                    Add First Content
                </a>
            </div>
            @endif
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