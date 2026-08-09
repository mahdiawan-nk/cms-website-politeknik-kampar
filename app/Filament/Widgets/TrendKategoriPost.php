<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use Filament\Widgets\ChartWidget;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
class TrendKategoriPost extends ChartWidget
{
    use HasWidgetShield;
    protected ?string $heading = 'Kategori Artikel Terpopuler';
    protected static ?int $sort = 3;
    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $locale = app()->getLocale();

        // Query Kategori dengan Post Dipublikasikan (Kompatibel PostgreSQL & MySQL)
        $categories = Category::query()
            ->whereHas('posts', function ($query) {
                $query->where('status', 'published');
            })
            ->withCount(['posts' => function ($query) {
                $query->where('status', 'published');
            }])
            ->orderByDesc('posts_count')
            ->limit(5)
            ->get();

        $labels = [];
        $data = [];

        foreach ($categories as $category) {
            // Penanganan Field JSON Multi-Bahasa (id/en)
            $name = $category->name;

            if (is_string($name)) {
                $decoded = json_decode($name, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $name = $decoded;
                }
            }

            if (is_array($name)) {
                $name = $name[$locale] ?? $name['id'] ?? reset($name);
            }

            $labels[] = $name ?: 'Tanpa Kategori';
            $data[] = $category->posts_count;
        }

        // Fallback jika belum ada artikel berkategori
        if (empty($labels)) {
            $labels = ['Belum Ada Kategori'];
            $data = [0];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Artikel',
                    'data' => $data,
                    'backgroundColor' => [
                        '#6366f1', // Indigo
                        '#8b5cf6', // Violet
                        '#ec4899', // Pink
                        '#06b6d4', // Cyan
                        '#f59e0b', // Amber
                    ],
                    'borderWidth' => 2,
                    'hoverOffset' => 6,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
