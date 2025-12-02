<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Admin Dashboard</h2>
                <p class="text-gray-600 mt-2">Manage your platform and monitor statistics</p>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

                <!-- Total Users -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg p-6 stat-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Total Users</h3>
                            <p class="text-4xl font-bold stat-number">{{ $stats['total_users'] }}</p>
                        </div>
                        <div class="stat-icon-bg">
                            <svg class="w-12 h-12 stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Courses -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg p-6 stat-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Total Courses</h3>
                            <p class="text-4xl font-bold stat-number">{{ $stats['total_courses'] }}</p>
                        </div>
                        <div class="stat-icon-bg">
                            <svg class="w-12 h-12 stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Teachers -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg p-6 stat-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Total Teachers</h3>
                            <p class="text-4xl font-bold stat-number">{{ $stats['total_teachers'] }}</p>
                        </div>
                        <div class="stat-icon-bg">
                            <svg class="w-12 h-12 stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Students -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg p-6 stat-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Total Students</h3>
                            <p class="text-4xl font-bold stat-number">{{ $stats['total_students'] }}</p>
                        </div>
                        <div class="stat-icon-bg">
                            <svg class="w-12 h-12 stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                <path
                                    d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-lg rounded-lg p-6">
                <h3 class="text-xl font-bold mb-6 text-gray-800">Quick Actions</h3>
                <div class="space-y-4">

                    <!-- Users -->
                    <div class="action-card rounded-lg p-5 border border-gray-200 transition">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center flex-1">
                                <div class="action-icon-wrapper mr-4">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-base action-title mb-1">Manage Users</h4>
                                    <p class="text-sm text-gray-600">Add, edit, or remove users</p>
                                </div>
                            </div>
                            <a href="{{ route('admin.users.index') }}" class="action-button px-5 py-2 rounded-lg text-sm font-semibold whitespace-nowrap ml-4">
                                View All Users →
                            </a>
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="action-card rounded-lg p-5 border border-gray-200 transition">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center flex-1">
                                <div class="action-icon-wrapper mr-4">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-base action-title mb-1">Manage Categories</h4>
                                    <p class="text-sm text-gray-600">Category management</p>
                                </div>
                            </div>
                            <a href="{{ route('admin.categories.index') }}" class="action-button px-5 py-2 rounded-lg text-sm font-semibold whitespace-nowrap ml-4">
                                View All Categories →
                            </a>
                        </div>
                    </div>

                    <!-- Courses -->
                    <div class="action-card rounded-lg p-5 border border-gray-200 transition">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center flex-1">
                                <div class="action-icon-wrapper mr-4">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                        </path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-base action-title mb-1">Manage Courses</h4>
                                    <p class="text-sm text-gray-600">View and manage courses</p>
                                </div>
                            </div>
                            <a href="{{ route('courses.index') }}" class="action-button px-5 py-2 rounded-lg text-sm font-semibold whitespace-nowrap ml-4">
                                View All Courses →
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        .nav-bg {
            background: linear-gradient(135deg, #1e7ac4 0%, #2a9df4 100%) !important;
        }

        .action-button {
            background: linear-gradient(135deg, #1e7ac4 0%, #2a9df4 100%);
            color: white;
            border: 2px solid transparent;
            transition: all .2s ease;
        }

        .action-button:hover {
            background: linear-gradient(135deg, #2a9df4 0%, #1e7ac4 100%);
            transform: translateX(2px);
        }

        .stat-card {
            border-left: 4px solid #1e7ac4;
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(30, 122, 196, 0.15);
            border-left-width: 6px;
        }
        .stat-number {
            color: #1e7ac4;
        }
        .stat-icon-bg {
            background: linear-gradient(135deg, #e0f7fa 0%, #b3e5fc 100%); 
            padding: 14px;
            border-radius: 12px;
        }
        .stat-icon {
            color: #1e7ac4;
        }

        .action-card {
            background-color: #fafbfc;
            transition: all 0.3s ease;
        }
        .action-card:hover {
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(30, 122, 196, 0.12);
            border-color: #1e7ac4;
            transform: translateX(4px);
        }

        .action-title {
            color: #1e7ac4;
        }

        .action-icon-wrapper {
            color: #1e7ac4;
            background: linear-gradient(135deg, #e0f7fa 0%, #b3e5fc 100%);
            padding: 10px;
            border-radius: 10px;
            flex-shrink: 0;
        }
    </style>

    <footer style="background: linear-gradient(135deg, #1e7ac4 0%, #2a9df4 100%);" 
        class="text-white py-2 fixed inset-x-0 bottom-0 z-50">
    <div class="max-w-7xl mx-auto px-8 text-center">
        <p class="text-sm">&copy; 2025 Studify. All rights reserved.</p>
    </div>
    </footer>
</x-app-layout>