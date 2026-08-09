@props(['stats'])

<section class="relative w-full bg-[#047857]/[0.04] backdrop-blur-md border-y border-emerald-700/10 py-7 px-4 sm:px-6 lg:px-8 font-sans overflow-hidden shadow-sm">
    {{-- Strip Aksen Gradasi Eco-Industrial di Bagian Atas --}}
    <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#10B981] via-emerald-400 to-[#FF8C00]"></div>
    <div class="absolute bottom-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#10B981] via-emerald-400 to-[#FF8C00]"></div>

    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-2 lg:grid-cols-4 divide-y lg:divide-y-0 lg:divide-x divide-emerald-900/10">

            @foreach ($stats as $index => $stat)
                <div x-data="{
                    current: 0,
                    target: {{ $stat['target'] ?? 0 }},
                    time: 1800,
                    startCounter() {
                        let start = null;
                        const step = (timestamp) => {
                            if (!start) start = timestamp;
                            const progress = Math.min((timestamp - start) / this.time, 1);
                            const easeProgress = 1 - Math.pow(1 - progress, 3);
                            this.current = Math.floor(easeProgress * this.target);
                            if (progress < 1) window.requestAnimationFrame(step);
                            else this.current = this.target;
                        };
                        window.requestAnimationFrame(step);
                    }
                }" x-intersect.once="startCounter()"
                    class="group relative px-4 sm:px-6 py-4 lg:py-2 transition-all duration-300">

                    {{-- Subtle Soft Palm Highlight saat Hover --}}
                    <div class="absolute inset-x-2 inset-y-0 bg-emerald-100/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl pointer-events-none"></div>

                    <div class="relative z-10 flex flex-col justify-center">
                        {{-- Indikator Nomor Minimalis --}}
                        <div class="flex items-center gap-2 mb-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#10B981] group-hover:bg-[#FF8C00] transition-colors duration-300"></span>
                            <span class="text-[10px] font-extrabold tracking-widest text-emerald-800/60 uppercase">
                                0{{ $index + 1}}
                            </span>
                        </div>

                        {{-- Angka & Suffix --}}
                        <div class="flex items-baseline gap-0.5">
                            <span x-text="current"
                                class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-800 tracking-tight transition-colors duration-300 group-hover:text-[#047857]">
                                0
                            </span>
                            <span class="text-xl sm:text-2xl font-extrabold text-[#FF8C00]">
                                {{ $stat['suffix'] ?? '' }}
                            </span>
                        </div>

                        {{-- Label Keterangan --}}
                        <h3 class="text-xs font-bold text-slate-600 uppercase tracking-widest mt-1 leading-tight group-hover:text-slate-900 transition-colors duration-300">
                            {{ $stat['label'] ?? '' }}
                        </h3>
                    </div>

                </div>
            @endforeach

        </div>
    </div>
</section>