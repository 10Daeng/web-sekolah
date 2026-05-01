@extends('layouts.app')

@section('title', 'Login')

@section('content')
<section class="bg-gradient-to-r from-primary-700 to-primary-900 py-16">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-3xl lg:text-4xl font-extrabold text-white mb-3">Masuk ke Akun</h1>
        <p class="text-primary-200 max-w-xl mx-auto">Login untuk mengakses dashboard dan layanan sekolah</p>
    </div>
</section>

<section class="py-12">
    <div class="max-w-md mx-auto px-4">
        <div class="bg-white rounded-2xl shadow-sm border p-8">
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm"
                           placeholder="email@example.com">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                    <input type="password" name="password" required
                           class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm"
                           placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-primary-600 rounded border-gray-300 focus:ring-primary-500">
                        Ingat saya
                    </label>
                </div>

                <button type="submit" class="w-full bg-primary-600 text-white font-semibold px-6 py-3 rounded-xl hover:bg-primary-700 transition-colors shadow-md">
                    Masuk
                </button>
            </form>

            <div class="mt-6 text-center text-sm text-gray-500">
                <p>Admin / Guru? Silakan login melalui <a href="/admin/login" class="text-primary-600 font-medium hover:underline">Panel Admin</a></p>
            </div>
        </div>
    </div>
</section>
@endsection
