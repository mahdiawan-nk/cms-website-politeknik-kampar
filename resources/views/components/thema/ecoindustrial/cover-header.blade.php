@props(['coverImage','pageTitle','pageRecord'])
<div class="relative w-full h-[260px] sm:h-[400px] lg:h-[480px] flex items-end justify-center overflow-hidden">

    <!-- Background Image Dynamic (Subtle Saturation) -->
    <img src="{{ $coverImage }}" alt="{{ $pageTitle }}"
        class="absolute inset-0 w-full h-full object-cover object-center filter saturate-[0.85] opacity-80">

    <!-- Light Gradient Overlay (Fades seamlessly to the background color) -->
    <div class="absolute inset-0 bg-gradient-to-t from-[#F8FAFC] via-[#F8FAFC]/80 to-white/30"></div>

    <!-- Technical Grid & Ambient Glows -->
    <div
        class="absolute inset-0 bg-[linear-gradient(to_right,#80808008_1px,transparent_1px),linear-gradient(to_bottom,#80808008_1px,transparent_1px)] bg-[size:40px_40px] pointer-events-none">
    </div>
    <div
        class="absolute top-1/4 left-1/4 w-96 h-96 bg-emerald-400/20 rounded-full blur-[100px] mix-blend-multiply pointer-events-none">
    </div>
    <div
        class="absolute top-1/3 right-1/4 w-80 h-80 bg-orange-300/15 rounded-full blur-[90px] mix-blend-multiply pointer-events-none">
    </div>

    <!-- Header Content Area -->
    <div class="relative z-20 w-full container mx-auto px-4 sm:px-6 lg:px-8 pb-10 sm:pb-16 flex flex-col items-start">

        <!-- Premium Glassmorphism Breadcrumb -->
        <nav class="inline-flex items-center gap-2 px-4 py-2 sm:px-5 sm:py-2.5 bg-white/70 backdrop-blur-md border border-slate-200/80 shadow-[0_4px_15px_rgba(0,0,0,0.02)] rounded-full mb-6 sm:mb-8"
            aria-label="Breadcrumb">
            <ol
                class="inline-flex items-center space-x-1 md:space-x-2 text-[11px] sm:text-xs font-bold uppercase tracking-wider text-slate-500">
                <li>
                    <a href="/" class="flex items-center gap-1.5 hover:text-[#10B981] transition-colors group">
                        <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-[#10B981] transition-colors"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        Beranda
                    </a>
                </li>

                {{-- Kategori / Parent Page --}}
                @if (!empty($pageRecord->category))
                    <li class="flex items-center">
                        <svg class="w-3 h-3 text-slate-300 mx-1 sm:mx-1.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                        <span class="text-slate-600">{{ $pageRecord->category }}</span>
                    </li>
                @endif

                {{-- Current Page --}}
                <li class="flex items-center">
                    <svg class="w-3 h-3 text-slate-300 mx-1 sm:mx-1.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-[#FF8C00] drop-shadow-sm">{{ $pageTitle }}</span>
                </li>
            </ol>
        </nav>

        <!-- Main Title Dinamis -->
        <h1
            class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.15] max-w-7xl">
            {{ $pageTitle }}
        </h1>

        <!-- Aksen Garis Eco-Industrial -->
        <div class="flex items-center gap-2 mt-6">
            <div class="w-16 sm:w-20 h-1.5 bg-gradient-to-r from-[#10B981] to-[#FF8C00] rounded-full"></div>
            <div class="w-2 h-1.5 bg-[#FF8C00]/40 rounded-full"></div>
        </div>

    </div>
</div>
