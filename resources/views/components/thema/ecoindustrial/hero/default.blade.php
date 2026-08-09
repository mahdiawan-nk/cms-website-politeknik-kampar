@props(['slides'])
<div x-data="{ current: @entangle('currentSlide'), total: {{ count($slides) }} }" x-init="setInterval(() => { $wire.nextSlide() }, 8000)"
    class="relative w-full overflow-hidden h-[100vh] min-h-[600px] bg-gray-900 font-sans select-none">

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

            <!-- OVERLAY MODERN ELEGANT -->
            <!-- Gradient Kiri ke Kanan: Lebih gelap di kiri agar teks mudah dibaca -->
            <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/40 to-transparent z-10"></div>

            <!-- Gradient Bawah: Untuk menonjolkan kontrol navigasi -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent z-10"></div>

            <!-- Content Area (Ditambahkan pt-28 untuk memberi ruang bagi Floating Navbar) -->
            <div class="absolute inset-0 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center z-20 pt-28">
                <div class="max-w-3xl text-left">

                    <!-- Tagline -->
                    @if ($slide->show_tagline && !empty($tagline))
                        <div class="mb-5 flex items-center gap-3" x-show="current === {{ $index }}"
                            x-transition:enter="transition ease-out duration-700 delay-200"
                            x-transition:enter-start="opacity-0 -translate-x-4"
                            x-transition:enter-end="opacity-100 translate-x-0">
                            <!-- Accent Line warna Oranye Polkam -->
                            <span class="w-10 h-[2px] bg-[#FF8C00] rounded-full shadow-sm"></span>
                            <span
                                class="text-xs md:text-sm font-bold uppercase tracking-[0.2em] text-[#10B981] drop-shadow-md">
                                {{ $tagline }}
                            </span>
                        </div>
                    @endif

                    <!-- Title -->
                    @if ($slide->show_title && !empty($title))
                        <h1 class="mb-6 text-3xl sm:text-5xl lg:text-[56px] font-bold leading-[1.15] text-white tracking-tight drop-shadow-lg"
                            x-show="current === {{ $index }}"
                            x-transition:enter="transition ease-out duration-800 delay-300"
                            x-transition:enter-start="opacity-0 translate-y-6"
                            x-transition:enter-end="opacity-100 translate-y-0">
                            {{ $title }}
                        </h1>
                    @endif

                    <!-- Description -->
                    @if ($slide->show_description && !empty($description))
                        <p class="mb-10 text-base md:text-xl text-gray-200 leading-relaxed font-light max-w-2xl drop-shadow-md"
                            x-show="current === {{ $index }}"
                            x-transition:enter="transition ease-out duration-800 delay-500"
                            x-transition:enter-start="opacity-0 translate-y-6"
                            x-transition:enter-end="opacity-100 translate-y-0">
                            {{ $description }}
                        </p>
                    @endif

                    <!-- Buttons CTA -->
                    <div class="flex flex-wrap gap-4 items-center" x-show="current === {{ $index }}"
                        x-transition:enter="transition ease-out duration-800 delay-700"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0">

                        <!-- Primary Button (Warna Oranye dengan rounded-xl) -->
                        @if ($slide->show_primary_button && !empty($primaryBtnText) && !empty($slide->primary_button_url))
                            <a href="{{ $slide->primary_button_url }}"
                                class="group relative inline-flex items-center gap-2 px-7 py-3.5 bg-[#FF8C00] hover:bg-[#F97316] text-white text-[15px] font-bold rounded-xl transition-all duration-300 shadow-[0_8px_20px_rgba(255,140,0,0.3)] hover:shadow-[0_10px_25px_rgba(255,140,0,0.4)] hover:-translate-y-0.5">
                                <span>{{ $primaryBtnText }}</span>
                                <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        @endif

                        <!-- Secondary Button (Glassmorphism effect senada dengan navbar) -->
                        @if ($slide->show_secondary_button && !empty($secondaryBtnText) && !empty($slide->secondary_button_url))
                            <a href="{{ $slide->secondary_button_url }}"
                                class="inline-flex items-center gap-2 px-7 py-3.5 bg-white/10 backdrop-blur-md border border-white/30 hover:border-white text-white text-[15px] font-bold rounded-xl transition-all duration-300 hover:bg-white hover:text-[#047857] shadow-lg hover:-translate-y-0.5">
                                <span>{{ $secondaryBtnText }}</span>
                            </a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modern Bottom Controls (Pill Indicators & Glassmorphism Arrows) -->
    @if (count($slides) > 1)
        <div
            class="absolute bottom-8 left-0 right-0 z-30 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">

            <!-- Slide Indicators (Dots & Pills) -->
            <div class="flex items-center gap-3">
                @foreach ($slides as $index => $slide)
                    <button @click="current = {{ $index }}"
                        class="h-2 rounded-full transition-all duration-500 focus:outline-none"
                        :class="current === {{ $index }} ? 'w-10 bg-[#10B981]' : 'w-2 bg-white/40 hover:bg-white/80'">
                    </button>
                @endforeach
            </div>

            <!-- Navigation Arrows (Glassmorphism rounded) -->
            <div class="flex items-center gap-3">
                <button wire:click="prevSlide"
                    class="p-3 text-white bg-white/10 hover:bg-[#047857] backdrop-blur-md border border-white/20 rounded-xl transition-all duration-300 shadow-lg group">
                    <svg class="w-5 h-5 transition-transform duration-300 group-hover:-translate-x-1" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button wire:click="nextSlide"
                    class="p-3 text-white bg-white/10 hover:bg-[#047857] backdrop-blur-md border border-white/20 rounded-xl transition-all duration-300 shadow-lg group">
                    <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    @endif
</div>
