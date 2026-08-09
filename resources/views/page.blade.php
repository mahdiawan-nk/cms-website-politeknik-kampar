<div class="relative min-h-screen bg-[#F8FAFC] font-sans selection:bg-[#10B981]/20 selection:text-emerald-900">

    <!-- COVER HEADER: Light Premium Fade -->
    <x-thema.ecoindustrial.cover-header :coverImage="$coverImage" :pageTitle="$pageTitle" :pageRecord="$pageRecord" />

    <!-- MAIN CONTENT AREA -->
    @if (($content['layout_type'] ?? '') === 'kata_sambutan')
        <livewire:sekilas-profil />
    @else
        <!-- Transisi mulus karena background header di bagian bawah sama dengan warna div ini -->
        <div class="relative z-10 w-full pt-4 pb-20 sm:pt-8 sm:pb-28">
            <!-- Top Accent Bar -->
            <div
                class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#10B981] via-emerald-400 to-[#FF8C00]">
            </div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Grid System Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">

                    <!-- ========================================== -->
                    <!-- MAIN CONTENT AREA (8 COLS)                 -->
                    <!-- ========================================== -->
                    <main class="lg:col-span-8">
                        <livewire:pages.index :content="$content" />
                    </main>

                    <!-- ========================================== -->
                    <!-- SIDEBAR AREA (4 COLS)                      -->
                    <!-- ========================================== -->
                    <aside class="lg:col-span-4 space-y-6 lg:sticky lg:top-24">

                        <!-- Widget 1: Banner CTA / Informational Widget -->
                        <div
                            class="p-6 rounded-2xl bg-gradient-to-br from-[#047857] to-[#064e3b] text-white shadow-md relative overflow-hidden">
                            <div
                                class="absolute -right-6 -bottom-6 w-32 h-32 bg-white/10 rounded-full blur-xl pointer-events-none">
                            </div>
                            <span
                                class="inline-block px-2.5 py-1 bg-[#FF8C00] text-white text-[10px] font-extrabold uppercase tracking-wider rounded mb-3">
                                Informasi Kampus
                            </span>
                            <h3 class="text-lg font-bold leading-snug mb-2">Penerimaan Mahasiswa Baru</h3>
                            <p class="text-xs text-emerald-100 mb-5 leading-relaxed">
                                Bergabunglah dengan Politeknik Kampar dan kembangkan potensi industri terapan Anda
                                bersama kami.
                            </p>
                            <a href="/pmb" wire:navigate
                                class="inline-flex items-center gap-2 px-4 py-2.5 bg-white text-[#047857] font-bold text-xs rounded-xl hover:bg-slate-100 transition-colors shadow-sm">
                                Info Pendaftaran
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>

                        <!-- Widget 2: Fast Info / Notice Card -->
                        @if ($relatedPosts->count() > 0)
                            <div class="p-6 bg-white rounded-2xl border border-slate-100 shadow-sm">
                                <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-100">
                                    <h3
                                        class="font-bold text-slate-900 text-sm uppercase tracking-wider flex items-center gap-2">
                                        <span class="w-2 h-2 bg-[#FF8C00] rounded-full"></span>
                                        Artikel Lainnya
                                    </h3>
                                </div>
                                <div class="space-y-4">
                                    @foreach ($relatedPosts as $item)
                                        <a href="{{ route('posts.show', $item->slug) }}" wire:navigate
                                            class="group flex items-start gap-3.5">
                                            <img src="{{ $item->featured_image_url }}" alt="{{ $item->title }}"
                                                class="w-16 h-16 rounded-xl object-cover flex-shrink-0 bg-slate-100 border border-slate-100">
                                            <div class="flex-grow min-w-0">
                                                <span
                                                    class="text-[10px] font-bold text-[#047857] uppercase tracking-wider block mb-1">
                                                    {{ $item->category?->name ?? 'Informasi' }}
                                                </span>
                                                <h4
                                                    class="text-xs font-bold text-slate-800 group-hover:text-[#047857] transition-colors line-clamp-2 leading-snug">
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

                        <!-- Widget 3: Tautan Cepat (Quick Links) -->
                        {{-- <div class="p-6 bg-white rounded-2xl border border-slate-200/80 shadow-sm">
                            <h3 class="font-bold text-slate-900 text-xs uppercase tracking-wider mb-4">
                                Akses Cepat
                            </h3>
                            <div class="grid grid-cols-2 gap-2 text-xs font-semibold text-slate-700">
                                <a href="/prodi" wire:navigate
                                    class="p-2.5 bg-slate-50 hover:bg-[#047857]/10 hover:text-[#047857] rounded-xl transition-colors text-center border border-slate-100">
                                    Program Studi
                                </a>
                                <a href="/fasilitas" wire:navigate
                                    class="p-2.5 bg-slate-50 hover:bg-[#047857]/10 hover:text-[#047857] rounded-xl transition-colors text-center border border-slate-100">
                                    Fasilitas Kampus
                                </a>
                                <a href="/beasiswa" wire:navigate
                                    class="p-2.5 bg-slate-50 hover:bg-[#047857]/10 hover:text-[#047857] rounded-xl transition-colors text-center border border-slate-100">
                                    Info Beasiswa
                                </a>
                                <a href="/kontak" wire:navigate
                                    class="p-2.5 bg-slate-50 hover:bg-[#047857]/10 hover:text-[#047857] rounded-xl transition-colors text-center border border-slate-100">
                                    Hubungi Kami
                                </a>
                            </div>
                        </div> --}}

                    </aside>

                </div>

            </div>
        </div>
    @endif

</div>
