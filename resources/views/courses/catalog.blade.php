<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-900">Course Catalog</h1>
                <p class="text-gray-600 mt-2">Discover and enroll in courses that interest you</p>
            </div>

            
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ session('error') }}
                </div>
            @endif

            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($courses as $course)
                    @php
                        
                        $isEnrolled = auth()->user() ? auth()->user()->enrolledCourses->contains($course->id) : false;
                        
                        
                        $progressData = ($isEnrolled && auth()->user()) 
                            ? auth()->user()->getCourseProgress($course)
                            : ['completed' => 0, 'total' => 0, 'percentage' => 0];
                        
                        $progress = $progressData['percentage'] ?? 0;
                        $completedCount = $progressData['completed'] ?? 0;
                        $totalCount = $progressData['total'] ?? 0;

                        
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

                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden flex flex-col">
                        
                        <div class="p-6 flex-grow">
                            <div class="flex items-start justify-between mb-3">
                                <h3 class="font-bold text-xl text-gray-900 flex-grow pr-2">
                                    {{ $course->name }}
                                </h3>
                                @if($isEnrolled)
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 whitespace-nowrap">
                                        Enrolled
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 whitespace-nowrap">
                                        Available
                                    </span>
                                @endif
                            </div>

                            
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ Str::limit($course->description, 150) }}
                            </p>

                            
                            <div class="flex items-center mb-3 pb-3 border-b border-gray-200">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold">
                                    {{ strtoupper(substr($course->teacher->name ?? 'T', 0, 1)) }}
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">{{ $course->teacher->name ?? 'Unknown Teacher' }}</p>
                                    <p class="text-xs text-gray-500">Instructor</p>
                                </div>
                            </div>

                            
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                <span>{{ $course->category->name ?? 'General' }}</span>
                            </div>

                            
                            <div class="flex items-center text-sm text-gray-500 mb-4">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>
                                    @if($course->start_date && $course->end_date)
                                        {{ \Carbon\Carbon::parse($course->start_date)->format('M d, Y') }} - 
                                        {{ \Carbon\Carbon::parse($course->end_date)->format('M d, Y') }}
                                    @else
                                        Flexible schedule
                                    @endif
                                </span>
                            </div>

                            
                            @if($isEnrolled)
                                <div class="mb-4 bg-gray-50 p-3 rounded-lg">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-sm font-medium text-gray-700">Your Progress</span>
                                        <span class="text-sm font-semibold text-blue-600">{{ number_format($progress, 0) }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-blue-600 h-2.5 rounded-full transition-all duration-300" 
                                             style="width: {{ $progress }}%"></div>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2">
                                        <span class="font-medium text-gray-700">{{ $completedCount }}</span> of 
                                        <span class="font-medium text-gray-700">{{ $totalCount }}</span> lessons completed
                                    </p>
                                </div>
                            @endif
                        </div>

                        
                        <div class="px-6 pb-6 space-y-2">
                            @if($isEnrolled)
                                
                                @if($firstContent)
                                    <a href="{{ route('lesson.show', ['course' => $course->id, 'content' => $firstContent->id]) }}" 
                                       class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-md font-medium transition duration-200 shadow-sm">
                                        <div class="flex items-center justify-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Continue Learning
                                        </div>
                                    </a>
                                @else
                                    <button disabled class="w-full text-center bg-gray-300 text-gray-700 px-4 py-2.5 rounded-md font-medium cursor-not-allowed">
                                        No Lessons Available
                                    </button>
                                @endif

                                
                                <form action="{{ route('course.unenroll', $course->id) }}" method="POST" 
                                      onsubmit="return confirm('Are you sure you want to unenroll from this course? Your progress will be saved.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-full text-center bg-red-50 hover:bg-red-100 text-red-600 px-4 py-2 rounded-md font-medium transition duration-200 border border-red-200">
                                        <div class="flex items-center justify-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Unenroll from Course
                                        </div>
                                    </button>
                                </form>
                            @else
                                
                                <form action="{{ route('course.enroll', $course->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="w-full bg-gray-600 hover:bg-gray-700 text-white px-4 py-2.5 rounded-md font-medium transition duration-200 shadow-sm">
                                        <div class="flex items-center justify-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            Enroll Now
                                        </div>
                                    </button>
                                </form>
                            @endif

                            
                            <a href="https://wa.me/6282198711839" 
                               target="_blank"
                               rel="noopener noreferrer"
                               class="block w-full text-center bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md font-medium transition duration-200 shadow-sm">
                                <div class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                    </svg>
                                    Contact Teacher
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    
                    <div class="col-span-3 text-center py-16">
                        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">No courses available</h3>
                        <p class="mt-2 text-gray-500">There are no active courses at the moment. Please check back later.</p>
                    </div>
                @endforelse
            </div>

            
            @if($courses->hasPages())
                <div class="mt-8">
                    {{ $courses->links() }}
                </div>
            @endif
        </div>
    </div>

    <style>
        
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <!-- Footer -->
    <footer style="background: linear-gradient(135deg, #1e7ac4 0%, #2a9df4 100%);" 
        class="text-white py-2 fixed inset-x-0 bottom-0 z-50">
    <div class="max-w-7xl mx-auto px-8 text-center">
        <p class="text-sm">&copy; 2025 Studify. All rights reserved.</p>
    </div>
    </footer>
</x-app-layout>
