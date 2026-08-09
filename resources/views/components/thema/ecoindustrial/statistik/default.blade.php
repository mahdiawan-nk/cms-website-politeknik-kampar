@props(['stats'])

<section class="relative w-full py-24 px-4 sm:px-6 lg:px-8 bg-white overflow-hidden font-sans ">

    {{-- Top Eco-Industrial Gradient Accent Strip --}}
    <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#10B981] via-emerald-400 to-[#FF8C00]"></div>

    {{-- Subtle Industrial Technical Grid & Ambient Glows --}}
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#00000005_1px,transparent_1px),linear-gradient(to_bottom,#00000005_1px,transparent_1px)] bg-[size:36px_36px] pointer-events-none"></div>
    <div class="absolute top-1/2 left-1/4 -translate-y-1/2 w-96 h-96 bg-emerald-400/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/2 right-1/4 -translate-y-1/2 w-96 h-96 bg-amber-400/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative z-10 container mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-10">

            @foreach ($stats as $index => $stat)
                <div x-data="{
                    current: 0,
                    target: {{ $stat['target'] }},
                    time: 2500, // Waktu animasi diperpanjang untuk kesan mewah
                    startCounter() {
                        let start = null;
                        const step = (timestamp) => {
                            if (!start) start = timestamp;
                            // Kalkulasi persentase progres
                            const progress = Math.min((timestamp - start) / this.time, 1);
                            // Cubic ease-out formula (Melambat di akhir)
                            const easeProgress = 1 - Math.pow(1 - progress, 4);
                            
                            this.current = Math.floor(easeProgress * this.target);
                            
                            if (progress < 1) {
                                window.requestAnimationFrame(step);
                            } else {
                                this.current = this.target; // Pastikan berhenti tepat di angka target
                            }
                        };
                        window.requestAnimationFrame(step);
                    }
                }" x-intersect.once="startCounter()"
                    class="group relative flex flex-col p-8 bg-slate-50/60 backdrop-blur-md hover:bg-white rounded-[2rem] border border-slate-100/80 hover:border-emerald-100 hover:shadow-[0_20px_40px_-10px_rgba(16,185,129,0.08)] transition-all duration-700 ease-out transform hover:-translate-y-1.5 overflow-hidden">

                    <!-- Loading / Hover Accent Line (Industrial Touch) -->
                    <div class="absolute top-0 left-0 w-0 h-1 bg-gradient-to-r from-[#10B981] to-[#FF8C00] group-hover:w-full transition-all duration-1000 ease-[cubic-bezier(0.25,1,0.5,1)]"></div>
                    
                    <!-- Dekorasi Titik Sudut Ala Blueprint Teknis -->
                    <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        <svg class="w-4 h-4 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4h4m12 0h-4M4 20h4m12 0h-4M12 4v16m-8-8h16" />
                        </svg>
                    </div>

                    <!-- Live Indicator (Gives a dashboard/system feel) -->
                    <div class="flex items-center gap-2 mb-6">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#10B981] opacity-50"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-[#10B981]"></span>
                        </span>
                        <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400 group-hover:text-[#10B981] transition-colors duration-300">
                            Metrik {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </span>
                    </div>

                    <!-- Main Numbers & Suffix -->
                    <div class="flex items-baseline mb-4">
                        <!-- Number -->
                        <span x-text="current"
                            class="text-5xl sm:text-6xl font-black tracking-tighter text-transparent bg-clip-text bg-gradient-to-b from-slate-900 to-slate-600 drop-shadow-sm group-hover:from-[#10B981] group-hover:to-emerald-700 transition-all duration-500">
                            0
                        </span>
                        <!-- Suffix (%, +, dll) -->
                        <span class="text-3xl sm:text-4xl font-black ml-1 text-[#FF8C00] group-hover:text-[#ea580c] group-hover:scale-110 origin-bottom-left transition-all duration-500 ease-out">
                            {{ $stat['suffix'] }}
                        </span>
                    </div>

                    <!-- Labels -->
                    <h3 class="text-lg font-extrabold tracking-tight mb-2 text-slate-800 group-hover:text-slate-900 transition-colors">
                        {{ $stat['label'] }}
                    </h3>

                    <p class="text-sm leading-relaxed text-slate-500 font-medium">
                        {{ $stat['sublabel'] }}
                    </p>

                </div>
            @endforeach

        </div>
    </div>
</section>