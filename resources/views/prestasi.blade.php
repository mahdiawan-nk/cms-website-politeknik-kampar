<div class="relative min-h-screen bg-slate-50/60 font-sans antialiased text-slate-800">
    <x-thema.ecoindustrial.cover-header :coverImage="$coverImage" :pageTitle="$pageTitle" />

    <div class="relative z-10 w-full pt-6 pb-20 sm:pt-10 sm:pb-28">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            <!-- Achievement Stats Grid -->
            @if ($stats->isNotEmpty())
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
                    @foreach ($stats as $stat)
                        <div
                            class="relative group overflow-hidden bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-slate-200/80 shadow-sm hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 text-center">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                            </div>
                            <div class="relative z-10">
                                <div
                                    class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight group-hover:text-emerald-600 transition-colors">
                                    {{ $stat->formatted_value }}
                                </div>
                                <div
                                    class="mt-1 text-xs sm:text-sm font-semibold uppercase tracking-wider text-slate-500 group-hover:text-slate-700 transition-colors">
                                    {{ $stat->label }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Filter & Search Bar -->
            <div
                class="bg-white/90 backdrop-blur-md p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col md:flex-row gap-4 justify-between items-center">

                <!-- Input Search -->
                <div class="relative w-full md:w-96">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" wire:model.live.debounce.300ms="search"
                        placeholder="Cari prestasi, kategori, penyelenggara..."
                        class="w-full pl-10 pr-10 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                    @if ($search)
                        <button wire:click="$set('search', '')"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    @endif
                </div>

                <!-- Select Filters -->
                <div class="flex flex-wrap sm:flex-nowrap items-center gap-3 w-full md:w-auto">
                    <!-- Filter Tahun -->
                    <select wire:model.live="year"
                        class="w-full sm:w-auto py-2.5 px-4 rounded-xl border border-slate-200 bg-slate-50/50 text-sm text-slate-700 font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        <option value="all">Semua Tahun</option>
                        @foreach ($availableYears as $y)
                            <option value="{{ $y }}">{{ $y }}</option>
                        @endforeach
                    </select>

                    <!-- Filter Tipe -->
                    {{-- <select wire:model.live="type"
                        class="w-full sm:w-auto py-2.5 px-4 rounded-xl border border-slate-200 bg-slate-50/50 text-sm text-slate-700 font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        <option value="all">Semua Jenis</option>
                        <option value="academic">Akademik</option>
                        <option value="non_academic">Non-Akademik</option>
                    </select> --}}

                    @if ($search || $type !== 'all' || $year !== 'all')
                        <button wire:click="clearFilters"
                            class="px-4 py-2.5 text-xs font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-xl transition-colors whitespace-nowrap">
                            Reset Filter
                        </button>
                    @endif
                </div>
            </div>

            <!-- Bento Grid Gallery -->
            @if ($achievements->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 auto-rows-[280px]">
                    @foreach ($achievements as $index => $item)
                        @php
                            $isLarge = $item->is_featured || ($index === 0 && $achievements->currentPage() === 1);
                            $spanClass = $isLarge ? 'sm:col-span-2 sm:row-span-2' : 'col-span-1 row-span-1';
                        @endphp

                        <div wire:key="achievement-{{ $item->id }}" wire:click="showDetail({{ $item->id }})"
                            class="group relative rounded-3xl overflow-hidden bg-slate-950 border border-slate-200/80 shadow-md hover:shadow-2xl hover:border-emerald-500/40 transition-all duration-500 ease-out cursor-pointer flex flex-col justify-end {{ $spanClass }}">

                            <!-- Background Image with Zoom Effect -->
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                                class="absolute inset-0 w-full h-full object-cover opacity-75 group-hover:opacity-90 group-hover:scale-105 transition-all duration-700 ease-out">

                            <!-- Multi-layer Gradient Overlay -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/60 to-transparent opacity-90 group-hover:opacity-85 transition-opacity duration-300">
                            </div>
                            <div
                                class="absolute inset-0 bg-gradient-to-b from-slate-950/40 via-transparent to-transparent">
                            </div>

                            <!-- Top Badges -->
                            <div
                                class="absolute top-4 left-4 right-4 flex flex-wrap gap-2 justify-between items-center z-10">
                                <div class="flex items-center gap-1.5">
                                    <span
                                        class="px-3 py-1 text-[11px] font-bold rounded-full bg-slate-900/80 backdrop-blur-md text-emerald-400 border border-emerald-500/30 shadow-sm">
                                        {{ $item->year }}
                                    </span>
                                    @if ($item->level)
                                        <span
                                            class="px-3 py-1 text-[11px] font-medium rounded-full bg-slate-900/70 backdrop-blur-md text-slate-200 border border-white/10 hidden sm:inline-block">
                                            {{ $item->level->label() ?? $item->level->value }}
                                        </span>
                                    @endif
                                </div>

                                @if ($item->is_featured)
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1 text-[11px] font-black tracking-wide rounded-full bg-gradient-to-r from-amber-400 to-amber-500 text-slate-950 shadow-lg shadow-amber-500/20">
                                        <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        Featured
                                    </span>
                                @endif
                            </div>

                            <!-- Floating Action Arrow Indicator -->
                            <div
                                class="absolute top-4 right-4 z-10 opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0 transition-all duration-300 hidden sm:block">
                                @if (!$item->is_featured)
                                    <div
                                        class="w-9 h-9 rounded-full bg-emerald-500 text-slate-950 flex items-center justify-center shadow-lg shadow-emerald-500/30">
                                        <svg class="w-4 h-4 transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Card Content -->
                            <div class="relative p-5 sm:p-6 z-10 space-y-2">
                                <div class="flex items-center gap-2 text-xs font-semibold text-emerald-400">
                                    <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                    <span>{{ $item->category }}</span>
                                </div>

                                <h3
                                    class="{{ $isLarge ? 'text-2xl sm:text-3xl lg:text-4xl' : 'text-base sm:text-lg' }} font-extrabold text-white leading-snug tracking-tight group-hover:text-emerald-300 transition-colors line-clamp-2">
                                    {{ $item->title }}
                                </h3>

                                @if ($isLarge && $item->description)
                                    <p
                                        class="text-sm text-slate-300/90 line-clamp-2 hidden sm:block font-normal leading-relaxed pt-1">
                                        {{ $item->description }}
                                    </p>
                                @endif

                                <div
                                    class="pt-2 flex items-center justify-between text-xs text-slate-400/90 border-t border-white/10">
                                    <span class="truncate max-w-[200px]">
                                        {{ $item->organizer ?? 'Politeknik Kampar' }}
                                    </span>
                                    <span
                                        class="text-emerald-400 font-semibold group-hover:underline inline-flex items-center gap-1">
                                        Detail
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pt-8">
                    {{ $achievements->links('thema.ecoindustrial.custom-pagination') }}
                </div>
            @else
                <!-- Empty State -->
                <div
                    class="bg-white/80 backdrop-blur-md rounded-3xl p-12 text-center border border-slate-200/80 max-w-lg mx-auto space-y-4 shadow-sm">
                    <div
                        class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto text-slate-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Prestasi Tidak Ditemukan</h3>
                    <p class="text-sm text-slate-500">Coba ubah kata kunci pencarian atau reset filter untuk menampilkan
                        data lainnya.</p>
                    <button wire:click="clearFilters"
                        class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl transition shadow-md shadow-emerald-600/20">
                        Bersihkan Filter
                    </button>
                </div>
            @endif

            <!-- Detail Modal -->
            @if ($showDetailModal && $selectedAchievement)
                <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
                    aria-modal="true">
                    <!-- Backdrop -->
                    <div class="fixed inset-0 bg-slate-950/70 backdrop-blur-md transition-opacity"
                        wire:click="closeModal"></div>

                    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                        <div
                            class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border border-slate-100">

                            <!-- Header Image -->
                            <div class="relative h-64 sm:h-80 w-full bg-slate-950">
                                <img src="{{ $selectedAchievement->image_url }}"
                                    alt="{{ $selectedAchievement->title }}" class="w-full h-full object-cover">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent">
                                </div>
                                <button wire:click="closeModal"
                                    class="absolute top-4 right-4 p-2.5 rounded-full bg-slate-950/60 text-white hover:bg-slate-950 backdrop-blur-md transition-colors border border-white/10">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Modal Body -->
                            <div class="p-6 sm:p-8 space-y-6">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                        Tahun {{ $selectedAchievement->year }}
                                    </span>
                                    @if ($selectedAchievement->category)
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700">
                                            {{ $selectedAchievement->category }}
                                        </span>
                                    @endif
                                    @if ($selectedAchievement->level)
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800">
                                            {{ $selectedAchievement->level->label() ?? $selectedAchievement->level->value }}
                                        </span>
                                    @endif
                                </div>

                                <div>
                                    <h2 class="text-2xl font-bold text-slate-900 leading-tight">
                                        {{ $selectedAchievement->title }}
                                    </h2>
                                    @if ($selectedAchievement->organizer)
                                        <p class="text-sm font-medium text-slate-500 mt-2">
                                            Penyelenggara: <span
                                                class="text-slate-800 font-semibold">{{ $selectedAchievement->organizer }}</span>
                                        </p>
                                    @endif
                                </div>

                                @if ($selectedAchievement->description)
                                    <div
                                        class="text-slate-600 text-sm leading-relaxed space-y-2 border-t border-slate-100 pt-5">
                                        <h4 class="font-bold text-slate-900">Deskripsi / Detail Prestasi:</h4>
                                        <p>{{ $selectedAchievement->description }}</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Footer -->
                            <div class="bg-slate-50/80 px-6 py-4 flex justify-end border-t border-slate-100">
                                <button wire:click="closeModal"
                                    class="px-5 py-2.5 bg-slate-200 hover:bg-slate-300 text-slate-800 font-semibold text-sm rounded-xl transition">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
