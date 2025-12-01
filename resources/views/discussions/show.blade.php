<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- Back Button --}}
            <a href="{{ route('discussions.index', $course->id) }}"
               class="inline-flex mb-4 items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm">
                ← Back to Discussions
            </a>

            {{-- Discussion Header --}}
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-600 text-white text-lg font-bold">
                        {{ strtoupper(substr($discussion->user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold">{{ $discussion->title }}</h2>
                        <p class="text-sm text-gray-500">
                            By {{ $discussion->user->name }} • {{ $discussion->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>

                <p class="text-gray-700 mt-2">{{ $discussion->body }}</p>
            </div>

            {{-- Replies Section --}}
            <div class="mt-6 bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Replies ({{ $discussion->replies->count() }})</h3>

                {{-- List all replies --}}
                @forelse ($discussion->replies as $reply)
                <div class="border-b py-4">
                    <div class="flex gap-3 items-start">
                        <div class="w-9 h-9 rounded-full bg-green-600 text-white flex items-center justify-center font-bold">
                            {{ strtoupper(substr($reply->user->name, 0, 1)) }}
                        </div>

                        <div class="flex-1">
                            <div class="flex justify-between">
                                <p class="font-semibold">
                                    {{ $reply->user->name }}
                                </p>
                                <small class="text-gray-500">
                                    {{ $reply->created_at->diffForHumans() }}
                                </small>
                            </div>

                            <p class="text-gray-700 mt-1">{{ $reply->reply }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-gray-500">Belum ada balasan.</p>
                @endforelse
            </div>

            {{-- Reply Form --}}
            <div class="mt-6 bg-white shadow rounded-lg p-6">
                <h3 class="font-semibold text-lg mb-3">Add a Reply</h3>

                <form method="POST" action="{{ route('discussions.reply', [$course->id, $discussion->id]) }}">
                    @csrf

                    <textarea name="reply" rows="4"
                        class="w-full border-gray-300 rounded-lg"
                        placeholder="Write your reply..."></textarea>

                    <button type="submit"
                        class="mt-3 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Submit Reply
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
