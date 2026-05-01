@php
$navLinks = [
    ['label' => 'Beranda', 'route' => 'home', 'icon' => 'home'],
    ['label' => 'Profil', 'route' => 'profil', 'icon' => 'info'],
    ['label' => 'Berita', 'route' => 'berita.index', 'icon' => 'book-open'],
    ['label' => 'Galeri', 'route' => 'galeri', 'icon' => 'image'],
    ['label' => 'Kalender', 'route' => 'kalender', 'icon' => 'calendar'],
    ['label' => 'PPDB', 'route' => 'ppdb.index', 'icon' => 'user-plus'],
];

$currentRoute = request()->route()->getName() ?? 'home';
@endphp

<nav x-data="mobileMenu" class="bg-white shadow-md sticky top-0 z-50">
    {{-- Top Bar --}}
    <div class="bg-primary-800 text-white text-xs py-1.5 hidden lg:block">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <span class="flex items-center gap-1.5">
                    <i data-feather="phone" class="w-3 h-3"></i> {{ config('app.sekolah.telp', '(021) 1234-5678') }}
                </span>
                <span class="flex items-center gap-1.5">
                    <i data-feather="mail" class="w-3 h-3"></i> {{ config('app.sekolah.email', 'info@sekolah.sch.id') }}
                </span>
            </div>
            <div class="flex items-center gap-3">
                <span>{{ config('app.sekolah.alamat_singkat', 'Jl. Pendidikan No. 1, Jakarta') }}</span>
            </div>
        </div>
    </div>

    {{-- Main Navbar --}}
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            {{-- Logo & Nama Sekolah --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 bg-primary-600 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-md group-hover:bg-primary-700 transition-colors">
                    {{ config('app.sekolah.logo_initials', 'S') }}
                </div>
                <div class="hidden sm:block">
                    <div class="font-bold text-gray-800 text-sm leading-tight">{{ config('app.sekolah.nama_pendek', 'SDN CONTOH') }}</div>
                    <div class="text-xs text-gray-500">{{ config('app.sekolah.tagline', 'Unggul, Mandiri, Berprestasi') }}</div>
                </div>
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden lg:flex items-center gap-1">
                @foreach($navLinks as $link)
                <a href="{{ route($link['route']) }}"
                   class="px-3 py-2 rounded-lg text-sm font-medium transition-colors
                          {{ $currentRoute === $link['route']
                             ? 'bg-primary-50 text-primary-700'
                             : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    {{ $link['label'] }}
                </a>
                @endforeach
            </div>

            {{-- Auth Buttons (Desktop) --}}
            <div class="hidden lg:flex items-center gap-2">
                @auth
                    <a href="{{ url('/admin') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-700 transition-colors shadow-sm">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('ppdb.daftar') }}" class="bg-gradient-to-r from-accent-500 to-accent-600 text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:from-accent-600 hover:to-accent-700 transition-all shadow-md hover:shadow-lg">
                        Daftar PPDB
                    </a>
                @endauth
            </div>

            {{-- Mobile Menu Button --}}
            <button @click="toggle()" class="lg:hidden p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                <i data-feather="menu" x-show="!open" class="w-6 h-6"></i>
                <i data-feather="x" x-show="open" class="w-6 h-6"></i>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="lg:hidden border-t bg-white">
        <div class="px-4 py-3 space-y-1">
            @foreach($navLinks as $link)
            <a href="{{ route($link['route']) }}"
               @click="close()"
               class="flex items-center gap-3 px-3 py-3 rounded-lg text-sm font-medium transition-colors
                      {{ $currentRoute === $link['route']
                         ? 'bg-primary-50 text-primary-700'
                         : 'text-gray-600 hover:bg-gray-100' }}">
                <i data-feather="{{ $link['icon'] }}" class="w-4 h-4"></i>
                {{ $link['label'] }}
            </a>
            @endforeach
            <div class="pt-2">
                @auth
                    <a href="{{ url('/admin') }}" class="block text-center bg-primary-600 text-white px-4 py-3 rounded-lg text-sm font-medium hover:bg-primary-700 transition-colors">
                        Dashboard Admin
                    </a>
                @else
                    <a href="{{ route('ppdb.daftar') }}" class="block text-center bg-gradient-to-r from-accent-500 to-accent-600 text-white px-4 py-3 rounded-lg text-sm font-semibold">
                        Daftar PPDB Sekarang
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
