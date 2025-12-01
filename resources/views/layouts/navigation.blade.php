<nav x-data="{ open: false }" class="nav-bg border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-xl font-bold text-white">
                        STUDIFY
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @auth
                        <x-nav-link :href="route('dashboard')" 
                                    :active="request()->routeIs('dashboard')" 
                                    class="text-white hover:text-black">
                            Dashboard
                        </x-nav-link>
                    @endauth

                    @if(auth()->check() && auth()->user()->role === 'student')
                        <x-nav-link :href="route('courses.catalog')" 
                                    :active="request()->routeIs('courses.catalog')" 
                                    class="text-white hover:text-black">
                            Catalog Courses 
                        </x-nav-link>
                    @endif

                    @if(auth()->check() && in_array(auth()->user()->role, ['teacher','admin']))
                        <x-nav-link :href="route('courses.index')" 
                                    :active="request()->routeIs('courses.index') || (request()->routeIs('courses.*') && !request()->routeIs('courses.catalog'))" 
                                    class="text-white hover:text-black">
                            Manage Courses
                        </x-nav-link>
                    @endif

                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <x-nav-link :href="route('admin.users.index')" 
                                    :active="request()->routeIs('admin.users.*')" 
                                    class="text-white hover:text-black">
                            Users
                        </x-nav-link>

                        <x-nav-link :href="route('admin.categories.index')" 
                                    :active="request()->routeIs('admin.categories.*')" 
                                    class="text-white hover:text-black">
                            Categories
                        </x-nav-link>
                    @endif
                </div>
            </div>

            @auth
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent 
                        text-sm leading-4 font-medium rounded-md text-white dropdown-btn 
                        focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" 
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 
                                          111.414 1.414l-4 4a1 1 0 
                                          01-1.414 0l-4-4a1 1 0-1.414z" 
                                          clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.show')">
                            Profile
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('profile.edit')">
                            Edit Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            @endauth

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" 
                        class="inline-flex items-center justify-center p-2 rounded-md text-white 
                        hover:text-gray-200 hamburger-btn focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" 
                              class="inline-flex" stroke-linecap="round" 
                              stroke-linejoin="round" stroke-width="2" 
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" 
                              class="hidden" stroke-linecap="round" 
                              stroke-linejoin="round" stroke-width="2" 
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-blue-900">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                <x-responsive-nav-link :href="route('dashboard')" 
                    :active="request()->routeIs('dashboard')"
                    class="mobile-link">
                    Dashboard
                </x-responsive-nav-link>

                @if(auth()->user()->role === 'student')
                    <x-responsive-nav-link :href="route('courses.catalog')" 
                        :active="request()->routeIs('courses.catalog')"
                        class="mobile-link">
                        Catalog Courses
                    </x-responsive-nav-link>
                @endif

                @if(in_array(auth()->user()->role, ['teacher','admin']))
                    <x-responsive-nav-link :href="route('courses.index')" 
                        :active="request()->routeIs('courses.index')"
                        class="mobile-link">
                        Manage Courses
                    </x-responsive-nav-link>
                @endif

                @if(auth()->user()->role === 'admin')
                    <x-responsive-nav-link :href="route('admin.users.index')" 
                        :active="request()->routeIs('admin.users.*')"
                        class="mobile-link">
                        Users
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('admin.categories.index')" 
                        :active="request()->routeIs('admin.categories.*')"
                        class="mobile-link">
                        Categories
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        @auth
        <div class="pt-4 pb-1 border-t border-blue-400">
            <div class="px-4 text-white">
                <div class="font-medium text-base">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-200">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.show')" class="mobile-link">
                    Profile
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('profile.edit')" class="mobile-link">
                    Edit Profile
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="mobile-link">
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>

<style>
    .nav-bg {
        background: linear-gradient(135deg, #2a9df4 0%, #1e7ac4 100%);
    }
    .dropdown-btn {
        background-color: rgba(255, 255, 255, 0.1);
    }
    .dropdown-btn:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }

    .mobile-link {
        color: white !important;
    }
    .mobile-link:hover {
        color: black !important;
        background-color: rgba(255, 255, 255, 0.5);
    }

    .hamburger-btn:hover,
    .hamburger-btn:focus {
        background-color: rgba(255, 255, 255, 0.15);
    }
</style>
