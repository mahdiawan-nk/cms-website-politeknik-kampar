@props(['announcements', 'events', 'allAnnouncementsUrl' => '#', 'allEventsUrl' => '#'])

<section class="relative w-full py-12 sm:py-16 lg:py-24 bg-[#F8FAFC] overflow-hidden font-sans text-slate-900 select-none"
         x-data="{ activeTab: 'announcements', isDesktop: window.innerWidth >= 1024 }"
         @resize.window.debounce.100ms="isDesktop = window.innerWidth >= 1024">

    {{-- Top Eco-Industrial Gradient Accent Strip --}}
    <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#10B981] via-emerald-400 to-[#FF8C00]"></div>

    {{-- Technical Background Grid --}}
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#00000005_1px,transparent_1px),linear-gradient(to_bottom,#00000005_1px,transparent_1px)] bg-[size:36px_36px] pointer-events-none"></div>

    <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-12">

        {{-- Mobile Segmented Tab Switcher --}}
        <div class="flex lg:hidden p-1.5 bg-slate-200/70 backdrop-blur-md rounded-2xl mb-8 border border-slate-300/50">
            <button @click="activeTab = 'announcements'" 
                    :class="activeTab === 'announcements' ? 'bg-white text-slate-900 shadow-sm font-extrabold' : 'text-slate-600 font-semibold'"
                    class="flex-1 py-2.5 px-3 text-xs tracking-wider uppercase rounded-xl transition-all duration-300 flex items-center justify-center gap-2">
                <span>📢</span> {{ __('Pengumuman') }}
            </button>
            <button @click="activeTab = 'events'" 
                    :class="activeTab === 'events' ? 'bg-white text-slate-900 shadow-sm font-extrabold' : 'text-slate-600 font-semibold'"
                    class="flex-1 py-2.5 px-3 text-xs tracking-wider uppercase rounded-xl transition-all duration-300 flex items-center justify-center gap-2">
                <span>📅</span> {{ __('Agenda') }}
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10">

            {{-- 1. PENGUMUMAN CARD (LIGHT THEME - Span 7) --}}
            <div class="lg:col-span-7 flex flex-col justify-between p-6 sm:p-8 lg:p-10 rounded-[2.5rem] bg-white border border-slate-200/80 shadow-sm hover:shadow-xl transition-all duration-500 relative overflow-hidden"
                 x-show="isDesktop || activeTab === 'announcements'">

                {{-- Accent Border Top --}}
                <div class="absolute top-0 left-0 right-0 h-1.5 bg-[#10B981]"></div>

                <div>
                    {{-- Header Pengumuman --}}
                    <div class="flex items-center justify-between pb-6 mb-6 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-[#10B981] flex items-center justify-center font-bold">
                                📢
                            </div>
                            <div>
                                <span class="text-[10px] font-bold tracking-widest uppercase text-[#10B981]">Informasi Kampus</span>
                                <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900">Pengumuman Terkini</h3>
                            </div>
                        </div>
                        <a href="{{ $allAnnouncementsUrl }}" class="hidden sm:inline-flex items-center gap-1.5 text-xs font-bold text-[#10B981] hover:underline">
                            <span>Arsip</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>

                    {{-- List Pengumuman --}}
                    <div class="divide-y divide-slate-100">
                        @foreach ($announcements as $announcement)
                            <a href="#" class="group py-4 sm:py-5 flex flex-col sm:flex-row sm:items-center justify-between gap-3 hover:bg-slate-50/80 -mx-4 px-4 rounded-2xl transition-all duration-300">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1.5">
                                        <span class="px-2.5 py-0.5 text-[9px] font-extrabold tracking-wider uppercase bg-emerald-100/80 text-[#10B981] rounded-md">
                                            {{ $announcement['badge'] }}
                                        </span>
                                        @if ($announcement['is_important'] ?? false)
                                            <span class="px-2 py-0.5 text-[9px] font-extrabold uppercase bg-amber-100 text-[#FF8C00] rounded-md flex items-center gap-1">
                                                <span class="w-1.5 h-1.5 rounded-full bg-[#FF8C00] animate-pulse"></span>
                                                Penting
                                            </span>
                                        @endif
                                        <span class="text-[11px] font-medium text-slate-400 ml-auto sm:ml-0">{{ $announcement['date'] }}</span>
                                    </div>
                                    <h4 class="text-sm sm:text-base font-bold text-slate-800 group-hover:text-[#10B981] transition-colors duration-200 line-clamp-2">
                                        {{ $announcement['title'] }}
                                    </h4>
                                </div>
                                <div class="hidden sm:flex shrink-0 w-8 h-8 rounded-full bg-slate-100 text-slate-400 group-hover:bg-[#10B981] group-hover:text-white items-center justify-center transition-all duration-300">
                                    <svg class="w-4 h-4 transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Mobile Bottom Button --}}
                <div class="mt-6 pt-4 border-t border-slate-100 sm:hidden">
                    <a href="{{ $allAnnouncementsUrl }}" class="block text-center text-xs font-extrabold uppercase text-[#10B981]">Lihat Semua Pengumuman →</a>
                </div>
            </div>

            {{-- 2. AGENDA CARD (DARK INDUSTRIAL THEME - Span 5) --}}
            <div class="lg:col-span-5 flex flex-col justify-between p-6 sm:p-8 lg:p-10 rounded-[2.5rem] bg-slate-900 text-white shadow-xl relative overflow-hidden"
                 x-show="isDesktop || activeTab === 'events'">

                {{-- Top Glow Accent & Border --}}
                <div class="absolute top-0 left-0 right-0 h-1.5 bg-[#FF8C00]"></div>
                <div class="absolute -top-24 -right-24 w-60 h-60 bg-[#FF8C00]/20 rounded-full blur-3xl pointer-events-none"></div>

                <div>
                    {{-- Header Agenda --}}
                    <div class="flex items-center justify-between pb-6 mb-6 border-b border-slate-800">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-amber-500/10 text-[#FF8C00] border border-amber-500/20 flex items-center justify-center font-bold">
                                📅
                            </div>
                            <div>
                                <span class="text-[10px] font-bold tracking-widest uppercase text-[#FF8C00]">Agenda Kegiatan</span>
                                <h3 class="text-xl sm:text-2xl font-extrabold text-white">Kalender Kampus</h3>
                            </div>
                        </div>
                        <a href="{{ $allEventsUrl }}" class="hidden sm:inline-flex items-center gap-1.5 text-xs font-bold text-[#FF8C00] hover:underline">
                            <span>Kalender</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>

                    {{-- List Agenda --}}
                    <div class="space-y-4">
                        @foreach ($events as $event)
                            <a href="#" class="group flex items-center gap-4 p-3.5 rounded-2xl bg-slate-800/60 border border-slate-700/50 hover:border-amber-500/50 hover:bg-slate-800 transition-all duration-300">
                                
                                {{-- Date Badge --}}
                                <div class="flex flex-col items-center justify-center w-14 h-14 shrink-0 rounded-xl bg-amber-500/10 text-[#FF8C00] border border-amber-500/20 group-hover:bg-[#FF8C00] group-hover:text-slate-950 transition-colors duration-300">
                                    <span class="text-lg font-black leading-none">{{ $event['day'] }}</span>
                                    <span class="text-[9px] font-extrabold uppercase mt-1 tracking-wider">{{ $event['month'] }}</span>
                                </div>

                                {{-- Details --}}
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-bold text-slate-100 group-hover:text-[#FF8C00] transition-colors duration-200 truncate">
                                        {{ $event['title'] }}
                                    </h4>
                                    <div class="mt-1 flex items-center gap-3 text-[11px] font-medium text-slate-400">
                                        <span class="flex items-center gap-1">⏰ {{ $event['time'] }}</span>
                                        <span class="flex items-center gap-1 truncate">📍 {{ $event['location'] }}</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Mobile Bottom Button --}}
                <div class="mt-6 pt-4 border-t border-slate-800 sm:hidden">
                    <a href="{{ $allEventsUrl }}" class="block text-center text-xs font-extrabold uppercase text-[#FF8C00]">Buka Kalender Lengkap →</a>
                </div>

            </div>

        </div>
    </div>
</section>