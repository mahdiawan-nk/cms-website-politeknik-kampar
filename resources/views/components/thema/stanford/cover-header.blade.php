@props(['coverImage', 'pageTitle', 'pageRecord'])
<div class="relative w-full h-[160px] sm:h-[220px] bg-stone-900">
    <!-- Background Image Dynamic -->
    <img src="{{ $coverImage }}" alt="{{ $pageTitle }}"
        class="absolute inset-0 w-full h-full object-cover opacity-50">

    <!-- Gradient Overlay (Stanford style dark gradient) -->
    <div class="absolute inset-0 bg-gradient-to-t from-stone-900 via-stone-900/40 to-transparent"></div>

    <!-- Title & Breadcrumb inside Header -->
    <div class="absolute bottom-0 left-0 w-full pb-10 sm:pb-14">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Breadcrumb Dinamis -->
            <nav class="flex text-sm text-stone-300 font-medium mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li>
                        <a href="/" class="hover:text-white transition-colors">Beranda</a>
                    </li>

                    {{-- Kategori / Parent Page (Jika ada di model) --}}
                    @if (!empty($pageRecord->category))
                        <li class="flex items-center">
                            <span class="mx-2 text-stone-400">/</span>
                            <span class="text-stone-300">{{ $pageRecord->category }}</span>
                        </li>
                    @endif

                    {{-- Current Page --}}
                    <li class="flex items-center">
                        <span class="mx-2 text-stone-400">/</span>
                        <span class="text-white font-semibold line-clamp-1">{{ $pageTitle }}</span>
                    </li>
                </ol>
            </nav>

            <!-- Main Title Dinamis -->
            <h1
                class="text-3xl sm:text-5xl lg:text-6xl font-serif font-bold text-white leading-tight max-w-4xl drop-shadow-md">
                {{ $pageTitle }}
            </h1>

        </div>
    </div>
</div>
