@extends('admin.layout')

@section('title', 'Pengaturan Sekolah')
@section('page_title', 'Pengaturan Sekolah')

@section('content')
<div x-data="schoolSettings()" class="max-w-4xl mx-auto">
    {{-- Tabs --}}
    <div class="flex gap-1 bg-white rounded-xl p-1 shadow-sm border mb-6 overflow-x-auto">
        @php $tabs = ['identitas' => 'Identitas Sekolah', 'kontak' => 'Kontak & Lokasi', 'logo' => 'Logo & Branding', 'akademik' => 'Akademik', 'sosmed' => 'Sosial Media']; @endphp
        @foreach($tabs as $key => $label)
        <button @click="activeTab = '{{ $key }}'"
            :class="activeTab === '{{ $key }}' ? 'bg-primary-600 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100'"
            class="flex-1 px-4 py-2.5 rounded-lg text-sm font-medium transition-all whitespace-nowrap">
            {{ $label }}
        </button>
        @endforeach
    </div>

    <form @submit.prevent="saveSettings">
        {{-- Tab: Identitas Sekolah --}}
        <div x-show="activeTab === 'identitas'" x-transition class="bg-white rounded-2xl shadow-sm border p-6 space-y-5">
            <h3 class="text-lg font-extrabold text-gray-900 pb-4 border-b">Identitas Sekolah</h3>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Sekolah (Panjang)</label>
                    <input type="text" x-model="form.nama" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
                    <p class="text-xs text-gray-400 mt-1">Contoh: SD Negeri Contoh 01 Jakarta</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Pendek</label>
                    <input type="text" x-model="form.nama_pendek" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
                    <p class="text-xs text-gray-400 mt-1">Contoh: SDN CONTOH 01</p>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tagline / Motto</label>
                <input type="text" x-model="form.tagline" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi Singkat</label>
                <textarea x-model="form.deskripsi_singkat" rows="3" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm resize-none"></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi Panjang (Profil Lengkap)</label>
                <textarea x-model="form.deskripsi" rows="5" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm resize-none"></textarea>
            </div>

            <div class="grid sm:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">NPSN</label>
                    <input type="text" x-model="form.npsn" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Akreditasi</label>
                    <select x-model="form.akreditasi" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
                        <option value="A">A</option><option value="B">B</option><option value="C">C</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tahun Berdiri</label>
                    <input type="number" x-model="form.tahun_berdiri" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Kepala Sekolah</label>
                <input type="text" x-model="form.kepala_sekolah" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Visi</label>
                    <textarea x-model="form.visi" rows="3" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm resize-none"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Misi (pisahkan dengan baris baru)</label>
                    <textarea x-model="form.misi" rows="5" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm resize-none"></textarea>
                </div>
            </div>
        </div>

        {{-- Tab: Kontak & Lokasi --}}
        <div x-show="activeTab === 'kontak'" x-transition class="bg-white rounded-2xl shadow-sm border p-6 space-y-5">
            <h3 class="text-lg font-extrabold text-gray-900 pb-4 border-b">Kontak & Lokasi</h3>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Telepon</label>
                    <input type="text" x-model="form.telp" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                    <input type="email" x-model="form.email" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Lengkap</label>
                <textarea x-model="form.alamat" rows="2" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm resize-none"></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Singkat</label>
                <input type="text" x-model="form.alamat_singkat" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Google Maps Embed URL</label>
                <input type="text" x-model="form.maps_url" placeholder="https://www.google.com/maps/embed?pb=..." class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                <p class="text-sm text-blue-700 flex items-center gap-2">
                    <i data-feather="info" class="w-4 h-4 flex-shrink-0"></i>
                    Jam operasional akan otomatis muncul di footer: Senin-Jumat 07:00-16:00 WIB
                </p>
            </div>
        </div>

        {{-- Tab: Logo & Branding --}}
        <div x-show="activeTab === 'logo'" x-transition class="bg-white rounded-2xl shadow-sm border p-6 space-y-5">
            <h3 class="text-lg font-extrabold text-gray-900 pb-4 border-b">Logo & Branding</h3>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Upload Logo Sekolah</label>
                <div class="border-2 border-dashed rounded-xl p-8 text-center hover:border-primary-400 transition-colors cursor-pointer bg-gray-50"
                     @click="$refs.logoInput.click()">
                    <input type="file" x-ref="logoInput" accept="image/*" @change="handleLogo($event)" class="hidden">
                    <template x-if="!form.logo">
                        <div>
                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i data-feather="upload" class="w-6 h-6 text-gray-500"></i>
                            </div>
                            <p class="font-medium text-gray-700">Klik untuk upload logo</p>
                            <p class="text-xs text-gray-400 mt-1">Rekomendasi: PNG, min 200x200px, max 2MB</p>
                        </div>
                    </template>
                    <template x-if="form.logo">
                        <div class="flex items-center justify-center gap-4">
                            <img :src="form.logo" class="w-16 h-16 rounded-xl object-contain bg-white border">
                            <div>
                                <p class="text-sm font-medium text-green-600 flex items-center gap-1"><i data-feather="check-circle" class="w-4 h-4"></i> Logo terupload</p>
                                <button type="button" @click.stop="form.logo = null" class="text-xs text-red-500 hover:text-red-700 mt-1">Hapus</button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Inisial Logo (1 huruf)</label>
                    <input type="text" x-model="form.logo_initials" maxlength="1" class="w-16 px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm text-center text-lg font-bold">
                    <p class="text-xs text-gray-400 mt-1">Digunakan jika logo gambar tidak tersedia</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Favicon</label>
                    <div class="flex items-center gap-3">
                        <input type="file" accept="image/x-icon,image/png" class="text-sm file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                    </div>
                </div>
            </div>
        </div>

        {{-- Tab: Akademik --}}
        <div x-show="activeTab === 'akademik'" x-transition class="bg-white rounded-2xl shadow-sm border p-6 space-y-5">
            <h3 class="text-lg font-extrabold text-gray-900 pb-4 border-b">Pengaturan Akademik</h3>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tahun Ajaran Aktif</label>
                    <input type="text" x-model="form.tahun_ajaran_aktif" placeholder="2026/2027" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Semester Aktif</label>
                    <select x-model="form.semester_aktif" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
                        <option value="1">Semester 1 (Ganjil)</option>
                        <option value="2">Semester 2 (Genap)</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kelas yang Tersedia</label>
                <div class="space-y-2" x-data="{ kelas: {{ json_encode(['Kelas 1', 'Kelas 2', 'Kelas 3', 'Kelas 4', 'Kelas 5', 'Kelas 6']) }}, newKelas: '' }">
                    <div class="grid sm:grid-cols-3 gap-2">
                        <template x-for="(k, i) in kelas" :key="i">
                            <div class="flex items-center justify-between bg-gray-50 rounded-lg px-3 py-2">
                                <span class="text-sm" x-text="k"></span>
                                <button type="button" @click="kelas.splice(i, 1)" class="text-red-400 hover:text-red-600"><i data-feather="x" class="w-4 h-4"></i></button>
                            </div>
                        </template>
                    </div>
                    <div class="flex gap-2">
                        <input type="text" x-model="newKelas" @keyup.enter="if(newKelas.trim()) { kelas.push(newKelas.trim()); newKelas = '' }" placeholder="Tambah nama kelas..." class="flex-1 px-4 py-2 bg-gray-50 border rounded-lg focus:ring-2 focus:ring-primary-500 outline-none text-sm">
                        <button type="button" @click="if(newKelas.trim()) { kelas.push(newKelas.trim()); newKelas = '' }" class="px-4 py-2 bg-primary-600 text-white text-sm rounded-lg hover:bg-primary-700 transition-colors">Tambah</button>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Mata Pelajaran</label>
                <div class="space-y-2" x-data="{ mapel: {{ json_encode(['Pendidikan Agama', 'PKn', 'Bahasa Indonesia', 'Matematika', 'IPA', 'IPS', 'SBdP', 'PJOK']) }}, newMapel: '' }">
                    <div class="grid sm:grid-cols-3 gap-2">
                        <template x-for="(m, i) in mapel" :key="i">
                            <div class="flex items-center justify-between bg-gray-50 rounded-lg px-3 py-2">
                                <span class="text-sm" x-text="m"></span>
                                <button type="button" @click="mapel.splice(i, 1)" class="text-red-400 hover:text-red-600"><i data-feather="x" class="w-4 h-4"></i></button>
                            </div>
                        </template>
                    </div>
                    <div class="flex gap-2">
                        <input type="text" x-model="newMapel" @keyup.enter="if(newMapel.trim()) { mapel.push(newMapel.trim()); newMapel = '' }" placeholder="Tambah mapel..." class="flex-1 px-4 py-2 bg-gray-50 border rounded-lg focus:ring-2 focus:ring-primary-500 outline-none text-sm">
                        <button type="button" @click="if(newMapel.trim()) { mapel.push(newMapel.trim()); newMapel = '' }" class="px-4 py-2 bg-primary-600 text-white text-sm rounded-lg hover:bg-primary-700 transition-colors">Tambah</button>
                    </div>
                </div>
            </div>

            <div class="grid sm:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jumlah Siswa Aktif</label>
                    <input type="number" x-model="form.jumlah_siswa" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jumlah Guru</label>
                    <input type="number" x-model="form.jumlah_guru" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jumlah Prestasi</label>
                    <input type="number" x-model="form.jumlah_prestasi" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
                </div>
            </div>
        </div>

        {{-- Tab: Sosial Media --}}
        <div x-show="activeTab === 'sosmed'" x-transition class="bg-white rounded-2xl shadow-sm border p-6 space-y-5">
            <h3 class="text-lg font-extrabold text-gray-900 pb-4 border-b">Social Media</h3>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Facebook URL</label>
                <input type="url" x-model="form.social.facebook" placeholder="https://facebook.com/sekolah" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Instagram URL</label>
                <input type="url" x-model="form.social.instagram" placeholder="https://instagram.com/sekolah" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">YouTube URL</label>
                <input type="url" x-model="form.social.youtube" placeholder="https://youtube.com/@sekolah" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">TikTok URL</label>
                <input type="url" x-model="form.social.tiktok" placeholder="https://tiktok.com/@sekolah" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
            </div>
        </div>

        {{-- Save Button --}}
        <div class="flex items-center justify-end gap-3 mt-6">
            <button type="button" @click="resetSettings" class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-colors text-sm">
                Reset
            </button>
            <button type="submit" class="px-8 py-3 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700 transition-colors shadow-md text-sm" :disabled="saving">
                <span x-show="!saving">Simpan Pengaturan</span>
                <span x-show="saving" class="flex items-center gap-2">
                    <svg class="animate-spin w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                    Menyimpan...
                </span>
            </button>
        </div>
    </form>

    {{-- Save Success Toast --}}
    <div x-show="saved" x-cloak x-transition @click="saved = false" class="fixed bottom-6 right-6 bg-green-600 text-white px-5 py-3 rounded-xl shadow-lg font-medium text-sm flex items-center gap-2 cursor-pointer">
        <i data-feather="check-circle" class="w-4 h-4"></i>
        Pengaturan berhasil disimpan!
    </div>
</div>
@endsection

@push('scripts')
<script>
    function schoolSettings() {
        return {
            activeTab: 'identitas',
            saving: false,
            saved: false,
            form: {
                nama: 'SD Negeri Contoh 01 Jakarta',
                nama_pendek: 'SDN CONTOH 01',
                tagline: 'Unggul, Mandiri, Berprestasi',
                deskripsi_singkat: 'Sekolah yang berkomitmen mencetak generasi unggul melalui pendidikan berkualitas dan berkarakter.',
                deskripsi: '',
                npsn: '20101234',
                akreditasi: 'A',
                tahun_berdiri: 1985,
                kepala_sekolah: 'Bapak Ahmad Syahid, S.Pd., M.Pd.',
                visi: 'Terwujudnya peserta didik yang unggul dalam prestasi, mandiri, berkarakter, dan berwawasan lingkungan berdasarkan iman dan takwa.',
                misi: 'Melaksanakan pembelajaran yang aktif, inovatif, kreatif, efektif, dan menyenangkan.\nMengembangkan bakat dan minat peserta didik melalui kegiatan ekstrakurikuler.\nMenanamkan nilai-nilai karakter dan budi pekerti luhur.\nMewujudkan lingkungan sekolah yang bersih, hijau, dan nyaman.\nMeningkatkan kualitas tenaga pendidik secara berkelanjutan.',
                telp: '(021) 1234-5678',
                email: 'info@sdncontoh01.sch.id',
                alamat: 'Jl. Pendidikan No. 1, Kecamatan Menteng, Jakarta Pusat 10310',
                alamat_singkat: 'Jl. Pendidikan No. 1, Jakarta',
                maps_url: '',
                logo: null,
                logo_initials: 'S',
                tahun_ajaran_aktif: '2026/2027',
                semester_aktif: '2',
                jumlah_siswa: 650,
                jumlah_guru: 35,
                jumlah_prestasi: 120,
                social: {
                    facebook: 'https://facebook.com/sdncontoh01',
                    instagram: 'https://instagram.com/sdncontoh01',
                    youtube: 'https://youtube.com/@sdncontoh01',
                    tiktok: ''
                }
            },
            handleLogo(e) {
                const file = e.target.files[0];
                if(!file) return;
                if(file.size > 2 * 1024 * 1024) { alert('Ukuran file maksimal 2MB!'); return; }
                const reader = new FileReader();
                reader.onload = (ev) => { this.form.logo = ev.target.result; };
                reader.readAsDataURL(file);
            },
            resetSettings() {
                if(confirm('Reset semua pengaturan ke nilai default?')) {
                    // This would fetch defaults from server. Simplified here.
                    window.location.reload();
                }
            },
            saveSettings() {
                this.saving = true;
                setTimeout(() => {
                    this.saving = false;
                    this.saved = true;
                    setTimeout(() => { this.saved = false; }, 3000);
                }, 1000);
            }
        }
    }
</script>
@endpush
