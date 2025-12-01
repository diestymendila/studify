<x-app-layout>
    <x-slot name="header">
        {{ $course->name ?? 'Course' }}
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 
                        7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" 
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 
                        1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 
                        11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 
                        4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

                {{-- Sidebar --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-sm p-4 sticky top-6">
                        <h3 class="font-bold text-lg mb-4 text-gray-900">Course Content</h3>

                        <div class="space-y-2 max-h-[calc(100vh-200px)] overflow-y-auto">
                            @foreach($contents as $item)

                                @php
                                    // Lesson sebelum item
                                    $prev = $contents->firstWhere('order', $item->order - 1);

                                    // Locked jika previous exists & belum completed
                                    $isLocked = $prev ? !$prev->is_completed : false;
                                @endphp

                                {{-- LOCKED --}}
                                @if ($isLocked)
                                    <div class="block p-3 rounded-lg bg-gray-100 border-2 border-gray-200 opacity-60 cursor-not-allowed">
                                        <div class="flex items-center justify-between">
                                            <div class="flex-1">
                                                <span class="text-xs font-semibold text-gray-500">Lesson {{ $item->order }}</span>
                                                <p class="text-sm font-medium text-gray-500 line-clamp-2">
                                                    {{ $item->title }}
                                                </p>
                                            </div>
                                            <svg class="w-6 h-6 text-gray-400 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 11c-1.657 0-3 1.343-3 3v3a3 3 0 003 3 3 3 0 003-3v-3c0-1.657-1.343-3-3-3zm0 0V7a4 4 0 
                                                    118 0v4"></path>
                                            </svg>
                                        </div>
                                    </div>

                                {{-- UNLOCKED --}}
                                @else
                                    <a href="{{ route('lesson.show', ['course' => $course->id, 'content' => $item->id]) }}"
                                       class="block p-3 rounded-lg transition 
                                       {{ isset($content) && $item->id == $content->id ? 'bg-blue-100 border-2 border-blue-500' : 'bg-gray-50 hover:bg-gray-100 border-2 border-transparent' }}">

                                        <div class="flex items-center justify-between">
                                            <div class="flex-1">
                                                <span class="text-xs font-semibold text-gray-500">
                                                    Lesson {{ $item->order }}
                                                </span>
                                                <p class="text-sm font-medium {{ isset($content) && $item->id == $content->id ? 'text-blue-700' : 'text-gray-900' }} line-clamp-2">
                                                    {{ $item->title }}
                                                </p>
                                            </div>

                                            @if($item->is_completed)
                                            <svg class="w-6 h-6 text-green-500 ml-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 
                                                    16zm3.707-9.293a1 1 0 00-1.414-1.414L9 
                                                    10.586 7.707 9.293a1 1 0 
                                                    00-1.414 1.414l2 2a1 1 0 
                                                    001.414 0l4-4z" 
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            @endif
                                        </div>
                                    </a>
                                @endif

                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Main Content --}}
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">

                        {{-- Header --}}
                        <div class="mb-6">
                            <span class="text-sm text-blue-600 font-semibold">Lesson {{ $content->order ?? '-' }}</span>
                            <h1 class="text-3xl font-bold text-gray-900 mt-1 mb-4">{{ $content->title ?? 'Untitled Lesson' }}</h1>

                            @if(!empty($isCompleted))
                            <div class="inline-flex items-center text-green-600 bg-green-50 px-4 py-2 rounded-lg">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 
                                        000 16zm3.707-9.293a1 1 0 
                                        00-1.414-1.414L9 10.586 
                                        7.707 9.293a1 1 0 
                                        00-1.414 1.414l2 2a1 1 0 
                                        001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-semibold">Completed</span>
                            </div>
                            @endif
                        </div>

                        {{-- Body --}}
                        <div class="prose max-w-none mb-8">
                            <div class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $content->body ?? 'No content available.' }}</div>
                        </div>

                        {{-- Buttons --}}
                        <div class="flex items-center justify-between gap-4 pt-6 border-t flex-wrap">

                            <div class="flex items-center gap-4 flex-wrap">

                                {{-- Mark Complete --}}
                                <form action="{{ route('content.complete', ['courseId' => $course->id, 'contentId' => $content->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center px-8 py-3 rounded-lg font-semibold transition duration-300
                                        {{ !empty($isCompleted) ? 'bg-green-500 hover:bg-green-600 text-white' : 'btn-gradient text-white hover:shadow-lg' }}">
                                        @if(!empty($isCompleted))
                                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 
                                                    000 16zm3.707-9.293a1 1 0 
                                                    00-1.414-1.414L9 10.586 
                                                    7.707 9.293a1 1 0 
                                                    00-1.414 1.414l2 2a1 1 0 
                                                    001.414 0l4-4z" 
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Completed
                                        @else
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 
                                                    0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Mark as Complete
                                        @endif
                                    </button>
                                </form>

                                {{-- Previous --}}
                                @if(!empty($previousContent))
                                <a href="{{ route('lesson.show', ['course' => $course->id, 'content' => $previousContent->id]) }}"
                                   class="inline-flex items-center btn-gradient text-white px-8 py-3 rounded-lg font-semibold transition hover:shadow-lg">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"></path>
                                    </svg>
                                    Previous Lesson
                                </a>
                                @endif

                                {{-- Next Lesson (UNLOCKED only) --}}
                                @php
                                    if ($nextContent) {
                                        $prevOfNext = $contents->firstWhere('order', $nextContent->order - 1);
                                        $nextLocked = $prevOfNext && !$prevOfNext->is_completed;
                                    } else {
                                        $nextLocked = true;
                                    }
                                @endphp

                                @if(!empty($nextContent) && !$nextLocked)
                                <a href="{{ route('lesson.show', ['course' => $course->id, 'content' => $nextContent->id]) }}"
                                   class="inline-flex items-center btn-gradient text-white px-8 py-3 rounded-lg font-semibold transition hover:shadow-lg">
                                    Next Lesson
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </a>
                                @endif

                            </div>

                            {{-- Back to Course --}}
                            <div>
                                <a href="{{ route('courses.catalog', $course->id) }}"
                                   class="inline-flex items-center bg-gray-600 hover:bg-gray-700 text-white px-8 py-3 rounded-lg font-semibold transition">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 
                                            10v10a1 1 0 001 1h3m10-11l2 
                                            2m-2-2v10a1 1 0 01-1 1h-3m-6 
                                            0a1 1 0 001-1v-4a1 1 0 011-1h2a1 
                                            1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    Back to Course
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Forum --}}
                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-6">
                        <div class="flex items-center justify-between flex-wrap gap-4">
                            <div class="flex items-center">
                                <svg class="w-8 h-8 text-purple-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8h2a2 2 0 012 2v6a2 2 
                                        0 01-2 2h-2v4l-4-4H9a1.994 
                                        1.994 0 01-1.414-.586m0 
                                        0L11 14h4a2 2 0 002-2V6a2 
                                        2 0 00-2-2H5a2 2 0 
                                        00-2 2v6a2 2 0 002 
                                        2h2v4l.586-.586z"></path>
                                </svg>
                                <div>
                                    <h4 class="font-bold text-purple-900">Need Help?</h4>
                                    <p class="text-sm text-purple-700">Join the discussion forum to ask questions</p>
                                </div>
                            </div>
                            <a href="{{ route('discussions.index', $course->id) }}"
                               class="bg-purple-500 hover:bg-purple-600 text-white px-6 py-2 rounded-lg font-semibold transition">
                                Go to Forum
                            </a>
                        </div>
                    </div>

                </div>
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
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
