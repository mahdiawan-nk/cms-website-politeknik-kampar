<div class="relative min-h-screen bg-slate-50/60 font-sans antialiased text-slate-800">
    <x-thema.ecoindustrial.cover-header :coverImage="$coverImage" :pageTitle="$pageTitle" />

    <!-- Pattern Background Eco-Industrial -->
    <div
        class="absolute inset-0 bg-[radial-gradient(#059669_1px,transparent_1px)] [background-size:24px_24px] opacity-[0.03] pointer-events-none">
    </div>

    <div class="relative z-10 w-full pt-6 pb-20 sm:pt-10 sm:pb-28">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Toolbar Header Glassmorphism -->
            <div
                class="mb-10 p-6 sm:p-8 bg-white/80 backdrop-blur-md rounded-3xl border border-slate-200/80 shadow-xl shadow-slate-200/50">

                <!-- Header Top: Title & Action CTA -->
                <div
                    class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 pb-6 border-b border-slate-100">

                    <!-- Judul & Subtitle -->
                    <div class="space-y-1.5">
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200/60 text-emerald-700 text-xs font-semibold tracking-wide uppercase">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            Kalender Akademik Polkam
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            {{ $pageTitle ?? 'Jadwal & Kalender Akademik' }}
                        </h1>
                        <p class="text-sm text-slate-500">Agendakan registrasi, KRS, perkuliahan, UTS/UAS, dan kegiatan
                            akademik Politeknik Kampar.</p>
                    </div>

                    <!-- Actions: Search & Export PDF Button -->
                    <div class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto">

                        <!-- Search Bar -->
                        <div class="w-full sm:w-72 relative">
                            <div class="relative flex items-center">
                                <input type="text" wire:model.live.debounce.300ms="search"
                                    placeholder="Cari agenda akademik..."
                                    class="w-full pl-11 pr-10 py-2.5 bg-slate-100/70 border border-slate-200 rounded-2xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-300">
                                <div class="absolute left-3.5 text-slate-400 pointer-events-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>

                                @if (!empty($search))
                                    <button wire:click="clearSearch"
                                        class="absolute right-3 text-slate-400 hover:text-slate-600 p-1 rounded-full hover:bg-slate-200/50 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </div>

                        

                    </div>

                </div>

                <!-- Header Bottom: Filter Semester & Color Legend Bar -->
                <div class="mt-6 flex flex-col md:flex-row md:items-center justify-between gap-4">

                    <!-- Filter Semester -->
                    <div class="flex items-center gap-2 overflow-x-auto no-scrollbar pb-1">
                        <button wire:click="setFilter('all')"
                            class="shrink-0 px-4 py-2 rounded-xl text-xs font-bold transition-all duration-200 {{ $filter === 'all' ? 'bg-emerald-600 text-white shadow-md shadow-emerald-600/20' : 'bg-slate-100 text-slate-600 hover:bg-slate-200/70' }}">
                            Semua Agenda
                        </button>

                        <button wire:click="setFilter('important')"
                            class="shrink-0 px-4 py-2 rounded-xl text-xs font-bold transition-all duration-200 flex items-center gap-1.5 {{ $filter === 'important' ? 'bg-amber-500 text-white shadow-md shadow-amber-500/20' : 'bg-slate-100 text-slate-600 hover:bg-slate-200/70' }}">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            Wajib / Penting
                        </button>
                    </div>

                    <!-- Legend Indikator Jenis Agenda -->
                    <div class="flex items-center gap-3 text-[11px] font-semibold text-slate-500 flex-wrap">
                        <span class="flex items-center gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span> Perkuliahan/Ujian
                        </span>
                        <span class="flex items-center gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span> Registrasi/KRS
                        </span>
                        <span class="flex items-center gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span> Libur Akademik
                        </span>
                    </div>

                </div>

            </div>

            <!-- Loading State -->
            <div wire:loading.flex class="justify-center items-center py-12">
                <div
                    class="inline-flex items-center gap-3 px-5 py-2.5 bg-white rounded-full shadow-lg border border-slate-100 text-emerald-600 text-sm font-medium">
                    <svg class="animate-spin h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    Memuat data kalender akademik...
                </div>
            </div>

            <!-- Academic Calendar Items Grid -->
            <div wire:loading.remove class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($announcements as $item)
                    <article
                        class="group relative flex flex-col bg-white rounded-3xl border {{ $item->is_important ? 'border-amber-300/80 ring-1 ring-amber-400/20' : 'border-slate-200/80' }} shadow-sm hover:shadow-2xl hover:shadow-emerald-950/5 hover:-translate-y-1.5 transition-all duration-300 overflow-hidden">

                        <!-- Top Section: Calendar Date Block & Status -->
                        <div class="p-6 pb-0 flex items-start justify-between gap-4">

                            <!-- Calendar Date Box Badge -->
                            <div
                                class="flex items-center gap-3 bg-slate-50 border border-slate-200/80 rounded-2xl p-3 shadow-inner">
                                <div
                                    class="w-12 h-12 rounded-xl bg-emerald-600 text-white flex flex-col items-center justify-center shadow-md shadow-emerald-600/20 shrink-0">
                                    <span class="text-[10px] font-extrabold uppercase tracking-wider leading-none">
                                        {{ $item->published_at?->translatedFormat('M') ?? 'AGU' }}
                                    </span>
                                    <span class="text-lg font-black leading-none mt-0.5">
                                        {{ $item->published_at?->format('d') ?? '01' }}
                                    </span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-xs font-bold text-slate-800">
                                        {{ $item->published_at?->translatedFormat('l, d F Y') }}
                                    </span>
                                    <span class="text-[11px] text-slate-500 font-medium">
                                        {{ $item->badge ?? 'Agenda Akademik' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Badges: Penting / Status -->
                            <div class="flex flex-col items-end gap-1.5 shrink-0">
                                @if ($item->is_important)
                                    <span
                                        class="inline-flex items-center gap-1 bg-amber-500 text-white text-[10px] font-extrabold px-2.5 py-0.5 rounded-full shadow-sm tracking-wider uppercase">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Wajib
                                    </span>
                                @endif

                                <span
                                    class="bg-emerald-50 text-emerald-800 text-[10px] font-bold px-2.5 py-0.5 rounded-full border border-emerald-200/60 uppercase tracking-wider">
                                    Aktif
                                </span>
                            </div>

                        </div>

                        <!-- Content Body -->
                        <div class="flex flex-col flex-1 p-6">

                            <!-- Judul Kegiatan Akademik (Clickable) -->
                            <h3
                                class="text-lg font-bold text-slate-900 group-hover:text-emerald-700 transition-colors duration-200 line-clamp-2 leading-snug mb-2">
                                <button type="button" wire:click="showDetail({{ $item->id }})"
                                    class="text-left hover:underline focus:outline-none">
                                    {{ $item->title }}
                                </button>
                            </h3>

                            <!-- Deskripsi & Catatan Kegiatan -->
                            <p class="text-slate-600 text-sm line-clamp-3 leading-relaxed mb-6 flex-1">
                                {{ strip_tags($item->content) }}
                            </p>

                            <!-- Footer Info (Pihak Terkait / Lokasi / Meta) -->
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between mt-auto">

                                <div class="flex items-center gap-2 text-xs text-slate-500 font-medium">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>T.A. {{ date('Y') }}/{{ date('Y') + 1 }}</span>
                                </div>

                                <!-- Tombol Modal Detail Agenda -->
                                <button type="button" wire:click="showDetail({{ $item->id }})"
                                    class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700 hover:text-emerald-800 transition-colors group/btn focus:outline-none">
                                    <span>Detail Agenda</span>
                                    <div
                                        class="w-6 h-6 rounded-full bg-emerald-50 flex items-center justify-center group-hover/btn:bg-emerald-600 group-hover/btn:text-white transition-all">
                                        <svg class="w-3.5 h-3.5 transition-transform group-hover/btn:translate-x-0.5"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </div>
                                </button>

                            </div>

                        </div>

                        <!-- Eco Industrial Top Accent Hover Line -->
                        <div
                            class="absolute top-0 left-0 right-0 h-1.5 {{ $item->is_important ? 'bg-amber-500' : 'bg-emerald-500' }} scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left">
                        </div>

                    </article>
                @empty
                    <!-- Empty State -->
                    <div
                        class="col-span-full text-center py-20 bg-white/70 backdrop-blur-sm rounded-3xl border border-dashed border-slate-300 p-8 shadow-sm">
                        <div
                            class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 mb-1">Jadwal Akademik Tidak Ditemukan</h3>
                        <p class="text-sm text-slate-500 max-w-md mx-auto mb-6">
                            @if (!empty($search))
                                Tidak ada kegiatan kalender akademik yang sesuai dengan kata kunci <span
                                    class="font-semibold text-slate-700">"{{ $search }}"</span>.
                            @else
                                Belum ada jadwal akademik yang dimasukkan pada periode ini.
                            @endif
                        </p>
                        @if (!empty($search))
                            <button wire:click="clearSearch"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-900 text-white text-xs font-semibold hover:bg-emerald-700 transition">
                                Bersihkan Pencarian
                            </button>
                        @endif
                    </div>
                @endforelse
            </div>

            <!-- Pagination Links -->
            @if ($announcements->hasPages())
                <div class="mt-14 flex justify-center">
                    <div
                        class="bg-white/80 backdrop-blur-md px-4 py-3 rounded-2xl border border-slate-200/80 shadow-md">
                        {{ $announcements->links('thema.ecoindustrial.custom-pagination') }}
                    </div>
                </div>
            @endif

        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- MODAL DETAIL AGENDA AKADEMIK                                              -->
    <!-- ========================================================================= -->
    @if ($showDetailModal && $selectedAnnouncement)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data x-on:keydown.escape.window="$wire.closeModal()">
            <!-- Overlay Backdrop -->
            <div class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm transition-opacity duration-300"
                wire:click="closeModal"></div>

            <!-- Modal Window -->
            <div class="flex min-h-full items-center justify-center p-4 sm:p-6 text-center">
                <div
                    class="relative w-full max-w-2xl transform overflow-hidden rounded-3xl bg-white text-left align-middle shadow-2xl transition-all border border-slate-100 my-8">

                    <!-- Header Accent Bar -->
                    <div
                        class="h-2 w-full {{ $selectedAnnouncement->is_important ? 'bg-amber-500' : 'bg-emerald-600' }}">
                    </div>

                    <!-- Modal Header -->
                    <div class="p-6 sm:p-8 pb-4 flex items-start justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <!-- Date Box Icon -->
                            <div
                                class="w-14 h-14 rounded-2xl bg-emerald-600 text-white flex flex-col items-center justify-center shadow-lg shadow-emerald-600/20 shrink-0">
                                <span class="text-[10px] font-black uppercase tracking-wider leading-none">
                                    {{ $selectedAnnouncement->published_at?->translatedFormat('M') ?? 'AGU' }}
                                </span>
                                <span class="text-xl font-black leading-none mt-1">
                                    {{ $selectedAnnouncement->published_at?->format('d') ?? '01' }}
                                </span>
                            </div>

                            <div>
                                <div class="flex items-center gap-2 flex-wrap mb-1">
                                    @if ($selectedAnnouncement->is_important)
                                        <span
                                            class="bg-amber-500 text-white text-[10px] font-extrabold px-2.5 py-0.5 rounded-full uppercase tracking-wider">
                                            Agenda Wajib
                                        </span>
                                    @endif
                                    <span
                                        class="bg-emerald-50 text-emerald-800 text-[11px] font-bold px-3 py-0.5 rounded-full border border-emerald-200/60 uppercase tracking-wider">
                                        {{ $selectedAnnouncement->badge ?? 'Agenda Akademik' }}
                                    </span>
                                </div>
                                <p class="text-xs text-slate-500 font-medium">
                                    {{ $selectedAnnouncement->published_at?->translatedFormat('l, d F Y') }}
                                </p>
                            </div>
                        </div>

                        <!-- Tombol Close Modal -->
                        <button type="button" wire:click="closeModal"
                            class="text-slate-400 hover:text-slate-600 p-2 rounded-full hover:bg-slate-100 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <div class="px-6 sm:px-8 py-4 space-y-4">
                        <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 leading-snug">
                            {{ $selectedAnnouncement->title }}
                        </h2>

                        <!-- Isi Konten Agenda -->
                        <div
                            class="prose prose-slate max-w-none text-slate-600 text-sm leading-relaxed pt-4 border-t border-slate-100">
                            {!! $selectedAnnouncement->content !!}
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div
                        class="p-6 sm:px-8 bg-slate-50/80 border-t border-slate-100 flex items-center justify-between gap-4">
                        <div class="flex items-center gap-2 text-xs text-slate-400">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Kalender Resmi Politeknik Kampar</span>
                        </div>

                        <button type="button" wire:click="closeModal"
                            class="px-5 py-2.5 bg-slate-900 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl transition-all shadow-md shadow-slate-900/10">
                            Tutup
                        </button>
                    </div>

                </div>
            </div>
        </div>
    @endif

</div>
