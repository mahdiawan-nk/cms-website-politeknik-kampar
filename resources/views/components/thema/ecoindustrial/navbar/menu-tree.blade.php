@props(['items', 'level' => 0])

@foreach ($items as $item)
    @php
        $hasChildren = !empty($item['children']);
    @endphp

    <div class="relative group/sub w-full font-sans" 
         x-data="{ openSub: false }" 
         @mouseenter="openSub = true"
         @mouseleave="openSub = false">

        <!-- Menu Item Link -->
        <a href="{{ $item['url'] ?? '#' }}" 
           target="{{ !empty($item['newtab']) ? '_blank' : '_self' }}" 
           wire:navigate
           class="group/item flex items-center justify-between px-4 py-3 text-[14px] font-bold text-slate-600 rounded-xl transition-all duration-300 relative hover:bg-emerald-50/60 hover:text-[#10B981] overflow-hidden">

            {{-- Hover Highlight Background Sweep (Optional subtelty) --}}
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-100/30 to-transparent opacity-0 group-hover/item:opacity-100 transition-opacity duration-300 pointer-events-none"></div>

            {{-- Aksen Garis Gradien Eco-Industrial di Sisi Kiri Saat Hover --}}
            <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-0 bg-gradient-to-b from-[#10B981] to-[#FF8C00] rounded-r-full transition-all duration-300 ease-out group-hover/item:h-2/3 opacity-0 group-hover/item:opacity-100"></span>

            {{-- Efek geser teks halus saat dihover --}}
            <span class="relative z-10 truncate pr-3 transition-transform duration-300 ease-out group-hover/item:translate-x-1.5">
                {{ $item['label'] }}
            </span>

            @if ($hasChildren)
                {{-- Panah Indikator Sub-menu dengan rotasi halus --}}
                <svg class="relative z-10 w-4 h-4 shrink-0 transition-transform duration-300 ease-out text-slate-400 group-hover/item:text-[#10B981]"
                    :class="openSub ? 'rotate-90 translate-x-0.5 text-[#10B981]' : ''" 
                    fill="none"
                    stroke="currentColor" 
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>
            @endif
        </a>

        {{-- SUB-MENU DROPDOWN REKURSIF (Glassmorphism & Soft Shadow) --}}
        @if ($hasChildren)
            <div x-show="openSub" 
                 x-cloak 
                 x-transition:enter="transition ease-[cubic-bezier(0.2,0.8,0.2,1)] duration-300"
                 x-transition:enter-start="opacity-0 translate-x-4 scale-95"
                 x-transition:enter-end="opacity-100 translate-x-0 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-x-0 scale-100"
                 x-transition:leave-end="opacity-0 translate-x-2 scale-95"
                 class="absolute top-0 left-full ml-1.5 min-w-[260px] bg-white/95 backdrop-blur-xl z-[60] p-2 border border-slate-200/70 shadow-[0_20px_40px_-10px_rgba(16,185,129,0.15)] rounded-2xl ring-1 ring-slate-900/5 origin-top-left"
                 style="display: none;">
                 
                <!-- Panggilan Rekursif Komponen -->
                <x-thema.ecoindustrial.navbar.menu-tree :items="$item['children']" :level="$level + 1" />
            
            </div>
        @endif
    </div>
@endforeach