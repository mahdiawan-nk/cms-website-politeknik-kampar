<?php

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Announcement;
use App\Models\Event;
use Carbon\Carbon;
new class extends Component {
    // Logika tema dihapus, tampilan dikunci ke Stanford

    public function with(): array
    {
        $locale = app()->getLocale();

        // Menggunakan Cache 10 Menit untuk Query Performa Maksimal
        return Cache::remember("home_announcements_events_{$locale}", now()->addMinutes(10), function () use ($locale) {
            // 1. QUERY ANNOUNCEMENTS
            $announcements = Announcement::query()
                ->select(['id', 'title', 'badge', 'is_important', 'published_at']) // Ambil kolom yang diperlukan saja (Exclude content HTML)
                ->where('status', 'published')
                ->whereNotNull('published_at')
                ->where('published_at', '<=', now())
                ->latest('published_at')
                ->limit(4)
                ->get()
                ->map(
                    fn($item) => [
                        'id' => $item->id,
                        'title' => $item->getTranslation('title', $locale),
                        'date' => $item->published_at ? Carbon::parse($item->published_at)->locale($locale)->translatedFormat('d F Y') : '-',
                        'badge' => $item->getTranslation('badge', $locale) ?? '-',
                        'is_important' => (bool) $item->is_important,
                    ],
                )
                ->toArray();

            // 2. QUERY EVENTS
            $events = Event::query()
                ->select(['id', 'title', 'location', 'event_date', 'start_time', 'end_time', 'time_zone']) // Exclude content & image
                ->where('status', 'published')
                ->where('event_date', '>=', now()->startOfDay()) // Mengambil agenda yang akan datang
                ->orderBy('event_date', 'asc')
                ->limit(4)
                ->get()
                ->map(function ($item) use ($locale) {
                    $eventDate = Carbon::parse($item->event_date)->locale($locale);

                    // Format Jam (Misal: "08:30 - 16:00 WIB")
                    $time = '-';
                    if ($item->start_time) {
                        $start = Carbon::parse($item->start_time)->format('H:i');
                        $end = $item->end_time ? Carbon::parse($item->end_time)->format('H:i') : null;
                        $time = $end ? "{$start} - {$end} {$item->time_zone}" : "{$start} {$item->time_zone}";
                    }

                    return [
                        'id' => $item->id,
                        'title' => $item->getTranslation('title', $locale),
                        'day' => $eventDate->format('d'),
                        'month' => strtoupper($eventDate->translatedFormat('M')), // JUL, AGU, SEP
                        'time' => $time,
                        'location' => $item->getTranslation('location', $locale) ?? '-',
                    ];
                })
                ->toArray();

            return [
                'announcements' => $announcements,
                'events' => $events,
            ];
        });
    }
}; ?>

<x-thema.ecoindustrial.annoucment.minimalist :announcements="$announcements" :events="$events" :allAnnouncementsUrl="route('pengumuman')" :allEventsUrl="route('agenda')" />
