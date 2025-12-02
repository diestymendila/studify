<x-app-layout>
    <style>
        .custom-gradient-bg {
            background-image: linear-gradient(135deg, #1e7ac4 0%, #2a9df4 100%);
        }
        .custom-gradient-text {
            color: #1e7ac4;
        }
        .custom-gradient-border {
            border-color: #1e7ac4;
        }
    </style>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detail Kursus: {{ $course->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                
                <!-- Header Section -->
                <div class="custom-gradient-bg p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-2xl font-bold text-white mb-2">{{ $course->name }}</h3>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $course->is_active ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                {{ $course->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="p-6 border-b border-gray-200">
                    <h4 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                        <span class="w-1 h-5 custom-gradient-bg mr-2"></span>
                        Deskripsi Kursus
                    </h4>
                    <p class="text-gray-700 leading-relaxed">{{ $course->description }}</p>
                </div>

                <!-- Course Details Grid -->
                <div class="p-6 border-b border-gray-200">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <span class="w-1 h-5 custom-gradient-bg mr-2"></span>
                        Informasi Kursus
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Teacher -->
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <div class="custom-gradient-bg p-2 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <span class="text-xs text-gray-600 block">Pengajar</span>
                                <span class="font-semibold text-gray-900">{{ $course->teacher->name }}</span>
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <div class="custom-gradient-bg p-2 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <div>
                                <span class="text-xs text-gray-600 block">Kategori</span>
                                <span class="font-semibold text-gray-900">{{ $course->category->name }}</span>
                            </div>
                        </div>

                        <!-- Start Date -->
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <div class="custom-gradient-bg p-2 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <span class="text-xs text-gray-600 block">Tanggal Mulai</span>
                                <span class="font-semibold text-gray-900">{{ $course->start_date->format('d M Y') }}</span>
                            </div>
                        </div>

                        <!-- End Date -->
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <div class="custom-gradient-bg p-2 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <span class="text-xs text-gray-600 block">Tanggal Selesai</span>
                                <span class="font-semibold text-gray-900">{{ $course->end_date->format('d M Y') }}</span>
                            </div>
                        </div>

                        <!-- Enrolled Students -->
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <div class="custom-gradient-bg p-2 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <span class="text-xs text-gray-600 block">Jumlah Siswa</span>
                                <span class="font-semibold text-gray-900">{{ $course->students->count() }} Siswa</span>
                            </div>
                        </div>

                        <!-- Total Lessons -->
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <div class="custom-gradient-bg p-2 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <div>
                                <span class="text-xs text-gray-600 block">Total Materi</span>
                                <span class="font-semibold text-gray-900">{{ $course->contents->count() }} Materi</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Contents Section -->
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                            <span class="w-1 h-5 custom-gradient-bg mr-2"></span>
                            Materi Kursus
                        </h4>
                        <a href="{{ route('contents.create', $course->id) }}" class="custom-gradient-bg hover:opacity-90 text-white px-4 py-2 rounded-lg text-sm font-semibold transition flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Materi
                        </a>
                    </div>
                    
                    @if($course->contents->count() > 0)
                        <div class="space-y-3">
                            @foreach($course->contents as $content)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition border border-gray-200">
                                    <div class="flex items-center flex-1">
                                        <span class="custom-gradient-bg text-white rounded-full w-10 h-10 flex items-center justify-center font-bold mr-4 flex-shrink-0">
                                            {{ $content->order }}
                                        </span>
                                        <div class="flex-1">
                                            <h5 class="font-semibold text-gray-900 mb-1">{{ $content->title }}</h5>
                                            <p class="text-sm text-gray-600">{{ Str::limit(strip_tags($content->body), 100) }}</p>
                                        </div>
                                    </div>
                                    <div class="flex gap-2 ml-4">
                                        <a href="{{ route('contents.edit', [$course->id, $content->id]) }}" class="custom-gradient-text hover:opacity-80 px-3 py-2 rounded-lg font-medium border custom-gradient-border hover:bg-blue-50 transition text-sm">
                                            Edit
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p class="text-gray-600 mb-4 font-medium">Belum ada materi yang ditambahkan</p>
                            <a href="{{ route('contents.create', $course->id) }}" class="inline-flex items-center custom-gradient-bg hover:opacity-90 text-white px-6 py-3 rounded-lg font-semibold transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Tambah Materi Pertama
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="p-6 bg-gray-50 border-t border-gray-200">
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('courses.edit', $course) }}" class="custom-gradient-bg hover:opacity-90 text-white px-6 py-3 rounded-lg font-semibold transition inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Kursus
                        </a>
                        
                        <a href="{{ route('courses.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold transition inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"></path>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer style="background: linear-gradient(135deg, #1e7ac4 0%, #2a9df4 100%);" 
        class="text-white py-2 fixed inset-x-0 bottom-0 z-50">
    <div class="max-w-7xl mx-auto px-8 text-center">
        <p class="text-sm">&copy; 2025 Studify. All rights reserved.</p>
    </div>
    </footer>
</x-app-layout>