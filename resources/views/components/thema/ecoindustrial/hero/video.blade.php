@props(['metadata'])

@php
    $rawVideo = $metadata['video_url'] ?? '';
    // Ekstraksi otomatis ID YouTube 11 karakter menggunakan Regex
    preg_match(
        '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/',
        $rawVideo,
        $matches,
    );
    $videoId = $matches[1] ?? $rawVideo;
@endphp

<div
    class="relative w-full h-screen bg-slate-950 text-white font-sans overflow-hidden flex items-center justify-center select-none selection:bg-[#10B981] selection:text-white">

    <!-- ================= 1. YOUTUBE FULL BACKGROUND ================= -->
    <div class="absolute inset-0 w-full h-full overflow-hidden pointer-events-none z-0">
        <!--
            Trik CSS Aspect Ratio:
            w-[100vw] h-[100vh] min-w-[177.77vh] min-h-[56.25vw]
            Memastikan video YouTube menutupi seluruh layar tanpa border hitam
        -->
        <iframe
            src="https://www.youtube-nocookie.com/embed/{{ $videoId }}?autoplay=1&mute=1&loop=1&playlist={{ $videoId }}&controls=0&showinfo=0&autohide=1&modestbranding=1&enablejsapi=1&playsinline=1&rel=0&iv_load_policy=3"
            title="Background Video Loop" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            class="absolute top-1/2 left-1/2 w-[100vw] h-[100vh] min-w-[177.77vh] min-h-[56.25vw] -translate-x-1/2 -translate-y-1/2 object-cover opacity-80 scale-105">
        </iframe>
    </div>

    <!-- ================= 2. ATMOSPHERIC OVERLAY (BALANCED LIGHT & CONTRAST) ================= -->
    <!-- 1. Base Dark Layer (Diturunkan dari 60% ke 30% + subtle blur agar video lebih jelas) -->
    <div class="absolute inset-0 bg-slate-950/30 backdrop-blur-[1.5px] z-0 pointer-events-none"></div>

    <!-- 2. Radial Dark Mask (Kegelapan terfokus di tengah balik teks, tepi video tetap terang) -->
    <div
        class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(2,6,23,0.55)_0%,rgba(2,6,23,0.2)_60%,transparent_100%)] z-0 pointer-events-none">
    </div>

    <!-- 3. Gradient Halus Atas & Bawah (Transition halus ke section lain) -->
    <div
        class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-slate-950/30 z-0 pointer-events-none">
    </div>

    <!-- 4. Glowing Ambient Orbs (Sedikit ditingkatkan opacity-nya untuk mempercantik nuansa) -->
    <div class="absolute top-1/4 -left-32 w-[500px] h-[500px] bg-emerald-500/25 rounded-full blur-[130px] pointer-events-none animate-pulse"
        style="animation-duration: 8s;"></div>
    <div class="absolute bottom-1/4 -right-32 w-[600px] h-[600px] bg-amber-500/20 rounded-full blur-[150px] pointer-events-none animate-pulse"
        style="animation-duration: 10s;"></div>

    <!-- ================= 3. CONTENT AREA (CENTERED) ================= -->
    <div
        class="relative z-10 w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center flex flex-col items-center mt-10">

        <!-- Tagline Badge -->
        <div
            class="inline-flex items-center gap-3 px-5 py-2 rounded-full bg-slate-900/60 border border-emerald-500/40 shadow-[0_0_20px_rgba(16,185,129,0.2)] backdrop-blur-md mb-8">
            <span class="relative flex h-2.5 w-2.5">
                <span
                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#FF8C00] opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-[#FF8C00]"></span>
            </span>
            <span class="text-xs md:text-sm font-extrabold uppercase tracking-[0.25em] text-[#10B981]">
                {{ $metadata['tagline'] }}
            </span>
        </div>

        <!-- Title -->
        <h1
            class="text-4xl sm:text-5xl lg:text-7xl font-black leading-[1.1] tracking-tight text-white drop-shadow-[0_5px_15px_rgba(0,0,0,0.5)] mb-6">
            {{ $metadata['title'] }} <br>
            <span
                class="bg-gradient-to-r from-[#10B981] to-[#34D399] bg-clip-text text-transparent">{{ $metadata['title_secondary'] }}</span>
        </h1>

        <!-- Description -->
        <p
            class="text-base sm:text-lg lg:text-xl text-slate-200 leading-relaxed font-normal max-w-2xl drop-shadow-md mb-10">
            {{ $metadata['description'] }}
        </p>

        <!-- Buttons CTA -->
        @if ($metadata['show_button_primary'] || $metadata['show_button_secondary'])
            <div class="flex flex-col sm:flex-row flex-wrap justify-center gap-4 items-center">
                @if ($metadata['show_button_primary'])
                    <!-- Primary Button -->
                    <a href="#"
                        class="group relative w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 bg-gradient-to-r from-[#FF8C00] via-[#FF7300] to-[#E06000] text-white text-[16px] font-bold rounded-2xl transition-all duration-300 shadow-[0_8px_30px_rgba(255,140,0,0.4)] hover:shadow-[0_12px_40px_rgba(255,140,0,0.6)] hover:-translate-y-1 overflow-hidden">
                        <span
                            class="absolute inset-0 w-1/2 h-full bg-white/25 skew-x-12 -translate-x-full group-hover:translate-x-[300%] transition-transform duration-1000 ease-in-out"></span>

                        <span class="relative z-10">{{ $metadata['button_text_primary'] }}</span>
                        <svg class="relative z-10 w-5 h-5 transition-transform duration-300 group-hover:translate-x-1.5"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                @endif
                @if ($metadata['show_button_secondary'])
                    <!-- Secondary Button -->
                    <a href="#"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 bg-white/10 backdrop-blur-md border border-white/20 hover:border-emerald-500/50 text-white text-[16px] font-bold rounded-2xl transition-all duration-300 hover:bg-white/20 shadow-lg hover:shadow-[0_0_25px_rgba(16,185,129,0.2)] hover:-translate-y-1">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ $metadata['button_text_secondary'] }}</span>
                    </a>
                @endif
            </div>
        @endif

    </div>

    <!-- Mouse Scroll Indicator (Bottom Center) -->
    <div
        class="absolute bottom-10 left-1/2 -translate-x-1/2 z-10 flex flex-col items-center gap-2 opacity-70 animate-bounce cursor-pointer hover:opacity-100 transition-opacity">
        <span class="text-[10px] font-mono tracking-[0.2em] text-white uppercase">Scroll</span>
        <div class="w-5 h-8 border-2 border-white/50 rounded-full flex justify-center p-1">
            <div class="w-1 h-2 bg-emerald-400 rounded-full"></div>
        </div>
    </div>
</div>
