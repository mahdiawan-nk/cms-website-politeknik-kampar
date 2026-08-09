<x-filament-widgets::widget class="bg-transparent">
    @php
        // Helper inline untuk mengambil string dari kolom JSON multi-bahasa
        $getLocaleText = function ($data) {
            if (is_array($data)) {
                return $data[app()->getLocale()] ?? $data['id'] ?? $data['en'] ?? reset($data) ?? '-';
            }
            return $data ?? '-';
        };
    @endphp

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- ================================================================= -->
        <!-- TABEL 1: PENGUMUMAN TERBARU                                       -->
        <!-- ================================================================= -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200/80 dark:border-slate-800 shadow-sm overflow-hidden flex flex-col justify-between">
            <div>
                <!-- Header Card -->
                <div class="p-4 sm:p-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between bg-slate-50/50 dark:bg-slate-800/30">
                    <div class="flex items-center gap-2.5">
                        <div class="w-2.5 h-2.5 rounded-full bg-[#FF8C00] animate-pulse"></div>
                        <h3 class="text-sm font-extrabold text-slate-900 dark:text-white tracking-tight">
                            Pengumuman Terbaru
                        </h3>
                    </div>
                    <a href="/cms/announcements" class="text-xs font-bold text-[#FF8C00] hover:underline flex items-center gap-1">
                        Lihat Semua &rarr;
                    </a>
                </div>

                <!-- Table Content -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 text-xs">
                            @forelse($announcements as $item)
                                @php
                                    $pubDate = $item->published_at ? \Carbon\Carbon::parse($item->published_at) : $item->created_at;
                                    $titleText = $getLocaleText($item->title);
                                    $badgeText = $getLocaleText($item->badge);
                                @endphp
                                <tr class="hover:bg-slate-50/60 dark:hover:bg-slate-800/30 transition-colors group">
                                    
                                    <!-- Tanggal (Mini Calendar Badge) -->
                                    <td class="py-3.5 pl-5 pr-3 whitespace-nowrap w-14">
                                        <div class="w-10 h-10 rounded-xl bg-amber-500/10 dark:bg-amber-500/15 border border-amber-500/20 text-[#FF8C00] flex flex-col items-center justify-center font-bold text-center">
                                            <span class="text-[9px] uppercase leading-none">{{ $pubDate->translatedFormat('M') }}</span>
                                            <span class="text-xs font-extrabold leading-none mt-0.5">{{ $pubDate->format('d') }}</span>
                                        </div>
                                    </td>

                                    <!-- Judul & Kategori -->
                                    <td class="py-3.5 px-3">
                                        <div class="flex items-center gap-2 mb-0.5">
                                            @if($item->is_important)
                                                <span class="px-1.5 py-0.5 rounded text-[9px] font-extrabold bg-red-500/10 text-red-600 dark:text-red-400 border border-red-500/20">
                                                    Penting
                                                </span>
                                            @endif
                                            <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">
                                                {{ $badgeText ?: 'Umum' }}
                                            </span>
                                        </div>
                                        <h4 class="font-bold text-slate-800 dark:text-slate-200 group-hover:text-[#FF8C00] transition-colors line-clamp-1">
                                            {{ $titleText }}
                                        </h4>
                                    </td>

                                    <!-- Tombol Aksi -->
                                    <td class="py-3.5 pr-5 pl-3 whitespace-nowrap text-right w-12">
                                        <a href="/cms/announcements/{{ $item->id }}/edit" title="Lihat Detail" class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-[#FF8C00] hover:text-white dark:hover:bg-[#FF8C00] text-slate-600 dark:text-slate-300 transition-all">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-8 text-center text-slate-400 font-medium text-xs">
                                        Belum ada pengumuman terbaru.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ================================================================= -->
        <!-- TABEL 2: AGENDA MENDATANG                                         -->
        <!-- ================================================================= -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200/80 dark:border-slate-800 shadow-sm overflow-hidden flex flex-col justify-between">
            <div>
                <!-- Header Card -->
                <div class="p-4 sm:p-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between bg-slate-50/50 dark:bg-slate-800/30">
                    <div class="flex items-center gap-2.5">
                        <div class="w-2.5 h-2.5 rounded-full bg-[#047857] dark:bg-[#10B981] animate-pulse"></div>
                        <h3 class="text-sm font-extrabold text-slate-900 dark:text-white tracking-tight">
                            Agenda Kampus Mendatang
                        </h3>
                    </div>
                    <a href="/cms/events" class="text-xs font-bold text-[#047857] dark:text-[#10B981] hover:underline flex items-center gap-1">
                        Lihat Semua &rarr;
                    </a>
                </div>

                <!-- Table Content -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 text-xs">
                            @forelse($events as $item)
                                @php
                                    $eventDate = \Carbon\Carbon::parse($item->event_date);
                                    $titleText = $getLocaleText($item->title);
                                    $locationText = $getLocaleText($item->location);
                                    $startTime = $item->start_time ? \Carbon\Carbon::parse($item->start_time)->format('H:i') : null;
                                @endphp
                                <tr class="hover:bg-slate-50/60 dark:hover:bg-slate-800/30 transition-colors group">
                                    
                                    <!-- Tanggal (Mini Calendar Badge) -->
                                    <td class="py-3.5 pl-5 pr-3 whitespace-nowrap w-14">
                                        <div class="w-10 h-10 rounded-xl bg-[#047857]/10 dark:bg-[#10B981]/15 border border-[#047857]/20 text-[#047857] dark:text-[#10B981] flex flex-col items-center justify-center font-bold text-center">
                                            <span class="text-[9px] uppercase leading-none">{{ $eventDate->translatedFormat('M') }}</span>
                                            <span class="text-xs font-extrabold leading-none mt-0.5">{{ $eventDate->format('d') }}</span>
                                        </div>
                                    </td>

                                    <!-- Judul, Jam, & Lokasi -->
                                    <td class="py-3.5 px-3">
                                        <h4 class="font-bold text-slate-800 dark:text-slate-200 group-hover:text-[#047857] dark:group-hover:text-[#10B981] transition-colors line-clamp-1">
                                            {{ $titleText }}
                                        </h4>
                                        <p class="text-[10px] text-slate-400 mt-0.5 flex items-center gap-1.5 truncate">
                                            @if($startTime)
                                                <span>{{ $startTime }} {{ $item->time_zone }}</span>
                                                <span>•</span>
                                            @endif
                                            <span class="truncate">{{ $locationText }}</span>
                                        </p>
                                    </td>

                                    <!-- Tombol Aksi -->
                                    <td class="py-3.5 pr-5 pl-3 whitespace-nowrap text-right w-12">
                                        <a href="/cms/events/{{ $item->id }}/edit" title="Lihat Detail" class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-[#047857] hover:text-white dark:hover:bg-[#10B981] dark:hover:text-slate-900 text-slate-600 dark:text-slate-300 transition-all">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-8 text-center text-slate-400 font-medium text-xs">
                                        Belum ada agenda event mendatang.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</x-filament-widgets::widget>