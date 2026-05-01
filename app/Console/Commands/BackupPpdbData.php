<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Registration;
use Illuminate\Support\Facades\Storage;

class BackupPpdbData extends Command
{
    protected $signature = 'ppdb:backup {--format=json : Output format (json or csv)}';
    protected $description = 'Backup data PPDB ke file';

    public function handle(): int
    {
        $format = $this->option('format');
        $registrations = Registration::all();

        $filename = 'ppdb-backup-' . now()->format('Ymd-His') . '.' . $format;

        if ($format === 'json') {
            Storage::disk('local')->put('backups/' . $filename, $registrations->toJson(JSON_PRETTY_PRINT));
        } else {
            $csv = fopen('php://temp', 'r+');
            fputcsv($csv, ['No Registrasi', 'Nama', 'NISN', 'Jalur', 'Status', 'Tanggal Daftar']);
            foreach ($registrations as $r) {
                fputcsv($csv, [$r->registration_number, $r->name, $r->nisn, $r->track, $r->status, $r->created_at]);
            }
            rewind($csv);
            Storage::disk('local')->put('backups/' . $filename, stream_get_contents($csv));
            fclose($csv);
        }

        $this->info("Backup berhasil: storage/app/backups/{$filename}");
        return Command::SUCCESS;
    }
}
