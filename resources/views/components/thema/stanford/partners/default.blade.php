@props(['partners'])

<div class="w-full py-12 overflow-hidden bg-stone-50">
    <div class="max-w-7xl mx-auto px-4">
        {{-- Header Stanford Style --}}
        <h3 class="text-sm uppercase tracking-widest font-bold mb-8 text-[#8C1515]">
            Mitra Industri Strategis
        </h3>

        <div x-data="{
            offset: 0,
            speed: 1,
            play: true,
            init() {
                let container = this.$refs.slider;
                setInterval(() => {
                    if (this.play) {
                        this.offset -= this.speed;
                        if (Math.abs(this.offset) >= container.scrollWidth / 2) {
                            this.offset = 0;
                        }
                    }
                }, 30);
            }
        }" class="relative w-full overflow-hidden">

            <div x-ref="slider" @mouseenter="play = false" @mouseleave="play = true"
                :style="{ transform: 'translateX(' + offset + 'px)' }"
                class="flex gap-12 cursor-grab active:cursor-grabbing transition-transform duration-75 ease-linear">

                @for ($i = 0; $i < 3; $i++)
                    @foreach ($partners as $partner)
                        <div
                            class="flex-shrink-0 flex items-center justify-center p-4 w-48 h-20 bg-white shadow-sm border border-stone-100 rounded-xl grayscale hover:grayscale-0 transition-all duration-300">
                            <img src="{{ $partner['logo'] }}" alt="{{ $partner['name'] }}"
                                class="h-10 object-contain opacity-70 hover:opacity-100 transition-opacity"
                                onerror="this.onerror=null;this.src='{{ asset('img/placeholder-logo.png') }}';">
                        </div>
                    @endforeach
                @endfor
            </div>
        </div>
    </div>
</div>
