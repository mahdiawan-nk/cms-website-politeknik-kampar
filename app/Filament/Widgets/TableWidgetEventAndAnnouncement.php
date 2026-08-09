<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Announcement;
use App\Models\Event;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
class TableWidgetEventAndAnnouncement extends Widget
{
    use HasWidgetShield;
    protected string $view = 'filament.widgets.table-widget-event-and-announcement';

    // Widget mengambil lebar penuh grid dashboard
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 5;
    public function getViewData(): array
    {
        // 1. Ambil 5 Pengumuman Terakhir yang dipublikasikan
        $announcements = Announcement::where('status', 'published')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->take(5)
            ->get();

        // 2. Ambil 5 Event/Agenda Kampus Mendatang yang dipublikasikan
        $events = Event::where('status', 'published')
            ->whereDate('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->take(5)
            ->get();

        return [
            'announcements' => $announcements,
            'events' => $events,
        ];
    }
}
