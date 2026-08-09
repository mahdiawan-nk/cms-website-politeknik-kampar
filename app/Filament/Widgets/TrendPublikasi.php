<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
class TrendPublikasi extends ChartWidget
{
    use HasWidgetShield;
    protected ?string $heading = 'Tren Publikasi Artikel';

    protected ?string $maxHeight = '300px';
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $months = [];
        $publishedCounts = [];

        // Query tren publikasi 6 bulan terakhir
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->translatedFormat('M Y');

            $publishedCounts[] = Post::where('status', 'published')
                ->whereYear('published_at', $date->year)
                ->whereMonth('published_at', $date->month)
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Artikel Dipublikasikan',
                    'data' => $publishedCounts,
                    'borderColor' => '#6366f1', // Warna garis (Indigo)
                    'backgroundColor' => 'rgba(99, 102, 241, 0.1)', // Warna bayangan transparan di bawah garis
                    'fill' => 'start',
                    'tension' => 0.4, // Membuat kurva garis melengkung halus
                    'pointRadius' => 4,
                    'pointHoverRadius' => 6,
                ],
            ],
            'labels' => $months,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
