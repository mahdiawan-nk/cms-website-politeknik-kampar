@props(['slides'])

<div x-data="{ 
        current: @entangle('currentSlide'), 
        total: {{ count($slides) }},
        timer: null,
        startTimer() {
            if (this.total > 1) {
                this.stopTimer();
                this.timer = setInterval(() => { $wire.nextSlide() }, 8000);
            }
        },
        stopTimer() {
            if (this.timer) clearInterval(this.timer);
        }
    }" 
    x-init="startTimer()"
    @mouseenter="stopTimer()"
    @mouseleave="startTimer()"
    class="relative w-full min-h-screen bg-slate-950 text-white font-sans overflow-hidden flex items-center pt-28 pb-16 lg:py-0 select-none selection:bg-[#10B981] selection:text-white">

    <!-- ================= 1. ULTRA-PREMIUM AMBIENT BACKGROUND ================= -->
    <!-- Grid pattern with radial fade out -->
    <div class="absolute inset-0 bg-[radial-gradient(#334155_1px,transparent_1px)] [background-size:28px_28px] opacity-30 [mask-image:radial-gradient(ellipse_at_center,black_40%,transparent_80%)] pointer-events-none"></div>

    <!-- Glowing Ambient Lights -->
    <div class="absolute -top-32 -left-32 w-[500px] h-[500px] bg-emerald-500/15 rounded-full blur-[140px] pointer-events-none animate-pulse" style="animation-duration: 8s;"></div>
    <div class="absolute top-1/2 -right-32 w-[600px] h-[600px] bg-amber-500/10 rounded-full blur-[160px] pointer-events-none animate-pulse" style="animation-duration: 10s;"></div>
    <div class="absolute -bottom-32 left-1/3 w-[450px] h-[450px] bg-indigo-500/10 rounded-full blur-[130px] pointer-events-none"></div>

    <div class="relative w-full container mx-auto px-4 sm:px-6 lg:px-8 z-10 my-auto">

        <!-- Main Loop Slides -->
        @foreach ($slides as $index => $slide)
            @php
                $locale = app()->getLocale();

                $tagline = is_array($slide->tagline)
                    ? $slide->tagline[$locale] ?? ($slide->tagline['id'] ?? '')
                    : $slide->tagline;
                $title = is_array($slide->title)
                    ? $slide->title[$locale] ?? ($slide->title['id'] ?? '')
                    : $slide->title;
                $description = is_array($slide->description)
                    ? $slide->description[$locale] ?? ($slide->description['id'] ?? '')
                    : $slide->description;
                $primaryBtnText = is_array($slide->primary_button_text)
                    ? $slide->primary_button_text[$locale] ?? ($slide->primary_button_text['id'] ?? '')
                    : $slide->primary_button_text;
                $secondaryBtnText = is_array($slide->secondary_button_text)
                    ? $slide->secondary_button_text[$locale] ?? ($slide->secondary_button_text['id'] ?? '')
                    : $slide->secondary_button_text;

                $imageUrl = isset($slide->image_url)
                    ? $slide->image_url
                    : (str_starts_with($slide->image_path ?? '', 'http')
                        ? $slide->image_path
                        : asset('storage/' . $slide->image_path));
            @endphp

            <!-- Slide Item Wrapper -->
            <div x-show="current === {{ $index }}" 
                 x-transition:leave="transition ease-in duration-300 absolute inset-0 pointer-events-none"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 style="display: none;" 
                 class="w-full">

                <!-- GRID KINI DIBAGI 5 : 7 (Bagian Gambar Lebih Lebar) -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center min-h-[520px]">

                    <!-- ================= LEFT COLUMN: Text & CTAs (5 COLUMNS) ================= -->
                    <div class="lg:col-span-5 space-y-6 lg:space-y-7 text-left z-20">

                        <!-- Tagline Badge -->
                        @if ($slide->show_tagline && !empty($tagline))
                            <div x-show="current === {{ $index }}"
                                x-transition:enter="transition ease-out duration-700 delay-100"
                                x-transition:enter-start="opacity-0 -translate-x-6"
                                x-transition:enter-end="opacity-100 translate-x-0"
                                class="inline-flex items-center gap-3 px-4 py-1.5 rounded-full bg-slate-900/90 border border-emerald-500/30 shadow-[0_0_20px_rgba(16,185,129,0.15)] backdrop-blur-xl">
                                <span class="relative flex h-2 w-2">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#FF8C00] opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-2 w-2 bg-[#FF8C00]"></span>
                                </span>
                                <span class="text-xs md:text-sm font-extrabold uppercase tracking-[0.25em] text-[#10B981]">
                                    {{ $tagline }}
                                </span>
                            </div>
                        @endif

                        <!-- Title -->
                        @if ($slide->show_title && !empty($title))
                            <h1 x-show="current === {{ $index }}"
                                x-transition:enter="transition ease-out duration-800 delay-200"
                                x-transition:enter-start="opacity-0 translate-y-8"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="text-xl sm:text-2xl lg:text-3xl font-black leading-[1.15] tracking-tight bg-gradient-to-r from-white via-slate-100 to-slate-300 bg-clip-text text-transparent drop-shadow-2xl">
                                {{ $title }}
                            </h1>
                        @endif

                        <!-- Description -->
                        @if ($slide->show_description && !empty($description))
                            <p x-show="current === {{ $index }}"
                                x-transition:enter="transition ease-out duration-800 delay-300"
                                x-transition:enter-start="opacity-0 translate-y-6"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="text-sm sm:text-base text-slate-300/90 leading-relaxed font-normal max-w-xl drop-shadow">
                                {{ $description }}
                            </p>
                        @endif

                        <!-- Buttons CTA -->
                        <div x-show="current === {{ $index }}"
                            x-transition:enter="transition ease-out duration-800 delay-400"
                            x-transition:enter-start="opacity-0 translate-y-6"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="flex flex-wrap gap-4 items-center pt-2">

                            <!-- Primary Button -->
                            @if ($slide->show_primary_button && !empty($primaryBtnText) && !empty($slide->primary_button_url))
                                <a href="{{ $slide->primary_button_url }}"
                                    class="group relative inline-flex items-center gap-3 px-7 py-3.5 bg-gradient-to-r from-[#FF8C00] via-[#FF7300] to-[#E06000] text-white text-[15px] font-bold rounded-2xl transition-all duration-300 shadow-[0_8px_30px_rgba(255,140,0,0.35)] hover:shadow-[0_12px_40px_rgba(255,140,0,0.5)] hover:-translate-y-1 overflow-hidden">
                                    <!-- Shine Overlay Animation -->
                                    <span class="absolute inset-0 w-1/2 h-full bg-white/25 skew-x-12 -translate-x-full group-hover:translate-x-[300%] transition-transform duration-1000 ease-in-out"></span>
                                    
                                    <span class="relative z-10">{{ $primaryBtnText }}</span>
                                    <svg class="relative z-10 w-4 h-4 transition-transform duration-300 group-hover:translate-x-1.5"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            @endif

                            <!-- Secondary Button -->
                            @if ($slide->show_secondary_button && !empty($secondaryBtnText) && !empty($slide->secondary_button_url))
                                <a href="{{ $slide->secondary_button_url }}"
                                    class="inline-flex items-center gap-2 px-7 py-3.5 bg-slate-900/60 backdrop-blur-xl border border-slate-700/80 hover:border-emerald-500/50 text-slate-200 hover:text-white text-[15px] font-bold rounded-2xl transition-all duration-300 hover:bg-slate-800/80 shadow-lg hover:shadow-[0_0_25px_rgba(16,185,129,0.15)] hover:-translate-y-1">
                                    <span>{{ $secondaryBtnText }}</span>
                                </a>
                            @endif

                        </div>

                    </div>

                    <!-- ================= RIGHT COLUMN: Ultra Showcase Frame (7 COLUMNS - WIDER) ================= -->
                    <div class="lg:col-span-7 relative">

                        <!-- Frame Outer Glow Aura -->
                        <div x-show="current === {{ $index }}"
                            x-transition:enter="transition ease-out duration-1000 delay-200"
                            x-transition:enter-start="opacity-0 scale-90 rotate-1"
                            x-transition:enter-end="opacity-100 scale-100 rotate-0"
                            class="relative p-[1px] rounded-3xl bg-gradient-to-b from-emerald-500/40 via-slate-700/30 to-amber-500/40 shadow-[0_20px_50px_rgba(0,0,0,0.6)] group">

                            <!-- Inner Frame Layer -->
                            <div class="relative rounded-[23px] bg-slate-900/90 backdrop-blur-xl p-3 overflow-hidden">

                                <!-- Image Display Screen (16:9 Cinematic Widescreen) -->
                                <div class="relative overflow-hidden rounded-2xl bg-slate-950 aspect-[16/10] sm:aspect-[16/9]">

                                    <img src="{{ $imageUrl }}" alt="{{ $title }}"
                                        class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-1000 ease-out">

                                    <!-- Dark Cinematic Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent opacity-80"></div>
                                    
                                    <!-- Metallic Edge Reflection Line -->
                                    <div class="absolute inset-0 border border-white/10 rounded-2xl pointer-events-none"></div>

                                    <!-- Tech Corner Accents -->
                                    <div class="absolute top-2 left-2 w-3.5 h-3.5 border-t-2 border-l-2 border-emerald-500/60 rounded-tl-sm pointer-events-none"></div>
                                    <div class="absolute top-2 right-2 w-3.5 h-3.5 border-t-2 border-r-2 border-emerald-500/60 rounded-tr-sm pointer-events-none"></div>
                                    <div class="absolute bottom-2 left-2 w-3.5 h-3.5 border-b-2 border-l-2 border-amber-500/60 rounded-bl-sm pointer-events-none"></div>
                                    <div class="absolute bottom-2 right-2 w-3.5 h-3.5 border-b-2 border-r-2 border-amber-500/60 rounded-br-sm pointer-events-none"></div>

                                    <!-- Floating Status Badge (Top Right) -->
                                    <div class="absolute top-4 right-4 z-10 inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-slate-950/80 backdrop-blur-xl border border-white/10 text-[11px] font-mono tracking-wider text-slate-200 shadow-xl">
                                        <span class="w-2 h-2 rounded-full bg-[#10B981] shadow-[0_0_8px_#10B981]"></span>
                                        <span>POLKAM VOKASI</span>
                                    </div>

                                    <!-- Floating Slide Counter Badge (Bottom Left) -->
                                    <div class="absolute bottom-4 left-4 z-10 px-3.5 py-1.5 rounded-xl bg-slate-950/80 backdrop-blur-xl border border-white/10 text-xs font-mono text-slate-400 shadow-xl flex items-center gap-1.5">
                                        <span class="text-[#FF8C00] font-bold text-sm">{{ sprintf('%02d', $index + 1) }}</span>
                                        <span class="text-slate-600">/</span>
                                        <span>{{ sprintf('%02d', count($slides)) }}</span>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        @endforeach

        <!-- Navigation Controls (Bottom Bar) -->
        @if (count($slides) > 1)
            <div class="mt-10 pt-6 border-t border-slate-800/60 flex items-center justify-between z-30">

                <!-- Slide Indicators (Glow Pills & Progress) -->
                <div class="flex items-center gap-3">
                    @foreach ($slides as $index => $slide)
                        <button @click="current = {{ $index }}"
                            class="relative h-2.5 rounded-full transition-all duration-500 focus:outline-none overflow-hidden"
                            :class="current === {{ $index }} ? 'w-12 bg-[#10B981] shadow-[0_0_12px_rgba(16,185,129,0.8)]' : 'w-3 bg-slate-800 hover:bg-slate-600'"
                            aria-label="Go to slide {{ $index + 1 }}">
                        </button>
                    @endforeach
                </div>

                <!-- Navigation Arrows -->
                <div class="flex items-center gap-3">
                    <button wire:click="prevSlide"
                        class="p-3.5 text-slate-400 hover:text-white bg-slate-900/80 hover:bg-emerald-600/20 border border-slate-800 hover:border-emerald-500/50 rounded-2xl backdrop-blur-xl transition-all duration-300 shadow-lg hover:shadow-[0_0_20px_rgba(16,185,129,0.2)] group focus:outline-none hover:-translate-x-0.5">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:-translate-x-1" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button wire:click="nextSlide"
                        class="p-3.5 text-slate-400 hover:text-white bg-slate-900/80 hover:bg-emerald-600/20 border border-slate-800 hover:border-emerald-500/50 rounded-2xl backdrop-blur-xl transition-all duration-300 shadow-lg hover:shadow-[0_0_20px_rgba(16,185,129,0.2)] group focus:outline-none hover:translate-x-0.5">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif

    </div>
</div>