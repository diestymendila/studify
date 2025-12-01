<x-app-layout> 
    <x-slot name="header">
        Discussion Forum: {{ $course->name }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- HEADER --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-semibold">Course Discussions</h3>
                        <p class="text-gray-600 text-sm mt-1">{{ $discussions->total() }} discussions</p>
                    </div>
                </div>
            </div>

            {{-- CREATE DISCUSSION --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8">
                <h3 class="text-lg font-semibold mb-3">Start a New Discussion</h3>

                <form action="{{ route('discussions.store', $course->id) }}" method="POST">
                    @csrf

                    <input type="text" name="title"
                           class="w-full border rounded-lg p-3 mb-3"
                           placeholder="Discussion title" required>

                    <textarea name="body" rows="4"
                              class="w-full border rounded-lg p-3"
                              placeholder="Write your discussion..." required></textarea>

                    <button type="submit"
                            class="mt-3 px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Publish Discussion
                    </button>
                </form>
            </div>

            {{-- DISCUSSION LIST --}}
            @if($discussions->count() > 0)

                <div class="space-y-4">
                    @foreach($discussions as $discussion)
                        <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition p-6">
                            <div class="flex items-start space-x-4">

                                {{-- USER ICON --}}
                                <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                                    {{ substr($discussion->user->name, 0, 1) }}
                                </div>

                                <div class="flex-1">

                                    {{-- TITLE --}}
                                    <div class="flex justify-between">
                                        <h4 class="text-lg font-bold text-gray-900">
                                            {{ $discussion->title }}
                                        </h4>
                                    </div>

                                    <p class="text-gray-600 mb-3">
                                        {{ Str::limit($discussion->body, 150) }}
                                    </p>

                                    {{-- META --}}
                                    <div class="flex items-center text-sm text-gray-500 space-x-4">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            <span>{{ $discussion->user->name }}</span>

                                            @if($discussion->user->isTeacher())
                                                <span class="ml-1 px-2 py-0.5 bg-purple-100 text-purple-800 rounded text-xs">
                                                    Teacher
                                                </span>
                                            @endif
                                        </div>

                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8z"/>
                                            </svg>
                                            <span>{{ $discussion->replies->count() }} replies</span>
                                        </div>

                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <span>{{ $discussion->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>

                                    {{-- REPLIES --}}
                                    @if($discussion->replies->count() > 0)
                                        <div class="mt-6 border-l-4 border-blue-300 pl-4">
                                            @foreach($discussion->replies as $reply)
                                                <div class="mb-4">

                                                    <div class="flex justify-between">
                                                        <p class="text-sm font-semibold">
                                                            {{ $reply->user->name }}
                                                            <span class="text-xs text-gray-400">
                                                                • {{ $reply->created_at->diffForHumans() }}
                                                            </span>
                                                        </p>

                                                        {{-- DELETE REPLY (STANDALONE FORM) --}}
                                                        @if(auth()->id() === $reply->user_id ||
                                                            auth()->user()->isAdmin() ||
                                                            (auth()->user()->isTeacher() && $course->teacher_id == auth()->id()))
                                                            <form action="{{ route('discussions.reply.destroy', [
                                                                'course' => $course->id,
                                                                'discussion' => $discussion->id,
                                                                'reply' => $reply->id
                                                            ]) }}"
                                                                  method="POST"
                                                                  class="inline"
                                                                  onsubmit="return confirm('Delete this reply?')">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-xs">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>

                                                    <p class="text-gray-700 ml-1">{{ $reply->body }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    {{-- REPLY FORM + DELETE DISCUSSION --}}
                                    <div class="mt-4">

                                        {{-- REPLY FORM --}}
                                        <form action="{{ route('discussions.reply', [
                                            'course' => $course->id,
                                            'discussion' => $discussion->id
                                        ]) }}" method="POST">

                                            @csrf

                                            <textarea name="body" rows="3"
                                                      class="w-full border rounded-lg p-3 focus:ring focus:ring-blue-300"
                                                      placeholder="Write a reply..." required></textarea>

                                            {{-- BUTTONS ROW (Side by side with separate forms) --}}
                                            <div class="flex items-center gap-3 mt-2">
                                                
                                                {{-- POST REPLY BUTTON --}}
                                                <button type="submit"
                                                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                                    Post Reply
                                                </button>

                                        </form>

                                        {{-- DELETE DISCUSSION (SEPARATE FORM - Side by side) --}}
                                        @if(auth()->id() === $discussion->user_id ||
                                            auth()->user()->isAdmin() ||
                                            (auth()->user()->isTeacher() && $course->teacher_id == auth()->id()))

                                            <form action="{{ route('discussions.destroy', [
                                                'course' => $course->id,
                                                'discussion' => $discussion->id
                                            ]) }}"
                                                  method="POST"
                                                  class="inline-block"
                                                  onsubmit="return confirm('Delete this entire discussion and all its replies?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                                    Delete Discussion
                                                </button>
                                            </form>

                                        @endif

                                            </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $discussions->links() }}
                </div>

            @else
                <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No discussions yet</h3>
                    <p class="text-gray-500 mb-6">Be the first to start a discussion for this course</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>