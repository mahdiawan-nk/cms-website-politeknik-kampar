@props(['siteSetting'])
<footer
    class="relative mt-auto w-full bg-[#F8FAFC] text-slate-500 font-sans border-t border-slate-200/60 overflow-hidden">

    {{-- Top Eco-Industrial Gradient Accent Strip --}}
    <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#10B981] via-emerald-400 to-[#FF8C00]">
    </div>

    {{-- Subtle Industrial Technical Grid & Ambient Glows --}}
    <div
        class="absolute inset-0 bg-[linear-gradient(to_right,#00000005_1px,transparent_1px),linear-gradient(to_bottom,#00000005_1px,transparent_1px)] bg-[size:36px_36px] pointer-events-none">
    </div>
    <div
        class="absolute top-1/2 left-1/4 -translate-y-1/2 w-96 h-96 bg-emerald-400/10 rounded-full blur-3xl pointer-events-none">
    </div>
    <div
        class="absolute top-1/2 right-1/4 -translate-y-1/2 w-96 h-96 bg-amber-400/10 rounded-full blur-3xl pointer-events-none">
    </div>

    <div class="relative z-20 container mx-auto px-6 lg:px-12 pt-20 pb-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 lg:gap-8">

            <!-- Kolom Identitas -->
            <div class="lg:col-span-5 flex flex-col pr-0 lg:pr-12">
                @php
                    $siteName = trim($siteSetting->site_name ?? 'POLITEKNIK KAMPAR');
                    $hasSpace = str_contains($siteName, ' ');

                    // Memisahkan kata utama dan kata terakhir
                    $firstPart = $hasSpace ? \Illuminate\Support\Str::beforeLast($siteName, ' ') : $siteName;
                    $highlightPart = $hasSpace ? \Illuminate\Support\Str::afterLast($siteName, ' ') : '';
                @endphp
                <a href="#" class="inline-block mb-6">
                    <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight text-slate-900">{{ $firstPart }}
                        <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-[#10B981] to-[#FF8C00]">{{ $highlightPart }}</span>
                    </h2>
                </a>
                <p class="text-sm md:text-base leading-relaxed text-slate-500 font-medium mb-8 max-w-md">
                    {{ $siteSetting->footer_description }}
                </p>

                <!-- Social Media (Premium SVGs) -->
                <div class="flex items-center space-x-3">
                    @php
                        $platforms = [
                            'facebook' => [
                                'name' => 'Facebook',
                                'hover' => 'hover:text-[#10B981] hover:border-emerald-300 hover:bg-emerald-50',
                                'icon' =>
                                    '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>',
                            ],
                            'instagram' => [
                                'name' => 'Instagram',
                                'hover' => 'hover:text-[#FF8C00] hover:border-orange-300 hover:bg-orange-50',
                                'icon' =>
                                    '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"/></svg>',
                            ],
                            'x' => [
                                'name' => 'X (Twitter)',
                                'hover' => 'hover:text-slate-900 hover:border-slate-300 hover:bg-slate-50',
                                'icon' =>
                                    '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
                            ],
                            'youtube' => [
                                'name' => 'YouTube',
                                'hover' => 'hover:text-red-500 hover:border-red-200 hover:bg-red-50',
                                'icon' =>
                                    '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
                            ],
                            'tiktok' => [
                                'name' => 'TikTok',
                                'hover' => 'hover:text-slate-900 hover:border-slate-400 hover:bg-slate-100',
                                'icon' =>
                                    '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 1 1-5.2 0 2.89 2.89 0 0 1 2.31-2.83V9.38a6.34 6.34 0 1 0 5.08 6.16V9.17a8.27 8.27 0 0 0 5.03 1.7v-4.2a4.83 4.83 0 0 1-.00-.02z"/></svg>',
                            ],
                            'linkedin' => [
                                'name' => 'LinkedIn',
                                'hover' => 'hover:text-[#0A66C2] hover:border-blue-300 hover:bg-blue-50',
                                'icon' =>
                                    '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/></svg>',
                            ],
                        ];
                    @endphp
                    @foreach ($siteSetting->social_links ?? [] as $social)
                        @php
                            $key = $social['platform'] ?? '';
                            $data = $platforms[$key] ?? null;
                        @endphp

                        @if ($data)
                            <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer"
                                title="{{ $data['name'] }}"
                                class="group flex items-center justify-center w-10 h-10 rounded-xl bg-white border border-slate-200 shadow-sm text-slate-400 {{ $data['hover'] }} hover:-translate-y-1 transition-all duration-300">
                                {!! $data['icon'] !!}
                            </a>
                        @endif
                    @endforeach
                    
                </div>
            </div>

            <!-- Kolom Navigasi Akademik -->
            <div class="lg:col-span-2">
                <h3 class="font-bold text-slate-900 mb-6 uppercase tracking-widest text-xs flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#10B981]"></span> Akademik
                </h3>
                <ul class="space-y-3.5 text-[15px] font-medium">
                    <li>
                        <a href="#"
                            class="group inline-flex items-center gap-2 text-slate-500 hover:text-[#10B981] transition-colors duration-300">
                            <span class="w-0 h-[1.5px] bg-[#10B981] transition-all duration-300 group-hover:w-2"></span>
                            Pendaftaran PMB
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="group inline-flex items-center gap-2 text-slate-500 hover:text-[#10B981] transition-colors duration-300">
                            <span class="w-0 h-[1.5px] bg-[#10B981] transition-all duration-300 group-hover:w-2"></span>
                            Program Studi
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="group inline-flex items-center gap-2 text-slate-500 hover:text-[#10B981] transition-colors duration-300">
                            <span class="w-0 h-[1.5px] bg-[#10B981] transition-all duration-300 group-hover:w-2"></span>
                            Kalender Akademik
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="group inline-flex items-center gap-2 text-slate-500 hover:text-[#10B981] transition-colors duration-300">
                            <span class="w-0 h-[1.5px] bg-[#10B981] transition-all duration-300 group-hover:w-2"></span>
                            Perpustakaan
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Kolom Navigasi Layanan -->
            <div class="lg:col-span-2">
                <h3 class="font-bold text-slate-900 mb-6 uppercase tracking-widest text-xs flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#FF8C00]"></span> Layanan
                </h3>
                <ul class="space-y-3.5 text-[15px] font-medium">
                    <li>
                        <a href="#"
                            class="group inline-flex items-center gap-2 text-slate-500 hover:text-[#FF8C00] transition-colors duration-300">
                            <span class="w-0 h-[1.5px] bg-[#FF8C00] transition-all duration-300 group-hover:w-2"></span>
                            SIAKAD
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="group inline-flex items-center gap-2 text-slate-500 hover:text-[#FF8C00] transition-colors duration-300">
                            <span class="w-0 h-[1.5px] bg-[#FF8C00] transition-all duration-300 group-hover:w-2"></span>
                            E-Learning
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="group inline-flex items-center gap-2 text-slate-500 hover:text-[#FF8C00] transition-colors duration-300">
                            <span class="w-0 h-[1.5px] bg-[#FF8C00] transition-all duration-300 group-hover:w-2"></span>
                            Lowongan Kerja
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="group inline-flex items-center gap-2 text-slate-500 hover:text-[#FF8C00] transition-colors duration-300">
                            <span class="w-0 h-[1.5px] bg-[#FF8C00] transition-all duration-300 group-hover:w-2"></span>
                            Hubungi Kami
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Kolom Navigasi Kontak -->
            <div class="lg:col-span-3">
                <h3 class="font-bold text-slate-900 mb-6 uppercase tracking-widest text-xs flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Kontak
                </h3>
                <ul class="space-y-4 text-[14px] font-medium text-slate-500">
                    <li class="flex items-start gap-3 group">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-[#10B981] transition-colors shrink-0 mt-0.5"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="leading-relaxed">{{ $siteSetting->address }}</span>
                    </li>
                    <li class="flex items-center gap-3 group">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-[#10B981] transition-colors shrink-0"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <a href="mailto:info@poltek-kampar.ac.id"
                            class="hover:text-[#10B981] transition-colors">{{ $siteSetting->email }}</a>
                    </li>
                    <li class="flex items-center gap-3 group">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-[#10B981] transition-colors shrink-0"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <a href="tel:0761123456" class="hover:text-[#10B981] transition-colors">{{ $siteSetting->phone }}</a>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Footer Bawah / Copyright Area -->
        <div
            class="mt-16 pt-8 border-t border-slate-200/80 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-sm font-semibold text-slate-400">
                &copy; {{ date('Y') }} Politeknik Kampar. All rights reserved.
            </p>
            <div class="flex flex-wrap justify-center gap-x-6 gap-y-2 text-sm font-semibold text-slate-400">
                <a href="#" class="hover:text-[#10B981] transition-colors">Privasi</a>
                <a href="#" class="hover:text-[#10B981] transition-colors">Ketentuan Layanan</a>
                <a href="#" class="hover:text-[#10B981] transition-colors">Peta Situs</a>
            </div>
        </div>
    </div>
</footer>
