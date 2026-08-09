<div class="bg-white min-h-screen pb-16">
    <!-- Header Cover & Title Area (Sudah mencakup Breadcrumb) -->
    <x-thema.ecoindustrial.post-header :post="$post" :coverImage="$coverImage"/>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 -mt-6 sm:-mt-10 relative z-30">
        
        <!-- Main Grid Layout (Artikel + Sidebar) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">

            <!-- ========================================== -->
            <!-- LEFT COLUMN: MAIN ARTICLE CONTENT (8 COLS) -->
            <!-- ========================================== -->
            <main class="lg:col-span-8 bg-white p-6 sm:p-8 rounded-2xl border border-slate-100 shadow-sm">
                <article>
                    <!-- Featured Image -->
                    @if($post->featured_image)
                        <div class="mb-8 rounded-xl overflow-hidden shadow-sm bg-slate-50 border border-slate-100">
                            <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}"
                                class="w-full h-auto max-h-[460px] object-cover">
                        </div>
                    @endif

                    <!-- Excerpt / Ringkasan (Jika ada) -->
                    @if ($post->excerpt)
                        <div class="p-4 sm:p-6 bg-[#F8FAFC] border-l-4 border-[#FF8C00] rounded-r-xl text-base sm:text-lg text-slate-700 italic mb-8 leading-relaxed">
                            "{{ $post->excerpt }}"
                        </div>
                    @endif

                    <!-- Article Body Content -->
                    <div class="prose prose-emerald max-w-none text-slate-800 text-base sm:text-lg leading-relaxed mb-10">
                        {!! $post->content !!}
                    </div>

                    <!-- Social Share Bar -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 p-5 bg-[#F8FAFC] rounded-2xl border border-slate-200/80 my-8">
                        <span class="font-bold text-sm text-slate-900 flex items-center gap-2">
                            <svg class="w-4 h-4 text-[#047857]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                            </svg>
                            Bagikan Artikel Ini:
                        </span>
                        <div class="flex items-center gap-2.5">
                            <!-- WhatsApp -->
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' - ' . url()->current()) }}"
                                target="_blank"
                                class="px-3.5 py-2 bg-[#25D366] text-white text-xs font-bold rounded-lg hover:opacity-90 transition-opacity flex items-center gap-1.5 shadow-sm">
                                WhatsApp
                            </a>
                            <!-- Facebook -->
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                target="_blank"
                                class="px-3.5 py-2 bg-[#1877F2] text-white text-xs font-bold rounded-lg hover:opacity-90 transition-opacity flex items-center gap-1.5 shadow-sm">
                                Facebook
                            </a>
                            <!-- X / Twitter -->
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(url()->current()) }}"
                                target="_blank"
                                class="px-3.5 py-2 bg-black text-white text-xs font-bold rounded-lg hover:opacity-90 transition-opacity flex items-center gap-1.5 shadow-sm">
                                X / Twitter
                            </a>
                        </div>
                    </div>
                </article>
            </main>

            <!-- ========================================== -->
            <!-- RIGHT COLUMN: SIDEBAR CONTENT (4 COLS)     -->
            <!-- ========================================== -->
            <aside class="lg:col-span-4 space-y-6 lg:sticky lg:top-24">
                
                <!-- Widget 1: Info Penulis -->
                <div class="p-6 bg-white rounded-2xl border border-slate-100 shadow-sm">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-4">Penulis Artikel</h3>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-[#047857] to-[#10B981] text-white flex items-center justify-center font-bold text-lg shadow-md">
                            {{ substr($post->author?->name ?? 'A', 0, 1) }}
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">{{ $post->author?->name ?? 'Humas Politeknik Kampar' }}</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Diterbitkan pada {{ $post->published_at ? $post->published_at->translatedFormat('d M Y') : $post->created_at->translatedFormat('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Widget 2: CTA Banner (Penerimaan Mahasiswa Baru / Informasi Kampus) -->
                <div class="p-6 rounded-2xl bg-gradient-to-br from-[#047857] to-[#064e3b] text-white shadow-lg relative overflow-hidden">
                    <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-white/10 rounded-full blur-xl pointer-events-none"></div>
                    <span class="inline-block px-2.5 py-1 bg-[#FF8C00] text-white text-[10px] font-extrabold uppercase tracking-wider rounded mb-3">Pendaftaran</span>
                    <h4 class="text-lg font-bold leading-snug mb-2">Penerimaan Mahasiswa Baru Politeknik Kampar</h4>
                    <p class="text-xs text-emerald-100 mb-5 leading-relaxed">Bergabunglah bersama kami dan wujudkan karir profesional di bidang industri modern.</p>
                    <a href="https://pmb.poltek-kampar.ac.id" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white text-[#047857] font-bold text-xs rounded-xl hover:bg-slate-100 transition-colors shadow-sm">
                        Info Selengkapnya
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>

                <!-- Widget 3: Sidebar Artikel Populer / Terbaru -->
                @if ($relatedPosts->count() > 0)
                    <div class="p-6 bg-white rounded-2xl border border-slate-100 shadow-sm">
                        <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-100">
                            <h3 class="font-bold text-slate-900 text-sm uppercase tracking-wider flex items-center gap-2">
                                <span class="w-2 h-2 bg-[#FF8C00] rounded-full"></span>
                                Artikel Lainnya
                            </h3>
                        </div>
                        <div class="space-y-4">
                            @foreach ($relatedPosts as $item)
                                <a href="{{ route('posts.show', $item->slug) }}" wire:navigate class="group flex items-start gap-3.5">
                                    <img src="{{ $item->featured_image_url }}" alt="{{ $item->title }}" class="w-16 h-16 rounded-xl object-cover flex-shrink-0 bg-slate-100 border border-slate-100">
                                    <div class="flex-grow min-w-0">
                                        <span class="text-[10px] font-bold text-[#047857] uppercase tracking-wider block mb-1">
                                            {{ $item->category?->name ?? 'Informasi' }}
                                        </span>
                                        <h4 class="text-xs font-bold text-slate-800 group-hover:text-[#047857] transition-colors line-clamp-2 leading-snug">
                                            {{ $item->title }}
                                        </h4>
                                        <span class="text-[10px] text-slate-400 mt-1 block">
                                            {{ $item->published_at ? $item->published_at->format('d M Y') : $item->created_at->format('d M Y') }}
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

            </aside>

        </div>

        <!-- ========================================== -->
        <!-- BOTTOM SECTION: RELATED POSTS GRID        -->
        <!-- ========================================== -->
        @if ($relatedPosts->count() > 0)
            <section class="mt-16 pt-12 border-t border-slate-200">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-2xl font-bold text-slate-900">Rekomendasi Bacaan</h3>
                        <p class="text-xs sm:text-sm text-slate-500 mt-1">Artikel menarik lainnya yang mungkin Anda sukai</p>
                    </div>
                    <a href="/artikel" wire:navigate class="text-xs font-bold text-[#047857] hover:text-[#064e3b] flex items-center gap-1 transition-colors">
                        Lihat Semua Artikel
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($relatedPosts as $related)
                        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden hover:shadow-md transition-all duration-300 group flex flex-col justify-between">
                            <div>
                                <a href="{{ route('posts.show', $related->slug) }}" wire:navigate class="block relative overflow-hidden aspect-video">
                                    <img src="{{ $related->featured_image_url }}" alt="{{ $related->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </a>
                                <div class="p-5">
                                    <span class="text-[10px] font-extrabold text-[#047857] bg-[#047857]/10 px-2.5 py-1 rounded-md uppercase tracking-wider inline-block mb-3">
                                        {{ $related->category?->name ?? 'Informasi' }}
                                    </span>
                                    <a href="{{ route('posts.show', $related->slug) }}" wire:navigate class="block">
                                        <h4 class="font-bold text-slate-900 text-base group-hover:text-[#047857] transition-colors line-clamp-2 mb-2 leading-snug">
                                            {{ $related->title }}
                                        </h4>
                                    </a>
                                </div>
                            </div>
                            <div class="px-5 pb-5 pt-0 text-xs text-slate-400 border-t border-slate-50 mt-auto flex items-center justify-between">
                                <span>{{ $related->published_at ? $related->published_at->format('d M Y') : $related->created_at->format('d M Y') }}</span>
                                <span class="text-[#047857] font-semibold group-hover:underline">Baca &rarr;</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

    </div>
</div>