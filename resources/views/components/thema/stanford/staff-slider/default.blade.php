@props(['staffs'])

<div class="w-full py-16 bg-white">
    <div class="max-w-7xl mx-auto">

        {{-- Handler Engine Auto Slide --}}
        <div x-data="{
            isPaused: false,
            stepSize: 334,
            intervalId: null,
            init() { this.startAutoSlide(); },
            startAutoSlide() {
                this.intervalId = setInterval(() => {
                    if (!this.isPaused) {
                        const el = this.$refs.slider;
                        if (Math.ceil(el.scrollLeft + el.clientWidth) >= el.scrollWidth - 10) {
                            el.scrollTo({ left: 0, behavior: 'smooth' });
                        } else {
                            el.scrollBy({ left: this.stepSize, behavior: 'smooth' });
                        }
                    }
                }, 4000);
            },
            scrollNext() { this.$refs.slider.scrollBy({ left: this.stepSize, behavior: 'smooth' }); },
            scrollPrev() { this.$refs.slider.scrollBy({ left: -this.stepSize, behavior: 'smooth' }); }
        }" class="w-full">

            <div class="mb-10 flex flex-col sm:flex-row sm:items-end justify-between border-b border-stone-200 pb-6">
                <div>
                    <p class="font-sans text-sm font-semibold tracking-wider text-[#8C1515]">
                        Sivitas Pengajar & Staf
                    </p>
                    <h2 class="mt-2 text-4xl font-serif font-bold tracking-tight text-stone-900">
                        Dosen & Tenaga Pendidik
                    </h2>
                </div>

                <div class="mt-4 sm:mt-0 flex items-center space-x-4">
                    <div class="flex space-x-2">
                        <button @click="scrollPrev()"
                            class="p-2 rounded-full border border-stone-200 text-stone-600 hover:bg-stone-100 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button @click="scrollNext()"
                            class="p-2 rounded-full border border-stone-200 text-stone-600 hover:bg-stone-100 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Slider Container --}}
            <div x-ref="slider" @mouseenter="isPaused = true" @mouseleave="isPaused = false"
                class="flex gap-6 overflow-x-auto scrollbar-hide snap-x snap-mandatory pb-6"
                style="-ms-overflow-style: none; scrollbar-width: none;">
                @foreach ($staffs as $staff)
                    <div
                        class="w-[310px] flex-shrink-0 snap-start group border border-stone-100 rounded-2xl bg-stone-50/50 hover:bg-white hover:shadow-md transition-all duration-300">

                        <div class="relative aspect-[4/5] w-full overflow-hidden rounded-t-2xl bg-stone-100">
                            <img src="{{ $staff['image'] }}" alt="{{ $staff['name'] }}"
                                class="w-full h-full object-cover grayscale transition-all duration-500 group-hover:grayscale-0 group-hover:scale-105" />
                            <div class="absolute bottom-4 left-4">
                                <span
                                    class="px-3 py-1 text-[10px] font-bold tracking-widest uppercase bg-[#8C1515] text-white rounded-md">
                                    {{ $staff['role'] }}
                                </span>
                            </div>
                        </div>

                        <div class="p-5">
                            <h3
                                class="text-base font-bold font-serif leading-snug tracking-tight text-stone-900 group-hover:text-[#8C1515] transition-colors duration-200">
                                {{ $staff['name'] }}
                            </h3>
                            <p class="mt-1 text-xs text-stone-500 font-sans line-clamp-1">
                                {{ $staff['department'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
</style>
