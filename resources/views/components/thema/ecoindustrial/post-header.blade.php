@props(['post', 'coverImage' => null])

@php
    // Prioritas gambar: prop coverImage -> featured_image_url dari model -> Unsplash Fallback
    $image =
        $coverImage ?:
        $post->featured_image_url ??
            'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80';

    $categoryName = $post->category?->name;
    $authorName = $post->author?->name ?? 'Admin Politeknik Kampar';
    $publishDate = $post->published_at
        ? $post->published_at->translatedFormat('d MMMM Y')
        : $post->created_at?->translatedFormat('d MMMM Y');
@endphp

<div class="relative w-full h-[360px] sm:h-[400px] lg:h-[480px] flex items-end justify-center overflow-hidden">

    <!-- Background Image Dynamic -->
    <img src="{{ $image }}" alt="{{ $post->title }}"
        class="absolute inset-0 w-full h-full object-cover object-center filter saturate-[0.85] opacity-80">

    <!-- Light Gradient Overlay (Fades seamlessly to the background color) -->
    <div class="absolute inset-0 bg-gradient-to-t from-[#F8FAFC] via-[#F8FAFC]/85 to-white/40"></div>

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
    <div class="relative z-20 w-full container mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-start">

        <!-- Premium Glassmorphism Breadcrumb -->
        <nav class="hidden sm:inline-flex items-center gap-2 px-4 py-2 sm:px-5 sm:py-2.5 bg-white/80 backdrop-blur-md border border-slate-200/80 shadow-[0_4px_15px_rgba(0,0,0,0.02)] rounded-full mb-6"
            aria-label="Breadcrumb">
            <ol
                class="inline-flex items-center space-x-1 md:space-x-2 text-[11px] sm:text-xs font-bold uppercase tracking-wider text-slate-500">
                <li>
                    <a href="/" wire:navigate
                        class="flex items-center gap-1.5 hover:text-[#10B981] transition-colors group">
                        <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-[#10B981] transition-colors"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        Beranda
                    </a>
                </li>

                {{-- Parent Index Artikel --}}
                <li class="flex items-center">
                    <svg class="w-3 h-3 text-slate-300 mx-1 sm:mx-1.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <a href="/artikel" wire:navigate class="hover:text-[#10B981] transition-colors">Artikel</a>
                </li>

                {{-- Sub-Kategori Post (Jika ada) --}}
                @if ($categoryName)
                    <li class="flex items-center">
                        <svg class="w-3 h-3 text-slate-300 mx-1 sm:mx-1.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                        <span class="text-slate-600">{{ $categoryName }}</span>
                    </li>
                @endif

                {{-- Current Title (Truncated agar rapi) --}}
                <li class="flex items-center">
                    <svg class="w-3 h-3 text-slate-300 mx-1 sm:mx-1.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span
                        class="text-[#FF8C00] drop-shadow-sm max-w-[120px] sm:max-w-[200px] truncate">{{ $post->title }}</span>
                </li>
            </ol>
        </nav>

        <!-- Category Badge -->
        @if ($categoryName)
            <div class="mb-3">
                <span
                    class="inline-flex items-center px-3.5 py-1.5 rounded-md text-xs font-bold uppercase tracking-wider bg-[#047857]/10 text-[#047857] border border-[#047857]/20">
                    {{ $categoryName }}
                </span>
            </div>
        @endif

        <!-- Main Post Title -->
        <h1
            class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-[1.2] max-w-4xl mb-6">
            {{ $post->title }}
        </h1>

        <!-- Meta Info (Penulis & Tanggal Rilis) -->
        <div class="flex flex-wrap items-center gap-4 text-xs sm:text-sm text-slate-600 font-medium">
            <div class="flex items-center gap-2.5">
                <div
                    class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#047857] to-[#10B981] text-white flex items-center justify-center font-bold text-xs uppercase shadow-sm">
                    {{ substr($authorName, 0, 1) }}
                </div>
                <span class="text-slate-800 font-semibold">{{ $authorName }}</span>
            </div>

            <span class="text-slate-300">•</span>

            <div class="flex items-center gap-1.5 text-slate-500">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                <time datetime="{{ $post->published_at?->toIso8601String() }}">{{ $publishDate }}</time>
            </div>
        </div>

        <!-- Aksen Garis Eco-Industrial -->
        <div class="flex items-center gap-2 mt-6">
            <div class="w-16 sm:w-20 h-1.5 bg-gradient-to-r from-[#10B981] to-[#FF8C00] rounded-full"></div>
            <div class="w-2 h-1.5 bg-[#FF8C00]/40 rounded-full"></div>
        </div>

    </div>
</div>
