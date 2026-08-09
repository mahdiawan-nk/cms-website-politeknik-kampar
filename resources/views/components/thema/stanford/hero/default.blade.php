@props(['slides'])
<div x-data="{ current: @entangle('currentSlide'), total: {{ count($slides) }} }" x-init="setInterval(() => { $wire.nextSlide() }, 8000)"
    class="relative w-full overflow-hidden h-[620px] md:h-[700px] lg:h-[83vh] min-h-[580px] bg-stone-950 font-sans select-none">

    @foreach ($slides as $index => $slide)
        @php
            $locale = app()->getLocale();

            $tagline = is_array($slide->tagline)
                ? $slide->tagline[$locale] ?? ($slide->tagline['id'] ?? '')
                : $slide->tagline;
            $title = is_array($slide->title) ? $slide->title[$locale] ?? ($slide->title['id'] ?? '') : $slide->title;
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

        <div x-show="current === {{ $index }}" class="absolute inset-0 w-full h-full" style="display: none;">

            <!-- Hero Background Image -->
            <div x-show="current === {{ $index }}" x-transition:enter="transition ease-out duration-[2000ms]"
                x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-[1000ms]"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-100"
                class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $imageUrl }}')">
            </div>

            <!-- OVERLAY PREMIUM TERANG & JERNIH -->
            <!-- 1. Soft Horizontal Gradient: Sisi kiri tempat teks berada diberi warna gelap transparan tipis, sisi kanan tetap terang jernih -->
            <div class="absolute inset-0 bg-gradient-to-r from-stone-950/30 via-stone-950/10 to-transparent z-10"></div>

            <!-- 2. Soft Bottom Gradient: Meredup halus di bagian paling bawah untuk menonjolkan kontrol navigasi -->
            <div class="absolute inset-0 bg-gradient-to-t from-stone-950/60 via-transparent to-black/20 z-10"></div>

            <!-- Stanford Decorative Top Accent Line -->
            <div class="absolute top-0 left-0 right-0 h-1 bg-[#8C1515] z-30"></div>

            <!-- Content Area -->
            <div class="absolute inset-0 max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 flex items-center z-20">
                <div class="max-w-3xl text-left pt-12 md:pt-0">

                    <!-- Tagline (Dengan subtle text-shadow) -->
                    @if ($slide->show_tagline && !empty($tagline))
                        <div class="mb-4 flex items-center gap-3" x-show="current === {{ $index }}"
                            x-transition:enter="transition ease-out duration-700 delay-200"
                            x-transition:enter-start="opacity-0 -translate-x-4"
                            x-transition:enter-end="opacity-100 translate-x-0">
                            <span class="w-8 h-[2px] bg-[#D14900] shadow-sm"></span>
                            <span
                                class="text-xs md:text-sm font-semibold uppercase tracking-[0.2em] text-[#E0A96D] drop-shadow-md">
                                {{ $tagline }}
                            </span>
                        </div>
                    @endif

                    <!-- Title (Menambahkan Drop Shadow Tipis Agar Teks Sangat Jelas di Atas Gambar Terang) -->
                    @if ($slide->show_title && !empty($title))
                        <h1 class="mb-6 text-3xl sm:text-5xl lg:text-6xl font-serif font-normal leading-[1.15] text-white tracking-tight drop-shadow-[0_4px_12px_rgba(0,0,0,0.6)]"
                            x-show="current === {{ $index }}"
                            x-transition:enter="transition ease-out duration-800 delay-300"
                            x-transition:enter-start="opacity-0 translate-y-6"
                            x-transition:enter-end="opacity-100 translate-y-0">
                            {{ $title }}
                        </h1>
                    @endif

                    <!-- Description -->
                    @if ($slide->show_description && !empty($description))
                        <p class="mb-10 text-base md:text-xl text-stone-100 leading-relaxed font-sans font-light max-w-2xl drop-shadow-[0_2px_8px_rgba(0,0,0,0.7)]"
                            x-show="current === {{ $index }}"
                            x-transition:enter="transition ease-out duration-800 delay-500"
                            x-transition:enter-start="opacity-0 translate-y-6"
                            x-transition:enter-end="opacity-100 translate-y-0">
                            {{ $description }}
                        </p>
                    @endif

                    <!-- Buttons CTA (Dipertegas dengan Backdrop Blur & Shadow) -->
                    <div class="flex flex-wrap gap-4 items-center" x-show="current === {{ $index }}"
                        x-transition:enter="transition ease-out duration-800 delay-700"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0">

                        <!-- Primary Button (Cardinal Red Accent) -->
                        @if ($slide->show_primary_button && !empty($primaryBtnText) && !empty($slide->primary_button_url))
                            <a href="{{ $slide->primary_button_url }}"
                                class="group relative inline-flex items-center gap-3 px-8 py-4 bg-[#8C1515] hover:bg-[#B1040E] text-white text-sm font-medium tracking-wider uppercase transition-all duration-300 shadow-xl hover:shadow-2xl hover:-translate-y-0.5">
                                <span>{{ $primaryBtnText }}</span>
                                <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        @endif

                        <!-- Secondary Button (Ghost Glassmorphism) -->
                        @if ($slide->show_secondary_button && !empty($secondaryBtnText) && !empty($slide->secondary_button_url))
                            <a href="{{ $slide->secondary_button_url }}"
                                class="inline-flex items-center gap-2 px-8 py-4 bg-black/30 backdrop-blur-md border border-white/50 hover:border-white text-white text-sm font-medium tracking-wider uppercase transition-all duration-300 hover:bg-white hover:text-stone-900 shadow-lg hover:-translate-y-0.5">
                                <span>{{ $secondaryBtnText }}</span>
                            </a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Stanford Bottom Controls (Numbered Progress & Indicators) -->
    @if (count($slides) > 1)
        <!-- Slide Indicators & Counter -->
        <div class="absolute bottom-10 left-6 sm:left-8 lg:left-12 z-30 flex items-center gap-6">
            <!-- Slide Numbers -->
            <div class="flex items-center gap-2 font-serif text-sm tracking-widest text-stone-300 drop-shadow">
                <span class="text-white font-bold text-base" x-text="String(current + 1).padStart(2, '0')"></span>
                <span class="text-stone-400">/</span>
                <span x-text="String(total).padStart(2, '0')"></span>
            </div>

            <!-- Progress Bars -->
            <div class="flex items-center gap-2">
                @foreach ($slides as $index => $slide)
                    <button @click="current = {{ $index }}"
                        class="h-[3px] transition-all duration-500 focus:outline-none shadow-sm"
                        :class="current === {{ $index }} ? 'w-12 bg-[#8C1515]' : 'w-4 bg-white/40 hover:bg-white/70'">
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Navigation Arrows -->
        <div class="absolute bottom-8 right-6 sm:right-8 lg:right-12 z-30 flex items-center gap-2">
            <button wire:click="prevSlide"
                class="p-3.5 text-white bg-black/40 hover:bg-[#8C1515] backdrop-blur-md border border-white/20 transition-all duration-300 shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button wire:click="nextSlide"
                class="p-3.5 text-white bg-black/40 hover:bg-[#8C1515] backdrop-blur-md border border-white/20 transition-all duration-300 shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    @endif
</div>
