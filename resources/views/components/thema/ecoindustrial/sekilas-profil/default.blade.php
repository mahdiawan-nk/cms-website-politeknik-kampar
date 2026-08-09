@props(['sambutan'])

<section class="relative w-full py-32 bg-[#F8FAFC] overflow-hidden font-sans text-slate-900">

    {{-- Top Eco-Industrial Gradient Accent Strip --}}
    <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#10B981] via-emerald-400 to-[#FF8C00]"></div>

    {{-- Subtle Industrial Technical Grid & Ambient Glows --}}
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#00000005_1px,transparent_1px),linear-gradient(to_bottom,#00000005_1px,transparent_1px)] bg-[size:36px_36px] pointer-events-none"></div>
    <div class="absolute top-1/2 left-1/4 -translate-y-1/2 w-96 h-96 bg-emerald-400/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/2 right-1/4 -translate-y-1/2 w-96 h-96 bg-amber-400/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative z-10 container mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-20 items-center">

            {{-- SEKSI KIRI: FOTO PROFIL (ENGINEERED FRAME) --}}
            <div class="lg:col-span-5 flex justify-center lg:justify-start">
                
                <div class="relative w-full max-w-[480px] aspect-[4/5] group">
                    <!-- Layered Glass Frame -->
                    <div class="absolute inset-0 bg-white rounded-[2.5rem] shadow-[0_20px_40px_-10px_rgba(16,185,129,0.1)] group-hover:shadow-[0_30px_60px_-15px_rgba(255,140,0,0.15)] transition-shadow duration-700 ease-out border border-slate-100"></div>
                    
                    <!-- Industrial Precision Corners (Muncul saat hover) -->
                    <div class="absolute -top-1 -left-1 w-10 h-10 border-t-2 border-l-2 border-[#10B981] rounded-tl-[2.6rem] opacity-0 group-hover:opacity-100 group-hover:-translate-x-2 group-hover:-translate-y-2 transition-all duration-700 ease-out z-20"></div>
                    <div class="absolute -bottom-1 -right-1 w-10 h-10 border-b-2 border-r-2 border-[#FF8C00] rounded-br-[2.6rem] opacity-0 group-hover:opacity-100 group-hover:translate-x-2 group-hover:translate-y-2 transition-all duration-700 ease-out z-20"></div>

                    <!-- Inner Image Container -->
                    <div class="absolute inset-3 rounded-[2rem] overflow-hidden bg-slate-100 z-10">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent opacity-80 lg:opacity-0 lg:group-hover:opacity-20 transition-opacity duration-500 z-10"></div>
                        
                        <img src="{{ $sambutan['foto'] }}" alt="{{ $sambutan['nama'] }}"
                            class="w-full h-full object-cover object-top transform scale-100 group-hover:scale-105 transition-transform duration-1000 ease-[cubic-bezier(0.25,1,0.5,1)]">

                        <!-- Mobile Overlay Name -->
                        <div class="absolute bottom-6 left-6 right-6 text-white lg:hidden z-20">
                            <h4 class="font-extrabold text-xl tracking-tight leading-tight drop-shadow-md">{{ $sambutan['nama'] }}</h4>
                            <div class="inline-flex items-center gap-2 mt-2 px-3 py-1 bg-[#FF8C00]/90 backdrop-blur-sm rounded-full">
                                <span class="text-[10px] uppercase font-bold tracking-widest text-white">{{ $sambutan['jabatan'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- SEKSI KANAN: KONTEN TEKS --}}
            <div class="lg:col-span-7 flex flex-col justify-center">
                
                <!-- Overline -->
                <div class="flex items-center gap-3 mb-6">
                    <span class="w-12 h-[2px] bg-gradient-to-r from-[#FF8C00] to-transparent"></span>
                    <span class="text-xs font-bold tracking-[0.2em] uppercase text-[#FF8C00]">
                        Sekilas Profil & Sambutan
                    </span>
                </div>

                <!-- Main Heading (Gradient Highlight) -->
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight mb-8 leading-[1.15]">
                    {{ $sambutan['judul'] }} <br class="hidden sm:inline">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#10B981] to-[#059669]">
                        {{ $sambutan['higliht_text'] }}
                    </span>
                </h2>

                <!-- Glassmorphism Quote Box -->
                <div class="relative p-8 sm:p-10 rounded-3xl bg-white/60 backdrop-blur-xl border border-slate-200/60 shadow-sm mb-8 group hover:bg-white/80 transition-all duration-500 ease-out overflow-hidden">
                    
                    <!-- Left Accent Line -->
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-1/2 bg-gradient-to-b from-[#10B981] to-[#FF8C00] rounded-r-full opacity-40 group-hover:opacity-100 group-hover:h-3/4 transition-all duration-500"></div>

                    <!-- Watermark Icon -->
                    <svg class="absolute top-6 left-6 w-16 h-16 text-emerald-100/40 -rotate-12 group-hover:rotate-0 group-hover:scale-110 transition-all duration-700 pointer-events-none" fill="currentColor" viewBox="0 0 32 32">
                        <path d="M10 8c-3.3 0-6 2.7-6 6v10h10V14H8c0-2.2 1.8-4 4-4V8zm16 0c-3.3 0-6 2.7-6 6v10h10V14h-6c0-2.2 1.8-4 4-4V8z"/>
                    </svg>

                    <p class="relative z-10 text-lg sm:text-xl leading-relaxed italic font-medium text-slate-700">
                        "{{ $sambutan['kutipan'] }}"
                    </p>
                </div>

                <!-- Closing Statement -->
                <p class="text-base sm:text-lg font-semibold text-slate-600 mb-10 leading-relaxed">
                    {{ $sambutan['salam_penutup'] }}
                </p>

                <!-- Signature / Profil Block -->
                <div class="hidden lg:flex items-center gap-5 pt-6 border-t border-slate-200/80">
                    
                    <!-- Icon Profile -->
                    <div class="w-14 h-14 rounded-full bg-emerald-50 border border-emerald-100 flex items-center justify-center flex-shrink-0 shadow-sm">
                        <svg class="w-6 h-6 text-[#10B981]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    
                    <div>
                        <h4 class="text-xl font-extrabold tracking-tight text-slate-900">
                            {{ $sambutan['nama'] }}
                        </h4>
                        <p class="text-xs uppercase tracking-widest mt-1.5 font-bold text-[#FF8C00]">
                            {{ $sambutan['jabatan'] }}
                        </p>
                    </div>

                    <!-- Subtle arrow indicator indicating "Read Full Profile" action if needed -->
                    <a href="#" class="ml-auto w-10 h-10 rounded-full bg-slate-50 hover:bg-[#10B981] text-slate-400 hover:text-white flex items-center justify-center transition-colors duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>