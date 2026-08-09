@props(['$stats'])

<section class="w-full py-16 px-4 sm:px-6 lg:px-8 border-y bg-white text-stone-800 border-stone-200">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">

            @foreach ($stats as $stat)
                <div x-data="{
                    current: 0,
                    target: {{ $stat['target'] }},
                    time: 1500,
                    startCounter() {
                        let start = null;
                        const step = (timestamp) => {
                            if (!start) start = timestamp;
                            const progress = Math.min((timestamp - start) / this.time, 1);
                            this.current = Math.floor(progress * this.target);
                            if (progress < 1) {
                                window.requestAnimationFrame(step);
                            }
                        };
                        window.requestAnimationFrame(step);
                    }
                }" x-intersect.once="startCounter()"
                    class="flex flex-col p-6 bg-stone-50/60 hover:bg-stone-50 border border-stone-100 rounded-2xl shadow-sm transition-all duration-300">

                    <div class="flex items-baseline mb-2">
                        <span x-text="current"
                            class="text-4xl sm:text-5xl tracking-tight font-serif font-bold text-[#8C1515]">
                            0
                        </span>
                        <span class="text-2xl sm:text-3xl font-bold ml-0.5 text-amber-500 font-serif">
                            {{ $stat['suffix'] }}
                        </span>
                    </div>

                    <h3 class="text-base font-bold tracking-wide mb-2 font-sans text-stone-900">
                        {{ $stat['label'] }}
                    </h3>

                    <p class="text-xs leading-relaxed text-stone-500 font-sans">
                        {{ $stat['sublabel'] }}
                    </p>
                </div>
            @endforeach

        </div>
    </div>
</section>
