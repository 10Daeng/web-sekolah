@extends('layouts.app')
@php
$jalurOptions = ['Zonasi', 'Prestasi', 'Afirmasi', 'Mutasi'];
$agamaOptions = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
@endphp

@section('title', 'Formulir Pendaftaran PPDB')

@section('content')
{{-- Page Header --}}
<section class="bg-gradient-to-r from-accent-400 to-accent-600 py-16">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-3xl lg:text-4xl font-extrabold text-white mb-3">Formulir Pendaftaran PPDB</h1>
        <p class="text-white/80 max-w-xl mx-auto">Isi formulir berikut dengan data yang benar dan lengkap. Pastikan semua dokumen pendukung telah disiapkan.</p>
    </div>
</section>

{{-- Form --}}
<section class="py-12" x-data="ppdbForm()">
    <div class="max-w-3xl mx-auto px-4">
        {{-- Stepper --}}
        <div class="flex items-center justify-center mb-10">
            <div class="flex items-center">
                <div :class="step >= 1 ? 'bg-primary-600 text-white' : 'bg-gray-200 text-gray-500'" class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm transition-colors">1</div>
                <span :class="step >= 1 ? 'text-primary-600' : 'text-gray-400'" class="text-sm font-medium ml-2 mr-4">Data Siswa</span>
            </div>
            <div :class="step >= 2 ? 'bg-primary-600' : 'bg-gray-200'" class="w-12 h-1 transition-colors"></div>
            <div class="flex items-center">
                <div :class="step >= 2 ? 'bg-primary-600 text-white' : 'bg-gray-200 text-gray-500'" class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm transition-colors">2</div>
                <span :class="step >= 2 ? 'text-primary-600' : 'text-gray-400'" class="text-sm font-medium ml-2 mr-4">Data Orang Tua</span>
            </div>
            <div :class="step >= 3 ? 'bg-primary-600' : 'bg-gray-200'" class="w-12 h-1 transition-colors"></div>
            <div class="flex items-center">
                <div :class="step >= 3 ? 'bg-primary-600 text-white' : 'bg-gray-200 text-gray-500'" class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm transition-colors">3</div>
                <span :class="step >= 3 ? 'text-primary-600' : 'text-gray-400'" class="text-sm font-medium ml-2">Upload Berkas</span>
            </div>
        </div>

        <form @submit.prevent="submitForm" class="space-y-6">
            {{-- Step 1: Data Siswa --}}
            <div x-show="step === 1" x-transition>
                <div class="bg-white rounded-2xl shadow-sm border p-6 space-y-5">
                    <h2 class="text-xl font-extrabold text-gray-900 flex items-center gap-2">
                        <i data-feather="user" class="w-5 h-5 text-primary-600"></i> Data Calon Siswa
                    </h2>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" x-model="form.nama" placeholder="Nama lengkap sesuai akta kelahiran" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email <span class="text-gray-400 text-xs font-normal">(opsional, untuk notifikasi)</span></label>
                        <input type="email" x-model="form.email" placeholder="email@example.com" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">NISN <span class="text-red-500">*</span></label>
                            <input type="text" x-model="form.nisn" placeholder="Nomor Induk Siswa Nasional (10 digit)" maxlength="10" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">NIK <span class="text-red-500">*</span></label>
                            <input type="text" x-model="form.nik" placeholder="Nomor Induk Kependudukan (16 digit)" maxlength="16" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tempat Lahir <span class="text-red-500">*</span></label>
                            <input type="text" x-model="form.tempat_lahir" placeholder="Kota/Kabupaten" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal Lahir <span class="text-red-500">*</span></label>
                            <input type="date" x-model="form.tanggal_lahir" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <select x-model="form.jenis_kelamin" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                                <option value="">Pilih...</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Agama <span class="text-red-500">*</span></label>
                            <select x-model="form.agama" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                                <option value="">Pilih...</option>
                                @foreach($agamaOptions as $agama)
                                <option value="{{ $agama }}">{{ $agama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Anak ke- <span class="text-red-500">*</span></label>
                            <input type="number" x-model="form.anak_ke" placeholder="Anak ke berapa" min="1" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Domisili <span class="text-red-500">*</span></label>
                        <textarea x-model="form.alamat" rows="2" placeholder="Alamat lengkap sesuai KK" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm resize-none"></textarea>
                    </div>

                    <div class="grid sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">RT</label>
                            <input type="text" x-model="form.rt" placeholder="RT" maxlength="5" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">RW</label>
                            <input type="text" x-model="form.rw" placeholder="RW" maxlength="5" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kode Pos</label>
                            <input type="text" x-model="form.kode_pos" placeholder="Kode pos" maxlength="5" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Asal Sekolah (TK)</label>
                        <input type="text" x-model="form.asal_sekolah" placeholder="Nama TK asal (jika ada)" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jalur Pendaftaran <span class="text-red-500">*</span></label>
                        <select x-model="form.jalur" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                            <option value="">Pilih jalur...</option>
                            @foreach($jalurOptions as $jalur)
                            <option value="{{ $jalur }}">{{ $jalur }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- Step 2: Data Orang Tua --}}
            <div x-show="step === 2" x-transition>
                {{-- Data Ayah --}}
                <div class="bg-white rounded-2xl shadow-sm border p-6 space-y-5 mb-6">
                    <h2 class="text-xl font-extrabold text-gray-900 flex items-center gap-2">
                        <i data-feather="users" class="w-5 h-5 text-primary-600"></i> Data Ayah Kandung
                    </h2>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Ayah <span class="text-red-500">*</span></label>
                        <input type="text" x-model="form.ayah_nama" placeholder="Nama lengkap ayah" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tempat Lahir Ayah</label>
                            <input type="text" x-model="form.ayah_tempat_lahir" placeholder="Kota/Kabupaten" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal Lahir Ayah</label>
                            <input type="date" x-model="form.ayah_tanggal_lahir" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Pendidikan Ayah</label>
                            <select x-model="form.ayah_pendidikan" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                                <option value="">Pilih...</option>
                                <option value="SD">SD</option><option value="SMP">SMP</option><option value="SMA">SMA</option>
                                <option value="D3">D3</option><option value="S1">S1</option><option value="S2">S2</option><option value="S3">S3</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Pekerjaan Ayah</label>
                            <input type="text" x-model="form.ayah_pekerjaan" placeholder="Pekerjaan ayah" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Penghasilan Ayah/bulan</label>
                            <select x-model="form.ayah_penghasilan" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                                <option value="">Pilih...</option>
                                <option value="< 1jt">&lt; Rp 1.000.000</option>
                                <option value="1-3jt">Rp 1.000.000 - 3.000.000</option>
                                <option value="3-5jt">Rp 3.000.000 - 5.000.000</option>
                                <option value="5-10jt">Rp 5.000.000 - 10.000.000</option>
                                <option value="> 10jt">&gt; Rp 10.000.000</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">No HP Ayah</label>
                            <input type="tel" x-model="form.ayah_hp" placeholder="08xxxxxxxxxx" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                        </div>
                    </div>
                </div>

                {{-- Data Ibu --}}
                <div class="bg-white rounded-2xl shadow-sm border p-6 space-y-5">
                    <h2 class="text-xl font-extrabold text-gray-900 flex items-center gap-2">
                        <i data-feather="users" class="w-5 h-5 text-primary-600"></i> Data Ibu Kandung
                    </h2>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Ibu <span class="text-red-500">*</span></label>
                        <input type="text" x-model="form.ibu_nama" placeholder="Nama lengkap ibu" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tempat Lahir Ibu</label>
                            <input type="text" x-model="form.ibu_tempat_lahir" placeholder="Kota/Kabupaten" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal Lahir Ibu</label>
                            <input type="date" x-model="form.ibu_tanggal_lahir" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Pendidikan Ibu</label>
                            <select x-model="form.ibu_pendidikan" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                                <option value="">Pilih...</option>
                                <option value="SD">SD</option><option value="SMP">SMP</option><option value="SMA">SMA</option>
                                <option value="D3">D3</option><option value="S1">S1</option><option value="S2">S2</option><option value="S3">S3</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Pekerjaan Ibu</label>
                            <input type="text" x-model="form.ibu_pekerjaan" placeholder="Pekerjaan ibu" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Penghasilan Ibu/bulan</label>
                            <select x-model="form.ibu_penghasilan" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                                <option value="">Pilih...</option>
                                <option value="< 1jt">&lt; Rp 1.000.000</option>
                                <option value="1-3jt">Rp 1.000.000 - 3.000.000</option>
                                <option value="3-5jt">Rp 3.000.000 - 5.000.000</option>
                                <option value="5-10jt">Rp 5.000.000 - 10.000.000</option>
                                <option value="> 10jt">&gt; Rp 10.000.000</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">No HP Ibu</label>
                            <input type="tel" x-model="form.ibu_hp" placeholder="08xxxxxxxxxx" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Step 3: Upload Berkas --}}
            <div x-show="step === 3" x-transition>
                <div class="bg-white rounded-2xl shadow-sm border p-6 space-y-5">
                    <h2 class="text-xl font-extrabold text-gray-900 flex items-center gap-2">
                        <i data-feather="upload-cloud" class="w-5 h-5 text-primary-600"></i> Upload Dokumen
                    </h2>
                    <p class="text-sm text-gray-500">Upload scan/foto dokumen asli. Format JPG/PDF, maksimal 5MB per file.</p>

                    @php $berkasList = [
                        ['key' => 'kk', 'label' => 'Kartu Keluarga (KK)', 'icon' => 'file-text', 'warna' => 'red'],
                        ['key' => 'akta', 'label' => 'Akta Kelahiran', 'icon' => 'file-text', 'warna' => 'blue'],
                        ['key' => 'ijazah', 'label' => 'Ijazah/SKL TK (jika ada)', 'icon' => 'file-text', 'warna' => 'green'],
                        ['key' => 'foto', 'label' => 'Pas Foto Calon Siswa', 'icon' => 'image', 'warna' => 'amber'],
                    ]; @endphp

                    @foreach($berkasList as $berkas)
                    <div class="border-2 border-dashed rounded-xl p-6 text-center hover:border-primary-400 transition-colors cursor-pointer"
                         :class="form.berkas.{{ $berkas['key'] }} ? 'border-green-400 bg-green-50' : 'border-gray-300 bg-gray-50'"
                         @click="$refs.{{ $berkas['key'] }}_input.click()"
                         @dragover.prevent @drop.prevent="handleDrop($event, '{{ $berkas['key'] }}')">
                        <input type="file" x-ref="{{ $berkas['key'] }}_input" @change="handleFile($event, '{{ $berkas['key'] }}')" accept=".jpg,.jpeg,.png,.pdf" class="hidden">
                        <template x-if="!form.berkas.{{ $berkas['key'] }}">
                            <div>
                                <div class="w-12 h-12 bg-{{ $berkas['warna'] }}-100 text-{{ $berkas['warna'] }}-600 rounded-xl flex items-center justify-center mx-auto mb-3">
                                    <i data-feather="{{ $berkas['icon'] }}" class="w-6 h-6"></i>
                                </div>
                                <p class="font-medium text-gray-700">{{ $berkas['label'] }}</p>
                                <p class="text-xs text-gray-400 mt-1">Klik atau drag & drop file di sini</p>
                                <p class="text-xs text-gray-400">JPG, PNG, PDF | Max 5MB</p>
                            </div>
                        </template>
                        <template x-if="form.berkas.{{ $berkas['key'] }}">
                            <div>
                                <div class="flex items-center justify-center gap-3">
                                    <i data-feather="check-circle" class="w-5 h-5 text-green-600"></i>
                                    <span class="font-medium text-green-700 text-sm" x-text="form.berkas.{{ $berkas['key'] }}?.name"></span>
                                    <button type="button" @click.stop="form.berkas.{{ $berkas['key'] }} = null" class="text-red-500 hover:text-red-700">
                                        <i data-feather="x" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                    @endforeach

                    <template x-if="form.jalur === 'Prestasi'">
                        <div class="border-2 border-dashed rounded-xl p-6 text-center hover:border-primary-400 transition-colors cursor-pointer"
                             :class="form.berkas.sertifikat ? 'border-purple-400 bg-purple-50' : 'border-gray-300 bg-gray-50'"
                             @click="$refs.sertifikat_input.click()">
                            <input type="file" x-ref="sertifikat_input" @change="handleFile($event, 'sertifikat')" accept=".jpg,.jpeg,.png,.pdf" class="hidden">
                            <template x-if="!form.berkas.sertifikat">
                                <div>
                                    <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center mx-auto mb-3">
                                        <i data-feather="award" class="w-6 h-6"></i>
                                    </div>
                                    <p class="font-medium text-gray-700">Sertifikat/Piagam Prestasi</p>
                                    <p class="text-xs text-gray-400 mt-1">Upload minimal 1 sertifikat prestasi</p>
                                </div>
                            </template>
                            <template x-if="form.berkas.sertifikat">
                                <div class="flex items-center justify-center gap-3">
                                    <i data-feather="check-circle" class="w-5 h-5 text-green-600"></i>
                                    <span class="font-medium text-green-700 text-sm" x-text="form.berkas.sertifikat?.name"></span>
                                    <button type="button" @click.stop="form.berkas.sertifikat = null" class="text-red-500 hover:text-red-700">
                                        <i data-feather="x" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </template>

                    <template x-if="form.jalur === 'Afirmasi'">
                        <div class="border-2 border-dashed rounded-xl p-6 text-center hover:border-primary-400 transition-colors cursor-pointer"
                             :class="form.berkas.sktm ? 'border-orange-400 bg-orange-50' : 'border-gray-300 bg-gray-50'"
                             @click="$refs.sktm_input.click()">
                            <input type="file" x-ref="sktm_input" @change="handleFile($event, 'sktm')" accept=".jpg,.jpeg,.png,.pdf" class="hidden">
                            <template x-if="!form.berkas.sktm">
                                <div>
                                    <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-xl flex items-center justify-center mx-auto mb-3">
                                        <i data-feather="file-text" class="w-6 h-6"></i>
                                    </div>
                                    <p class="font-medium text-gray-700">Surat Keterangan Tidak Mampu (SKTM)</p>
                                    <p class="text-xs text-gray-400 mt-1">Dari kelurahan setempat</p>
                                </div>
                            </template>
                            <template x-if="form.berkas.sktm">
                                <div class="flex items-center justify-center gap-3">
                                    <i data-feather="check-circle" class="w-5 h-5 text-green-600"></i>
                                    <span class="font-medium text-green-700 text-sm" x-text="form.berkas.sktm?.name"></span>
                                    <button type="button" @click.stop="form.berkas.sktm = null" class="text-red-500 hover:text-red-700">
                                        <i data-feather="x" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </template>

                    <template x-if="form.jalur === 'Mutasi'">
                        <div class="border-2 border-dashed rounded-xl p-6 text-center hover:border-primary-400 transition-colors cursor-pointer"
                             :class="form.berkas.surat_pindah ? 'border-teal-400 bg-teal-50' : 'border-gray-300 bg-gray-50'"
                             @click="$refs.surat_pindah_input.click()">
                            <input type="file" x-ref="surat_pindah_input" @change="handleFile($event, 'surat_pindah')" accept=".jpg,.jpeg,.png,.pdf" class="hidden">
                            <template x-if="!form.berkas.surat_pindah">
                                <div>
                                    <div class="w-12 h-12 bg-teal-100 text-teal-600 rounded-xl flex items-center justify-center mx-auto mb-3">
                                        <i data-feather="file-text" class="w-6 h-6"></i>
                                    </div>
                                    <p class="font-medium text-gray-700">Surat Pindah Tugas Orang Tua</p>
                                    <p class="text-xs text-gray-400 mt-1">Dari instansi tempat bekerja</p>
                                </div>
                            </template>
                            <template x-if="form.berkas.surat_pindah">
                                <div class="flex items-center justify-center gap-3">
                                    <i data-feather="check-circle" class="w-5 h-5 text-green-600"></i>
                                    <span class="font-medium text-green-700 text-sm" x-text="form.berkas.surat_pindah?.name"></span>
                                    <button type="button" @click.stop="form.berkas.surat_pindah = null" class="text-red-500 hover:text-red-700">
                                        <i data-feather="x" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Step 4: Konfirmasi --}}
            <div x-show="step === 4" x-transition>
                <div class="bg-white rounded-2xl shadow-sm border p-6 space-y-4">
                    <h2 class="text-xl font-extrabold text-gray-900 flex items-center gap-2">
                        <i data-feather="check-square" class="w-5 h-5 text-primary-600"></i> Konfirmasi Data
                    </h2>
                    <p class="text-sm text-gray-500">Periksa kembali data yang telah diisi. Pastikan semua data sudah benar sebelum mengirim.</p>

                    {{-- Summary --}}
                    <div class="bg-gray-50 rounded-xl p-5 space-y-3 text-sm">
                        <div class="grid sm:grid-cols-2 gap-2">
                            <div><span class="text-gray-500">Nama:</span> <span class="font-medium text-gray-800" x-text="form.nama || '-'"></span></div>
                            <div><span class="text-gray-500">NISN:</span> <span class="font-medium text-gray-800" x-text="form.nisn || '-'"></span></div>
                            <div><span class="text-gray-500">NIK:</span> <span class="font-medium text-gray-800" x-text="form.nik || '-'"></span></div>
                            <div><span class="text-gray-500">Jalur:</span> <span class="font-medium text-primary-600" x-text="form.jalur || '-'"></span></div>
                            <div><span class="text-gray-500">Tempat, Tgl Lahir:</span> <span class="font-medium text-gray-800" x-text="(form.tempat_lahir || '-') + ', ' + (form.tanggal_lahir || '-')"></span></div>
                            <div><span class="text-gray-500">Agama:</span> <span class="font-medium text-gray-800" x-text="form.agama || '-'"></span></div>
                        </div>
                        <hr>
                        <div class="grid sm:grid-cols-2 gap-2">
                            <div><span class="text-gray-500">Ayah:</span> <span class="font-medium text-gray-800" x-text="form.ayah_nama || '-'"></span></div>
                            <div><span class="text-gray-500">Ibu:</span> <span class="font-medium text-gray-800" x-text="form.ibu_nama || '-'"></span></div>
                        </div>
                        <hr>
                        <div class="text-sm text-gray-500">
                            <span>Berkas terupload: </span>
                            <span x-text="Object.values(form.berkas).filter(f => f !== null).length" class="font-medium text-gray-800"></span> file
                        </div>
                    </div>

                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="checkbox" x-model="form.setuju" class="mt-1 w-5 h-5 text-primary-600 rounded border-gray-300 focus:ring-primary-500">
                        <span class="text-sm text-gray-600">Saya menyatakan bahwa data yang diisi adalah benar. Jika dikemudian hari ditemukan ketidaksesuaian, saya bersedia menerima konsekuensi pembatalan pendaftaran.</span>
                    </label>
                </div>
            </div>

            {{-- Navigation Buttons --}}
            <div class="flex items-center justify-between pt-4">
                <button type="button" x-show="step > 1" @click="step--"
                    class="flex items-center gap-2 px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-colors">
                    <i data-feather="arrow-left" class="w-4 h-4"></i>
                    Sebelumnya
                </button>
                <div x-show="step === 1" class="flex-1"></div>

                <button type="button" x-show="step < 4" @click="nextStep()"
                    class="flex items-center gap-2 px-6 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-colors shadow-md ml-auto">
                    Selanjutnya
                    <i data-feather="arrow-right" class="w-4 h-4"></i>
                </button>

                <button type="submit" x-show="step === 4"
                    class="flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-accent-500 to-accent-600 text-white font-bold rounded-xl hover:from-accent-600 hover:to-accent-700 transition-all shadow-lg ml-auto text-lg"
                    :disabled="!form.setuju || submitting"
                    :class="{ 'opacity-50 cursor-not-allowed': !form.setuju }">
                    <i data-feather="send" class="w-5 h-5"></i>
                    <span x-text="submitting ? 'Mengirim...' : 'Kirim Pendaftaran'"></span>
                </button>
            </div>
        </form>

        {{-- Success Modal --}}
        <div x-show="success" x-cloak x-transition class="fixed inset-0 z-50 bg-black/50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl max-w-md w-full p-8 text-center shadow-2xl">
                <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-feather="check" class="w-8 h-8"></i>
                </div>
                <h3 class="text-xl font-extrabold text-gray-900 mb-2">Pendaftaran Berhasil!</h3>
                <p class="text-gray-600 text-sm mb-2">Pendaftaran Anda telah kami terima dengan nomor registrasi:</p>
                <p class="text-2xl font-extrabold text-primary-600 mb-4" x-text="registrationNumber"></p>
                <p class="text-sm text-gray-500 mb-6">Silakan simpan nomor registrasi untuk mengecek status pendaftaran. Admin akan memverifikasi berkas Anda dalam 1-5 hari kerja.</p>
                <button @click="window.location.href='{{ route('ppdb.index') }}'" class="bg-primary-600 text-white font-semibold px-6 py-2.5 rounded-xl hover:bg-primary-700 transition-colors">
                    Kembali ke Info PPDB
                </button>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    function ppdbForm() {
        return {
            step: 1,
            submitting: false,
            success: false,
            registrationNumber: '',
            form: {
                nama: '', email: '', nisn: '', nik: '', tempat_lahir: '', tanggal_lahir: '', jenis_kelamin: '',
                agama: '', anak_ke: '', alamat: '', rt: '', rw: '', kode_pos: '',
                asal_sekolah: '', jalur: '',
                ayah_nama: '', ayah_tempat_lahir: '', ayah_tanggal_lahir: '', ayah_pendidikan: '',
                ayah_pekerjaan: '', ayah_penghasilan: '', ayah_hp: '',
                ibu_nama: '', ibu_tempat_lahir: '', ibu_tanggal_lahir: '', ibu_pendidikan: '',
                ibu_pekerjaan: '', ibu_penghasilan: '', ibu_hp: '',
                berkas: { kk: null, akta: null, ijazah: null, foto: null, sertifikat: null, sktm: null, surat_pindah: null },
                setuju: false
            },
            nextStep() {
                // Basic validation per step
                if(this.step === 1) {
                    if(!this.form.nama || !this.form.nisn || !this.form.nik || !this.form.jalur) {
                        alert('Mohon isi semua field wajib (*) pada langkah ini.');
                        return;
                    }
                }
                if(this.step === 2) {
                    if(!this.form.ayah_nama || !this.form.ibu_nama) {
                        alert('Mohon isi minimal nama ayah dan ibu.');
                        return;
                    }
                }
                this.step++;
                window.scrollTo({ top: 200, behavior: 'smooth' });
            },
            handleFile(event, key) {
                const file = event.target.files[0];
                if(file) {
                    if(file.size > 5 * 1024 * 1024) {
                        alert('Ukuran file maksimal 5MB!');
                        return;
                    }
                    this.form.berkas[key] = file;
                }
            },
            handleDrop(event, key) {
                const file = event.dataTransfer.files[0];
                if(file) {
                    if(file.size > 5 * 1024 * 1024) {
                        alert('Ukuran file maksimal 5MB!');
                        return;
                    }
                    this.form.berkas[key] = file;
                }
            },
            submitForm() {
                if(!this.form.setuju) return;
                this.submitting = true;

                const formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');

                // Data siswa
                formData.append('nama', this.form.nama);
                formData.append('email', this.form.email);
                formData.append('nisn', this.form.nisn);
                formData.append('nik', this.form.nik);
                formData.append('tempat_lahir', this.form.tempat_lahir);
                formData.append('tanggal_lahir', this.form.tanggal_lahir);
                formData.append('jenis_kelamin', this.form.jenis_kelamin);
                formData.append('agama', this.form.agama);
                formData.append('anak_ke', this.form.anak_ke);
                formData.append('alamat', this.form.alamat);
                formData.append('rt', this.form.rt);
                formData.append('rw', this.form.rw);
                formData.append('kode_pos', this.form.kode_pos);
                formData.append('asal_sekolah', this.form.asal_sekolah);
                formData.append('jalur', this.form.jalur);

                // Data orang tua
                formData.append('ayah_nama', this.form.ayah_nama);
                formData.append('ayah_tempat_lahir', this.form.ayah_tempat_lahir);
                formData.append('ayah_tanggal_lahir', this.form.ayah_tanggal_lahir);
                formData.append('ayah_pendidikan', this.form.ayah_pendidikan);
                formData.append('ayah_pekerjaan', this.form.ayah_pekerjaan);
                formData.append('ayah_penghasilan', this.form.ayah_penghasilan);
                formData.append('ayah_hp', this.form.ayah_hp);
                formData.append('ibu_nama', this.form.ibu_nama);
                formData.append('ibu_tempat_lahir', this.form.ibu_tempat_lahir);
                formData.append('ibu_tanggal_lahir', this.form.ibu_tanggal_lahir);
                formData.append('ibu_pendidikan', this.form.ibu_pendidikan);
                formData.append('ibu_pekerjaan', this.form.ibu_pekerjaan);
                formData.append('ibu_penghasilan', this.form.ibu_penghasilan);
                formData.append('ibu_hp', this.form.ibu_hp);

                // Berkas
                if(this.form.berkas.kk) formData.append('berkas_kk', this.form.berkas.kk);
                if(this.form.berkas.akta) formData.append('berkas_akta', this.form.berkas.akta);
                if(this.form.berkas.ijazah) formData.append('berkas_ijazah', this.form.berkas.ijazah);
                if(this.form.berkas.foto) formData.append('berkas_foto', this.form.berkas.foto);
                if(this.form.berkas.sertifikat) formData.append('berkas_sertifikat', this.form.berkas.sertifikat);
                if(this.form.berkas.sktm) formData.append('berkas_sktm', this.form.berkas.sktm);
                if(this.form.berkas.surat_pindah) formData.append('berkas_surat_pindah', this.form.berkas.surat_pindah);

                fetch('{{ route('ppdb.store') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                })
                .then(response => {
                    if (response.redirected) {
                        window.location.href = response.url;
                        return;
                    }
                    if (!response.ok) {
                        return response.json().then(err => { throw err; });
                    }
                    return response.json();
                })
                .then(data => {
                    this.submitting = false;
                    this.success = true;
                })
                .catch(error => {
                    this.submitting = false;
                    alert('Terjadi kesalahan saat mengirim data. Pastikan semua field wajib diisi dan file tidak melebihi 5MB.');
                    console.error(error);
                });
            }
        }
    }
</script>
@endpush
