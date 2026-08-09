@props(['slides'])
<div x-data="{
    // Tambahkan .live jika Anda menggunakan Livewire v3 dan butuh sinkronisasi realtime
    current: @entangle('currentSlide'),
    
    // Pengaman jika $slides kebetulan null/kosong
    total: {{ is_countable($slides) ? count($slides) : 0 }},
    
    animMode: 'horizontal',
    modes: ['horizontal', 'vertical', 'diagonal', 'cube', 'flip'],

    init() {
        this.$watch('current', value => {
            this.animMode = this.modes[Math.floor(Math.random() * this.modes.length)];
        });
        
        // PERBAIKAN: Gunakan this.$wire (bukan $wire saja) 
        // dan jalankan autoplay hanya jika slide lebih dari 1
        if (this.total > 1) {
            setInterval(() => { 
                this.$wire.nextSlide(); 
            }, 5000);
        }
    },

    getStyle(index) {
        let diff = index - this.current;
        if (diff > Math.floor(this.total / 2)) diff -= this.total;
        if (diff < -Math.floor(this.total / 2)) diff += this.total;

        let transition = 'transition: all 1.2s cubic-bezier(0.2, 0.8, 0.2, 1);';

        // --- POSISI KARTU AKTIF (TENGAH) ---
        if (diff === 0) {
            return transition + 'transform: translate3d(0%, 0%, 60px) rotateX(0deg) rotateY(0deg) rotateZ(0deg) scale(1); z-index: 50; opacity: 1; filter: blur(0px); box-shadow: 0 40px 100px -20px rgba(15, 23, 42, 0.25), 0 20px 40px -20px rgba(16, 185, 129, 0.15); pointer-events: auto;';
        }

        let tx = 0, ty = 0, tz = -150, rx = 0, ry = 0, rz = 0;
        let scale = 0.85, opacity = 0.6, blur = 3; 
        let isNext = diff > 0;

        switch(this.animMode) {
            case 'horizontal': 
                tx = isNext ? 65 : -65;
                ry = isNext ? -22 : 22;
                break;
            case 'vertical': 
                ty = isNext ? 75 : -75;
                rx = isNext ? 22 : -22;
                break;
            case 'diagonal': 
                tx = isNext ? 55 : -55;
                ty = isNext ? -55 : 55;
                ry = isNext ? -15 : 15;
                rz = isNext ? 10 : -10;
                break;
            case 'cube': 
                tx = isNext ? 80 : -80;
                tz = -400;
                ry = isNext ? -90 : 90;
                opacity = 0.2;
                break;
            case 'flip': 
                ty = isNext ? 50 : -50;
                rx = isNext ? -180 : 180;
                tz = -300;
                opacity = 0;
                break;
        }

        if (Math.abs(diff) > 1) {
            tz = -500;
            opacity = 0;
            blur = 15;
            scale = 0.5;
            
            if (['horizontal', 'cube', 'diagonal'].includes(this.animMode)) tx = isNext ? 120 : -120;
            if (['vertical', 'flip'].includes(this.animMode)) ty = isNext ? 120 : -120;
        }

        return `${transition} transform: translate3d(${tx}%, ${ty}%, ${tz}px) rotateX(${rx}deg) rotateY(${ry}deg) rotateZ(${rz}deg) scale(${scale}); z-index: ${40 - Math.abs(diff)}; opacity: ${opacity}; filter: blur(${blur}px); cursor: pointer; pointer-events: auto;`;
    }
}" 
class="relative w-full h-[100vh] min-h-[750px] overflow-hidden bg-[#F8FAFC] flex items-center justify-center font-sans select-none">
    <!-- Premium Cinematic Blurred Background (Light Mode) -->
    <div class="absolute inset-0 z-0 overflow-hidden">
        @foreach ($slides as $index => $slide)
            @php
                $imageUrl = isset($slide->image_url) ? $slide->image_url : (str_starts_with($slide->image_path ?? '', 'http') ? $slide->image_path : asset('storage/' . $slide->image_path));
            @endphp
            <div x-show="current === {{ $index }}" 
                x-transition:enter="transition ease-out duration-[2000ms]"
                x-transition:enter-start="opacity-0 scale-100" 
                x-transition:enter-end="opacity-40 scale-125"
                x-transition:leave="transition ease-in duration-[1500ms]" 
                x-transition:leave-start="opacity-40 scale-125"
                x-transition:leave-end="opacity-0 scale-150" 
                class="absolute inset-0 bg-cover bg-center blur-[100px] saturate-[1.2]"
                style="background-image: url('{{ $imageUrl }}');">
            </div>
        @endforeach
        <!-- Fade Lembut ke Latar Belakang Light Mode (Tidak menggunakan hitam pekat) -->
        <div class="absolute inset-0 bg-gradient-to-b from-white/30 via-white/70 to-[#F8FAFC]"></div>
    </div>

    <!-- 3D Perspective Stage -->
    <div class="relative z-10 w-full max-w-[1400px] h-[550px] sm:h-[650px] flex justify-center items-center"
        style="perspective: 2500px; transform-style: preserve-3d;">

        @foreach ($slides as $index => $slide)
            @php
                $locale = app()->getLocale();
                $tagline = is_array($slide->tagline ?? null) ? $slide->tagline[$locale] ?? ($slide->tagline['id'] ?? '') : $slide->tagline ?? '';
                $title = is_array($slide->title ?? null) ? $slide->title[$locale] ?? ($slide->title['id'] ?? '') : $slide->title ?? '';
                $description = is_array($slide->description ?? null) ? $slide->description[$locale] ?? ($slide->description['id'] ?? '') : $slide->description ?? '';
                $primaryBtn = is_array($slide->primary_button_text ?? null) ? $slide->primary_button_text[$locale] ?? ($slide->primary_button_text['id'] ?? '') : $slide->primary_button_text ?? '';
                $secondaryBtn = is_array($slide->secondary_button_text ?? null) ? $slide->secondary_button_text[$locale] ?? ($slide->secondary_button_text['id'] ?? '') : $slide->secondary_button_text ?? '';
                $imageUrl = isset($slide->image_url) ? $slide->image_url : (str_starts_with($slide->image_path ?? '', 'http') ? $slide->image_path : asset('storage/' . $slide->image_path));
            @endphp

            <!-- Card Elements -->
            <div class="absolute w-[85%] sm:w-[75%] lg:w-[80%] h-[75vh] sm:h-[25vh] lg:h-[55vh] rounded-[2.5rem] overflow-hidden origin-center will-change-transform group bg-slate-100"
                :style="getStyle({{ $index }})" style="transform-style: preserve-3d;"
                @click="if(current !== {{ $index }}) current = {{ $index }}">

                <!-- Inner Image Parallax -->
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-[2000ms] ease-[cubic-bezier(0.2,0.8,0.2,1)]"
                    :class="current === {{ $index }} ? 'scale-100' : 'scale-110'"
                    style="background-image: url('{{ $imageUrl }}');">
                </div>

                <!-- 🌟 PERBAIKAN GRADIENT: Sangat Lembut, Tidak Menggelapkan Seluruh Gambar -->
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/20 to-transparent opacity-90"></div>
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_left,_var(--tw-gradient-stops))] from-slate-900/50 via-transparent to-transparent"></div>

                <!-- 🌟 PERBAIKAN BORDER: Soft Inner Ring (Efek Kaca) bukan garis keras -->
                <div class="absolute inset-0 rounded-[2.5rem] ring-1 ring-inset ring-white/30 shadow-[inset_0_0_40px_rgba(255,255,255,0.15)] pointer-events-none mix-blend-overlay"></div>

                <!-- Konten Kartu -->
                <div class="absolute inset-0 flex flex-col justify-end p-8 sm:p-14 lg:p-16 transition-opacity duration-700"
                    :class="current === {{ $index }} ? 'opacity-100 pointer-events-auto' : 'opacity-0 pointer-events-none'">

                    <div class="max-w-4xl transform transition-all duration-1000 delay-150"
                        :class="current === {{ $index }} ? 'translate-y-0 opacity-100' : 'translate-y-12 opacity-0'">

                        <!-- Tagline Glowing Accent -->
                        @if (!empty($tagline))
                            <div class="flex items-center gap-4 mb-5">
                                <span class="w-12 h-1 bg-gradient-to-r from-[#10B981] to-[#FF8C00] rounded-full"></span>
                                <span class="text-xs sm:text-sm font-extrabold uppercase tracking-[0.2em] text-emerald-300 drop-shadow-md">
                                    {{ $tagline }}
                                </span>
                            </div>
                        @endif

                        <!-- Judul Besar & Bold (Tambahan Text Shadow Halus) -->
                        @if (!empty($title))
                            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-[1.15] mb-6 drop-shadow-[0_4px_10px_rgba(0,0,0,0.4)] tracking-tight">
                                {{ $title }}
                            </h2>
                        @endif

                        <!-- Deskripsi -->
                        @if (!empty($description))
                            <p class="text-slate-200 text-base sm:text-lg lg:text-xl font-medium mb-10 leading-relaxed max-w-2xl drop-shadow-[0_2px_4px_rgba(0,0,0,0.5)]">
                                {{ $description }}
                            </p>
                        @endif

                        <!-- Tombol Premium -->
                        <div class="flex flex-wrap gap-4 sm:gap-5">
                            @if (!empty($primaryBtn))
                                <a href="{{ $slide->primary_button_url ?? '#' }}"
                                    class="relative inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-[#10B981] to-emerald-600 text-white text-[15px] font-bold rounded-2xl overflow-hidden group/btn shadow-[0_10px_30px_rgba(16,185,129,0.3)] hover:shadow-[0_15px_40px_rgba(16,185,129,0.5)] hover:-translate-y-1 transition-all duration-300">
                                    <span class="relative z-10 flex items-center gap-2">
                                        {{ $primaryBtn }}
                                        <svg class="w-4 h-4 transition-transform duration-300 group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </span>
                                    <div class="absolute inset-0 bg-white/20 translate-y-full group-hover/btn:translate-y-0 transition-transform duration-300 ease-in-out"></div>
                                </a>
                            @endif

                            @if (!empty($secondaryBtn))
                                <a href="{{ $slide->secondary_button_url ?? '#' }}"
                                    class="inline-flex items-center justify-center px-8 py-4 bg-white/10 backdrop-blur-md ring-1 ring-white/30 hover:bg-white hover:text-[#10B981] hover:ring-white text-white text-[15px] font-bold rounded-2xl transition-all duration-300 hover:-translate-y-1 shadow-lg">
                                    {{ $secondaryBtn }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- UI Controls (Bawah) - Mengikuti Konsep Light Mode Glassmorphism -->
    <div class="absolute bottom-10 left-0 right-0 z-50 w-full max-w-7xl mx-auto px-6 lg:px-12 flex flex-col md:flex-row items-center justify-between gap-6">

        <!-- Animated Progress Pill -->
        <div class="flex items-center gap-2 p-2.5 rounded-full bg-white/70 backdrop-blur-xl border border-slate-200/80 shadow-sm">
            @foreach ($slides as $index => $slide)
                <button @click="current = {{ $index }}"
                    class="h-2 rounded-full transition-all duration-700 ease-out"
                    :class="current === {{ $index }} ? 'w-12 bg-[#FF8C00] shadow-[0_0_12px_rgba(255,140,0,0.4)]' : 'w-2 bg-slate-300 hover:bg-slate-400'">
                </button>
            @endforeach
        </div>

        <!-- Glassmorphism Nav Arrows -->
        <div class="flex items-center gap-4">
            <button wire:click="prevSlide"
                class="group relative flex items-center justify-center w-12 h-12 rounded-full bg-white/70 backdrop-blur-xl border border-slate-200/80 text-slate-600 shadow-sm transition-all hover:bg-[#10B981] hover:text-white hover:border-[#10B981] hover:scale-110 overflow-hidden">
                <svg class="w-5 h-5 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button wire:click="nextSlide"
                class="group relative flex items-center justify-center w-12 h-12 rounded-full bg-white/70 backdrop-blur-xl border border-slate-200/80 text-slate-600 shadow-sm transition-all hover:bg-[#10B981] hover:text-white hover:border-[#10B981] hover:scale-110 overflow-hidden">
                <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</div>