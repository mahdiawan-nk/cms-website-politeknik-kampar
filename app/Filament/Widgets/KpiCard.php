<?php

namespace App\Filament\Widgets;

use App\Models\Announcement;
use App\Models\Event;
use App\Models\Page;
use App\Models\Post;
use Filament\Widgets\Widget;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class KpiCard extends Widget
{
    use HasWidgetShield;
    protected string $view = 'filament.widgets.kpi-card';
    protected static ?int $sort = 2;
    // Mengatur agar widget memenuhi lebar grid
    protected int | string | array $columnSpan = 'full';

    protected function getViewData(): array
    {
        return [
            // Stat Artikel
            'publishedPosts' => Post::where('status', 'published')->count(),
            'draftPosts'     => Post::where('status', 'draft')->count(),

            // Stat Halaman
            'activePages'    => Page::where('is_published', true)->count(),

            // Stat Agenda / Events Mendatang
            'upcomingEvents' => Event::where('status', 'published')
                ->where('event_date', '>=', now()->toDateString())
                ->count(),

            // Stat Pengumuman Penting
            'importantAnnouncements' => Announcement::where('status', 'published')
                ->where('is_important', true)
                ->count(),
        ];
    }
}
