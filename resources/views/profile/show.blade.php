<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800">My Profile</h2>
                <p class="text-gray-600 mt-2">View and manage your personal information</p>
            </div>

            <!-- Profile Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 mb-6">
                <div class="flex items-center space-x-6">
                    <div class="w-24 h-24 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white text-4xl font-bold shadow-lg">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <div class="flex-1">
                        <h2 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h2>
                        <p class="text-gray-600 mt-1">{{ $user->email }}</p>
                        <div class="mt-3 flex items-center gap-3">
                            <span class="inline-block px-4 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                                {{ ucfirst($user->role) }}
                            </span>
                            <span class="inline-block px-4 py-1 {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} rounded-full text-sm font-semibold">
                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('profile.edit') }}" class="btn-gradient text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            <!-- Student Content -->
            @if($user->isStudent())
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">My Enrolled Courses</h3>
                </div>
                
                @if(isset($coursesWithProgress) && $coursesWithProgress->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($coursesWithProgress as $course)
                    <div class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                        <div class="gradient-bg h-32"></div>
                        <div class="p-6">
                            <h4 class="font-bold text-lg mb-2">{{ $course->name }}</h4>
                            <p class="text-sm text-gray-600 mb-4">
                                <span class="font-semibold">Teacher:</span> {{ $course->teacher->name }}
                            </p>
                            
                            <div class="mb-4">
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-gray-700 font-semibold">Progress</span>
                                    <span class="font-bold text-blue-600">
                                        {{ $course->completed_contents }}/{{ $course->total_contents }} lessons
                                    </span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="btn-gradient h-3 rounded-full transition-all duration-300" style="width: {{ $course->progress }}%"></div>
                                </div>
                                <div class="text-right mt-1">
                                    <span class="text-xs text-gray-600">{{ number_format($course->progress, 0) }}% Complete</span>
                                </div>
                            </div>

                            <a href="{{ route('lesson.show', $course->id) }}" class="block w-full text-center btn-gradient text-white px-4 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                                Continue Learning
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-16 bg-gray-50 rounded-lg">
                    <svg class="w-20 h-20 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path>
                    </svg>
                    <h4 class="text-xl font-semibold text-gray-700 mb-2">No courses enrolled yet</h4>
                    <p class="text-gray-500 mb-6">Start your learning journey by enrolling in a course</p>
                    <a href="{{ route('home') }}" class="inline-block btn-gradient text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                        Browse Courses
                    </a>
                </div>
                @endif
            </div>
            @endif

            <!-- Teacher Content -->
            @if($user->isTeacher())
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">My Teaching Courses</h3>
                </div>
                
                @if(isset($courses) && $courses->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($courses as $course)
                    <div class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                        <div class="gradient-bg h-32"></div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $course->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $course->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            
                            <h4 class="font-bold text-lg mb-2">{{ $course->name }}</h4>
                            <p class="text-sm text-gray-600 mb-4">
                                {{ Str::limit($course->description, 80) }}
                            </p>
                            
                            <div class="flex items-center text-sm text-gray-600 mb-2">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span class="font-semibold">{{ $course->students_count }} students enrolled</span>
                            </div>

                            <!-- Student Progress Summary -->
                            @if($course->students_count > 0)
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-semibold text-blue-800">Students Progress</span>
                                    <a href="{{ route('lesson.show', $course->id) }}#student-progress" class="text-xs text-blue-600 hover:text-blue-800 font-medium">
                                        View Details →
                                    </a>
                                </div>
                                <div class="text-sm text-gray-700">
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs text-gray-600">Average Progress:</span>
                                        <span class="font-bold text-blue-600">
                                            {{ isset($course->average_progress) ? number_format($course->average_progress, 0) : '0' }}%
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endif

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
                <div class="text-center py-16 bg-gray-50 rounded-lg">
                    <svg class="w-20 h-20 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <h4 class="text-xl font-semibold text-gray-700 mb-2">No courses created yet</h4>
                    <p class="text-gray-500 mb-6">Start teaching by creating your first course</p>
                    <a href="{{ route('courses.create') }}" class="inline-block btn-gradient text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                        Create Your First Course
                    </a>
                </div>
                @endif
            </div>
            @endif
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