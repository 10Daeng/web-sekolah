<?php

namespace App\Filament\Widgets;

use App\Models\Registration;
use Filament\Widgets\ChartWidget;

class PpdbChart extends ChartWidget
{
    protected static ?string $heading = 'Pendaftar PPDB per Jalur';

    protected function getData(): array
    {
        $zonasi = Registration::where('track', 'Zonasi')->count();
        $prestasi = Registration::where('track', 'Prestasi')->count();
        $afirmasi = Registration::where('track', 'Afirmasi')->count();
        $mutasi = Registration::where('track', 'Mutasi')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pendaftar',
                    'data' => [$zonasi, $prestasi, $afirmasi, $mutasi],
                    'backgroundColor' => [
                        '#3b82f6', // blue (zonasi)
                        '#f59e0b', // amber (prestasi)
                        '#ef4444', // red (afirmasi)
                        '#22c55e', // green (mutasi)
                    ],
                    'borderColor' => [
                        '#2563eb',
                        '#d97706',
                        '#dc2626',
                        '#16a34a',
                    ],
                    'borderWidth' => 1,
                ],
            ],
            'labels' => ['Zonasi', 'Prestasi', 'Afirmasi', 'Mutasi'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
