<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'" class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-900 text-gray-300 transform transition-transform duration-300 lg:relative lg:z-auto flex flex-col">
    {{-- Logo --}}
    <div class="h-16 flex items-center gap-3 px-5 border-b border-gray-800">
        <div class="w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">S</div>
        <span class="font-bold text-white text-sm" x-show="sidebarOpen">{{ config('app.sekolah.nama_pendek', 'Admin SIST') }}</span>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
        @php $adminMenu = [
            ['label' => 'Dashboard', 'icon' => 'grid', 'route' => 'admin.dashboard'],
            ['label' => 'Berita & Pengumuman', 'icon' => 'book-open', 'route' => 'admin.posts.index'],
            ['label' => 'Galeri', 'icon' => 'image', 'route' => 'admin.albums.index'],
            ['label' => 'Kalender Akademik', 'icon' => 'calendar', 'route' => 'admin.calendars.index'],
            ['label' => 'PPDB', 'icon' => 'user-plus', 'route' => 'admin.registrations.index', 'sub' => [
                ['label' => 'Pendaftar', 'route' => 'admin.registrations.index'],
                ['label' => 'Verifikasi', 'route' => 'admin.registrations.verify'],
                ['label' => 'Pengumuman', 'route' => 'admin.registrations.announcement'],
            ]],
            ['label' => 'Materi & Tugas', 'icon' => 'folder', 'route' => 'admin.documents.index'],
            ['label' => 'Prestasi', 'icon' => 'award', 'route' => 'admin.achievements.index'],
            ['label' => 'Master Data', 'icon' => 'database', 'route' => 'admin.master.index', 'sub' => [
                ['label' => 'Tahun Ajaran', 'route' => 'admin.academic-years.index'],
                ['label' => 'Kelas', 'route' => 'admin.classes.index'],
                ['label' => 'Mata Pelajaran', 'route' => 'admin.subjects.index'],
            ]],
            ['label' => 'Manajemen User', 'icon' => 'users', 'route' => 'admin.users.index'],
            ['label' => 'Pengaturan Sekolah', 'icon' => 'settings', 'route' => 'admin.settings.index'],
        ]; @endphp

        @foreach($adminMenu as $menu)
        @if(isset($menu['sub']))
        <div x-data="{ open: false }">
            <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-medium text-gray-400 hover:bg-gray-800 hover:text-white transition-colors">
                <div class="flex items-center gap-3">
                    <i data-feather="{{ $menu['icon'] }}" class="w-4 h-4"></i>
                    <span x-show="sidebarOpen">{{ $menu['label'] }}</span>
                </div>
                <i data-feather="chevron-down" class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" x-show="sidebarOpen"></i>
            </button>
            <div x-show="open" class="ml-8 mt-1 space-y-1" x-show="sidebarOpen">
                @foreach($menu['sub'] as $sub)
                <a href="{{ route($sub['route']) }}" class="block px-3 py-2 rounded-lg text-sm text-gray-500 hover:text-white hover:bg-gray-800 transition-colors">{{ $sub['label'] }}</a>
                @endforeach
            </div>
        </div>
        @else
        <a href="{{ route($menu['route']) }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-400 hover:bg-gray-800 hover:text-white transition-colors">
            <i data-feather="{{ $menu['icon'] }}" class="w-4 h-4"></i>
            <span x-show="sidebarOpen">{{ $menu['label'] }}</span>
        </a>
        @endif
        @endforeach
    </nav>

    {{-- Footer --}}
    <div class="p-4 border-t border-gray-800">
        <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 text-xs text-gray-500 hover:text-white transition-colors" x-show="sidebarOpen">
            <i data-feather="external-link" class="w-3 h-3"></i> Lihat Website
        </a>
    </div>
</aside>
