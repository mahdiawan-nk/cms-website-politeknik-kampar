@props(['announcements', 'events', 'allAnnouncementsUrl' => '#', 'allEventsUrl' => '#'])

<section class="relative w-full py-12 sm:py-20 bg-[#F8FAFC] overflow-hidden font-sans text-slate-900 select-none">

    {{-- Top Eco-Industrial Accent Line --}}
    <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#10B981] via-emerald-400 to-[#FF8C00]">
    </div>

    <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-12">

        {{-- Section Title --}}
        <x-thema.ecoindustrial.header-section :header="[
            'badge' => __('frontend.header_announcement.badge'),
            'title' => __('frontend.header_announcement.title'),
            'title_higlight' => __('frontend.header_announcement.title_highlight'),
            'description' => __('frontend.header_announcement.description'),
        ]" />

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16">

            {{-- SEKSI PENGUMUMAN (Kiri - Timeline Emerald) --}}
            <div class="relative pl-6 sm:pl-8 border-l-2 border-emerald-200/80 space-y-6">

                <div
                    class="absolute -top-3 -left-[17px] w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold text-xs shadow-md">
                    📢
                </div>

                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-xl font-extrabold text-slate-900">Pengumuman Resmi</h3>
                    <a href="{{ $allAnnouncementsUrl }}" wire:navigate class="text-xs font-bold text-[#10B981] hover:underline">Lihat
                        Semua →</a>
                </div>

                @foreach ($announcements as $announcement)
                    <div
                        class="group relative bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md hover:border-emerald-300 transition-all duration-300">
                        {{-- Small Bullet Connector --}}
                        <div
                            class="absolute top-6 -left-[31px] sm:-left-[39px] w-3 h-3 rounded-full bg-emerald-400 border-2 border-white">
                        </div>

                        <div class="flex items-center gap-2 mb-2">
                            <span
                                class="text-[10px] font-extrabold uppercase px-2 py-0.5 rounded bg-slate-100 text-slate-600">
                                {{ $announcement['badge'] }}
                            </span>
                            <span
                                class="text-xs font-semibold text-slate-400 ml-auto">{{ $announcement['date'] }}</span>
                        </div>

                        <h4 class="text-base font-bold text-slate-800 group-hover:text-[#10B981] transition-colors">
                            <a href="#" class="before:absolute before:inset-0">{{ $announcement['title'] }}</a>
                        </h4>
                    </div>
                @endforeach

            </div>

            {{-- SEKSI AGENDA (Kanan - Timeline Amber) --}}
            <div class="relative pl-6 sm:pl-8 border-l-2 border-amber-200/80 space-y-6">

                <div
                    class="absolute -top-3 -left-[17px] w-8 h-8 rounded-full bg-[#FF8C00] text-white flex items-center justify-center font-bold text-xs shadow-md">
                    📅
                </div>

                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-xl font-extrabold text-slate-900">Agenda Mendatang</h3>
                    <a href="{{ $allEventsUrl }}" wire:navigate class="text-xs font-bold text-[#FF8C00] hover:underline">Lihat
                        Kalender →</a>
                </div>

                @foreach ($events as $event)
                    <div
                        class="group relative bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md hover:border-amber-300 transition-all duration-300 flex items-center gap-4">
                        {{-- Small Bullet Connector --}}
                        <div
                            class="absolute top-6 -left-[31px] sm:-left-[39px] w-3 h-3 rounded-full bg-[#FF8C00] border-2 border-white">
                        </div>

                        {{-- Compact Date Box --}}
                        <div
                            class="flex flex-col items-center justify-center w-12 h-12 rounded-xl bg-amber-50 text-[#FF8C00] font-black shrink-0 border border-amber-200/60">
                            <span class="text-base leading-none">{{ $event['day'] }}</span>
                            <span
                                class="text-[8px] uppercase font-bold tracking-wider mt-0.5">{{ $event['month'] }}</span>
                        </div>

                        <div class="min-w-0 flex-1">
                            <h4
                                class="text-sm sm:text-base font-bold text-slate-800 group-hover:text-[#FF8C00] transition-colors truncate">
                                <a href="#" class="before:absolute before:inset-0">{{ $event['title'] }}</a>
                            </h4>
                            <div class="mt-1 flex items-center gap-3 text-xs text-slate-500 font-medium">
                                <span>⏰ {{ $event['time'] }}</span>
                                <span class="truncate">📍 {{ $event['location'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>

    </div>
</section>
