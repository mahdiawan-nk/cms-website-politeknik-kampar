<x-filament-widgets::widget>
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        
        <!-- ================= CARD 1: ARTIKEL PUBLISHED ================= -->
        <div class="group relative overflow-hidden rounded-2xl border border-gray-200/80 bg-gradient-to-br from-white via-slate-50/50 to-indigo-50/30 p-5 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-indigo-300 hover:shadow-xl hover:shadow-indigo-500/10 dark:border-white/10 dark:from-gray-900 dark:via-gray-900/90 dark:to-indigo-950/20 dark:hover:border-indigo-500/40 dark:hover:shadow-indigo-500/10">
            <!-- Ambient Light Glow -->
            <div class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-indigo-500/10 blur-2xl transition-all duration-500 group-hover:bg-indigo-500/20 dark:bg-indigo-500/15"></div>

            <div class="relative flex items-start justify-between">
                <div class="space-y-3">
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Artikel Published</span>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <h3 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                            {{ number_format($publishedPosts) }}
                        </h3>
                    </div>
                </div>

                <!-- Icon Container with Gradient Glow -->
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-gradient-to-tr from-indigo-600 to-violet-500 text-white shadow-lg shadow-indigo-500/30 transition-transform duration-300 group-hover:scale-110">
                    <x-heroicon-o-document-text class="h-6 w-6" />
                </div>
            </div>

            <!-- Card Footer Badges -->
            <div class="mt-4 flex items-center justify-between border-t border-gray-100 pt-3 dark:border-white/5">
                <div class="flex items-center gap-1.5 text-xs text-slate-500 dark:text-slate-400">
                    <span class="inline-flex items-center rounded-md bg-amber-50 px-2 py-0.5 text-xs font-semibold text-amber-700 ring-1 ring-inset ring-amber-600/20 dark:bg-amber-400/10 dark:text-amber-400 dark:ring-amber-400/20">
                        {{ $draftPosts }} Draft
                    </span>
                    <span>perlu di-review</span>
                </div>
            </div>
        </div>


        <!-- ================= CARD 2: HALAMAN AKTIF ================= -->
        <div class="group relative overflow-hidden rounded-2xl border border-gray-200/80 bg-gradient-to-br from-white via-slate-50/50 to-emerald-50/30 p-5 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-emerald-300 hover:shadow-xl hover:shadow-emerald-500/10 dark:border-white/10 dark:from-gray-900 dark:via-gray-900/90 dark:to-emerald-950/20 dark:hover:border-emerald-500/40 dark:hover:shadow-emerald-500/10">
            <!-- Ambient Light Glow -->
            <div class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-emerald-500/10 blur-2xl transition-all duration-500 group-hover:bg-emerald-500/20 dark:bg-emerald-500/15"></div>

            <div class="relative flex items-start justify-between">
                <div class="space-y-3">
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Halaman Aktif</span>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <h3 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                            {{ number_format($activePages) }}
                        </h3>
                    </div>
                </div>

                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-400 text-white shadow-lg shadow-emerald-500/30 transition-transform duration-300 group-hover:scale-110">
                    <x-heroicon-o-rectangle-group class="h-6 w-6" />
                </div>
            </div>

            <!-- Card Footer with Pulsing Status Indicator -->
            <div class="mt-4 flex items-center justify-between border-t border-gray-100 pt-3 dark:border-white/5">
                <div class="flex items-center gap-2">
                    <span class="relative flex h-2 w-2">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                    </span>
                    <span class="text-xs font-medium text-emerald-600 dark:text-emerald-400">Tampil di Publik</span>
                </div>
            </div>
        </div>


        <!-- ================= CARD 3: AGENDA MENDATANG ================= -->
        <div class="group relative overflow-hidden rounded-2xl border border-gray-200/80 bg-gradient-to-br from-white via-slate-50/50 to-sky-50/30 p-5 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-sky-300 hover:shadow-xl hover:shadow-sky-500/10 dark:border-white/10 dark:from-gray-900 dark:via-gray-900/90 dark:to-sky-950/20 dark:hover:border-sky-500/40 dark:hover:shadow-sky-500/10">
            <!-- Ambient Light Glow -->
            <div class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-sky-500/10 blur-2xl transition-all duration-500 group-hover:bg-sky-500/20 dark:bg-sky-500/15"></div>

            <div class="relative flex items-start justify-between">
                <div class="space-y-3">
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Agenda Mendatang</span>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <h3 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                            {{ number_format($upcomingEvents) }}
                        </h3>
                    </div>
                </div>

                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-gradient-to-tr from-sky-600 to-blue-400 text-white shadow-lg shadow-sky-500/30 transition-transform duration-300 group-hover:scale-110">
                    <x-heroicon-o-calendar-days class="h-6 w-6" />
                </div>
            </div>

            <!-- Card Footer -->
            <div class="mt-4 flex items-center justify-between border-t border-gray-100 pt-3 dark:border-white/5">
                <span class="text-xs text-slate-500 dark:text-slate-400">Event Aktif & Terjadwal</span>
            </div>
        </div>


        <!-- ================= CARD 4: PENGUMUMAN PENTING ================= -->
        <div class="group relative overflow-hidden rounded-2xl border border-gray-200/80 bg-gradient-to-br from-white via-slate-50/50 to-rose-50/30 p-5 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-rose-300 hover:shadow-xl hover:shadow-rose-500/10 dark:border-white/10 dark:from-gray-900 dark:via-gray-900/90 dark:to-rose-950/20 dark:hover:border-rose-500/40 dark:hover:shadow-rose-500/10">
            <!-- Ambient Light Glow -->
            <div class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-rose-500/10 blur-2xl transition-all duration-500 group-hover:bg-rose-500/20 dark:bg-rose-500/15"></div>

            <div class="relative flex items-start justify-between">
                <div class="space-y-3">
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Pengumuman Penting</span>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <h3 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                            {{ number_format($importantAnnouncements) }}
                        </h3>
                    </div>
                </div>

                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-gradient-to-tr from-rose-600 to-pink-500 text-white shadow-lg shadow-rose-500/30 transition-transform duration-300 group-hover:scale-110">
                    <x-heroicon-o-megaphone class="h-6 w-6" />
                </div>
            </div>

            <!-- Card Footer Badge Alert -->
            <div class="mt-4 flex items-center justify-between border-t border-gray-100 pt-3 dark:border-white/5">
                <div class="flex items-center gap-1.5">
                    <span class="inline-flex items-center gap-1 rounded-md bg-rose-50 px-2 py-0.5 text-xs font-bold text-rose-700 ring-1 ring-inset ring-rose-600/20 dark:bg-rose-500/10 dark:text-rose-400 dark:ring-rose-500/20">
                        <x-heroicon-m-exclamation-triangle class="h-3.5 w-3.5" />
                        Prioritas Tinggi
                    </span>
                </div>
            </div>
        </div>

    </div>
</x-filament-widgets::widget>