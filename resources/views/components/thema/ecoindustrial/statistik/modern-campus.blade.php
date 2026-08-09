@props(['stats'])

<section class="w-full py-20 px-4 sm:px-6 lg:px-8 bg-slate-50 border-y border-slate-200/80 font-sans">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-3xl p-8 lg:p-12 shadow-xl shadow-slate-200/50 border border-slate-100">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12 divide-y sm:divide-y-0 sm:divide-x divide-slate-100">
                
                @foreach ($stats as $index => $stat)
                    <div x-data="{
                        current: 0,
                        target: {{ $stat['target'] ?? 0 }},
                        time: 2000,
                        startCounter() {
                            let start = null;
                            const step = (timestamp) => {
                                if (!start) start = timestamp;
                                const progress = Math.min((timestamp - start) / this.time, 1);
                                const easeProgress = 1 - Math.pow(1 - progress, 4);
                                this.current = Math.floor(easeProgress * this.target);
                                if (progress < 1) window.requestAnimationFrame(step);
                                else this.current = this.target;
                            };
                            window.requestAnimationFrame(step);
                        }
                    }"
                    x-intersect.once="startCounter()"
                    class="pt-6 sm:pt-0 sm:px-6 first:pl-0 last:pr-0 flex flex-col justify-between group">
                        
                        <div>
                            <!-- Badge Nomor Urut -->
                            <span class="inline-block text-[11px] font-bold text-blue-700 bg-blue-50 px-2.5 py-1 rounded-md mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                Metrik #0{{ $index + 1 }}
                            </span>

                            <!-- Angka Metriks -->
                            <div class="flex items-baseline mb-2">
                                <span x-text="current" class="text-5xl font-black text-slate-900 tracking-tight group-hover:text-blue-900 transition-colors">
                                    0
                                </span>
                                <span class="text-3xl font-bold text-emerald-600 ml-1">
                                    {{ $stat['suffix'] ?? '' }}
                                </span>
                            </div>

                            <!-- Judul Metriks -->
                            <h3 class="text-base font-bold text-slate-800">
                                {{ $stat['label'] ?? '' }}
                            </h3>
                        </div>

                        <!-- Keterangan Tambahan -->
                        <p class="text-xs text-slate-500 mt-3 leading-relaxed">
                            {{ $stat['sublabel'] ?? $stat['sub_label'] ?? '' }}
                        </p>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</section>