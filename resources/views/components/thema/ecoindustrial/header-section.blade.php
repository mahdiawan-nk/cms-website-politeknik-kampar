@props([
    'header' => [],
    'layout' => 'center', // Opsi: 'center' atau 'grid' (bisa juga 'split')
])

@php
    // Memungkinkan layout diatur via prop <x-... layout="grid" /> atau melalui array $header['layout']
    $activeLayout = $header['layout'] ?? $layout;

    $badge = $header['badge'] ?? '';
    $title = $header['title'] ?? '';
    $titleHighlight = $header['title_higlight'] ?? ($header['title_highlight'] ?? '');
    $description = $header['description'] ?? '';
@endphp

@if ($activeLayout === 'grid' || $activeLayout === 'split')
    {{-- OPSI 2: GRID / SPLIT (Badge & Judul di Kiri, Deskripsi di Kanan) --}}
    <div class="mb-12 sm:mb-16 grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-12 items-end">

        {{-- Kiri: Badge & Judul Utama --}}
        <div class="lg:col-span-7 flex flex-col items-start text-left gap-2.5">
            @if (!empty($badge))
                <div class="flex items-center gap-3">
                    <span class="w-8 h-[2px] bg-gradient-to-r from-[#10B981] to-[#FF8C00]"></span>
                    <span class="text-xs font-bold tracking-[0.2em] uppercase text-[#FF8C00]">{{ $badge }}</span>
                </div>
            @endif

            <h2 class="text-2xl sm:text-3xl md:text-4xl tracking-tight font-extrabold text-slate-900 leading-snug">
                {{ $title }}
                @if (!empty($titleHighlight))
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#10B981] to-[#FF8C00]">
                        {{ $titleHighlight }}
                    </span>
                @endif
            </h2>
        </div>

        {{-- Kanan: Deskripsi Singkat --}}
        @if (!empty($description))
            <div class="lg:col-span-5 flex items-end">
                <p
                    class="text-sm sm:text-base font-medium text-slate-600 leading-relaxed text-left border-l-2 border-emerald-500/30 pl-4 lg:pl-5">
                    {{ $description }}
                </p>
            </div>
        @endif

    </div>
@else
    {{-- OPSI 1: CENTER (Default Tengah) --}}
    <div class="mb-12 sm:mb-16 flex flex-col items-center text-center gap-3 max-w-3xl mx-auto">

        {{-- Badge Label --}}
        @if (!empty($badge))
            <div class="flex items-center gap-3">
                <span class="w-8 h-[2px] bg-gradient-to-l from-[#10B981] to-transparent"></span>
                <span class="text-xs font-bold tracking-[0.2em] uppercase text-[#FF8C00]">{{ $badge }}</span>
                <span class="w-8 h-[2px] bg-gradient-to-r from-[#10B981] to-transparent"></span>
            </div>
        @endif

        {{-- Main Title --}}
        <h2 class="text-2xl sm:text-3xl md:text-4xl tracking-tight font-extrabold text-slate-900 leading-snug">
            {{ $title }}
            @if (!empty($titleHighlight))
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#10B981] to-[#FF8C00]">
                    {{ $titleHighlight }}
                </span>
            @endif
        </h2>

        {{-- Description Section --}}
        @if (!empty($description))
            <p class="text-sm sm:text-base font-medium text-slate-600 leading-relaxed max-w-2xl mt-1">
                {{ $description }}
            </p>
        @endif

    </div>
@endif
