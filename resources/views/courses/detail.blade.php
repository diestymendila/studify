<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->title ?? 'Course Detail' }} - Platform Kursus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .main-content {
            flex: 1;
        }
        .bg-primary {
            background-color: #2563eb;
        }
        .text-primary {
            color: #2563eb;
        }
        .border-primary {
            border-color: #2563eb;
        }
        .hover-primary:hover {
            background-color: #1d4ed8;
        }
        .btn-primary {
            background-color: #2563eb;
            color: white;
            transition: all 0.3s;
            text-align: center;
        }
        .btn-primary:hover {
            background-color: #1d4ed8;
        }
        .course-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 500;
        }
        .lock-icon {
            color: #9ca3af;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="bg-primary shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-14">
                <div class="flex items-center">
                    <a href="#" class="text-base font-semibold text-white">Platform Kursus</a>
                </div>
                <div class="flex items-center space-x-2">
                    <a href="#" class="text-white hover:text-gray-200 px-3 py-1.5 text-sm">Login</a>
                    <a href="#" class="bg-white text-primary hover:bg-gray-100 px-3 py-1.5 rounded text-sm font-medium">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <!-- Back Button -->
            <div class="mb-3">
                @if(Route::has('home'))
                <a href="{{ route('home') }}" class="text-primary hover:text-blue-700 flex items-center text-sm">
                @elseif(Route::has('courses.index'))
                <a href="{{ route('courses.index') }}" class="text-primary hover:text-blue-700 flex items-center text-sm">
                @else
                <a href="/" class="text-primary hover:text-blue-700 flex items-center text-sm">
                @endif
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali ke Daftar Kursus
                </a>
            </div>

            <!-- Course Card -->
            <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
                <!-- Course Header with Blue Background -->
                <div class="bg-primary px-5 py-4">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="course-badge bg-white text-primary">
                            {{ strtoupper($course->category->name ?? 'COURSE') }}
                        </span>
                        <span class="course-badge {{ $course->status === 'active' ? 'bg-green-500' : 'bg-gray-500' }} text-white">
                            {{ $course->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </div>
                    <h1 class="text-xl font-bold text-white mb-2">{{ $course->name ?? $course->title }}</h1>
                    
                    <div class="flex flex-wrap items-center gap-4 text-xs text-white">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>{{ $course->teacher->name ?? 'Teacher' }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <span>{{ $course->students_count ?? 0 }} Siswa</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <span>{{ isset($course->contents) ? $course->contents->count() : 0 }} Materi</span>
                        </div>
                    </div>
                </div>

                <!-- Course Body -->
                <div class="px-6 py-5">
                    <!-- About Section -->
                    <div class="mb-6 mt-2">
                        <h2 class="text-base font-bold text-gray-900 mb-2">Tentang Kursus Ini</h2>
                        <p class="text-gray-700 text-sm leading-relaxed">{{ $course->description ?? 'Tidak ada deskripsi tersedia' }}</p>
                    </div>

                    <!-- Duration Section -->
                    <div class="mb-6 pb-6 border-b border-gray-200">
                        <h2 class="text-base font-bold text-gray-900 mb-3">Durasi Kursus</h2>
                        <div class="flex items-center text-gray-700">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-sm">
                                @if($course->start_date && $course->end_date)
                                    {{ \Carbon\Carbon::parse($course->start_date)->format('d M Y') }} - 
                                    {{ \Carbon\Carbon::parse($course->end_date)->format('d M Y') }}
                                @else
                                    Tidak ada jadwal
                                @endif
                            </span>
                        </div>
                    </div>

                    <!-- Course Materials Section -->
                    <div class="mb-6 pb-6 border-b border-gray-200">
                        <h2 class="text-base font-bold text-gray-900 mb-3">Materi Pembelajaran</h2>
                        
                        @if($course->contents && $course->contents->count() > 0)
                            <div class="space-y-2">
                                @foreach($course->contents->sortBy('order') as $index => $content)
                                <div class="flex items-start py-2">
                                    <div class="flex items-start flex-1">
                                        <span class="text-gray-900 font-semibold text-sm mr-3 flex-shrink-0 mt-0.5">
                                            {{ $index + 1 }}
                                        </span>
                                        <span class="text-sm text-gray-900">{{ $content->title }}</span>
                                    </div>
                                    @if($isEnrolled ?? false)
                                        @php
                                            $isCompleted = false;
                                            if (auth()->check()) {
                                                $completion = DB::table('content_completions')
                                                    ->where('content_id', $content->id)
                                                    ->where('user_id', auth()->id())
                                                    ->first();
                                                $isCompleted = $completion !== null;
                                            }
                                        @endphp
                                        @if($isCompleted)
                                        <span class="text-green-600 flex items-center text-sm font-medium">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                        @endif
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-6 text-gray-500 text-sm">
                                Belum ada materi yang tersedia
                            </div>
                        @endif
                    </div>

                    <!-- Locked Section (shown when not enrolled) -->
                    @auth
                        @if(auth()->user()->role === 'student' && !($isEnrolled ?? false))
                        <div class="py-8 text-center">
                            <div class="mb-5">
                                <div class="lock-icon mb-3">
                                    <svg class="w-14 h-14 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <p class="text-gray-700 text-sm">Daftar ke kursus ini untuk mengakses semua materi</p>
                            </div>
                            @if(Route::has('course.enroll'))
                            <div class="flex justify-center">
                                <form action="{{ route('course.enroll', $course->id) }}" method="POST" class="w-full max-w-md">
                                    @csrf
                                    <button type="submit" class="w-full btn-primary px-6 py-3 rounded text-sm font-medium">
                                        Daftar Kursus
                                    </button>
                                </form>
                            </div>
                            @else
                            <div class="flex justify-center">
                                <button type="button" class="w-full max-w-md btn-primary px-6 py-3 rounded text-sm font-medium">
                                    Daftar Kursus
                                </button>
                            </div>
                            @endif
                        </div>
                        @endif
                    @else
                        <div class="py-8 text-center">
                            <div class="mb-5">
                                <div class="lock-icon mb-3">
                                    <svg class="w-14 h-14 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <p class="text-gray-700 text-sm">Silakan login untuk mendaftar di kursus ini</p>
                            </div>
                            <div class="flex justify-center">
                                @if(Route::has('login'))
                                <a href="{{ route('login') }}" class="block w-full max-w-md btn-primary px-6 py-3 rounded text-sm font-medium">
                                    Login untuk Mendaftar
                                </a>
                                @else
                                <a href="#" class="block w-full max-w-md btn-primary px-6 py-3 rounded text-sm font-medium">
                                    Login untuk Mendaftar
                                </a>
                                @endif
                            </div>
                        </div>
                    @endauth

                    <!-- Enrolled Actions -->
                    @auth
                        @if(auth()->user()->role === 'student' && ($isEnrolled ?? false))
                        <div class="pt-5 pb-6 border-b border-gray-200">
                            <div class="flex flex-wrap gap-2">
                                @if(Route::has('lesson.show'))
                                <a href="{{ route('lesson.show', $course->id) }}" class="flex-1 text-center btn-primary px-5 py-2 rounded text-sm font-medium">
                                    Lanjutkan Belajar
                                </a>
                                @endif

                                @if(Route::has('discussions.index'))
                                <a href="{{ route('discussions.index', $course->id) }}" class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded text-sm font-medium transition">
                                    Forum Diskusi
                                </a>
                                @endif

                                @if(Route::has('course.unenroll'))
                                <form action="{{ route('course.unenroll', $course->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin keluar dari kursus ini?')" class="w-full bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded text-sm font-medium transition">
                                        Keluar dari Kursus
                                    </button>
                                </form>
                                @endif
                            </div>

                            <!-- Progress Section -->
                            @if(isset($progress))
                            <div class="mt-4 p-3 bg-blue-50 rounded border border-blue-200">
                                <div class="flex justify-between items-center mb-1.5">
                                    <span class="text-xs font-medium text-gray-700">Progress Anda</span>
                                    <span class="text-xs font-bold text-primary">{{ number_format($progress, 0) }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                    <div class="bg-primary h-2 rounded-full transition-all duration-300" style="width: {{ $progress }}%"></div>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endif
                    @endauth
                </div>

                <!-- Teacher Contact Section -->
                <div class="px-6 pb-6 pt-6 border-t border-gray-200">
                    <h3 class="text-sm font-bold text-gray-900 mb-3">Hubungi Pengajar</h3>
                    <div class="flex items-start justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white font-bold text-base mr-3 flex-shrink-0">
                                {{ strtoupper(substr($course->teacher->name ?? 'T', 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900 text-sm">{{ $course->teacher->name ?? 'Teacher' }}</p>
                                <p class="text-xs text-gray-600">{{ $course->category->name ?? 'Course' }} Mentor</p>
                            </div>
                        </div>
                        @if(isset($course->teacher) && $course->teacher->phone)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $course->teacher->phone) }}" target="_blank" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-xs font-medium border border-green-600 transition flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                            Chat WhatsApp
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white py-4 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm text-white-400">&copy; 2025 Studify. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>