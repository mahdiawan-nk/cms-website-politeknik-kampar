<x-filament-widgets::widget>
    @php
        // Helper inline untuk mengekstrak string dari JSON multi-bahasa (ID / EN)
        $getLocaleText = function ($data) {
            if (is_string($data) && (str_starts_with($data, '{') || str_starts_with($data, '['))) {
                $decoded = json_decode($data, true);
                if (is_array($decoded)) {
                    return $decoded[app()->getLocale()] ??
                        ($decoded['id'] ?? ($decoded['en'] ?? (reset($decoded) ?? null)));
                }
            }
            if (is_array($data)) {
                return $data[app()->getLocale()] ?? ($data['id'] ?? ($data['en'] ?? (reset($data) ?? null)));
            }
            return $data;
        };

        $announcementText = $setting
            ? $getLocaleText($setting->topbar_announcement ?? ($setting['topbar_announcement'] ?? null))
            : null;
        $isActive = $setting->is_announcement_active ?? ($setting['is_announcement_active'] ?? true);
    @endphp

    @if ($isActive && !empty($announcementText))
        <div
            class="relative overflow-hidden rounded-2xl border border-amber-200/80 dark:border-amber-500/30 bg-gradient-to-r from-amber-50 via-orange-50 to-amber-50 dark:from-amber-950/40 dark:via-slate-900 dark:to-amber-950/40 shadow-sm p-2.5 sm:p-3 flex items-center gap-3">

            <!-- BADGE LABEL (Kiri) -->
            <div
                class="flex-shrink-0 z-10 flex items-center gap-2 px-3 py-1.5 rounded-xl bg-amber-500 text-white shadow-md shadow-amber-500/20 text-xs font-black uppercase tracking-wider">
                <svg class="w-4 h-4 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5.882T19.24 5 11 13-2.5 0 0021 11.882V19.5a1.5 1.5 0 01-1.5 1.5h-3a1.5 1.5 0 01-1.5-1.5v-2.238a2 2 0 00-.586-1.414l-1.172-1.172a1 1 0 00-1.414 0l-1.172 1.172a2 2 0 00-.586 1.414V19.5a1.5 1.5 0 01-1.5 1.5h-3A1.5 1.5 0 013 19.5v-7.618a2 2 0 00-.76-1.588L1 9l1.24-.706z">
                    </path>
                </svg>
                <span class="hidden sm:inline">Info Kampus</span>
            </div>

            <!-- RUNNING TEXT CONTAINER -->
            <div class="relative w-full overflow-hidden flex items-center">
                <marquee onmouseover="this.stop();" onmouseout="this.start();" scrollamount="6"
                    class="text-xs sm:text-sm font-semibold text-amber-950 dark:text-amber-200 tracking-wide">
                    {{ $announcementText }}
                </marquee>
            </div>

            <!-- STATUS INDICATOR (Kanan) -->
            <div
                class="hidden md:flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-white/60 dark:bg-slate-800/60 border border-amber-200/60 dark:border-amber-500/20 text-[10px] font-bold text-amber-800 dark:text-amber-300 shrink-0">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                Live Announcement
            </div>

        </div>
    @endif
</x-filament-widgets::widget>
