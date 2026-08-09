<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Filament\Widgets\Widget;
use Illuminate\Support\Carbon;

class TrendCard extends Widget
{
    protected string $view = 'livewire.trend-card';

    // Widget mengambil 1 baris penuh di dashboard

    protected function getViewData(): array
    {
        $locale = app()->getLocale();

        // ----------------------------------------------------
        // 1. DATA TREN PUBLIKASI (6 Bulan Terakhir)
        // ----------------------------------------------------
        $months = [];
        $postTrendData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->translatedFormat('M Y');

            $count = Post::where('status', 'published')
                ->whereYear('published_at', $date->year)
                ->whereMonth('published_at', $date->month)
                ->count();

            $postTrendData[] = $count;
        }

        // ----------------------------------------------------
        // 2. DATA KATEGORI POST (PostgreSQL Safe)
        // ----------------------------------------------------
        $categories = Category::query()
            ->whereHas('posts', function ($q) {
                $q->where('status', 'published');
            })
            ->withCount(['posts' => function ($q) {
                $q->where('status', 'published');
            }])
            ->orderByDesc('posts_count')
            ->limit(5)
            ->get();

        $categoryLabels = [];
        $categoryCounts = [];

        foreach ($categories as $cat) {
            // Safe JSON Handling untuk field multi-bahasa
            $name = $cat->name;

            if (is_string($name)) {
                $decoded = json_decode($name, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $name = $decoded;
                }
            }

            if (is_array($name)) {
                $name = $name[$locale] ?? $name['id'] ?? reset($name);
            }

            $categoryLabels[] = $name ?: 'Umum';
            $categoryCounts[] = $cat->posts_count;
        }

        // Fallback jika belum ada data
        if (empty($categoryLabels)) {
            $categoryLabels = ['Belum Ada Kategori'];
            $categoryCounts = [0];
        }

        $totalPostsInCategories = array_sum($categoryCounts);

        return [
            'trendLabels'            => $months,
            'trendData'              => $postTrendData,
            'categoryLabels'         => $categoryLabels,
            'categoryCounts'         => $categoryCounts,
            'totalPostsInCategories' => $totalPostsInCategories,
        ];
    }
}
