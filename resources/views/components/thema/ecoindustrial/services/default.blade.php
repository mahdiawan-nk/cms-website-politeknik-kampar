@props(['services'])

<section class="relative w-full py-12 sm:py-16 md:py-20 lg:py-24 bg-[#F8FAFC] overflow-hidden font-sans text-slate-900 select-none">

    {{-- Top Eco-Industrial Gradient Accent Strip --}}
    <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#10B981] via-emerald-400 to-[#FF8C00]"></div>

    {{-- Subtle Industrial Technical Grid & Ambient Glows (Responsive Sizing) --}}
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#00000005_1px,transparent_1px),linear-gradient(to_bottom,#00000005_1px,transparent_1px)] bg-[size:24px_24px] sm:bg-[size:36px_36px] pointer-events-none"></div>
    <div class="absolute top-1/2 left-1/4 -translate-y-1/2 w-48 sm:w-72 md:w-96 h-48 sm:h-72 md:h-96 bg-emerald-400/10 rounded-full blur-2xl sm:blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/2 right-1/4 -translate-y-1/2 w-48 sm:w-72 md:w-96 h-48 sm:h-72 md:h-96 bg-amber-400/10 rounded-full blur-2xl sm:blur-3xl pointer-events-none"></div>

    <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 xl:px-12" 
         x-data="{
             atStart: true,
             atEnd: false,
             checkScroll() {
                 const slider = this.$refs.serviceSlider;
                 if (!slider) return;
                 this.atStart = slider.scrollLeft <= 10;
                 this.atEnd = (slider.scrollLeft + slider.clientWidth) >= (slider.scrollWidth - 10);
             },
             scrollNext() {
                 const slider = this.$refs.serviceSlider;
                 const scrollAmount = slider.clientWidth * 0.75;
                 slider.scrollBy({ left: scrollAmount, behavior: 'smooth' });
             },
             scrollPrev() {
                 const slider = this.$refs.serviceSlider;
                 const scrollAmount = slider.clientWidth * 0.75;
                 slider.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
             }
         }"
         x-init="$nextTick(() => checkScroll())">

        {{-- Header Seksi --}}
        <x-thema.ecoindustrial.header-section :header="$services['header']" />

        {{-- Slider Wrapper dengan Navigasi Adaptif --}}
        <div class="relative group mt-6 sm:mt-10 lg:mt-12">

            {{-- Tombol Navigasi Kiri (Laptop / Desktop / Desktop Wide) --}}
            <button @click="scrollPrev()"
                    :disabled="atStart"
                    :class="{ 'opacity-30 cursor-not-allowed pointer-events-none': atStart, 'opacity-100 hover:scale-105 active:scale-95': !atStart }"
                    aria-label="Previous Service"
                    class="hidden lg:flex absolute -left-4 xl:-left-6 top-1/2 -translate-y-1/2 z-30 w-11 h-11 xl:w-12 xl:h-12 rounded-full bg-white/95 backdrop-blur-md border border-slate-200/90 items-center justify-center text-slate-600 hover:text-[#10B981] hover:border-emerald-300 shadow-lg hover:shadow-xl transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            {{-- Horizontal Track Layanan Modular --}}
            <div class="relative -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8">
                <div x-ref="serviceSlider"
                     @scroll.debounce.100ms="checkScroll()"
                     class="flex overflow-x-auto gap-4 sm:gap-6 pb-6 sm:pb-8 pt-3 sm:pt-4 snap-x snap-mandatory hide-scroll scroll-smooth touch-pan-x">

                    @foreach ($services['metadata'] as $service)
                        <div class="snap-start shrink-0 w-[85vw] max-w-[320px] sm:max-w-none sm:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] xl:w-[calc(25%-18px)] group/card relative flex flex-col justify-between p-5 sm:p-6 md:p-8 bg-white/80 backdrop-blur-xl border border-slate-200/80 rounded-[1.5rem] sm:rounded-[2rem] hover:border-emerald-200 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.05)] hover:shadow-[0_25px_50px_-12px_rgba(16,185,129,0.15)] transition-all duration-500 ease-[cubic-bezier(0.25,1,0.5,1)] hover:-translate-y-1.5 sm:hover:-translate-y-2">

                            {{-- Top Accent Line --}}
                            <div class="absolute top-0 left-6 right-6 sm:left-8 sm:right-8 h-[2px] bg-gradient-to-r from-[#10B981] to-[#FF8C00] scale-x-0 group-hover/card:scale-x-100 transition-transform duration-500 origin-left">
                            </div>

                            <div class="flex flex-col h-full justify-between">
                                <div>
                                    {{-- Audience Badge --}}
                                    <div class="flex items-start justify-between mb-4 sm:mb-6">
                                        <span class="text-[9px] sm:text-[10px] uppercase font-extrabold tracking-widest px-2.5 py-1.5 bg-slate-100/90 text-slate-500 rounded-md group-hover/card:bg-[#FF8C00]/10 group-hover/card:text-[#FF8C00] transition-colors duration-300">
                                            {{ $service['kategori'] }}
                                        </span>
                                    </div>

                                    {{-- Judul Layanan --}}
                                    <h3 class="text-base sm:text-lg lg:text-xl font-extrabold tracking-tight leading-snug text-slate-900 group-hover/card:text-[#10B981] transition-colors duration-300 mb-2 sm:mb-3">
                                        {{ $service['name_services'] }}
                                    </h3>

                                    {{-- Deskripsi --}}
                                    <p class="text-xs sm:text-sm font-medium leading-relaxed text-slate-500 line-clamp-3 sm:line-clamp-4">
                                        {{ $service['description'] }}
                                    </p>
                                </div>

                                {{-- Tombol Aksi --}}
                                <div class="mt-6 sm:mt-8 pt-4 sm:pt-6 border-t border-slate-200/60">
                                    <a href="{{ $service['url'] }}"
                                       class="inline-flex items-center w-full justify-between text-[10px] sm:text-xs font-bold tracking-widest uppercase text-slate-400 group-hover/card:text-[#FF8C00] transition-colors duration-300 focus:outline-none focus:text-[#FF8C00]">
                                        <span>Akses Portal</span>
                                        <div class="flex items-center">
                                            <span class="w-5 sm:w-6 h-[2px] bg-slate-200 group-hover/card:bg-[#FF8C00] relative transition-colors duration-300"></span>
                                            <svg class="w-4 h-4 transform transition-transform duration-300 group-hover/card:translate-x-1 -ml-1 text-slate-300 group-hover/card:text-[#FF8C00]"
                                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </div>
                                    </a>
                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>
            </div>

            {{-- Tombol Navigasi Kanan (Laptop / Desktop / Desktop Wide) --}}
            <button @click="scrollNext()"
                    :disabled="atEnd"
                    :class="{ 'opacity-30 cursor-not-allowed pointer-events-none': atEnd, 'opacity-100 hover:scale-105 active:scale-95': !atEnd }"
                    aria-label="Next Service"
                    class="hidden lg:flex absolute -right-4 xl:-right-6 top-1/2 -translate-y-1/2 z-30 w-11 h-11 xl:w-12 xl:h-12 rounded-full bg-white/95 backdrop-blur-md border border-slate-200/90 items-center justify-center text-slate-600 hover:text-[#FF8C00] hover:border-orange-300 shadow-lg hover:shadow-xl transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            {{-- Navigasi Mobile / Tablet (Bawah Slider) --}}
            <div class="flex lg:hidden items-center justify-between mt-4 px-2">
                {{-- Hint Gesture Swipe --}}
                <div class="flex items-center gap-1.5 text-slate-400 text-[11px] font-medium">
                    <svg class="w-4 h-4 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                    <span>Geser untuk melihat layanan</span>
                </div>

                {{-- Tombol Prev / Next Mobile --}}
                <div class="flex items-center gap-2">
                    <button @click="scrollPrev()"
                            :disabled="atStart"
                            :class="{ 'opacity-30 cursor-not-allowed': atStart }"
                            aria-label="Previous Service Mobile"
                            class="w-9 h-9 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-600 active:bg-slate-100 transition-all shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <button @click="scrollNext()"
                            :disabled="atEnd"
                            :class="{ 'opacity-30 cursor-not-allowed': atEnd }"
                            aria-label="Next Service Mobile"
                            class="w-9 h-9 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-600 active:bg-slate-100 transition-all shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>

        </div>

    </div>
</section>

{{-- Cross-Browser Hide Scrollbar --}}
<style>
    .hide-scroll::-webkit-scrollbar {
        display: none;
    }
    .hide-scroll {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>