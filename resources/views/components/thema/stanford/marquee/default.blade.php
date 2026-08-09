<div x-data="{ visible: true }" x-show="visible" x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="translate-y-full opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
    x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-y-0 opacity-100"
    x-transition:leave-end="translate-y-full opacity-0"
    class="fixed bottom-0 left-0 right-0 w-full z-50 border-t border-stone-200 bg-white/95 backdrop-blur-md shadow-[0_-4px_20px_rgba(0,0,0,0.05)]">

    <div class="max-w-7xl mx-auto flex items-center h-10 relative overflow-hidden">

        <div
            class="flex items-center gap-2 z-10 px-4 h-full font-sans font-bold uppercase tracking-wider text-[11px] border-r border-stone-200 bg-[#8C1515] text-white">
            <span class="inline-block w-2 h-2 rounded-full animate-pulse bg-white"></span>
            VISI KAMPUS
        </div>

        <div class="flex-1 overflow-hidden relative flex items-center h-full">
            <marquee class="font-serif text-[13px] font-medium tracking-wide text-stone-800" behavior="scroll"
                direction="left" scrollamount="5" onmouseover="this.stop();" onmouseout="this.start();">

                <span class="mx-10"></span>

                <span>"Menjadi Politeknik Unggul yang Menghasilkan Sumber Daya Manusia Profesional, Berkarakter, dan
                    Berdaya Saing Global di Bidang Teknologi dan Industri Pada Tahun 2035."</span>

                <span class="mx-16 inline-block text-stone-300">|</span>

                <span class="text-[#8C1515] font-semibold">Politeknik Kampar — Pioneering Technology & Industry</span>

                <span class="mx-10"></span>
            </marquee>

            <div
                class="absolute right-0 top-0 bottom-0 w-16 pointer-events-none z-10 bg-gradient-to-r from-transparent to-white">
            </div>
        </div>

        

    </div>
</div>
