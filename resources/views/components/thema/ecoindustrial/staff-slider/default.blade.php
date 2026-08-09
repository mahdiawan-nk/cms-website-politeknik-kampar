@props(['staffs'])

<section class="relative w-full py-24 lg:py-32 bg-[#F8FAFC] overflow-hidden font-sans text-slate-900 border-t border-slate-200/50">

    <!-- Subtle Technical Grid Overlay -->
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#80808008_1px,transparent_1px),linear-gradient(to_bottom,#80808008_1px,transparent_1px)] bg-[size:40px_40px] pointer-events-none"></div>

    <!-- Ambient Eco-Industrial Glows -->
    <div class="absolute top-1/2 left-0 -translate-y-1/2 w-[500px] h-[500px] bg-emerald-300/15 rounded-full blur-[150px] pointer-events-none mix-blend-multiply"></div>
    <div class="absolute top-1/2 right-0 w-[400px] h-[400px] bg-orange-300/10 rounded-full blur-[120px] pointer-events-none mix-blend-multiply"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Engine Auto Slide (True Infinite Loop) --}}
        <div x-data="{
            isPaused: false,
            intervalId: null,
            originalWidth: 0,
            
            init() { 
                this.$nextTick(() => {
                    const slider = this.$refs.slider;
                    const items = Array.from(slider.children);
                    
                    // 1. Hitung total lebar set kartu asli (termasuk gap 24px dari 'gap-6')
                    this.originalWidth = items.reduce((acc, el) => acc + el.offsetWidth + 24, 0);
                    
                    // 2. Kloning semua kartu dan letakkan di belakang (untuk ilusi tak berujung)
                    items.forEach(item => {
                        const clone = item.cloneNode(true);
                        clone.setAttribute('aria-hidden', 'true'); // Aksesibilitas: hindari pembacaan ganda
                        slider.appendChild(clone);
                    });
                });
                
                this.startAutoSlide(); 
            },
            
            getStepSize() {
                const firstCard = this.$refs.slider.children[0];
                return firstCard ? firstCard.offsetWidth + 24 : 344; // Lebar kartu + margin
            },
            
            startAutoSlide() {
                this.intervalId = setInterval(() => {
                    if (!this.isPaused && this.$refs.slider) {
                        this.scrollNext();
                    }
                }, 4000);
            },
            
            scrollNext() { 
                const el = this.$refs.slider;
                const step = this.getStepSize();
                
                // Jika posisi sudah mencapai set kloning, reset posisi ke set asli SECARA INSTAN (0 detik)
                if (el.scrollLeft >= this.originalWidth - 5) {
                    el.style.scrollBehavior = 'auto'; // Matikan animasi
                    el.scrollLeft -= this.originalWidth; // Geser mundur secara rahasia
                    void el.offsetWidth; // Paksa browser untuk render ulang seketika
                }
                
                // Nyalakan kembali animasi lalu geser
                el.style.scrollBehavior = 'smooth';
                el.scrollBy({ left: step }); 
            },
            
            scrollPrev() { 
                const el = this.$refs.slider;
                const step = this.getStepSize();
                
                // Jika sedang di paling awal dan dipencet mundur, lompat instan ke set kloning
                if (el.scrollLeft <= 0) {
                    el.style.scrollBehavior = 'auto';
                    el.scrollLeft += this.originalWidth;
                    void el.offsetWidth;
                }
                
                el.style.scrollBehavior = 'smooth';
                el.scrollBy({ left: -step }); 
            }
        }" class="w-full">

            {{-- Header Slider & Navigation --}}
            <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6 relative z-20">
                <div class="max-w-2xl relative">
                    <p class="text-[10px] md:text-xs font-extrabold tracking-widest uppercase mb-3 text-[#FF8C00]">
                        Sivitas Pengajar & Staf
                    </p>
                    <h2 class="text-3xl md:text-4xl tracking-tight font-extrabold text-slate-900 leading-snug">
                        Dosen & <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#10B981] to-[#FF8C00]">Tenaga Pendidik</span>
                    </h2>
                </div>

                {{-- Premium Nav Buttons --}}
                <div class="hidden sm:flex items-center gap-3">
                    <button @click="scrollPrev()"
                        class="w-12 h-12 rounded-full bg-white/80 backdrop-blur border border-slate-200 flex items-center justify-center text-slate-400 hover:text-[#10B981] hover:border-emerald-200 shadow-sm hover:shadow-[0_8px_20px_-4px_rgba(16,185,129,0.15)] transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button @click="scrollNext()"
                        class="w-12 h-12 rounded-full bg-white/80 backdrop-blur border border-slate-200 flex items-center justify-center text-slate-400 hover:text-[#FF8C00] hover:border-orange-200 shadow-sm hover:shadow-[0_8px_20px_-4px_rgba(255,140,0,0.15)] transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>

            {{-- Slider Container (Class scroll-smooth dihapus dari HTML agar JS bisa mengontrolnya penuh) --}}
            <div class="relative -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8">
                <div x-ref="slider" 
                    @mouseenter="isPaused = true" 
                    @mouseleave="isPaused = false"
                    class="flex gap-6 overflow-x-auto hide-scroll snap-x snap-mandatory py-4 pb-12">
                    
                    @foreach ($staffs as $staff)
                        <div class="w-[85vw] sm:w-[320px] flex-shrink-0 snap-start group relative flex flex-col bg-white/80 backdrop-blur-xl border border-slate-200/80 rounded-[2rem] hover:border-emerald-200 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.05)] hover:shadow-[0_25px_50px_-12px_rgba(16,185,129,0.15)] transition-all duration-500 ease-[cubic-bezier(0.25,1,0.5,1)] hover:-translate-y-2 overflow-hidden">
                            
                            <!-- Top Eco-Industrial Accent Line -->
                            <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#10B981] to-[#FF8C00] scale-x-0 group-hover:scale-x-100 transition-transform duration-700 origin-left z-20"></div>

                            <!-- Photo Container -->
                            <div class="relative aspect-[4/5] w-full overflow-hidden bg-slate-100 rounded-t-[2rem]">
                                <div class="absolute inset-0 bg-slate-900/5 group-hover:bg-transparent transition-colors duration-500 z-10"></div>
                                
                                <img src="{{ $staff['image'] }}" alt="{{ $staff['name'] }}"
                                    class="w-full h-full object-cover grayscale opacity-90 transition-all duration-700 ease-out group-hover:grayscale-0 group-hover:opacity-100 group-hover:scale-105" />
                                
                                <!-- Floating Role Badge -->
                                <div class="absolute bottom-4 left-4 z-20">
                                    <span class="px-3.5 py-1.5 text-[9px] font-extrabold tracking-widest uppercase bg-white/95 backdrop-blur-md text-[#FF8C00] rounded-lg shadow-sm border border-white/20 group-hover:bg-[#10B981] group-hover:text-white group-hover:border-transparent transition-colors duration-500">
                                        {{ $staff['role'] }}
                                    </span>
                                </div>
                            </div>

                            <!-- Text Content -->
                            <div class="p-6">
                                <h3 class="text-lg font-extrabold leading-snug tracking-tight text-slate-900 group-hover:text-[#10B981] transition-colors duration-300">
                                    {{ $staff['name'] }}
                                </h3>
                                <div class="mt-2 flex items-center gap-2">
                                    <span class="w-4 h-[1px] bg-slate-300 group-hover:bg-[#FF8C00] transition-colors duration-300"></span>
                                    <p class="text-xs text-slate-500 font-bold uppercase tracking-wider line-clamp-1 group-hover:text-slate-600 transition-colors">
                                        {{ $staff['department'] }}
                                    </p>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    .hide-scroll::-webkit-scrollbar { display: none; }
    .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
</style>