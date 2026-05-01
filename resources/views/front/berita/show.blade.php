@extends('layouts.app')

@section('title', $post->title)

@section('content')
<section class="py-12">
    <div class="max-w-4xl mx-auto px-4">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-primary-600">Beranda</a>
            <span>/</span>
            <a href="{{ route('berita.index') }}" class="hover:text-primary-600">Berita</a>
            <span>/</span>
            <span class="text-gray-400 line-clamp-1">{{ $post->title }}</span>
        </nav>

        {{-- Article --}}
        <article>
            {{-- Header --}}
            <div class="mb-8">
                <div class="flex items-center gap-2 mb-4">
                    <span class="bg-green-50 text-green-600 text-xs font-semibold px-3 py-1 rounded-full">{{ $post->category }}</span>
                    <span class="text-xs text-gray-400">{{ $post->published_at?->locale('id')->isoFormat('dddd, D MMMM Y') }}</span>
                </div>
                <h1 class="text-2xl lg:text-4xl font-extrabold text-gray-900 leading-tight">{{ $post->title }}</h1>
                <div class="flex items-center gap-3 mt-4 text-sm text-gray-500">
                    <div class="flex items-center gap-1.5">
                        <i data-feather="user" class="w-4 h-4"></i>
                        <span>{{ $post->author?->name ?? 'Admin' }}</span>
                    </div>
                </div>
            </div>

            {{-- Featured Image --}}
            <div class="rounded-2xl overflow-hidden mb-8 shadow-md">
                <img src="{{ $post->getFirstMediaUrl('featured_image') ?: 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=1200' }}" alt="{{ $post->title }}" class="w-full h-80 lg:h-96 object-cover">
            </div>

            {{-- Content --}}
            <div class="prose prose-gray max-w-none text-gray-700 leading-relaxed text-base space-y-4">
                {!! $post->content !!}
            </div>

            {{-- Tags --}}
            <div class="flex flex-wrap gap-2 mt-8 pt-6 border-t">
                <span class="text-sm font-medium text-gray-700">Tags:</span>
                <span class="bg-gray-100 text-gray-600 text-xs px-3 py-1 rounded-full">OSN</span>
                <span class="bg-gray-100 text-gray-600 text-xs px-3 py-1 rounded-full">Prestasi</span>
                <span class="bg-gray-100 text-gray-600 text-xs px-3 py-1 rounded-full">Olimpiade</span>
                <span class="bg-gray-100 text-gray-600 text-xs px-3 py-1 rounded-full">Siswa Berprestasi</span>
            </div>

            {{-- Share --}}
            <div class="flex items-center gap-3 mt-6">
                <span class="text-sm font-medium text-gray-700">Bagikan:</span>
                <a href="#" class="w-9 h-9 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center hover:bg-blue-200 transition-colors"><i data-feather="facebook" class="w-4 h-4"></i></a>
                <a href="#" class="w-9 h-9 bg-sky-100 text-sky-600 rounded-lg flex items-center justify-center hover:bg-sky-200 transition-colors"><i data-feather="twitter" class="w-4 h-4"></i></a>
                <a href="#" class="w-9 h-9 bg-green-100 text-green-600 rounded-lg flex items-center justify-center hover:bg-green-200 transition-colors"><i data-feather="message-circle" class="w-4 h-4"></i></a>
            </div>
        </article>

        {{-- Related Articles --}}
        <div class="mt-16">
            <h2 class="text-2xl font-extrabold text-gray-900 mb-6">Berita Terkait</h2>
            <div class="grid sm:grid-cols-3 gap-6">
                @forelse($relatedPosts as $rp)
                <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                    <div class="aspect-video bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center">
                        <i data-feather="book-open" class="w-10 h-10 text-white opacity-50"></i>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-xs font-medium text-primary-600 bg-primary-50 px-2 py-0.5 rounded">{{ $rp->category }}</span>
                            <span class="text-xs text-gray-400">{{ $rp->published_at?->format('d M Y') }}</span>
                        </div>
                        <a href="{{ route('berita.show', $rp->slug) }}" class="font-bold text-gray-900 text-sm line-clamp-2 hover:text-primary-600 transition-colors">{{ $rp->title }}</a>
                    </div>
                </article>
                @empty
                <p class="text-gray-500 text-sm col-span-3">Tidak ada berita terkait.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
