@props(['stats'])

<section class="relative w-full py-16 sm:py-20 px-4 sm:px-6 lg:px-8 bg-[#047857]/[0.03] text-slate-800 overflow-hidden font-sans border-y border-emerald-900/10">
    {{-- Top Eco-Industrial Gradient Accent Strip --}}
    <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#10B981] via-emerald-400 to-[#FF8C00]"></div>

    {{-- Subtle Industrial Technical Grid & Ambient Glows --}}
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#00000005_1px,transparent_1px),linear-gradient(to_bottom,#00000005_1px,transparent_1px)] bg-[size:36px_36px] pointer-events-none"></div>
    <div class="absolute top-1/2 left-1/4 -translate-y-1/2 w-96 h-96 bg-emerald-400/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/2 right-1/4 -translate-y-1/2 w-96 h-96 bg-amber-400/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative z-10 max-w-7xl mx-auto">
        {{-- Header Badge Ultra Premium --}}
        <div class="text-center mb-12 sm:mb-16">
            <span class="inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-[0.2em] text-emerald-800 bg-white/80 backdrop-blur-md px-4 py-2 rounded-full border border-emerald-500/20 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-[#FF8C00] shadow-[0_0_8px_rgba(255,140,0,0.6)]"></span>
                Keunggulan Akademik & Capaian
            </span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
            @foreach ($stats as $index => $stat)
                <div x-data="{
                    current: 0,
                    target: {{ $stat['target'] ?? 0 }},
                    time: 2200,
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
                }" 
                x-intersect.once="startCounter()"
                class="group relative flex flex-col justify-between p-8 bg-white/80 backdrop-blur-xl rounded-[2rem] border border-slate-200/80 shadow-[0_8px_30px_rgb(0,0,0,0.03)] hover:shadow-[0_20px_40px_-15px_rgba(16,185,129,0.18)] hover:border-emerald-300 hover:-translate-y-1.5 transition-all duration-500 ease-out overflow-hidden">
                    
                    {{-- Decorative Top Hover Glow Line --}}
                    <div class="absolute top-0 left-8 right-8 h-[2px] bg-gradient-to-r from-[#10B981] to-[#FF8C00] opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    {{-- Subtle Internal Ambient Glow on Hover --}}
                    <div class="absolute -top-12 -right-12 w-28 h-28 bg-emerald-400/10 rounded-full blur-2xl group-hover:bg-emerald-400/25 transition-all duration-500 pointer-events-none"></div>

                    <div>
                        {{-- Header Index & Indicator Dot --}}
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-[11px] font-extrabold tracking-widest text-emerald-800/60 uppercase">
                                0{{ $index + 1 }}
                            </span>
                            <span class="w-1.5 h-1.5 rounded-full bg-[#10B981] group-hover:bg-[#FF8C00] transition-colors duration-300"></span>
                        </div>

                        {{-- Number & Suffix --}}
                        <div class="flex items-baseline gap-1 mb-2">
                            <span x-text="current" class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight text-slate-900 group-hover:text-[#047857] transition-colors duration-300">
                                0
                            </span>
                            <span class="text-2xl sm:text-3xl font-extrabold text-[#FF8C00]">
                                {{ $stat['suffix'] ?? '' }}
                            </span>
                        </div>

                        {{-- Title / Label --}}
                        <h3 class="text-base sm:text-lg font-bold text-slate-800 group-hover:text-slate-900 transition-colors leading-snug">
                            {{ $stat['label'] ?? '' }}
                        </h3>
                    </div>

                    {{-- Sublabel (Hanya Rendisi Jika Ada) --}}
                    @php
                        $sublabel = $stat['sublabel'] ?? $stat['sub_label'] ?? '';
                    @endphp
                    @if (!empty($sublabel))
                        <p class="text-xs text-slate-500 mt-6 leading-relaxed font-medium border-t border-slate-100 pt-4 group-hover:text-slate-600 transition-colors">
                            {{ $sublabel }}
                        </p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>