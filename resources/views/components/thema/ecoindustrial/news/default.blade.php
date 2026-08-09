@props(['newsData', 'allNewsUrl' => '#'])

<section class="relative w-full py-12 lg:py-16 bg-[#F8FAFC] overflow-hidden font-sans text-slate-900">

    {{-- Top Eco-Industrial Gradient Accent Strip --}}
    <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#10B981] via-emerald-400 to-[#FF8C00]">
    </div>

    {{-- Subtle Industrial Technical Grid & Ambient Glows --}}
    <div
        class="absolute inset-0 bg-[linear-gradient(to_right,#00000005_1px,transparent_1px),linear-gradient(to_bottom,#00000005_1px,transparent_1px)] bg-[size:36px_36px] pointer-events-none">
    </div>
    <div class="absolute top-1/3 left-10 w-96 h-96 bg-emerald-400/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-amber-400/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative z-10 container mx-auto px-6 lg:px-12">

        {{-- Header Sekilas Berita --}}
        <x-thema.ecoindustrial.header-section :header="[
            'badge' => 'Kabar Kampus',
            'title' => 'Informasi &',
            'title_higlight' => 'Berita Terkini',
            'description' =>
                'Ikuti perkembangan terbaru, kegiatan riset, prestasi mahasiswa, serta berbagai wawasan ilmiah dan cerita menarik dari lingkungan kampus kami.',
        ]" />

        {{-- Grid 3 Kolom Seimbang --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @foreach ($newsData as $news)
                <article
                    class="group relative flex flex-col justify-between overflow-hidden border border-slate-200/80 bg-white/90 backdrop-blur-xl rounded-[2rem] shadow-sm hover:shadow-[0_20px_40px_-15px_rgba(16,185,129,0.15)] hover:border-emerald-300 transition-all duration-500 hover:-translate-y-1.5">

                    {{-- Top Accent Hover Line --}}
                    <div
                        class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#10B981] to-[#FF8C00] scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left z-20">
                    </div>

                    <div>
                        {{-- Image Container --}}
                        <div class="relative overflow-hidden aspect-[16/10] w-full rounded-t-[2rem]">
                            <div
                                class="absolute inset-0 bg-slate-900/10 group-hover:bg-transparent transition-colors duration-500 z-10">
                            </div>
                            <img src="{{ $news['featured_image_url'] }}" alt="{{ $news['title'] }}"
                                class="w-full h-full object-cover transition-transform duration-700 ease-in-out group-hover:scale-105" />

                            {{-- Floating Category Badge --}}
                            <div class="absolute top-4 left-4 z-20">
                                <span
                                    class="px-3.5 py-1 text-[10px] font-extrabold uppercase tracking-widest text-white bg-[#10B981]/90 backdrop-blur-md border border-white/20 shadow-md rounded-full">
                                    {{ $news['category_name'] }}
                                </span>
                            </div>
                        </div>

                        {{-- Card Body --}}
                        <div class="p-6">
                            <div
                                class="flex items-center gap-2 mb-3 text-[11px] font-bold tracking-wide text-slate-400 uppercase">
                                <svg class="w-3.5 h-3.5 text-[#FF8C00]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $news['published_at'] }}</span>
                            </div>

                            <h3
                                class="text-lg md:text-xl font-extrabold tracking-tight leading-snug text-slate-900 group-hover:text-[#10B981] transition-colors duration-300 line-clamp-2">
                                <a href="{{ $news['url'] ?? '#' }}" class="before:absolute before:inset-0">
                                    {{ $news['title'] }}
                                </a>
                            </h3>

                            <p class="mt-3 text-xs md:text-sm leading-relaxed text-slate-500 font-medium line-clamp-3">
                                {{ $news['excerpt'] }}
                            </p>
                        </div>
                    </div>

                    {{-- Card Footer --}}
                    <div class="px-6 pb-6 pt-2">
                        <div
                            class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-extrabold text-slate-400 group-hover:text-[#FF8C00] transition-colors duration-300">
                            <span>Baca Selengkapnya</span>
                            <div
                                class="w-6 h-6 rounded-full bg-slate-100 group-hover:bg-[#FF8C00] group-hover:text-white flex items-center justify-center transition-colors duration-300">
                                <svg class="w-3.5 h-3.5 transform group-hover:translate-x-0.5 transition-transform duration-300"
                                    fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                </article>
            @endforeach
        </div>

        {{-- Button All --}}
        <div class="mt-12 text-center relative z-20">
            <a href="{{ $allNewsUrl }}"
                class="inline-flex items-center justify-center gap-3 px-8 py-3.5 rounded-2xl bg-white border border-slate-200/80 text-slate-800 font-extrabold text-xs tracking-wider uppercase shadow-sm hover:border-emerald-300 hover:text-[#10B981] hover:shadow-[0_10px_30px_-10px_rgba(16,185,129,0.2)] hover:-translate-y-0.5 active:scale-95 transition-all duration-300 group">
                <span>Lihat Semua Artikel & Berita</span>
                <div
                    class="w-7 h-7 rounded-full bg-emerald-50 text-[#10B981] group-hover:bg-[#10B981] group-hover:text-white flex items-center justify-center transition-colors duration-300">
                    <svg class="w-4 h-4 transform group-hover:translate-x-0.5 transition-transform duration-300"
                        fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </div>
            </a>
        </div>

    </div>
</section>
