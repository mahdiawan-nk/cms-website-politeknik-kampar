@props(['items', 'theme' => 'stanford', 'level' => 0])

@foreach ($items as $item)
    @php
        $hasChildren = !empty($item['children']);
        $isStanford = $theme === 'stanford';
    @endphp

    <div class="relative group/sub w-full" x-data="{ openSub: false }" @mouseenter="openSub = true"
        @mouseleave="openSub = false">

        <a href="{{ $item['url'] ?? '#' }}" target="{{ !empty($item['newtab']) ? '_blank' : '_self' }}" wire:navigate
            class="group/item flex items-center justify-between px-3.5 py-2.5 text-sm font-medium transition-all duration-200 relative
           @if ($isStanford) text-stone-800 hover:text-[#8C1515] hover:bg-stone-50/80 rounded-sm
               {{ $level === 0 ? 'font-serif tracking-wide' : 'font-sans text-xs uppercase tracking-wider' }}
           @else
               text-stone-800 hover:bg-[#FF851B] hover:text-white rounded-none @endif">

            {{-- Aksen Garis Merah Stanford di Sisi Kiri Saat Hover --}}
            @if ($isStanford)
                <span
                    class="absolute left-0 top-1/2 -translate-y-1/2 w-0.5 h-0 bg-[#8C1515] transition-all duration-200 group-hover/item:h-3/4"></span>
            @endif

            <span
                class="truncate pr-3 @if ($isStanford) transition-transform duration-200 group-hover/item:translate-x-1 @endif">
                {{ $item['label'] }}
            </span>

            @if ($hasChildren)
                <svg class="w-3.5 h-3.5 shrink-0 transition-all duration-200
                    @if ($isStanford) text-stone-400 group-hover/item:text-[#8C1515]
                    @else
                        text-stone-400 group-hover/item:text-white @endif"
                    :class="openSub ? 'rotate-90 md:rotate-0 translate-x-0.5' : ''" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="1.75" d="M9 5l7 7-7 7" />
                </svg>
            @endif
        </a>

        {{-- SUB-MENU DROPDOWN --}}
        @if ($hasChildren)
            <div x-show="openSub" x-cloak x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-x-1 scale-98"
                x-transition:enter-end="opacity-100 translate-x-0 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-x-0 scale-100"
                x-transition:leave-end="opacity-0 translate-x-1 scale-98"
                class="absolute top-0 left-full ml-1.5 min-w-[240px] bg-white z-50 p-1.5
                @if ($isStanford) border-t-2 border-t-[#8C1515] border-x border-b border-stone-200/80 shadow-2xl rounded-b-sm
                @else
                    border-2 border-stone-900 rounded-none shadow-xl @endif"
                style="display: none;">

                <x-menu-tree :items="$item['children']" :theme="$theme" :level="$level + 1" />
            </div>
        @endif
    </div>
@endforeach
