@props(['staffs'])

<section
    class="relative w-full py-16 md:py-24 lg:py-16 bg-[#F8FAFC] overflow-hidden font-sans text-slate-900 select-none">

    {{-- Top Eco-Industrial Gradient Accent Strip --}}
    <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#10B981] via-emerald-400 to-[#FF8C00]">
    </div>

    {{-- Subtle Industrial Technical Grid & Ambient Glows --}}
    <div
        class="absolute inset-0 bg-[linear-gradient(to_right,#00000005_1px,transparent_1px),linear-gradient(to_bottom,#00000005_1px,transparent_1px)] bg-[size:36px_36px] pointer-events-none">
    </div>
    <div
        class="absolute top-1/2 left-1/4 -translate-y-1/2 w-72 md:w-96 h-72 md:h-96 bg-emerald-400/10 rounded-full blur-3xl pointer-events-none">
    </div>
    <div
        class="absolute top-1/2 right-1/4 -translate-y-1/2 w-72 md:w-96 h-72 md:h-96 bg-amber-400/10 rounded-full blur-3xl pointer-events-none">
    </div>

    <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-12" x-data="{
        active: 0,
        total: {{ count($staffs['metadata']) }},
        isHovered: false,
        interval: null,
        isMobile: window.innerWidth < 768,
        touchStartX: 0,
        touchEndX: 0,
    
        init() {
            this.startAutoPlay();
        },
    
        next() {
            this.active = (this.active + 1) % this.total;
        },
    
        prev() {
            this.active = (this.active - 1 + this.total) % this.total;
        },
    
        startAutoPlay() {
            this.interval = setInterval(() => {
                if (!this.isHovered) {
                    this.next();
                }
            }, 4000);
        },
    
        // Touch Handling untuk Mobile Swipe Gesture
        handleTouchStart(e) {
            this.touchStartX = e.touches[0].clientX;
        },
    
        handleTouchEnd(e) {
            this.touchEndX = e.changedTouches[0].clientX;
            const diff = this.touchStartX - this.touchEndX;
            if (Math.abs(diff) > 40) { // Threshold 40px swipe
                if (diff > 0) this.next();
                else this.prev();
            }
        },
    
        // Logika Engine 3D Transform Adaptif (Mobile vs Desktop)
        getStyle(index) {
            // 1. Posisi Tengah (Active View)
            if (index === this.active) {
                return 'transform: translateX(0) scale(1) rotateY(0deg) translateZ(0); z-index: 30; opacity: 1;';
            }
    
            // Kalkulasi index Kiri dan Kanan (Infinite Wrap)
            let left1 = (this.active - 1 + this.total) % this.total;
            let right1 = (this.active + 1) % this.total;
            let left2 = (this.active - 2 + this.total) % this.total;
            let right2 = (this.active + 2) % this.total;
    
            // Mode Mobile: Skala & Jarak Lebih Rapat
            if (this.isMobile) {
                if (index === left1) {
                    return 'transform: translateX(-68%) scale(0.82) rotateY(12deg) translateZ(-60px); z-index: 20; opacity: 0.35; filter: blur(1px); cursor: pointer;';
                }
                if (index === right1) {
                    return 'transform: translateX(68%) scale(0.82) rotateY(-12deg) translateZ(-60px); z-index: 20; opacity: 0.35; filter: blur(1px); cursor: pointer;';
                }
                // Sembunyikan layer 2 di mobile agar layar tidak crowded
                return 'transform: translateX(0) scale(0.5) translateZ(-300px); z-index: 0; opacity: 0; pointer-events: none;';
            }
    
            // Mode Desktop: 5-Layer Perspective
            if (index === left1) {
                return 'transform: translateX(-55%) scale(0.85) rotateY(15deg) translateZ(-100px); z-index: 20; opacity: 0.6; filter: blur(1px); cursor: pointer;';
            }
            if (index === right1) {
                return 'transform: translateX(55%) scale(0.85) rotateY(-15deg) translateZ(-100px); z-index: 20; opacity: 0.6; filter: blur(1px); cursor: pointer;';
            }
            if (index === left2) {
                return 'transform: translateX(-105%) scale(0.7) rotateY(25deg) translateZ(-220px); z-index: 10; opacity: 0.25; filter: blur(3px); cursor: pointer;';
            }
            if (index === right2) {
                return 'transform: translateX(105%) scale(0.7) rotateY(-25deg) translateZ(-220px); z-index: 10; opacity: 0.25; filter: blur(3px); cursor: pointer;';
            }
    
            return 'transform: translateX(0) scale(0.5) translateZ(-400px); z-index: 0; opacity: 0; pointer-events: none;';
        }
    }"
        @resize.window.debounce.100ms="isMobile = window.innerWidth < 768">

        {{-- Header Seksi --}}
        <x-thema.ecoindustrial.header-section :header="$staffs['header']" layout="grid"/>

        {{-- 3D Viewport --}}
        <div class="relative w-full h-[490px] sm:h-[540px] md:h-[620px] flex items-center justify-center perspective-[1200px] touch-pan-y"
            @mouseenter="isHovered = true" @mouseleave="isHovered = false" @touchstart="handleTouchStart($event)"
            @touchend="handleTouchEnd($event)">

            {{-- Tombol Navigasi Kiri --}}
            <button @click="prev()" aria-label="Previous Slide"
                class="absolute left-1 sm:left-4 z-40 w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-white/90 backdrop-blur border border-slate-200/80 flex items-center justify-center text-slate-500 hover:text-[#10B981] hover:border-emerald-200 shadow-md hover:shadow-lg transition-all duration-300 transform -translate-y-1/2 top-1/2 active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <!-- Cards Container -->
            <div
                class="relative w-full max-w-[290px] sm:max-w-sm md:max-w-md h-full flex items-center justify-center transform-style-3d">
                @foreach ($staffs['metadata'] as $index => $staff)
                    <!-- Individual 3D Card -->
                    <div :style="getStyle({{ $index }})" @click="active = {{ $index }}"
                        class="absolute w-[82vw] max-w-[320px] sm:max-w-[380px] md:max-w-[380px] flex flex-col bg-white/95 backdrop-blur-2xl rounded-[1.75rem] sm:rounded-[2rem] transition-all duration-[700ms] cubic-bezier(0.25, 1, 0.5, 1) will-change-transform"
                        :class="active === {{ $index }} ?
                            'border-2 border-[#10B981]/50 shadow-[0_12px_40px_-10px_rgba(16,185,129,0.25)]' :
                            'border border-slate-200/80 shadow-md'">

                        <!-- Top Accent Line -->
                        <div class="absolute top-0 left-6 right-6 sm:left-8 sm:right-8 h-[2px] bg-gradient-to-r from-[#10B981] to-[#FF8C00] transition-opacity duration-500 z-30"
                            :class="active === {{ $index }} ? 'opacity-100' : 'opacity-0'"></div>

                        <!-- Image/Portrait Area -->
                        <div
                            class="relative aspect-[4/4.5] sm:aspect-[4/5] w-full rounded-t-[1.75rem] sm:rounded-t-[2rem] bg-slate-100 overflow-hidden group">
                            @php
                                $existFile = ($staff['photo'] ? asset('storage/'.$staff['photo']) : asset('img/logo-plkm.png'));
                            @endphp
                            <!-- Foto Dosen -->
                            <img src="{{ $existFile }}" alt="{{ $staff['name'] }}"
                                class="relative z-10 w-full h-full object-cover transition-all duration-[700ms]"
                                :class="active === {{ $index }} ? 'scale-105 grayscale-0' :
                                    'scale-100 grayscale opacity-60'" />

                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-slate-900/0 to-transparent z-15 transition-opacity duration-500"
                                :class="active === {{ $index }} ? 'opacity-100' : 'opacity-0'"></div>

                            <!-- Live Status Badge -->
                            <div class="absolute top-3 right-3 sm:top-4 sm:right-4 z-20 transition-all duration-500"
                                :class="active === {{ $index }} ? 'opacity-100 translate-y-0' :
                                    'opacity-0 -translate-y-2 pointer-events-none'">
                                <span
                                    class="flex items-center gap-1.5 px-2.5 py-1 bg-white/90 backdrop-blur border border-white/20 text-[#10B981] text-[8px] sm:text-[9px] font-extrabold tracking-widest uppercase rounded-full shadow-sm">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#10B981] animate-pulse"></span>
                                    Profil Aktif
                                </span>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div
                            class="p-4 sm:p-6 text-center bg-white rounded-b-[1.75rem] sm:rounded-b-[2rem] flex flex-col justify-center border-t border-slate-100">

                            <!-- Role -->
                            <span
                                class="text-[9px] sm:text-[10px] font-extrabold uppercase tracking-widest text-[#FF8C00] mb-1 sm:mb-2 block">
                                {{ $staff['role'] }}
                            </span>

                            <!-- Name -->
                            <h3 class="text-base sm:text-lg md:text-xl font-extrabold tracking-tight text-slate-900 mb-1.5 sm:mb-2 transition-colors duration-300 leading-snug line-clamp-1"
                                :class="active === {{ $index }} ? 'text-[#10B981]' : ''">
                                {{ $staff['name'] }}
                            </h3>

                            <!-- NIDN & Department Container -->
                            <div class="flex flex-col gap-1.5 items-center transition-all duration-500"
                                :class="active === {{ $index }} ? 'opacity-100 translate-y-0 h-auto' :
                                    'opacity-0 translate-y-2 h-0 overflow-hidden'">

                                <!-- NIDN Badge -->
                                {{-- <span
                                    class="inline-block px-2 py-0.5 sm:px-2.5 sm:py-1 bg-slate-100 text-slate-600 text-[9px] sm:text-[10px] font-bold rounded-md font-mono tracking-wider">
                                    NIDN: {{ $staff['nidn'] }}
                                </span> --}}

                                <!-- Department -->
                                <p
                                    class="text-[11px] sm:text-xs font-medium text-slate-500 line-clamp-1 sm:line-clamp-2 leading-relaxed">
                                    {{ $staff['department'] }}
                                </p>
                            </div>

                        </div>

                    </div>
                @endforeach
            </div>

            {{-- Tombol Navigasi Kanan --}}
            <button @click="next()" aria-label="Next Slide"
                class="absolute right-1 sm:right-4 z-40 w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-white/90 backdrop-blur border border-slate-200/80 flex items-center justify-center text-slate-500 hover:text-[#FF8C00] hover:border-orange-200 shadow-md hover:shadow-lg transition-all duration-300 transform -translate-y-1/2 top-1/2 active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        {{-- Mobile & Desktop Pagination Dots --}}
        <div class="flex items-center justify-center gap-2 mt-4 sm:mt-6 relative z-30">
            <template x-for="(staff, index) in total" :key="index">
                <button @click="active = index" class="h-2 rounded-full transition-all duration-300 focus:outline-none"
                    :class="active === index ? 'w-7 sm:w-8 bg-gradient-to-r from-[#10B981] to-[#FF8C00]' :
                        'w-2 bg-slate-300 hover:bg-slate-400'"
                    :aria-label="'Go to slide ' + (index + 1)">
                </button>
            </template>
        </div>

    </div>
</section>

<!-- Custom CSS Utilities -->
<style>
    .perspective-\\[1200px\\] {
        perspective: 1200px;
    }

    .transform-style-3d {
        transform-style: preserve-3d;
    }
</style>
