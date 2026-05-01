<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PpdbController extends Controller
{
    public function index()
    {
        return view('front.ppdb.info');
    }

    public function create()
    {
        return view('front.ppdb.daftar');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nisn' => 'required|string|max:10',
            'nik' => 'required|string|max:16',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:50',
            'anak_ke' => 'required|integer|min:1',
            'alamat' => 'required|string',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'kode_pos' => 'nullable|string|max:5',
            'asal_sekolah' => 'nullable|string|max:255',
            'jalur' => 'required|in:Zonasi,Prestasi,Afirmasi,Mutasi',
            'ayah_nama' => 'required|string|max:255',
            'ayah_tempat_lahir' => 'nullable|string|max:255',
            'ayah_tanggal_lahir' => 'nullable|date',
            'ayah_pendidikan' => 'nullable|string|max:50',
            'ayah_pekerjaan' => 'nullable|string|max:255',
            'ayah_penghasilan' => 'nullable|string|max:50',
            'ayah_hp' => 'nullable|string|max:20',
            'ibu_nama' => 'required|string|max:255',
            'ibu_tempat_lahir' => 'nullable|string|max:255',
            'ibu_tanggal_lahir' => 'nullable|date',
            'ibu_pendidikan' => 'nullable|string|max:50',
            'ibu_pekerjaan' => 'nullable|string|max:255',
            'ibu_penghasilan' => 'nullable|string|max:50',
            'ibu_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'berkas_kk' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'berkas_akta' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'berkas_ijazah' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'berkas_foto' => 'required|file|mimes:jpg,jpeg,png|max:5120',
            'berkas_sertifikat' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'berkas_sktm' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'berkas_surat_pindah' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $registrationNumber = 'PPDB-' . now()->year . '-' . strtoupper(Str::random(6));

        $registration = Registration::create([
            'registration_number' => $registrationNumber,
            'name' => $validated['nama'],
            'nisn' => $validated['nisn'],
            'nik' => $validated['nik'],
            'place_of_birth' => $validated['tempat_lahir'],
            'date_of_birth' => $validated['tanggal_lahir'],
            'gender' => $validated['jenis_kelamin'],
            'religion' => $validated['agama'],
            'child_order' => $validated['anak_ke'],
            'address' => $validated['alamat'],
            'rt' => $validated['rt'],
            'rw' => $validated['rw'],
            'postal_code' => $validated['kode_pos'],
            'previous_school' => $validated['asal_sekolah'],
            'track' => $validated['jalur'],
            'father_name' => $validated['ayah_nama'],
            'father_birth_place' => $validated['ayah_tempat_lahir'],
            'father_birth_date' => $validated['ayah_tanggal_lahir'],
            'father_education' => $validated['ayah_pendidikan'],
            'father_job' => $validated['ayah_pekerjaan'],
            'father_income' => $validated['ayah_penghasilan'],
            'father_phone' => $validated['ayah_hp'],
            'mother_name' => $validated['ibu_nama'],
            'mother_birth_place' => $validated['ibu_tempat_lahir'],
            'mother_birth_date' => $validated['ibu_tanggal_lahir'],
            'mother_education' => $validated['ibu_pendidikan'],
            'mother_job' => $validated['ibu_pekerjaan'],
            'mother_income' => $validated['ibu_penghasilan'],
            'mother_phone' => $validated['ibu_hp'],
            'email' => $validated['email'] ?? null,
            'status' => 'Pending',
        ]);

        // Upload media
        if ($request->hasFile('berkas_kk')) {
            $registration->addMediaFromRequest('berkas_kk')->toMediaCollection('kk');
        }
        if ($request->hasFile('berkas_akta')) {
            $registration->addMediaFromRequest('berkas_akta')->toMediaCollection('akta');
        }
        if ($request->hasFile('berkas_ijazah')) {
            $registration->addMediaFromRequest('berkas_ijazah')->toMediaCollection('ijazah');
        }
        if ($request->hasFile('berkas_foto')) {
            $registration->addMediaFromRequest('berkas_foto')->toMediaCollection('foto');
        }
        if ($request->hasFile('berkas_sertifikat')) {
            $registration->addMediaFromRequest('berkas_sertifikat')->toMediaCollection('sertifikat');
        }
        if ($request->hasFile('berkas_sktm')) {
            $registration->addMediaFromRequest('berkas_sktm')->toMediaCollection('sktm');
        }
        if ($request->hasFile('berkas_surat_pindah')) {
            $registration->addMediaFromRequest('berkas_surat_pindah')->toMediaCollection('surat_pindah');
        }

        // Notify admin
        $adminEmail = config('app.sekolah.email', 'admin@example.com');
        if ($adminEmail) {
            \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\PpdbNewRegistration($registration));
        }

        return redirect()->route('ppdb.index')
            ->with('registration_success', true)
            ->with('registration_number', $registrationNumber);
    }

    public function cekStatus()
    {
        return view('front.ppdb.cek-status');
    }

    public function cekStatusPost(Request $request)
    {
        $request->validate([
            'nomor' => 'required|string',
        ]);

        $registration = Registration::where('registration_number', $request->nomor)
            ->orWhere('nisn', $request->nomor)
            ->orWhere('nik', $request->nomor)
            ->first();

        if (! $registration) {
            return back()->withErrors(['nomor' => 'Data pendaftaran tidak ditemukan.']);
        }

        return back()->with('registration', $registration);
    }
}
