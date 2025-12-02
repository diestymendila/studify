<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-900">Student Dashboard</h1>
                <p class="text-gray-600 mt-2">Track your learning progress and continue your courses</p>
            </div>

            <!-- Stats Card -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6 mb-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900">My Enrolled Courses</h3>
                        <p class="text-gray-600 mt-1">
                            You are enrolled in {{ $coursesWithProgress->count() }} courses
                        </p>
                    </div>
                    <a href="{{ route('courses.catalog') }}" 
                       class="btn-gradient text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition duration-200">
                        Browse More Courses
                    </a>
                </div>
            </div>

            <!-- Courses Grid -->
            @if($coursesWithProgress->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($coursesWithProgress as $course)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">

                            <!-- Gradient Header -->
                            <div class="gradient-bg h-32"></div>

                            <!-- Course Content -->
                            <div class="p-6">
                                <h4 class="text-lg font-bold text-gray-900 mb-2">{{ $course->name }}</h4>
                                <p class="text-gray-600 text-sm mb-4">
                                    <span class="font-semibold">Teacher:</span> 
                                    {{ $course->teacher->name ?? 'Unknown Teacher' }}
                                </p>

                                <!-- Progress -->
                                <div class="mb-4">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-sm font-medium text-gray-700">Progress</span>
                                        <span class="text-sm font-bold text-blue-600">
                                            {{ number_format($course->progress ?? 0, 0) }}%
                                        </span>
                                    </div>

                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="progress-bar h-3 rounded-full transition-all duration-300"
                                             style="width: {{ $course->progress ?? 0 }}%">
                                        </div>
                                    </div>

                                    <p class="text-xs text-gray-500 mt-2">
                                        <span class="font-medium text-gray-700">{{ $course->completed_contents ?? 0 }}</span> of 
                                        <span class="font-medium text-gray-700">{{ $course->total_contents ?? 0 }}</span> lessons completed
                                    </p>
                                </div>

                                <!-- Continue -->
                                @php
                                    // Ambil lesson/content pertama berdasarkan order
                                    $firstContent = null;
                                    if($course->relationLoaded('contents')) {
                                        $firstContent = $course->contents->sortBy('order')->first();
                                    } else {
                                        
                                        try {
                                            $firstContent = $course->contents()->orderBy('order')->first();
                                        } catch (\Throwable $e) {
                                            $firstContent = null;
                                        }
                                    }
                                @endphp

                                @if($firstContent)
                                    <a href="{{ route('lesson.show', ['course' => $course->id, 'content' => $firstContent->id]) }}"
                                       class="block w-full text-center btn-gradient text-white px-4 py-3 rounded-lg font-semibold hover:shadow-lg transition duration-200">
                                        Continue Learning
                                    </a>
                                @else
                                    <a href="{{ route('courses.catalog') }}" 
                                       class="block w-full text-center bg-gray-300 text-gray-700 px-4 py-3 rounded-lg font-semibold cursor-not-allowed">
                                        No Lessons Available
                                    </a>
                                @endif

                            </div>
                        </div>
                    @endforeach
                </div>

            @else
                <!-- Empty State -->
                <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>

                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No enrolled courses</h3>
                    <p class="text-gray-500 mb-6">
                        You haven't enrolled in any courses yet. Browse our course catalog and start learning today!
                    </p>

                    <a href="{{ route('courses.catalog') }}" 
                       class="inline-block btn-gradient text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition duration-200">
                        Browse Courses
                    </a>
                </div>
            @endif
        </div>
    </div>

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
        .progress-bar {
            background: linear-gradient(135deg, #2a9df4, #1e7ac4);
        }
    </style>

    <footer style="background: linear-gradient(135deg, #1e7ac4 0%, #2a9df4 100%);" 
        class="text-white py-2 fixed inset-x-0 bottom-0 z-50">
    <div class="max-w-7xl mx-auto px-8 text-center">
        <p class="text-sm">&copy; 2025 Studify. All rights reserved.</p>
    </div>
    </footer>
</x-app-layout>
