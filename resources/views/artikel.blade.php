<div class="relative min-h-screen bg-slate-50/60 font-sans antialiased text-slate-800">
    <x-thema.ecoindustrial.cover-header :coverImage="$coverImage" :pageTitle="$pageTitle"/>
    
    <!-- Background Gradient Pattern (Eco-Industrial Touch) -->
    <div class="absolute inset-0 bg-[radial-gradient(#059669_1px,transparent_1px)] [background-size:24px_24px] opacity-[0.03] pointer-events-none"></div>

    <div class="relative z-10 w-full pt-6 pb-20 sm:pt-10 sm:pb-28">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header & Search Toolbar (Eco-Industrial Glass Bar) -->
            <div class="mb-10 p-6 sm:p-8 bg-white/80 backdrop-blur-md rounded-3xl border border-slate-200/80 shadow-xl shadow-slate-200/50">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    
                    <!-- Title & Tagline -->
                    <div class="space-y-1">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200/60 text-emerald-700 text-xs font-semibold tracking-wide uppercase">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            Polkam Eco-Vokasi News
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            {{ $pageTitle }}
                        </h1>
                        <p class="text-sm text-slate-500">Inovasi, riset terapan, dan wawasan terkini Politeknik Kampar.</p>
                    </div>

                    <!-- Livewire Search Input Feature -->
                    <div class="w-full lg:w-96 relative">
                        <div class="relative flex items-center">
                            <input 
                                type="text" 
                                wire:model.live.debounce.300ms="search"
                                placeholder="Cari artikel, topik, atau kata kunci..." 
                                class="w-full pl-11 pr-10 py-3 bg-slate-100/70 border border-slate-200 rounded-2xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-300"
                            >
                            <!-- Search Icon -->
                            <div class="absolute left-3.5 text-slate-400 pointer-events-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>

                            <!-- Clear Search Button -->
                            @if(!empty($search))
                                <button 
                                    wire:click="clearSearch"
                                    class="absolute right-3 text-slate-400 hover:text-slate-600 p-1 rounded-full hover:bg-slate-200/50 transition"
                                    title="Bersihkan pencarian"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>

                </div>

                <!-- Category Filters (Horizontal Scrollable Pills) -->
                @if($categories->count() > 0)
                    <div class="mt-6 pt-6 border-t border-slate-100 flex items-center gap-2 overflow-x-auto no-scrollbar pb-1">
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider mr-2 shrink-0">Kategori:</span>
                        
                        <button 
                            wire:click="selectCategory(null)"
                            class="shrink-0 px-4 py-1.5 rounded-xl text-xs font-medium transition-all duration-200 {{ is_null($categoryId) ? 'bg-emerald-600 text-white shadow-md shadow-emerald-600/20' : 'bg-slate-100 text-slate-600 hover:bg-slate-200/70' }}"
                        >
                            Semua
                        </button>

                        @foreach($categories as $cat)
                            <button 
                                wire:click="selectCategory({{ $cat->id }})"
                                class="shrink-0 px-4 py-1.5 rounded-xl text-xs font-medium transition-all duration-200 {{ $categoryId === $cat->id ? 'bg-emerald-600 text-white shadow-md shadow-emerald-600/20' : 'bg-slate-100 text-slate-600 hover:bg-slate-200/70' }}"
                            >
                                {{ $cat->name }}
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Indicator Indicator Loading State -->
            <div wire:loading.flex class="justify-center items-center py-12">
                <div class="inline-flex items-center gap-3 px-5 py-2.5 bg-white rounded-full shadow-lg border border-slate-100 text-emerald-600 text-sm font-medium">
                    <svg class="animate-spin h-5 w-5 text-emerald-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Memuat data artikel...
                </div>
            </div>

            <!-- Grid Cards Container -->
            <div wire:loading.remove class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($posts as $post)
                    <article class="group relative flex flex-col bg-white rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-2xl hover:shadow-emerald-950/5 hover:-translate-y-1.5 transition-all duration-300 overflow-hidden">
                        
                        <!-- Image Container with Industrial Aspect Ratio & Glow Overlay -->
                        <div class="relative aspect-[16/10] w-full overflow-hidden bg-slate-100">
                            <img 
                                src="{{ $post->featured_image_url }}" 
                                alt="{{ $post->title }}" 
                                class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105"
                                loading="lazy"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent opacity-80 group-hover:opacity-60 transition-opacity"></div>
                            
                            <!-- Category Badge -->
                            @if($post->category)
                                <span class="absolute top-4 left-4 bg-white/90 backdrop-blur-md text-emerald-800 text-[11px] font-bold px-3 py-1 rounded-full shadow-md border border-white/50 tracking-wide uppercase">
                                    {{ $post->category->name }}
                                </span>
                            @endif

                            <!-- Date Badge (Bottom Left overlay) -->
                            <div class="absolute bottom-3 left-4 flex items-center gap-1.5 text-xs text-slate-200 font-medium">
                                <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $post->published_at?->translatedFormat('d M Y') ?? 'Draft' }}
                            </div>
                        </div>

                        <!-- Content Body -->
                        <div class="flex flex-col flex-1 p-6">
                            
                            <!-- Title -->
                            <h3 class="text-lg font-bold text-slate-900 group-hover:text-emerald-700 transition-colors duration-200 line-clamp-2 leading-snug mb-3">
                                <a href="{{ route('posts.show', ['slug' => $post->slug]) }}" wire:navigate class="block" wire:navigate>
                                    {{ $post->title }}
                                </a>
                            </h3>

                            <!-- Excerpt -->
                            <p class="text-slate-600 text-sm line-clamp-3 leading-relaxed mb-6 flex-1">
                                {{ $post->excerpt }}
                            </p>

                            <!-- Card Footer -->
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between mt-auto">
                                
                                <!-- Author -->
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold text-xs">
                                        {{ strtoupper(substr($post->author?->name ?? 'A', 0, 1)) }}
                                    </div>
                                    <span class="text-xs font-medium text-slate-500 truncate max-w-[110px]">
                                        {{ $post->author?->name ?? 'Admin Polkam' }}
                                    </span>
                                </div>

                                <!-- Read More CTA Button -->
                                <a href="#" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700 hover:text-emerald-800 transition-colors group/btn">
                                    <span>Baca</span>
                                    <div class="w-6 h-6 rounded-full bg-emerald-50 flex items-center justify-center group-hover/btn:bg-emerald-600 group-hover/btn:text-white transition-all">
                                        <svg class="w-3.5 h-3.5 transition-transform group-hover/btn:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                        </svg>
                                    </div>
                                </a>

                            </div>

                        </div>

                        <!-- Accent Industrial Top Line on Hover -->
                        <div class="absolute top-0 left-0 right-0 h-1 bg-emerald-500 scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>

                    </article>
                @empty
                    <!-- Empty State (Ultra Premium Eco Industrial) -->
                    <div class="col-span-full text-center py-20 bg-white/70 backdrop-blur-sm rounded-3xl border border-dashed border-slate-300 p-8 shadow-sm">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 mb-1">Artikel Tidak Ditemukan</h3>
                        <p class="text-sm text-slate-500 max-w-md mx-auto mb-6">
                            @if(!empty($search))
                                Tidak ada berita atau artikel yang sesuai dengan kata kunci <span class="font-semibold text-slate-700">"{{ $search }}"</span>.
                            @else
                                Belum ada artikel yang dipublikasikan untuk kategori ini.
                            @endif
                        </p>
                        @if(!empty($search))
                            <button 
                                wire:click="clearSearch" 
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-900 text-white text-xs font-semibold hover:bg-emerald-700 transition"
                            >
                                Bersihkan Pencarian
                            </button>
                        @endif
                    </div>
                @endforelse
            </div>

            <!-- Tailwind Pagination Links Feature -->
            @if($posts->hasPages())
                <div class="mt-14 flex justify-center">
                    <div class="bg-white/80 backdrop-blur-md px-4 py-3 rounded-2xl border border-slate-200/80 shadow-md">
                        {{ $posts->links('thema.ecoindustrial.custom-pagination') }}
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>