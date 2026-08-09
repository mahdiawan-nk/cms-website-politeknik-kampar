@props(['departments'])

<section class="relative w-full py-32 bg-[#F8FAFC] overflow-hidden font-sans text-slate-900 border-t border-slate-200/50">

    <!-- Subtle Technical Grid Overlay -->
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#80808008_1px,transparent_1px),linear-gradient(to_bottom,#80808008_1px,transparent_1px)] bg-[size:40px_40px] pointer-events-none"></div>

    <!-- Ambient Eco-Industrial Glows -->
    <div class="absolute top-[-10%] left-[-5%] w-[500px] h-[500px] bg-emerald-200/20 rounded-full blur-[120px] pointer-events-none mix-blend-multiply"></div>
    <div class="absolute bottom-[-10%] right-[-5%] w-[500px] h-[500px] bg-orange-200/20 rounded-full blur-[120px] pointer-events-none mix-blend-multiply"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"
        x-data="{
            isAutoplay: true,
            interval: null,
            scrollNext() {
                const slider = this.$refs.slider;
                // Jika sudah di ujung kanan, kembali ke awal
                if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth - 10) {
                    slider.scrollTo({ left: 0, behavior: 'smooth' });
                } else {
                    // Geser sejauh 1 lebar kartu + gap
                    slider.scrollBy({ left: slider.clientWidth > 1024 ? slider.clientWidth / 4 : slider.clientWidth > 768 ? slider.clientWidth / 2 : slider.clientWidth, behavior: 'smooth' });
                }
            },
            scrollPrev() {
                const slider = this.$refs.slider;
                slider.scrollBy({ left: -(slider.clientWidth > 1024 ? slider.clientWidth / 4 : slider.clientWidth > 768 ? slider.clientWidth / 2 : slider.clientWidth), behavior: 'smooth' });
            },
            startAutoplay() {
                this.isAutoplay = true;
                this.interval = setInterval(() => {
                    this.scrollNext();
                }, 4000); // 4 detik per slide
            },
            stopAutoplay() {
                this.isAutoplay = false;
                clearInterval(this.interval);
            }
        }"
        x-init="startAutoplay()"
        @mouseenter="stopAutoplay()"
        @mouseleave="startAutoplay()"
    >

        <!-- Header Area (Tetap menggunakan Livewire Anda) -->
        <div class="mb-12 relative z-20">
            <livewire:ui.header-section badge="Program Akademik" title="Pilihan Program Studi"
                description="Mempersiapkan lulusan siap kerja dengan kurikulum berbasis industri terapan dan laboratorium berstandar internasional." />
            
            <!-- Custom Premium Navigation Arrows (Desktop) -->
            <div class="hidden lg:flex absolute bottom-0 right-0 gap-3">
                <button @click="scrollPrev()" class="w-12 h-12 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-400 hover:text-[#10B981] hover:border-emerald-200 hover:shadow-[0_8px_20px_-4px_rgba(16,185,129,0.15)] transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button @click="scrollNext()" class="w-12 h-12 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-400 hover:text-[#FF8C00] hover:border-orange-200 hover:shadow-[0_8px_20px_-4px_rgba(255,140,0,0.15)] transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>

        <!-- Slider Track -->
        <div class="relative -mx-4 sm:-mx-6 lg:mx-0">
            <div x-ref="slider" 
                 class="flex overflow-x-auto gap-6 px-4 sm:px-6 lg:px-4 pb-12 pt-4 snap-x snap-mandatory hide-scroll scroll-smooth">
                
                @foreach ($departments as $prodi)
                    <!-- Premium Slider Card -->
                    <div class="snap-start shrink-0 w-[85vw] sm:w-[calc(50%-12px)] lg:w-[calc(25%-18px)] group relative flex flex-col justify-between p-8 bg-white/80 backdrop-blur-xl border border-slate-200/80 hover:border-emerald-200 rounded-[2rem] shadow-[0_4px_20px_-10px_rgba(0,0,0,0.05)] hover:shadow-[0_25px_50px_-12px_rgba(16,185,129,0.15)] hover:-translate-y-2 transition-all duration-500 ease-[cubic-bezier(0.25,1,0.5,1)]">
                        
                        <!-- Eco-Industrial Accent Line (Top) -->
                        <div class="absolute top-0 left-8 right-8 h-[2px] bg-gradient-to-r from-[#10B981] to-[#FF8C00] scale-x-0 group-hover:scale-x-100 transition-transform duration-700 origin-left"></div>

                        <div>
                            <!-- Header Info Card -->
                            <div class="flex items-start justify-between mb-8">
                                <span class="inline-flex text-[10px] font-extrabold tracking-widest px-3 py-1.5 border border-slate-100 text-slate-500 rounded-full bg-slate-50 uppercase group-hover:bg-[#FF8C00]/10 group-hover:text-[#FF8C00] group-hover:border-[#FF8C00]/20 transition-colors duration-300">
                                    {{ $prodi['code'] }}
                                </span>

                                <!-- Icon Container -->
                                <div class="w-12 h-12 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-[#10B981] group-hover:text-white group-hover:border-[#10B981] group-hover:rotate-3 transition-all duration-500 shadow-sm">
                                    @if ($prodi['icon'] === 'cpu')
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21M6.75 6.75h10.5a2.25 2.25 0 0 1 2.25 2.25v10.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V9a2.25 2.25 0 0 1 2.25-2.25Z" /></svg>
                                    @elseif($prodi['icon'] === 'code')
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" /></svg>
                                    @elseif($prodi['icon'] === 'droplet')
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" /></svg>
                                    @else
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 .621-.504 1.125-1.125 1.125H4.875A1.125 1.125 0 0 1 3.75 19.5v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38c-1.87.63-4.102.9-6.177.9-2.074 0-4.307-.27-6.177-.9a3.123 3.123 0 0 1-.673-.38m0 0a2.18 2.18 0 0 1-.75-1.661V8.706c0-1.081.768-2.015 1.837-2.175a48.114 48.114 0 0 1 3.413-.387m11.125 4.158v-4.158m-11 4.158v-4.158m11-4.158c-.18-.011-.36-.024-.54-.037M5.43 6.368c.18-.011.36-.024.54-.037m3.93 0a48.694 48.694 0 0 1 4.2-.1c.53 0 1.062.011 1.592.037m-5.792-.037a48.396 48.396 0 0 1 4.2-.1" /></svg>
                                    @endif
                                </div>
                            </div>

                            <!-- Title -->
                            <h4 class="text-xl font-extrabold text-slate-900 mb-3 group-hover:text-[#10B981] transition-colors duration-300 leading-snug">
                                {{ $prodi['title'] }}
                            </h4>

                            <!-- Akreditasi Badge -->
                            <div class="mb-5 flex items-center gap-2">
                                <span class="flex h-2 w-2 rounded-full bg-[#10B981]"></span>
                                <span class="text-xs font-bold uppercase tracking-wide text-slate-600">
                                    Akreditasi: <span class="text-emerald-600">{{ $prodi['accreditation'] }}</span>
                                </span>
                            </div>

                            <!-- Description -->
                            <p class="text-sm font-medium leading-relaxed text-slate-500 mb-10 line-clamp-3">
                                {{ $prodi['desc'] }}
                            </p>
                        </div>

                        <!-- Read More Link -->
                        <a href="/prodi/{{ $prodi['slug'] }}" class="inline-flex items-center text-xs font-bold tracking-widest uppercase text-slate-400 group-hover:text-[#FF8C00] transition-colors duration-300 mt-auto">
                            <span>Pelajari Kurikulum</span>
                            <span class="ml-3 w-8 h-[2px] bg-slate-200 group-hover:bg-[#FF8C00] relative transition-colors duration-300">
                                <svg class="absolute -top-[5px] -right-1 w-3 h-3 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                            </span>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
        
        <!-- Mobile Navigation (Dots Indicator) -->
        <div class="flex lg:hidden justify-center items-center gap-4 mt-2">
            <button @click="scrollPrev()" class="p-2 text-slate-400 active:text-[#10B981]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <div class="flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-[#10B981]"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
            </div>
            <button @click="scrollNext()" class="p-2 text-slate-400 active:text-[#FF8C00]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>

    </div>
</section>

<!-- Hide scrollbar utility class -->
<style>
    .hide-scroll::-webkit-scrollbar { display: none; }
    .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
</style>