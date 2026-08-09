@props(['partners','headers'])

<section class="relative w-full py-16 sm:py-20 lg:py-16 bg-[#F8FAFC] overflow-hidden font-sans select-none">

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

    <div class="relative z-20 w-full container mx-auto px-4 sm:px-6 lg:px-12" x-data="{
        activeIndex: 0,
        totalItems: {{ count($partners) }},
        autoplayInterval: null,
        isMobile: window.innerWidth < 768,
        touchStartX: 0,
        touchEndX: 0,
    
        init() {
            this.startAutoplay();
        },
        next() {
            this.activeIndex = (this.activeIndex + 1) % this.totalItems;
        },
        prev() {
            this.activeIndex = (this.activeIndex - 1 + this.totalItems) % this.totalItems;
        },
        goTo(index) {
            this.activeIndex = index;
        },
        startAutoplay() {
            this.stopAutoplay();
            this.autoplayInterval = setInterval(() => { this.next(); }, 3500);
        },
        stopAutoplay() {
            if (this.autoplayInterval) clearInterval(this.autoplayInterval);
        },
        handleTouchStart(e) {
            this.touchStartX = e.touches[0].clientX;
        },
        handleTouchEnd(e) {
            this.touchEndX = e.changedTouches[0].clientX;
            const diff = this.touchStartX - this.touchEndX;
            if (Math.abs(diff) > 40) {
                if (diff > 0) this.next();
                else this.prev();
            }
        },
    
        // Kalkulasi posisi 3D adaptif (Mobile vs Desktop)
        getCoverFlowClass(index) {
            let diff = index - this.activeIndex;
            const half = Math.floor(this.totalItems / 2);
    
            // Circular loop index
            if (diff < -half) diff += this.totalItems;
            if (diff > half) diff -= this.totalItems;
    
            // Tampilan Seluler (Mobile Optimization)
            if (this.isMobile) {
                if (diff === 0) {
                    return 'z-30 opacity-100 [transform:translateX(0)_scale(1.05)_rotateY(0deg)_translateZ(0)] shadow-[0_15px_30px_-8px_rgba(16,185,129,0.25)] border-emerald-400 bg-white';
                } else if (diff === -1) {
                    return 'z-20 opacity-50 [transform:translateX(-60%)_scale(0.8)_rotateY(20deg)_translateZ(-80px)] cursor-pointer bg-white/80 backdrop-blur-md';
                } else if (diff === 1) {
                    return 'z-20 opacity-50 [transform:translateX(60%)_scale(0.8)_rotateY(-20deg)_translateZ(-80px)] cursor-pointer bg-white/80 backdrop-blur-md';
                } else {
                    return 'z-10 opacity-0 [transform:translateX(0)_scale(0.5)_translateZ(-300px)] pointer-events-none bg-white';
                }
            }
    
            // Tampilan Desktop & Tablet (5-Layer Perspective)
            if (diff === 0) {
                return 'z-50 opacity-100 [transform:translateX(0)_scale(1.1)_rotateY(0deg)_translateZ(0)] shadow-[0_20px_40px_-10px_rgba(16,185,129,0.25)] border-emerald-400 bg-white';
            } else if (diff === -1) {
                return 'z-40 opacity-75 [transform:translateX(-75%)_scale(0.85)_rotateY(25deg)_translateZ(-100px)] cursor-pointer hover:opacity-100 bg-white/80 backdrop-blur-md';
            } else if (diff === 1) {
                return 'z-40 opacity-75 [transform:translateX(75%)_scale(0.85)_rotateY(-25deg)_translateZ(-100px)] cursor-pointer hover:opacity-100 bg-white/80 backdrop-blur-md';
            } else if (diff === -2) {
                return 'z-30 opacity-40 [transform:translateX(-135%)_scale(0.7)_rotateY(40deg)_translateZ(-200px)] cursor-pointer bg-white/60 backdrop-blur-sm';
            } else if (diff === 2) {
                return 'z-30 opacity-40 [transform:translateX(135%)_scale(0.7)_rotateY(-40deg)_translateZ(-200px)] cursor-pointer bg-white/60 backdrop-blur-sm';
            } else {
                return 'z-10 opacity-0 [transform:translateX(0)_scale(0.5)_rotateY(0deg)_translateZ(-400px)] pointer-events-none bg-white';
            }
        }
    }"
        @resize.window.debounce.100ms="isMobile = window.innerWidth < 768" @mouseenter="stopAutoplay()"
        @mouseleave="startAutoplay()">

        {{-- Section Header --}}
        <x-thema.ecoindustrial.header-section :header="$headers" layout="grid"/>

        <!-- Engine 3D Perspective -->
        <div class="relative w-full h-[160px] sm:h-[190px] md:h-[220px] flex justify-center items-center perspective-[1500px] [transform-style:preserve-3d] touch-pan-y"
            @touchstart="handleTouchStart($event)" @touchend="handleTouchEnd($event)">

            {{-- Tombol Navigasi Kiri --}}
            <button @click="prev()" aria-label="Previous Partner"
                class="absolute left-0 sm:left-2 lg:left-6 z-50 w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-white/80 backdrop-blur border border-slate-200/80 flex items-center justify-center text-slate-600 hover:text-[#10B981] hover:border-emerald-200 shadow-md transition-all duration-300 active:scale-95">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            @foreach ($partners as $index => $partner)
                <!-- Kartu Mitra Individual -->
                <div @click="goTo({{ $index }})"
                    class="absolute w-40 sm:w-56 md:w-64 lg:w-72 h-22 sm:h-26 md:h-30 flex items-center justify-center p-4 sm:p-6 rounded-2xl sm:rounded-[1.25rem] border border-slate-200/80 transition-all duration-700 ease-[cubic-bezier(0.25,1,0.5,1)] origin-center overflow-hidden group active:scale-95"
                    :class="getCoverFlowClass({{ $index }})">

                    <!-- Efek Glow Refleksi saat Aktif -->
                    <div class="absolute inset-0 bg-gradient-to-tr from-emerald-50/90 via-white/40 to-orange-50/40 transition-opacity duration-700 pointer-events-none"
                        :class="activeIndex === {{ $index }} ? 'opacity-100' : 'opacity-0'"></div>

                    <!-- Logo Image -->
                    <img src="{{ asset('storage/'.$partner['logo']) }}" alt="{{ $partner['name'] }}"
                        class="relative z-10 max-w-full max-h-full object-contain transition-all duration-700"
                        :class="activeIndex === {{ $index }} ? 'grayscale-0 opacity-100 scale-115' :
                            'grayscale opacity-60 scale-95 group-hover:grayscale-0 group-hover:opacity-90'"
                        onerror="this.onerror=null;this.src='{{ asset('img/placeholder-logo.png') }}';">
                </div>
            @endforeach

            {{-- Tombol Navigasi Kanan --}}
            <button @click="next()" aria-label="Next Partner"
                class="absolute right-0 sm:right-2 lg:right-6 z-50 w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-white/80 backdrop-blur border border-slate-200/80 flex items-center justify-center text-slate-600 hover:text-[#FF8C00] hover:border-orange-200 shadow-md transition-all duration-300 active:scale-95">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>
            </button>

        </div>

        <!-- Navigation Dots -->
        <div class="flex justify-center items-center gap-1.5 sm:gap-2 mt-6 sm:mt-8 relative z-20">
            @foreach ($partners as $index => $partner)
                <button @click="goTo({{ $index }})" aria-label="Go to partner {{ $index + 1 }}"
                    class="h-1.5 rounded-full transition-all duration-500 ease-out focus:outline-none"
                    :class="activeIndex === {{ $index }} ? 'w-6 sm:w-8 bg-gradient-to-r from-[#10B981] to-[#FF8C00]' :
                        'w-2 bg-slate-300 hover:bg-slate-400'">
                </button>
            @endforeach
        </div>

    </div>
</section>

<style>
    /* Utility pendukung perspective 3D cross-browser */
    .perspective-\\[1500px\\] {
        perspective: 1500px;
    }

    .\\[transform-style\:preserve-3d\\] {
        transform-style: preserve-3d;
    }
</style>
