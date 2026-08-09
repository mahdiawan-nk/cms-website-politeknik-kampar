@props(['items', 'level' => 0])

{{-- Outer Container: Card Glassmorphism Ultra Premium --}}
<div
    class="relative bg-white/95 backdrop-blur-2xl border border-slate-200/80 shadow-[0_30px_70px_-15px_rgba(15,23,42,0.08)] rounded-[2rem] ring-1 ring-slate-900/5 overflow-hidden min-w-[750px] max-w-[950px] font-sans">

    {{-- Top Eco-Industrial Gradient Accent Bar --}}
    <div class="h-1 w-full bg-gradient-to-r from-[#10B981] via-emerald-400 to-[#FF8C00]"></div>

    {{-- Grid Kolom dengan Divider Halus --}}
    <div class="grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-slate-100/80">
        @foreach ($items as $item)
            @php
                $hasChildren = !empty($item['children']);
            @endphp

            {{-- Kolom / Card Terpadu --}}
            <div
                class="group/column p-6 flex flex-col justify-between hover:bg-gradient-to-b hover:from-emerald-50/30 hover:to-transparent transition-all duration-300">

                <div>
                    {{-- Header Kategori / Title Level 1 --}}
                    <div class="flex items-center justify-between pb-1 mb-1 border-b border-slate-100">
                        <a href="{{ $item['url'] ?? '#' }}" target="{{ !empty($item['newtab']) ? '_blank' : '_self' }}"
                            wire:navigate
                            class="font-extrabold text-[15px] text-slate-900 hover:text-[#10B981] transition-colors duration-300 flex items-center gap-2.5 group/head">

                            {{-- Bullet Point Aksen Pulsing Eco-Industrial --}}
                            <span class="relative flex h-2.5 w-2.5 items-center justify-center shrink-0">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#10B981] opacity-30 group-hover/head:opacity-75"></span>
                                <span
                                    class="relative inline-flex rounded-full h-2 w-2 bg-gradient-to-r from-[#10B981] to-[#FF8C00]"></span>
                            </span>

                            <span class="truncate tracking-tight">{{ $item['label'] }}</span>
                        </a>

                        @if (!empty($item['badge']))
                            <span
                                class="text-[10px] font-extrabold px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 ring-1 ring-emerald-500/20 uppercase tracking-widest shrink-0">
                                {{ $item['badge'] }}
                            </span>
                        @endif
                    </div>

                    {{-- Daftar Sub-menu (Level 2) --}}
                    @if ($hasChildren)
                        <ul class="space-y-1.5 mb-6">
                            @foreach ($item['children'] as $child)
                                <li>
                                    <a href="{{ $child['url'] ?? '#' }}"
                                        target="{{ !empty($child['newtab']) ? '_blank' : '_self' }}" wire:navigate
                                        class="group/subitem text-xs font-bold text-slate-600 hover:text-[#10B981] flex items-center justify-between py-2 px-2.5 rounded-xl hover:bg-white/90 hover:shadow-sm transition-all duration-300 relative overflow-hidden">

                                        {{-- Active Line Accent pada Hover --}}
                                        <span
                                            class="absolute left-0 top-1/2 -translate-y-1/2 w-0.5 h-0 bg-[#10B981] rounded-r-full transition-all duration-300 group-hover/subitem:h-1/2"></span>

                                        <span
                                            class="truncate transition-transform duration-300 group-hover/subitem:translate-x-1.5">
                                            {{ $child['label'] }}
                                        </span>

                                        {{-- Icon Panah Slide In --}}
                                        <svg class="w-3.5 h-3.5 opacity-0 -translate-x-2 group-hover/subitem:opacity-100 group-hover/subitem:translate-x-0 transition-all duration-300 text-[#10B981] shrink-0"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @elseif(!empty($item['description']))
                        <p class="text-xs text-slate-500 leading-relaxed font-medium px-1 mb-6">
                            {{ $item['description'] }}
                        </p>
                    @endif
                </div>

                {{-- Action / Read More di Bagian Bawah Kolom --}}
                @if ($item['url'] != '/#' && $item['url'] != '#')
                    <div class="pt-1 ">
                        <a href="{{ $item['url'] ?? '#' }}" wire:navigate
                            class="inline-flex items-center gap-2 text-xs font-extrabold text-[#10B981] hover:text-emerald-700 transition-all duration-300 group/link">
                            <span class="uppercase tracking-wider text-[10px]">Lihat Selengkapnya</span>
                            <div
                                class="p-1 rounded-full bg-emerald-50 text-[#10B981] group-hover/link:bg-[#10B981] group-hover/link:text-white transition-all duration-300">
                                <svg class="w-3 h-3 transform transition-transform duration-300 group-hover/link:translate-x-0.5"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </div>
                        </a>
                    </div>
                @endif


            </div>
        @endforeach
    </div>

</div>
