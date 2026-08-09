@props(['departments'])

<section class="relative w-full py-12 sm:py-16 md:py-20 lg:py-24 bg-[#F8FAFC] overflow-hidden font-sans text-slate-900 select-none">

    {{-- Top Eco-Industrial Gradient Accent Strip --}}
    <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#10B981] via-emerald-400 to-[#FF8C00]">
    </div>

    {{-- Subtle Industrial Technical Grid & Ambient Glows (Responsive Sizing) --}}
    <div
        class="absolute inset-0 bg-[linear-gradient(to_right,#00000005_1px,transparent_1px),linear-gradient(to_bottom,#00000005_1px,transparent_1px)] bg-[size:24px_24px] sm:bg-[size:36px_36px] pointer-events-none">
    </div>
    <div
        class="absolute top-1/2 left-1/4 -translate-y-1/2 w-48 sm:w-72 md:w-96 h-48 sm:h-72 md:h-96 bg-emerald-400/10 rounded-full blur-2xl sm:blur-3xl pointer-events-none">
    </div>
    <div
        class="absolute top-1/2 right-1/4 -translate-y-1/2 w-48 sm:w-72 md:w-96 h-48 sm:h-72 md:h-96 bg-amber-400/10 rounded-full blur-2xl sm:blur-3xl pointer-events-none">
    </div>

    <div class="relative z-10 w-full container mx-auto px-4 sm:px-6 lg:px-8 xl:px-12" 
        x-data="{
            activeIndex: 0,
            totalItems: {{ count($departments['listProdi'] ?? []) }},
            autoplayInterval: null,
            touchStartX: 0,
            touchEndX: 0,
        
            init() {
                this.startAutoplay();
            },
        
            next() {
                if (this.totalItems <= 1) return;
                this.activeIndex = (this.activeIndex + 1) % this.totalItems;
            },
        
            prev() {
                if (this.totalItems <= 1) return;
                this.activeIndex = (this.activeIndex - 1 + this.totalItems) % this.totalItems;
            },
        
            goTo(index) {
                this.activeIndex = index;
            },
        
            startAutoplay() {
                if (this.totalItems <= 1) return;
                this.stopAutoplay();
                this.autoplayInterval = setInterval(() => { this.next(); }, 4500);
            },
        
            stopAutoplay() {
                if (this.autoplayInterval) clearInterval(this.autoplayInterval);
            },

            handleTouchStart(e) {
                this.stopAutoplay();
                this.touchStartX = e.changedTouches[0].screenX;
            },

            handleTouchEnd(e) {
                this.touchEndX = e.changedTouches[0].screenX;
                if (this.touchStartX - this.touchEndX > 40) {
                    this.next();
                } else if (this.touchEndX - this.touchStartX > 40) {
                    this.prev();
                }
                this.startAutoplay();
            },
        
            // Logic Cover Flow 3D Adaptif Multi-Device
            getCoverFlowClass(index) {
                let diff = index - this.activeIndex;
                const half = Math.floor(this.totalItems / 2);
        
                if (diff < -half) diff += this.totalItems;
                if (diff > half) diff -= this.totalItems;
        
                if (diff === 0) {
                    // Center Card (Aktif)
                    return 'z-50 opacity-100 [transform:translateX(0)_scale(1)_rotateY(0deg)] shadow-[0_20px_50px_-10px_rgba(16,185,129,0.25)] border-emerald-300 bg-white/95 backdrop-blur-xl pointer-events-auto';
                } else if (diff === -1) {
                    // Card Kiri 1
                    return 'z-40 opacity-40 sm:opacity-70 [transform:translateX(-22%)_scale(0.82)] sm:[transform:translateX(-48%)_scale(0.85)_rotateY(20deg)] md:[transform:translateX(-55%)_scale(0.85)_rotateY(25deg)] cursor-pointer hover:opacity-100 bg-white/80 backdrop-blur-md pointer-events-auto';
                } else if (diff === 1) {
                    // Card Kanan 1
                    return 'z-40 opacity-40 sm:opacity-70 [transform:translateX(22%)_scale(0.82)] sm:[transform:translateX(48%)_scale(0.85)_rotateY(-20deg)] md:[transform:translateX(55%)_scale(0.85)_rotateY(-25deg)] cursor-pointer hover:opacity-100 bg-white/80 backdrop-blur-md pointer-events-auto';
                } else if (diff === -2) {
                    // Card Kiri 2
                    return 'z-30 opacity-0 sm:opacity-30 [transform:translateX(-45%)_scale(0.7)] sm:[transform:translateX(-85%)_scale(0.7)_rotateY(35deg)] md:[transform:translateX(-105%)_scale(0.7)_rotateY(45deg)] pointer-events-none sm:pointer-events-auto cursor-pointer bg-white/60';
                } else if (diff === 2) {
                    // Card Kanan 2
                    return 'z-30 opacity-0 sm:opacity-30 [transform:translateX(45%)_scale(0.7)] sm:[transform:translateX(85%)_scale(0.7)_rotateY(-35deg)] md:[transform:translateX(105%)_scale(0.7)_rotateY(-45deg)] pointer-events-none sm:pointer-events-auto cursor-pointer bg-white/60';
                } else {
                    // Sembunyikan sisa kartu
                    return 'z-10 opacity-0 [transform:translateX(0)_scale(0.5)] pointer-events-none bg-white';
                }
            }
        }" 
        @mouseenter="stopAutoplay()"
        @mouseleave="startAutoplay()"
        @touchstart="handleTouchStart($event)"
        @touchend="handleTouchEnd($event)">

        <!-- Header Area -->
        <x-thema.ecoindustrial.header-section :header="$departments['header']" />

        <!-- 3D Cover Flow Container -->
        <div class="relative w-full h-[450px] sm:h-[480px] md:h-[520px] flex justify-center items-center perspective-[1200px] sm:perspective-[2000px] [transform-style:preserve-3d] mt-6 sm:mt-10 lg:mt-12 group">

            @foreach ($departments['listProdi'] as $index => $prodi)
                <!-- Hero Card -->
                <div @click="goTo({{ $index }})"
                    class="absolute w-[88vw] sm:w-[380px] lg:w-[430px] xl:w-[480px] max-w-[500px] flex flex-col justify-between p-5 sm:p-8 md:p-10 border border-slate-200/90 rounded-[1.75rem] sm:rounded-[2.25rem] lg:rounded-[2.5rem] transition-all duration-700 ease-[cubic-bezier(0.25,1,0.5,1)] origin-center"
                    :class="getCoverFlowClass({{ $index }})">

                    <!-- Top Gradient Accent Line -->
                    <div x-show="activeIndex === {{ $index }}" x-transition.opacity.duration.700ms
                        class="absolute top-0 left-8 right-8 sm:left-10 sm:right-10 h-[3px] bg-gradient-to-r from-[#10B981] to-[#FF8C00] rounded-b-full">
                    </div>

                    <div>
                        <!-- Header & Badge -->
                        <div class="flex items-start justify-between mb-4 sm:mb-6 md:mb-8">
                            <span
                                class="inline-flex text-[10px] sm:text-xs font-extrabold tracking-widest px-2.5 py-1 sm:px-3 sm:py-1.5 border rounded-full uppercase transition-colors duration-500"
                                :class="activeIndex === {{ $index }} ?
                                    'bg-[#FF8C00]/10 text-[#FF8C00] border-[#FF8C00]/30' :
                                    'bg-slate-50 text-slate-500 border-slate-100'">
                                {{ $prodi['singkatan'] }}
                            </span>
                        </div>

                        <!-- Title -->
                        <h4 class="font-extrabold text-slate-900 mb-2 sm:mb-3 leading-snug transition-all duration-500 text-base sm:text-lg md:text-xl"
                            :class="activeIndex === {{ $index }} ? 'text-[#10B981]' : ''">
                           {{ $prodi['jenjang'] }} - {{ $prodi['nama_prodi'] }}
                        </h4>

                        <!-- Akreditasi -->
                        <div class="mb-4 sm:mb-6 flex items-center gap-2">
                            <span class="flex h-2 w-2 rounded-full bg-[#10B981] animate-pulse"></span>
                            <span class="text-xs sm:text-sm font-bold uppercase tracking-wide text-slate-500">
                                Akreditasi: <span class="text-emerald-600 font-extrabold">{{ $prodi['akreditasi'] }}</span>
                            </span>
                        </div>

                        <!-- Description -->
                        <p class="text-xs sm:text-sm md:text-base font-medium leading-relaxed text-slate-500 mb-6 sm:mb-8 line-clamp-3 sm:line-clamp-4 transition-opacity duration-500"
                            :class="activeIndex === {{ $index }} ? 'opacity-100' : 'opacity-70'">
                            {{ $prodi['deskripsi'] }}
                        </p>
                    </div>

                    <!-- Read More Link -->
                    <div class="mt-auto">
                        <a href="{{ $prodi['url'] }}"
                            class="inline-flex items-center text-[11px] sm:text-xs md:text-sm font-bold tracking-widest uppercase transition-all duration-300"
                            :class="activeIndex === {{ $index }} ?
                                'text-[#FF8C00] pointer-events-auto hover:translate-x-2' :
                                'text-slate-400 pointer-events-none'">
                            <span>Pelajari Kurikulum</span>
                            <span class="ml-2.5 sm:ml-3 w-6 sm:w-8 h-[2px] relative transition-colors duration-300"
                                :class="activeIndex === {{ $index }} ? 'bg-[#FF8C00]' : 'bg-slate-200'">
                                <svg class="absolute -top-[5px] -right-1 w-3 h-3" fill="none" stroke="currentColor"
                                    stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            @endforeach

            <!-- Desktop Side Navigation Overlay -->
            @if (count($departments['listProdi'] ?? []) > 1)
                <button @click="prev()"
                    aria-label="Previous Program Studi"
                    class="hidden md:flex absolute left-2 lg:left-6 xl:left-10 top-1/2 -translate-y-1/2 z-50 w-11 h-11 lg:w-12 lg:h-12 rounded-full bg-white/90 backdrop-blur-md border border-slate-200 flex items-center justify-center text-slate-600 hover:text-[#10B981] hover:border-emerald-200 shadow-md hover:shadow-xl transition-all duration-300 active:scale-95">
                    <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button @click="next()"
                    aria-label="Next Program Studi"
                    class="hidden md:flex absolute right-2 lg:right-6 xl:right-10 top-1/2 -translate-y-1/2 z-50 w-11 h-11 lg:w-12 lg:h-12 rounded-full bg-white/90 backdrop-blur-md border border-slate-200 flex items-center justify-center text-slate-600 hover:text-[#FF8C00] hover:border-orange-200 shadow-md hover:shadow-xl transition-all duration-300 active:scale-95">
                    <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            @endif

        </div>

        <!-- Navigation Controls & Dots (Mobile & Desktop) -->
        @if (count($departments['listProdi'] ?? []) > 1)
            <div class="flex flex-col items-center gap-3 mt-6 sm:mt-10 relative z-20">
                
                {{-- Control Bar Mobile (Tombol Prev - Dots - Tombol Next) --}}
                <div class="flex items-center justify-between w-full max-w-xs sm:max-w-sm px-2">
                    
                    {{-- Tombol Prev Mobile --}}
                    <button @click="prev()"
                            aria-label="Previous Program Studi Mobile"
                            class="md:hidden w-9 h-9 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-600 active:bg-slate-100 hover:text-[#10B981] transition-all shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    {{-- Pagination Dots --}}
                    <div class="flex justify-center items-center gap-2 sm:gap-2.5">
                        @foreach ($departments['listProdi'] as $index => $prodi)
                            <button @click="goTo({{ $index }})"
                                class="h-2 rounded-full transition-all duration-500 ease-out focus:outline-none"
                                :class="activeIndex === {{ $index }} ? 'w-8 sm:w-10 bg-gradient-to-r from-[#10B981] to-[#FF8C00]' :
                                    'w-2 bg-slate-300 hover:bg-slate-400'"
                                aria-label="Go to prodi {{ $index + 1 }}">
                            </button>
                        @endforeach
                    </div>

                    {{-- Tombol Next Mobile --}}
                    <button @click="next()"
                            aria-label="Next Program Studi Mobile"
                            class="md:hidden w-9 h-9 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-600 active:bg-slate-100 hover:text-[#FF8C00] transition-all shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                </div>

                {{-- Hint Gesture Swipe (Mobile Only) --}}
                <div class="flex md:hidden items-center gap-1.5 text-slate-400 text-[11px] font-medium">
                    <svg class="w-3.5 h-3.5 animate-pulse text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                    <span>Usap layar atau tekan tombol untuk prodi lainnya</span>
                </div>

            </div>
        @endif

    </div>
</section>

<!-- Ekstra Helper Style untuk Perspective 3D -->
<style>
    .perspective-\[1200px\] {
        perspective: 1200px;
    }

    .perspective-\[2000px\] {
        perspective: 2000px;
    }

    .\[transform-style\:preserve-3d\] {
        transform-style: preserve-3d;
    }
</style>