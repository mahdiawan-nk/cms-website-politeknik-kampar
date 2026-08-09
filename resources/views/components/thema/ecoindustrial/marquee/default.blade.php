@props(['siteSetting'])
<div x-data="{ visible: true }" 
     x-show="visible" 
     x-transition:enter="transition ease-out duration-500 transform"
     x-transition:enter-start="translate-y-full opacity-0" 
     x-transition:enter-end="translate-y-0 opacity-100"
     x-transition:leave="transition ease-in duration-300 transform" 
     x-transition:leave-start="translate-y-0 opacity-100"
     x-transition:leave-end="translate-y-full opacity-0"
     class="fixed bottom-0 left-0 right-0 w-full z-[100] border-t border-slate-200/80 bg-white/90 backdrop-blur-xl shadow-[0_-10px_30px_rgba(16,185,129,0.08)] font-sans pb-[env(safe-area-inset-bottom,0px)]">

    <!-- Top Accent Line -->
    <div class="absolute top-0 left-0 w-full h-[1.5px] bg-gradient-to-r from-transparent via-[#10B981]/60 to-transparent"></div>

    <div class="max-w-[1500px] mx-auto flex items-center h-10 sm:h-12 relative overflow-hidden">

        <!-- Left Badge: Visi Kampus (Shrink-0 agar ukuran konsisten di mobile) -->
        <div class="shrink-0 flex items-center gap-1.5 sm:gap-2.5 z-20 px-3 sm:px-5 h-full font-bold uppercase tracking-wider sm:tracking-widest text-[10px] sm:text-[11px] bg-gradient-to-r from-[#10B981] to-emerald-700 text-white shadow-[4px_0_15px_rgba(16,185,129,0.25)] select-none">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#FF8C00] opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-[#FF8C00]"></span>
            </span>
            <span class="whitespace-nowrap">Visi Kampus</span>
        </div>

        <!-- Center: Ticker/Marquee Area -->
        <div class="flex-1 overflow-hidden relative flex items-center h-full ticker-container [mask-image:_linear-gradient(to_right,transparent_0,_black_3%,_black_97%,transparent_100%)] sm:[mask-image:_linear-gradient(to_right,transparent_0,_black_5%,_black_95%,transparent_100%)]">
            
            <!-- Seamless Scrolling Container -->
            <div class="flex w-max animate-ticker hover:[animation-play-state:paused] cursor-default whitespace-nowrap">
                
                <!-- Set 1 -->
                <div class="flex items-center gap-4 sm:gap-8 px-4 sm:px-8 text-xs sm:text-[13px] font-semibold tracking-wide text-slate-700 shrink-0">
                    <span>"{{ $siteSetting->topbar_announcement }}"</span>
                    
                    <span class="text-slate-300 text-[10px]">◆</span>
                    
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#10B981] to-[#FF8C00] font-extrabold uppercase tracking-widest">
                        Politeknik Kampar — Unggul Inovatif Terkemuka
                    </span>

                    <span class="text-slate-300 text-[10px]">◆</span>
                </div>

                <!-- Set 2 (Duplikat Persis untuk Loop Tanpa Jeda) -->
                <div class="flex items-center gap-4 sm:gap-8 px-4 sm:px-8 text-xs sm:text-[13px] font-semibold tracking-wide text-slate-700 shrink-0" aria-hidden="true">
                    <span>"{{ $siteSetting->topbar_announcement }}"</span>
                    
                    <span class="text-slate-300 text-[10px]">◆</span>
                    
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#10B981] to-[#FF8C00] font-extrabold uppercase tracking-widest">
                        Politeknik Kampar — Unggul Inovatif Terkemuka
                    </span>

                    <span class="text-slate-300 text-[10px]">◆</span>
                </div>

            </div>
        </div>

        <!-- Right: Tombol Close (Mobile Friendly) -->
        <div class="shrink-0 z-20 flex items-center h-full pl-1 pr-2 sm:px-3 bg-gradient-to-l from-white via-white/90 to-transparent">
            <button @click="visible = false" 
                    type="button"
                    class="p-1 sm:p-1.5 text-slate-400 hover:text-slate-700 hover:bg-slate-100 rounded-full transition-colors duration-200 focus:outline-none"
                    title="Tutup Pengumuman">
                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

    </div>
</div>

<!-- Custom Style for Smooth Hardware-Accelerated Marquee -->
<style>
    @keyframes smooth-ticker {
        0% { transform: translate3d(0, 0, 0); }
        100% { transform: translate3d(-50%, 0, 0); } /* Tepat berpindah 50% untuk menggantikan Set 1 dengan Set 2 secara mulus */
    }
    
    .animate-ticker {
        animation: smooth-ticker 30s linear infinite;
        will-change: transform;
        backface-visibility: hidden;
    }

    /* Memperlambat animasi di layar HP agar teks lebih mudah dibaca */
    @media (max-width: 640px) {
        .animate-ticker {
            animation-duration: 25s;
        }
    }
</style>