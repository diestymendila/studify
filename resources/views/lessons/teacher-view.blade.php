<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <div class="mb-6">
                    <a href="{{ route('profile.show') }}" class="text-blue-600 hover:text-blue-800 mb-4 inline-flex items-center font-semibold transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Profile
                    </a>
                    <h2 class="text-3xl font-bold text-gray-900 mt-4">{{ $course->name }}</h2>
                    <p class="text-gray-600 mt-2">Student Progress Overview</p>
                </div>

                @if($studentsProgress && $studentsProgress->count() > 0)
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm text-blue-800">
                            <strong>{{ $studentsProgress->count() }}</strong> student(s) enrolled in this course
                        </span>
                    </div>
                </div>

                <div class="overflow-x-auto shadow-md rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-blue-500 to-blue-600">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Student</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Email</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Progress</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Completed</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($studentsProgress as $student)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold shadow-md">
                                                {{ strtoupper(substr($student['name'], 0, 1)) }}
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900">{{ $student['name'] }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-600">{{ $student['email'] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-32 bg-gray-200 rounded-full h-3 mr-3 shadow-inner">
                                            <div class="bg-gradient-to-r from-blue-400 to-blue-600 h-3 rounded-full transition-all duration-500 shadow-sm" style="width: {{ $student['progress'] }}%"></div>
                                        </div>
                                        <span class="text-sm font-bold text-gray-700 min-w-[45px]">{{ number_format($student['progress'], 0) }}%</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $student['progress'] == 100 ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ $student['completed_contents'] }}/{{ $student['total_contents'] }} lessons
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Summary Statistics -->
                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-lg p-4">
                        <div class="text-sm font-semibold text-blue-800 mb-1">Average Progress</div>
                        <div class="text-2xl font-bold text-blue-900">
                            {{ number_format($studentsProgress->avg('progress'), 1) }}%
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-lg p-4">
                        <div class="text-sm font-semibold text-green-800 mb-1">Completed Students</div>
                        <div class="text-2xl font-bold text-green-900">
                            {{ $studentsProgress->where('progress', 100)->count() }}
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 border border-yellow-200 rounded-lg p-4">
                        <div class="text-sm font-semibold text-yellow-800 mb-1">In Progress</div>
                        <div class="text-2xl font-bold text-yellow-900">
                            {{ $studentsProgress->where('progress', '>', 0)->where('progress', '<', 100)->count() }}
                        </div>
                    </div>
                </div>
                @else
                <div class="text-center py-20 bg-gray-50 rounded-lg">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <h4 class="text-xl font-semibold text-gray-600 mb-2">No students enrolled yet</h4>
                    <p class="text-gray-500">Students will appear here once they enroll in this course</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .gradient-bg {
        background: linear-gradient(135deg, #2a9df4 0%, #ffffff 100%);
    }
</style>