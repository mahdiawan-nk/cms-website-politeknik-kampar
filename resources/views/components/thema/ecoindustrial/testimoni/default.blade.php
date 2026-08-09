@props(['testimonials'])

<section class="relative w-full py-12 sm:py-16 md:py-20 lg:py-24 bg-[#F8FAFC] overflow-hidden font-sans text-slate-900 select-none">

    {{-- Top Eco-Industrial Gradient Accent Strip --}}
    <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#10B981] via-emerald-400 to-[#FF8C00]">
    </div>

    {{-- Subtle Industrial Technical Grid & Ambient Glows --}}
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#00000005_1px,transparent_1px),linear-gradient(to_bottom,#00000005_1px,transparent_1px)] bg-[size:24px_24px] sm:bg-[size:36px_36px] pointer-events-none">
    </div>
    <div class="absolute top-1/2 left-1/4 -translate-y-1/2 w-48 sm:w-72 md:w-96 h-48 sm:h-72 md:h-96 bg-emerald-400/10 rounded-full blur-2xl sm:blur-3xl pointer-events-none">
    </div>
    <div class="absolute top-1/2 right-1/4 -translate-y-1/2 w-48 sm:w-72 md:w-96 h-48 sm:h-72 md:h-96 bg-amber-400/10 rounded-full blur-2xl sm:blur-3xl pointer-events-none">
    </div>

    <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 xl:px-12">

        <!-- Premium Header -->
        <x-thema.ecoindustrial.header-section :header="$testimonials['header']" />

        <!-- Slider Container dengan Alpine.js -->
        <div x-data="{
            active: 0,
            total: {{ count($testimonials['metadata'] ?? []) }},
            touchStartX: 0,
            touchEndX: 0,
            interval: null,
            next() {
                if (this.total <= 1) return;
                this.active = (this.active + 1) % this.total;
            },
            prev() {
                if (this.total <= 1) return;
                this.active = (this.active - 1 + this.total) % this.total;
            },
            start() {
                if (this.total <= 1) return;
                this.stop();
                this.interval = setInterval(() => { this.next() }, 5000);
            },
            stop() {
                if (this.interval) clearInterval(this.interval);
            },
            handleTouchStart(e) {
                this.stop();
                this.touchStartX = e.changedTouches[0].screenX;
            },
            handleTouchEnd(e) {
                this.touchEndX = e.changedTouches[0].screenX;
                if (this.touchStartX - this.touchEndX > 40) {
                    this.next();
                } else if (this.touchEndX - this.touchStartX > 40) {
                    this.prev();
                }
                this.start();
            }
        }" 
        x-init="start()" 
        @mouseenter="stop()" 
        @mouseleave="start()"
        @touchstart="handleTouchStart($event)"
        @touchend="handleTouchEnd($event)"
        class="relative max-w-5xl mx-auto mt-6 sm:mt-10 lg:mt-12 group">

            {{-- Tombol Navigasi Kiri (Laptop / Desktop) --}}
            @if (count($testimonials['metadata'] ?? []) > 1)
                <button @click="prev()"
                        aria-label="Previous Testimonial Desktop"
                        class="hidden lg:flex absolute -left-5 xl:-left-7 top-1/2 -translate-y-1/2 z-30 w-11 h-11 xl:w-12 xl:h-12 rounded-full bg-white/95 backdrop-blur-md border border-slate-200/90 items-center justify-center text-slate-600 hover:text-[#10B981] hover:border-emerald-300 shadow-md hover:shadow-xl transition-all duration-300 active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
            @endif

            <!-- Overflow Hidden Wrapper -->
            <div class="overflow-hidden rounded-[1.75rem] sm:rounded-[2.25rem] lg:rounded-[2.5rem] p-2 sm:p-4 -m-2 sm:-m-4">
                <div class="relative flex transition-transform duration-700 sm:duration-1000 ease-[cubic-bezier(0.25,1,0.5,1)]"
                    :style="'transform: translateX(-' + (active * 100) + '%)'">

                    @foreach ($testimonials['metadata'] as $index => $item)
                        <div class="w-full flex-shrink-0 px-1 sm:px-2 lg:px-4">
                            <!-- Premium Glass Card -->
                            <div
                                class="relative w-full bg-white/80 backdrop-blur-2xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.04)] hover:shadow-[0_20px_40px_-8px_rgba(16,185,129,0.1)] rounded-[1.5rem] sm:rounded-[2rem] p-5 sm:p-8 md:p-10 lg:p-12 border border-white hover:border-emerald-100 transition-all duration-500 ease-out group/card overflow-hidden">

                                <!-- Decorative SVG Quote -->
                                <svg class="absolute top-4 right-4 sm:top-8 sm:right-10 w-16 h-16 sm:w-24 sm:h-24 md:w-32 md:h-32 text-slate-100/60 -rotate-12 group-hover/card:scale-110 group-hover/card:-rotate-6 group-hover/card:text-emerald-50/60 transition-all duration-700 pointer-events-none"
                                    fill="currentColor" viewBox="0 0 32 32">
                                    <path
                                        d="M10 8c-3.3 0-6 2.7-6 6v10h10V14H8c0-2.2 1.8-4 4-4V8zm16 0c-3.3 0-6 2.7-6 6v10h10V14h-6c0-2.2 1.8-4 4-4V8z" />
                                </svg>

                                <div class="relative z-10 grid grid-cols-1 md:grid-cols-12 gap-6 sm:gap-8 md:gap-10 items-center">

                                    <!-- Avatar & Profile -->
                                    <div
                                        class="md:col-span-5 lg:col-span-4 flex flex-col items-center md:items-start text-center md:text-left">

                                        <!-- Animated Avatar Ring -->
                                        <div
                                            class="relative group-hover/card:-translate-y-1.5 transition-transform duration-500 ease-out">
                                            <div
                                                class="absolute inset-0 bg-gradient-to-br from-[#10B981] to-[#FF8C00] rounded-full blur opacity-20 group-hover/card:opacity-40 transition-opacity duration-500 scale-110">
                                            </div>
                                            @php
                                                $existAvatar = ($item['avatar'] ? asset('storage/'.$item['avatar']) : asset('img/user-default.png'));
                                            @endphp
                                            <img src="{{ $existAvatar }}" alt="{{ $item['name'] }}"
                                                class="relative object-cover w-20 h-20 sm:w-24 sm:h-24 lg:w-28 lg:h-28 rounded-full border-[3px] border-white shadow-md z-10">
                                            
                                            <!-- Success Badge Indicator -->
                                            <div
                                                class="absolute bottom-0.5 right-0.5 sm:bottom-1 sm:right-1 w-5 h-5 sm:w-6 sm:h-6 bg-white rounded-full flex items-center justify-center shadow-sm z-20">
                                                <div class="w-3 h-3 sm:w-4 sm:h-4 bg-[#10B981] rounded-full animate-pulse"></div>
                                            </div>
                                        </div>

                                        <h4
                                            class="mt-4 sm:mt-6 font-extrabold text-lg sm:text-xl tracking-tight text-slate-900 group-hover/card:text-[#10B981] transition-colors duration-300">
                                            {{ $item['name'] }}
                                        </h4>
                                        <p class="text-[11px] sm:text-xs font-semibold mt-1 text-slate-500 uppercase tracking-wider">
                                            {{ $item['major'] }}
                                        </p>
                                        <div class="mt-1 flex items-center gap-1.5 text-[11px] sm:text-xs text-slate-400 font-medium">
                                            <svg class="w-3.5 h-3.5 flex-shrink-0 text-slate-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 14l9-5-9-5-9 5 9 5z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 14l9-5-9-5-9 5 9 5z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 14v7" />
                                            </svg>
                                            <span>Lulusan {{ $item['graduation_year'] }}</span>
                                        </div>
                                    </div>

                                    <!-- Quote & Company Info -->
                                    <div class="md:col-span-7 lg:col-span-8 flex flex-col justify-center">
                                        <blockquote
                                            class="text-sm sm:text-base md:text-lg lg:text-xl leading-relaxed font-medium text-slate-700 transition-all duration-500 italic md:not-italic">
                                            "{{ $item['quote'] }}"
                                        </blockquote>

                                        <div class="mt-5 sm:mt-8 flex flex-wrap items-center justify-center md:justify-start gap-2.5 sm:gap-3">
                                            <span class="text-xs sm:text-sm font-semibold text-slate-400">Berkarier di:</span>
                                            <span
                                                class="px-3.5 py-1.5 text-[11px] sm:text-xs font-bold tracking-wider uppercase bg-slate-50 border border-slate-100 text-slate-800 rounded-full shadow-sm flex items-center gap-2 group-hover/card:border-emerald-200 group-hover/card:bg-emerald-50/50 transition-all duration-300">
                                                <svg class="w-3.5 h-3.5 text-[#FF8C00] flex-shrink-0" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                                <span>{{ $item['current_position'] }}</span>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Tombol Navigasi Kanan (Laptop / Desktop) --}}
            @if (count($testimonials['metadata'] ?? []) > 1)
                <button @click="next()"
                        aria-label="Next Testimonial Desktop"
                        class="hidden lg:flex absolute -right-5 xl:-right-7 top-1/2 -translate-y-1/2 z-30 w-11 h-11 xl:w-12 xl:h-12 rounded-full bg-white/95 backdrop-blur-md border border-slate-200/90 items-center justify-center text-slate-600 hover:text-[#FF8C00] hover:border-orange-300 shadow-md hover:shadow-xl transition-all duration-300 active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            @endif

            <!-- Navigation Controls & Dots (Mobile & Desktop) -->
            @if (count($testimonials['metadata'] ?? []) > 1)
                <div class="flex flex-col items-center gap-3 mt-6 sm:mt-8 lg:mt-10">
                    
                    {{-- Control Bar Mobile (Tombol Prev - Dots - Tombol Next) --}}
                    <div class="flex items-center justify-between w-full max-w-xs sm:max-w-sm px-2">
                        
                        {{-- Tombol Prev Mobile --}}
                        <button @click="prev()"
                                aria-label="Previous Testimonial Mobile"
                                class="lg:hidden w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-white border border-slate-200/90 flex items-center justify-center text-slate-600 active:bg-slate-100 hover:text-[#10B981] transition-all shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>

                        {{-- Ultra Premium Navigation Dots --}}
                        <div class="flex justify-center items-center gap-2 sm:gap-2.5">
                            @foreach ($testimonials['metadata'] as $index => $item)
                                <button @click="active = {{ $index }}"
                                    class="h-2 rounded-full transition-all duration-500 ease-out relative overflow-hidden focus:outline-none"
                                    :class="active === {{ $index }} ? 'w-8 sm:w-10 bg-[#10B981]' :
                                        'w-2.5 bg-slate-200 hover:bg-slate-300 hover:scale-110'"
                                    aria-label="Go to slide {{ $index + 1 }}">
                                    <!-- Shine effect on active dot -->
                                    <div x-show="active === {{ $index }}" x-transition.opacity.duration.500ms
                                        class="absolute inset-0 bg-white/40 animate-[shimmer_2s_infinite] w-full"
                                        style="transform: skewX(-20deg);">
                                    </div>
                                </button>
                            @endforeach
                        </div>

                        {{-- Tombol Next Mobile --}}
                        <button @click="next()"
                                aria-label="Next Testimonial Mobile"
                                class="lg:hidden w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-white border border-slate-200/90 flex items-center justify-center text-slate-600 active:bg-slate-100 hover:text-[#FF8C00] transition-all shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>

                    </div>

                    {{-- Hint Gesture Swipe (Mobile Only) --}}
                    <div class="flex lg:hidden items-center gap-1.5 text-slate-400 text-[11px] font-medium">
                        <svg class="w-3.5 h-3.5 animate-pulse text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                        <span>Usap layar atau tekan tombol untuk lainnya</span>
                    </div>

                </div>
            @endif

        </div>
    </div>
</section>

{{-- Shimmer Animation for Navigation Dots --}}
<style>
    @keyframes shimmer {
        0% {
            transform: translateX(-150%) skewX(-20deg);
        }
        100% {
            transform: translateX(150%) skewX(-20deg);
        }
    }
</style>