<div class="flex items-center py-1">
    <a href="{{ filament()->getUrl() }}" class="group relative flex items-center gap-3.5 focus:outline-none">

        <!-- Ambient Glow Effect (Latar Belakang Menyala - Adapts to Mode) -->
        {{-- <div
            class="absolute -inset-1 rounded-2xl bg-gradient-to-r from-emerald-500 via-teal-500 to-amber-500 opacity-20 dark:opacity-30 blur-md transition duration-500 group-hover:opacity-60 dark:group-hover:opacity-80 group-hover:blur-lg">
        </div> --}}

        <!-- LOGO CONTAINER -->
        <div
            class="relative flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-600 via-teal-600 to-emerald-800 dark:to-slate-900 p-[1px] shadow-lg shadow-emerald-500/10 dark:shadow-xl dark:shadow-emerald-500/20 ring-1 ring-slate-900/10 dark:ring-white/20 transition-all duration-300 group-hover:scale-105 group-hover:shadow-emerald-500/30">
            
            <!-- Inner Glass Layer -->
            <div
                class="flex h-full w-full items-center justify-center rounded-[15px] bg-gradient-to-br from-white/30 via-emerald-600/20 to-transparent dark:from-white/20 dark:via-emerald-600/40 backdrop-blur-md">
                <!-- Content & Layout CMS Icon -->
                <svg class="h-6 w-6 text-white drop-shadow-[0_2px_4px_rgba(0,0,0,0.3)] dark:drop-shadow-[0_2px_4px_rgba(0,0,0,0.5)] transition-transform duration-300 group-hover:rotate-3"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>

            <!-- Mini Indicator Pulse Status -->
            <span class="absolute -right-0.5 -top-0.5 flex h-3 w-3">
                <span
                    class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex h-3 w-3 rounded-full border-2 border-white dark:border-slate-900 bg-emerald-500"></span>
            </span>
        </div>

        <!-- BRAND TEXT & DETAILS -->
        <div class="relative flex flex-col justify-center">
            <div class="flex items-center gap-2">
                <!-- Title dengan Dynamic Text Color -->
                <span class="text-xl font-black tracking-tight text-slate-900 dark:text-white">
                    CMS<span
                        class="bg-gradient-to-r from-emerald-600 via-teal-500 to-amber-500 dark:from-emerald-400 dark:via-teal-300 dark:to-amber-400 bg-clip-text text-transparent group-hover:animate-pulse">Panel</span>
                </span>

                <!-- Badge Version Adaptive -->
                <span
                    class="inline-flex items-center rounded-full border border-emerald-200/80 bg-emerald-50/80 px-2 py-0.5 text-[9px] font-extrabold uppercase tracking-widest text-emerald-700 shadow-sm backdrop-blur-sm dark:border-emerald-500/30 dark:bg-emerald-950/60 dark:text-emerald-300">
                    v1.0
                </span>
            </div>

            <!-- Subtitle dengan Adaptasi Mode -->
            <span class="text-[10px] font-semibold tracking-wider uppercase text-slate-500 dark:text-slate-400">
                Content Management System
            </span>
        </div>

    </a>
</div>