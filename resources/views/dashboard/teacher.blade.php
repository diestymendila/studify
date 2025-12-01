<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Teacher Dashboard</h2>
                <p class="text-gray-600 mt-2">Manage your courses and track student progress</p>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-semibold">My Courses</h3>
                        <p class="text-gray-600 mt-1">You have {{ $courses->count() }} courses</p>
                    </div>
                    <a href="{{ route('courses.create') }}" class="btn-gradient text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                        Create New Course
                    </a>
                </div>
            </div>

            @if($courses->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($courses as $course)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="gradient-bg h-32"></div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $course->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $course->is_active ? 'Active' : 'Inactive' }}
                            </span>
                            <span class="text-sm text-gray-500">👥 {{ $course->students_count }} students</span>
                        </div>
                        
                        <h4 class="text-lg font-bold mb-2">{{ $course->name }}</h4>
                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($course->description, 80) }}</p>
                        
                        <div class="flex gap-2">
                            <a href="{{ route('courses.show', $course->id) }}" class="flex-1 text-center bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded text-sm transition">
                                View
                            </a>
                            <a href="{{ route('courses.edit', $course->id) }}" class="flex-1 text-center bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded text-sm transition">
                                Edit
                            </a>
                            <a href="{{ route('contents.index', $course->id) }}" class="flex-1 text-center bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded text-sm transition">
                                Contents
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No courses yet</h3>
                <p class="text-gray-500 mb-6">You haven't created any courses yet. Start by creating your first course.</p>
                <a href="{{ route('courses.create') }}" class="inline-block btn-gradient text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                    Create Your First Course
                </a>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>

<style>
    .gradient-bg {
        background: linear-gradient(135deg, #2a9df4 0%, #ffffff 100%);
    }
    .btn-gradient {
        background: linear-gradient(135deg, #2a9df4 0%, #1e7ac4 100%);
    }
    .btn-gradient:hover {
        background: linear-gradient(135deg, #1e7ac4 0%, #2a9df4 100%);
    }
</style>