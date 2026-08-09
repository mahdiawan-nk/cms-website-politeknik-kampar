@props(['newsData', 'allNewsUrl' => '#'])

<section class="relative w-full py-16 lg:py-24 bg-[#F8FAFC] overflow-hidden font-sans text-slate-900">

    {{-- Accent Line & Blueprint Grid Background --}}
    <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#10B981] via-emerald-400 to-[#FF8C00]"></div>
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#00000005_1px,transparent_1px),linear-gradient(to_bottom,#00000005_1px,transparent_1px)] bg-[size:32px_32px] pointer-events-none"></div>

    {{-- Ambient Glows --}}
    <div class="absolute top-1/4 left-1/4 -translate-y-1/2 w-96 h-96 bg-emerald-400/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-amber-400/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        {{-- Header Section --}}
        <x-thema.ecoindustrial.header-section :header="[
            'badge' => __('frontend.news_header.badge'),
            'title' => __('frontend.news_header.title'),
            'title_higlight' => __('frontend.news_header.title_highlight'),
            'description' => __('frontend.news_header.description'),
        ]" />

        @php
            $hero = $newsData[0] ?? null;
            $gridItems = array_slice($newsData, 1, 4);
        @endphp

        {{-- BENTO GRID CONTAINER --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">

            {{-- 1. HERO BENTO CARD (Span 5 di Kolom Kiri) --}}
            @if ($hero)
                <div class="lg:col-span-5 flex flex-col">
                    <div class="group relative flex-1 flex flex-col justify-end overflow-hidden rounded-3xl border border-slate-200/80 bg-slate-950 shadow-sm hover:shadow-2xl hover:border-[#10B981]/50 transition-all duration-500 min-h-[440px] lg:min-h-0">

                        {{-- Background Image + Overlay Gradient --}}
                        <img src="{{ $hero['featured_image_url'] }}" alt="{{ $hero['title'] }}"
                            class="absolute inset-0 w-full h-full object-cover opacity-75 group-hover:scale-105 group-hover:opacity-85 transition-all duration-700 ease-out" />
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/60 to-transparent"></div>

                        {{-- Card Header Tag & Status --}}
                        <div class="absolute top-5 left-5 right-5 flex items-center justify-between z-10">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 text-[10px] font-bold font-mono uppercase tracking-wider text-white bg-[#10B981] rounded-full shadow-md backdrop-blur-md">
                                <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                                {{ $hero['category_name'] }}
                            </span>

                            <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-slate-900/80 backdrop-blur-md border border-white/10 text-white rounded-full text-[10px] font-mono tracking-widest uppercase">
                                ★ UTAMA
                            </span>
                        </div>

                        {{-- Content Overlay --}}
                        <div class="relative z-10 p-6 sm:p-8 flex flex-col justify-end">
                            <div class="flex items-center gap-2 mb-3 text-xs font-mono font-medium text-slate-300">
                                <span>{{ $hero['published_at'] }}</span>
                            </div>

                            <h3 class="text-xl sm:text-2xl font-black text-white leading-snug group-hover:text-emerald-300 transition-colors duration-300 line-clamp-3">
                                <a href="{{ route('posts.show', ['slug' => $hero['slug']]) }}" wire:navigate class="before:absolute before:inset-0 focus:outline-none">
                                    {{ $hero['title'] }}
                                </a>
                            </h3>

                            <p class="mt-3 text-xs sm:text-sm text-slate-300 line-clamp-2 font-normal leading-relaxed opacity-90">
                                {{ $hero['excerpt'] }}
                            </p>

                            <div class="mt-6 pt-4 border-t border-white/15 flex items-center justify-between text-xs font-mono font-bold text-[#10B981]">
                                <span>BACA SELENGKAPNYA</span>
                                <svg class="w-4 h-4 transform group-hover:translate-x-1.5 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- 2. SUB-BENTO GRID (Span 7 di Kolom Kanan: 2x2 Grid) --}}
            <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-5">
                @foreach ($gridItems as $item)
                    <div class="group relative flex flex-col justify-between p-5 bg-white/80 backdrop-blur-md border border-slate-200/80 rounded-3xl shadow-sm hover:shadow-xl hover:shadow-emerald-500/10 hover:border-[#10B981]/40 hover:-translate-y-1 transition-all duration-300 overflow-hidden">

                        <div>
                            {{-- Thumbnail Image Container --}}
                            <div class="relative aspect-[16/10] w-full rounded-2xl overflow-hidden mb-4 bg-slate-100">
                                <img src="{{ $item['featured_image_url'] }}" alt="{{ $item['title'] }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" />
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/30 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>

                            {{-- Category & Date Bar --}}
                            <div class="flex items-center justify-between text-[11px] font-mono font-bold uppercase tracking-wider mb-2">
                                <span class="text-[#FF8C00]">{{ $item['category_name'] }}</span>
                                <span class="text-slate-400 font-normal">{{ $item['published_at'] }}</span>
                            </div>

                            {{-- News Title --}}
                            <h4 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-[#10B981] transition-colors duration-300 line-clamp-2 leading-snug">
                                <a href="{{ route('posts.show', ['slug' => $item['slug']]) }}" wire:navigate class="before:absolute before:inset-0 focus:outline-none">
                                    {{ $item['title'] }}
                                </a>
                            </h4>
                        </div>

                        {{-- Footer Action Link --}}
                        <div class="mt-5 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-mono font-bold text-[#10B981]">
                            <span class="text-[11px] text-slate-400 group-hover:text-[#10B981] transition-colors">BACA</span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>

        {{-- CTA Button (Semua Artikel) --}}
        <div class="mt-12 text-center">
            <a href="{{ $allNewsUrl }}" wire:navigate
                class="inline-flex items-center gap-3 px-8 py-3.5 rounded-2xl bg-white border border-slate-200/80 text-slate-800 font-mono font-bold text-xs uppercase tracking-wider hover:border-[#10B981]/50 hover:text-[#10B981] hover:shadow-lg transition-all duration-300 group shadow-sm">
                <span>Lihat Semua Artikel & Berita</span>
                <svg class="w-4 h-4 text-[#10B981] transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>

    </div>
</section>