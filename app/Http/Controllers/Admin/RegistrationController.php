<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        return redirect('/admin/registrations');
    }

    public function show(Registration $registration)
    {
        return redirect("/admin/registrations/{$registration->id}/edit");
    }

    public function verify(Registration $registration)
    {
        $registration->update([
            'status' => 'Diverifikasi',
            'verified_at' => now(),
            'verified_by' => auth()->id(),
        ]);

        return back()->with('success', 'Berkas berhasil diverifikasi.');
    }

    public function updateStatus(Request $request, Registration $registration)
    {
        $request->validate([
            'status' => 'required|in:Pending,Diverifikasi,Lulus,Tidak Lulus,Cadangan',
            'notes' => 'nullable|string',
        ]);

        $registration->update([
            'status' => $request->status,
            'notes' => $request->notes,
            'verified_at' => now(),
            'verified_by' => auth()->id(),
        ]);

        return back()->with('success', 'Status pendaftaran diperbarui.');
    }

    public function export(\Illuminate\Http\Request $request)
    {
        $track = $request->input('track');
        $status = $request->input('status');

        $filename = 'ppdb-export-' . now()->format('Ymd-His') . '.xlsx';

        return (new \App\Exports\RegistrationsExport($track, $status))->download($filename);
    }

    public function announcement()
    {
        $registrations = Registration::whereIn('status', ['Lulus', 'Cadangan'])->get();
        return view('admin.ppdb.announcement', compact('registrations'));
    }
}
