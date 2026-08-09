@props(['item', 'theme' => 'ecoindustrial'])

@php
    $hasChildren = !empty($item['children']);
@endphp

@if (!$hasChildren)
    <a href="{{ $item['url'] ?? '#' }}" 
       target="{{ !empty($item['newtab']) ? '_blank' : '_self' }}"
       wire:navigate
       class="group/mobile-item flex items-center justify-between px-4 py-3 text-sm font-bold text-slate-700 hover:text-[#10B981] hover:bg-emerald-50/60 rounded-xl transition-all duration-300 relative overflow-hidden">
        
        {{-- Aksen Garis Gradien Eco-Industrial Sisi Kiri --}}
        <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-0 bg-gradient-to-b from-[#10B981] to-[#FF8C00] rounded-r-full transition-all duration-300 group-hover/mobile-item:h-2/3"></span>

        {{-- Label Teks --}}
        <span class="truncate transition-transform duration-300 group-hover/mobile-item:translate-x-1.5">
            {{ $item['label'] }}
        </span>
    </a>
@else
    <div x-data="{ openNested: false }" class="w-full font-sans">
        {{-- Tombol Toggle Sub-menu --}}
        <button @click="openNested = !openNested"
            type="button"
            class="group/mobile-btn w-full flex items-center justify-between px-4 py-3 text-sm font-bold text-slate-700 hover:text-[#10B981] hover:bg-emerald-50/60 rounded-xl transition-all duration-300 relative">
            
            <span class="truncate transition-transform duration-300 group-hover/mobile-btn:translate-x-1.5" 
                  :class="openNested ? 'text-[#10B981]' : ''">
                {{ $item['label'] }}
            </span>

            {{-- Indikator Panah Rotasi Halus --}}
            <svg class="w-4 h-4 text-slate-400 transition-transform duration-300 group-hover/mobile-btn:text-[#10B981]" 
                 :class="openNested ? 'rotate-180 text-[#10B981]' : ''" 
                 fill="none" 
                 stroke="currentColor" 
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        {{-- Wadah Sub-menu Rekursif --}}
        <div x-show="openNested" 
             x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-2 scale-98"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 -translate-y-2 scale-98"
             class="pl-3 ml-3 mt-1 border-l-2 border-emerald-500/20 space-y-1">
            @foreach ($item['children'] as $child)
                @include('components.mobile-menu-item', ['item' => $child, 'theme' => $theme])
            @endforeach
        </div>
    </div>
@endif