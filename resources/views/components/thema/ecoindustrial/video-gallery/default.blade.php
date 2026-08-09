@props(['videos' => [], 'headers' => []])

<section class="relative w-full py-14 lg:py-20 bg-[#F8FAFC] overflow-hidden font-sans border-t border-slate-200/50"
    x-data="{
        modalOpen: false,
        activeVideoId: '',
        openVideo(id) {
            if (!id) return;
            this.activeVideoId = id;
            this.modalOpen = true;
            document.body.style.overflow = 'hidden';
        },
        closeVideo() {
            this.modalOpen = false;
            setTimeout(() => { this.activeVideoId = ''; }, 300);
            document.body.style.overflow = 'auto';
        }
    }" @keydown.escape.window="closeVideo()">

    {{-- Top Eco-Industrial Gradient Accent Strip --}}
    <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#10B981] via-emerald-400 to-[#FF8C00]">
    </div>

    {{-- Subtle Industrial Technical Grid & Ambient Glows --}}
    <div
        class="absolute inset-0 bg-[linear-gradient(to_right,#00000005_1px,transparent_1px),linear-gradient(to_bottom,#00000005_1px,transparent_1px)] bg-[size:32px_32px] pointer-events-none">
    </div>
    <div
        class="absolute top-1/2 left-1/4 -translate-y-1/2 w-80 h-80 bg-emerald-400/10 rounded-full blur-3xl pointer-events-none">
    </div>
    <div
        class="absolute top-1/2 right-1/4 -translate-y-1/2 w-80 h-80 bg-amber-400/10 rounded-full blur-3xl pointer-events-none">
    </div>

    <div class="relative z-20 container mx-auto px-4 sm:px-6 lg:px-10">

        <!-- Header Section -->
        @if(!empty($headers))
            <div class="mb-8 lg:mb-10">
                <x-thema.ecoindustrial.header-section :header="$headers" layout="grid"/>
            </div>
        @endif

        <!-- Video Grid: Ultra-Premium 4-Column Layout (1 Row Desktop) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 lg:gap-6">
            @foreach (array_slice($videos, 0, 4) as $video)
                @php
                    // Extract Video ID dari youtube_url
                    $rawUrl = $video['youtube_url'] ?? $video['url'] ?? '';
                    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $rawUrl, $matches);
                    $videoId = $matches[1] ?? ($video['id'] ?? '');

                    // Menggunakan Thumbnail Custom (jika diupload) atau Fallback ke YouTube Thumbnail
                    $hasCustomThumbnail = !empty($video['thumbnail']);
                    $thumbnailUrl = $hasCustomThumbnail 
                        ? asset('storage/' . $video['thumbnail']) 
                        : "https://i.ytimg.com/vi/{$videoId}/maxresdefault.jpg";
                @endphp

                <div
                    class="group relative flex flex-col bg-white rounded-[1.75rem] p-2.5 border border-slate-200/80 shadow-sm hover:shadow-xl hover:shadow-emerald-900/10 hover:border-emerald-300/80 transition-all duration-500 ease-out hover:-translate-y-1.5">

                    <!-- Thumbnail Area (Interactive) -->
                    <div @click="openVideo('{{ $videoId }}')"
                        class="relative w-full aspect-video rounded-[1.25rem] overflow-hidden bg-slate-900 cursor-pointer">

                        <img src="{{ $thumbnailUrl }}"
                            @if(!$hasCustomThumbnail)
                                onerror="this.onerror=null; this.src='https://i.ytimg.com/vi/{{ $videoId }}/hqdefault.jpg'"
                            @endif
                            alt="{{ $video['title'] ?? 'Video Kampus' }}"
                            class="w-full h-full object-cover transform transition-transform duration-700 ease-out group-hover:scale-105 opacity-95 group-hover:opacity-100"
                            loading="lazy">

                        <!-- Dark Overlay Effect -->
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-slate-900/20 to-transparent group-hover:from-slate-950/40 transition-colors duration-500">
                        </div>

                        <!-- Floating Play Button -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div
                                class="w-12 h-12 rounded-full bg-white/30 backdrop-blur-md border border-white/60 flex items-center justify-center text-white shadow-lg transform transition-all duration-500 group-hover:scale-110 group-hover:bg-[#10B981] group-hover:border-[#10B981] group-hover:shadow-[#10B981]/50">
                                <svg class="w-5 h-5 ml-0.5 fill-current" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                            </div>
                        </div>

                        <!-- Badge "Putar" -->
                        <div
                            class="absolute bottom-2.5 right-2.5 px-2 py-0.5 bg-black/60 backdrop-blur-md rounded-md text-white text-[10px] font-semibold tracking-wider uppercase border border-white/10">
                            Putar
                        </div>
                    </div>

                    <!-- Content Text -->
                    <div class="pt-3.5 pb-2 px-2.5 flex flex-col flex-grow justify-between">
                        <div>
                            <!-- Category Micro Tag -->
                            <div class="flex items-center gap-1.5 mb-1.5">
                                <span class="px-2 py-0.5 rounded-full bg-emerald-50 text-[10px] font-extrabold text-[#10B981] uppercase tracking-wider border border-emerald-200/60 line-clamp-1">
                                    {{ $video['category'] ?? 'Politeknik' }}
                                </span>
                            </div>

                            <!-- Title -->
                            <h3
                                class="font-bold text-slate-800 text-sm leading-snug line-clamp-2 group-hover:text-[#10B981] transition-colors duration-300">
                                {{ $video['title'] ?? '' }}
                            </h3>
                        </div>

                        <!-- Action Indicator Footer -->
                        <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between text-[11px] font-medium text-slate-400">
                            <span class="flex items-center gap-1 text-emerald-600 font-semibold group-hover:translate-x-1 transition-transform duration-300">
                                Tonton Video
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </span>
                            <span class="text-[10px] text-slate-400">YouTube</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Tombol "Lihat Semua Video" Compact -->
        <div class="mt-10 flex justify-center relative z-20">
            <a href="https://www.youtube.com/@PoliteknikKampar" target="_blank" rel="noopener noreferrer"
                class="group relative inline-flex items-center gap-2.5 px-6 py-3 bg-white/90 backdrop-blur-md border border-slate-200/80 text-slate-700 rounded-full font-bold shadow-sm hover:shadow-[0_10px_25px_-5px_rgba(16,185,129,0.2)] hover:border-emerald-300 transition-all duration-300 overflow-hidden hover:-translate-y-0.5">

                <!-- Hover Glow Effect Background -->
                <div
                    class="absolute inset-0 bg-gradient-to-r from-emerald-50/60 to-orange-50/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>

                <!-- Logo YouTube -->
                <svg class="w-5 h-5 text-[#FF0000] relative z-10 transition-transform duration-300 group-hover:scale-110"
                    fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                </svg>

                <!-- Text -->
                <span
                    class="relative z-10 text-xs md:text-sm group-hover:text-emerald-700 transition-colors duration-300">
                    Kunjungi Channel YouTube Resmi
                </span>

                <!-- Arrow Icon -->
                <svg class="w-3.5 h-3.5 relative z-10 text-slate-400 group-hover:text-emerald-600 transition-all duration-300 group-hover:translate-x-1"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>
        </div>

    </div>

    <!-- Teleport Modal Embed Video -->
    <template x-teleport="body">
        <div x-show="modalOpen" style="display: none;"
            class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-lg" @click="closeVideo()"></div>
            <div class="relative w-full max-w-4xl aspect-video bg-black rounded-2xl overflow-hidden shadow-2xl ring-1 ring-white/20 transform scale-100"
                x-show="modalOpen" x-transition:enter="ease-out duration-300 delay-75"
                x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-2 scale-95">
                <button @click="closeVideo()"
                    class="absolute top-3 right-3 z-50 w-9 h-9 flex items-center justify-center rounded-full bg-black/60 hover:bg-[#FF8C00] text-white backdrop-blur-md transition-colors duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <template x-if="activeVideoId">
                    <iframe class="w-full h-full absolute inset-0"
                        :src="`https://www.youtube.com/embed/${activeVideoId}?autoplay=1&rel=0`" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </template>
            </div>
        </div>
    </template>
</section>