<header class="sticky top-0 z-40 bg-white shadow-sm">
    <div class="flex items-center justify-between h-16 px-4">
        <div class="flex items-center gap-3">
            <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                <i data-feather="menu" class="w-5 h-5 text-gray-600"></i>
            </button>
            <h1 class="text-lg font-bold text-gray-800">@yield('page_title', 'Dashboard')</h1>
        </div>
        <div class="flex items-center gap-3">
            {{-- Notif --}}
            <button class="relative p-2 rounded-lg hover:bg-gray-100 transition-colors">
                <i data-feather="bell" class="w-5 h-5 text-gray-500"></i>
                <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>
            {{-- User Dropdown --}}
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center gap-2 p-1.5 rounded-lg hover:bg-gray-100 transition-colors">
                    <div class="w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center text-white text-sm font-bold">A</div>
                    <div class="text-sm text-left hidden sm:block">
                        <div class="font-medium text-gray-700">Admin</div>
                        <div class="text-xs text-gray-400">Super Admin</div>
                    </div>
                </button>
                <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border py-1 z-50">
                    <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50"><i data-feather="user" class="w-4 h-4"></i> Profil</a>
                    <hr class="my-1">
                    <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50"><i data-feather="log-out" class="w-4 h-4"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>
