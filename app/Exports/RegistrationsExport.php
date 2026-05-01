<?php

namespace App\Exports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RegistrationsExport implements FromQuery, WithHeadings, WithMapping, WithStyles
{
    use Exportable;

    protected ?string $track = null;
    protected ?string $status = null;

    public function __construct(?string $track = null, ?string $status = null)
    {
        $this->track = $track;
        $this->status = $status;
    }

    public function query()
    {
        $query = Registration::query();

        if ($this->track) {
            $query->where('track', $this->track);
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        return $query->latest();
    }

    public function headings(): array
    {
        return [
            'No. Registrasi',
            'Tanggal Daftar',
            'Nama',
            'Email',
            'NISN',
            'NIK',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Agama',
            'Anak Ke',
            'Alamat',
            'RT',
            'RW',
            'Kode Pos',
            'Asal Sekolah',
            'Jalur',
            'Nama Ayah',
            'Pendidikan Ayah',
            'Pekerjaan Ayah',
            'Penghasilan Ayah',
            'No HP Ayah',
            'Nama Ibu',
            'Pendidikan Ibu',
            'Pekerjaan Ibu',
            'Penghasilan Ibu',
            'No HP Ibu',
            'Status',
            'Catatan',
            'Tanggal Verifikasi',
        ];
    }

    public function map($registration): array
    {
        return [
            $registration->registration_number,
            $registration->created_at?->format('d/m/Y H:i'),
            $registration->name,
            $registration->email,
            $registration->nisn,
            $registration->nik,
            $registration->place_of_birth,
            $registration->date_of_birth?->format('d/m/Y'),
            $registration->gender === 'L' ? 'Laki-laki' : 'Perempuan',
            $registration->religion,
            $registration->child_order,
            $registration->address,
            $registration->rt,
            $registration->rw,
            $registration->postal_code,
            $registration->previous_school,
            $registration->track,
            $registration->father_name,
            $registration->father_education,
            $registration->father_job,
            $registration->father_income,
            $registration->father_phone,
            $registration->mother_name,
            $registration->mother_education,
            $registration->mother_job,
            $registration->mother_income,
            $registration->mother_phone,
            $registration->status,
            $registration->notes,
            $registration->verified_at?->format('d/m/Y H:i'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
