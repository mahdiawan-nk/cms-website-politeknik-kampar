@props(['slides'])

<!-- Import Google Fonts Serif Luxury (Cormorant Garamond & Playfair Display) -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap');
    
    .font-prestige-serif { font-family: 'Cormorant Garamond', Georgia, serif; }
    .font-prestige-sans { font-family: 'Plus Jakarta Sans', sans-serif; }
</style>

<div x-data="{ current: @entangle('currentSlide'), total: {{ count($slides) }} }" 
    x-init="if (total > 1) setInterval(() => { $wire.nextSlide() }, 8000)"
    class="relative w-full h-screen min-h-[700px] max-h-[1080px] bg-[#0A0D0C] font-prestige-sans overflow-hidden select-none">

    <!-- 1. Ambient Dark Vignette & Gold Ambient Lighting -->
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-amber-900/10 via-stone-950/80 to-[#050706] z-10 pointer-events-none"></div>
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[350px] bg-gradient-to-b from-[#10B981]/10 via-amber-500/5 to-transparent blur-[140px] pointer-events-none z-10"></div>

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

        <div x-show="current === {{ $index }}" 
            class="absolute inset-0 w-full h-full" 
            style="display: none;">

            <!-- Cinematic Ken-Burns Background Image -->
            <div x-show="current === {{ $index }}" 
                x-transition:enter="transition ease-out duration-[2500ms]"
                x-transition:enter-start="opacity-0 scale-110 blur-sm" 
                x-transition:enter-end="opacity-100 scale-100 blur-0"
                x-transition:leave="transition ease-in duration-[1200ms]"
                x-transition:leave-start="opacity-100 scale-100" 
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute inset-0 bg-cover bg-center opacity-30 mix-blend-luminosity brightness-90" 
                style="background-image: url('{{ $imageUrl }}')">
            </div>

            <!-- Heavy Prestige Gradient Overlays for Maximum Contrast -->
            <div class="absolute inset-0 bg-gradient-to-t from-[#0A0D0C] via-[#0A0D0C]/60 to-transparent z-10"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#0A0D0C]/90 via-[#0A0D0C]/50 to-transparent z-10"></div>

            <!-- Main High-Impact Typography Content Container -->
            <div class="absolute inset-0 w-full max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 flex flex-col justify-center items-start z-20 pt-24 pb-16">
                
                <div class="max-w-4xl text-left space-y-6">

                    <!-- Tagline (Prestige Crest Line & Monospace / Tracking) -->
                    @if ($slide->show_tagline && !empty($tagline))
                        <div x-show="current === {{ $index }}"
                            x-transition:enter="transition ease-out duration-700 delay-200"
                            x-transition:enter-start="opacity-0 -translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="inline-flex items-center gap-3">
                            
                            <span class="w-8 h-[1px] bg-gradient-to-r from-[#FF8C00] to-amber-200"></span>
                            
                            <span class="text-xs sm:text-sm uppercase tracking-[0.35em] text-amber-200/90 font-medium font-prestige-sans drop-shadow">
                                {{ $tagline }}
                            </span>
                        </div>
                    @endif

                    <!-- High-Impact Serif Headline -->
                    @if ($slide->show_title && !empty($title))
                        <h1 x-show="current === {{ $index }}"
                            x-transition:enter="transition ease-out duration-1000 delay-300"
                            x-transition:enter-start="opacity-0 translate-y-8"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="text-4xl sm:text-6xl lg:text-[76px] font-prestige-serif font-normal leading-[1.08] text-stone-100 tracking-tight drop-shadow-2xl">
                            {!! nl2br(e($title)) !!}
                        </h1>
                    @endif

                    <!-- Description -->
                    @if ($slide->show_description && !empty($description))
                        <p x-show="current === {{ $index }}"
                            x-transition:enter="transition ease-out duration-900 delay-500"
                            x-transition:enter-start="opacity-0 translate-y-6"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="text-base sm:text-xl text-stone-300/90 font-light leading-relaxed max-w-2xl font-prestige-sans pt-2">
                            {{ $description }}
                        </p>
                    @endif

                    <!-- Buttons CTA (Gold Foil & Glass Classic) -->
                    <div x-show="current === {{ $index }}"
                        x-transition:enter="transition ease-out duration-800 delay-700"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="flex flex-wrap gap-5 items-center pt-6">

                        <!-- Primary Button (Warm Gold / Polkam Amber Classic) -->
                        @if ($slide->show_primary_button && !empty($primaryBtnText) && !empty($slide->primary_button_url))
                            <a href="{{ $slide->primary_button_url }}"
                                class="group relative inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-[#FF8C00] via-amber-600 to-[#D97706] text-white text-sm uppercase tracking-[0.15em] font-semibold rounded-none border-b-2 border-amber-300/60 shadow-[0_15px_35px_rgba(217,119,6,0.25)] hover:shadow-[0_20px_40px_rgba(255,140,0,0.35)] hover:-translate-y-0.5 transition-all duration-300">
                                <span>{{ $primaryBtnText }}</span>
                                <svg class="w-4 h-4 text-amber-200 transition-transform duration-300 group-hover:translate-x-1"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        @endif

                        <!-- Secondary Button (Classic Transparent Border) -->
                        @if ($slide->show_secondary_button && !empty($secondaryBtnText) && !empty($slide->secondary_button_url))
                            <a href="{{ $slide->secondary_button_url }}"
                                class="inline-flex items-center gap-2 px-8 py-4 bg-stone-900/40 backdrop-blur-md border border-stone-600/60 hover:border-amber-400/80 text-stone-200 hover:text-white text-sm uppercase tracking-[0.15em] font-medium rounded-none transition-all duration-300 hover:bg-stone-800/60 shadow-lg hover:-translate-y-0.5">
                                <span>{{ $secondaryBtnText }}</span>
                            </a>
                        @endif

                    </div>

                </div>

            </div>
        </div>
    @endforeach

    <!-- Bottom Controls: Academic Editorial Pagination & Minimal Arrows -->
    @if (count($slides) > 1)
        <div class="absolute bottom-10 left-0 right-0 z-30 w-full max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 flex items-center justify-between border-t border-stone-800/80 pt-6">

            <!-- Editorial Counter Indicator (e.g., 01 / 04) -->
            <div class="flex items-center gap-6">
                <div class="font-prestige-serif text-lg text-amber-200/90 tracking-widest">
                    <span x-text="String(current + 1).padStart(2, '0')" class="font-bold text-white text-xl"></span>
                    <span class="text-stone-600 mx-1">/</span>
                    <span class="text-stone-500 text-sm">{{ sprintf('%02d', count($slides)) }}</span>
                </div>

                <!-- Gold Line Indicator -->
                <div class="hidden sm:flex items-center gap-2">
                    @foreach ($slides as $index => $slide)
                        <button @click="current = {{ $index }}"
                            class="h-[2px] transition-all duration-700 focus:outline-none"
                            :class="current === {{ $index }} ? 'w-12 bg-gradient-to-r from-[#FF8C00] to-amber-300' : 'w-4 bg-stone-800 hover:bg-stone-600'"
                            aria-label="Slide {{ $index + 1 }}">
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Classic Editorial Navigation Arrows -->
            <div class="flex items-center gap-4">
                <button wire:click="prevSlide"
                    class="p-3.5 text-stone-400 hover:text-amber-200 bg-stone-950/60 hover:bg-stone-900 border border-stone-800 hover:border-amber-500/40 rounded-none transition-all duration-300 shadow-xl group">
                    <svg class="w-5 h-5 transition-transform duration-300 group-hover:-translate-x-1" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button wire:click="nextSlide"
                    class="p-3.5 text-stone-400 hover:text-amber-200 bg-stone-950/60 hover:bg-stone-900 border border-stone-800 hover:border-amber-500/40 rounded-none transition-all duration-300 shadow-xl group">
                    <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

        </div>
    @endif

</div>