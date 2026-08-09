<?php

use Livewire\Component;
use App\Models\Achivement;
use App\Models\AchivementStat;

new class extends Component {
    public function with()
    {
        return [
            'stats' => AchivementStat::all(),
            'achievements' => Achivement::latest()->featured()->take(4)->get(),
        ];
    }
};
?>

<section class="relative w-full py-16 lg:py-24 bg-[#F8FAFC] overflow-hidden font-sans text-slate-900">
    <!-- Top Accent Strip -->
    <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#10B981] via-emerald-400 to-[#FF8C00]"></div>

    <!-- Industrial Blueprint Grid -->
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#00000005_1px,transparent_1px),linear-gradient(to_bottom,#00000005_1px,transparent_1px)] bg-[size:32px_32px] pointer-events-none"></div>

    <!-- Ambient Glows -->
    <div class="absolute top-1/3 left-1/4 -translate-y-1/2 w-96 h-96 bg-emerald-400/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-amber-400/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <x-thema.ecoindustrial.header-section :header="[
            'badge' => __('frontend.header_achievement.badge'),
            'title' => __('frontend.header_achievement.title'),
            'title_higlight' => __('frontend.header_achievement.title_highlight'),
            'description' => __('frontend.header_achievement.description'),
        ]" layout="grid" />

        <!-- UNIFIED BENTO GRID CONTAINER -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 auto-rows-[minmax(180px,auto)]">

            <!-- BENTO BLOCK 1: Quick Stats Cluster (Top Row Bento) -->
            @foreach ($stats as $stat)
                @php
                    $themeValue = is_object($stat->color_theme) ? $stat->color_theme->value : $stat->color_theme;
                    $isOrange = in_array(strtolower((string)$themeValue), ['orange', 'warning', 'amber', 'secondary']);

                    $accentBg = $isOrange ? 'bg-[#FF8C00]' : 'bg-[#10B981]';
                    $textColor = $isOrange ? 'text-[#FF8C00]' : 'text-[#10B981]';
                    $shadowHover = $isOrange ? 'hover:shadow-amber-500/10 hover:border-[#FF8C00]/30' : 'hover:shadow-emerald-500/10 hover:border-[#10B981]/30';
                @endphp

                <div class="group relative bg-white/80 backdrop-blur-md rounded-3xl border border-slate-200/80 p-6 shadow-sm hover:shadow-xl {{ $shadowHover }} transition-all duration-300 overflow-hidden flex flex-col justify-between">
                    <div class="absolute top-0 left-0 w-1.5 h-full {{ $accentBg }}"></div>
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-mono font-bold text-slate-400 uppercase tracking-widest">STAT // 0{{ $loop->iteration }}</span>
                        <div class="w-2 h-2 rounded-full {{ $accentBg }} opacity-60 group-hover:scale-150 transition-transform"></div>
                    </div>
                    <div class="my-auto py-2">
                        <span class="block text-3xl sm:text-4xl font-black text-slate-900 font-mono tracking-tight">
                            {{ number_format($stat->value) }}<span class="{{ $textColor }}">{{ $stat->suffix }}</span>
                        </span>
                        <span class="text-xs font-mono font-semibold text-slate-500 uppercase tracking-wider mt-1 block">
                            {{ $stat->label }}
                        </span>
                    </div>
                </div>
            @endforeach

            <!-- BENTO BLOCK 2: Dynamic Achievement Cards Grid -->
            @forelse($achievements as $item)
                @php
                    $levelVal = is_object($item->level) ? $item->level->value : $item->level ?? '';
                    $isInternational = str_contains(strtolower((string) $levelVal), 'international') || str_contains(strtolower((string) $levelVal), 'internasional');

                    $badgeBg = $isInternational ? 'bg-[#10B981]' : 'bg-[#FF8C00]';
                    $accentText = $isInternational ? 'text-[#10B981]' : 'text-[#FF8C00]';
                    $hoverAccentText = $isInternational ? 'group-hover:text-[#10B981]' : 'group-hover:text-[#FF8C00]';
                    $hoverBorder = $isInternational ? 'hover:border-[#10B981]/40' : 'hover:border-[#FF8C00]/40';
                    $shadowHover = $isInternational ? 'hover:shadow-emerald-500/10' : 'hover:shadow-amber-500/10';

                    // Bento Grid Layout Assignment
                    $isHero = $loop->first; // Item 1: Large Featured Card (Spans 2 columns & 2 rows)
                    $isWide = $loop->iteration == 2; // Item 2: Horizontal Card (Spans 2 columns)
                @endphp

                @if($isHero)
                    <!-- HERO BENTO CARD (2x2 Grid Span) -->
                    <div class="group relative md:col-span-2 lg:col-span-2 lg:row-span-2 bg-white/90 backdrop-blur-md rounded-3xl border border-slate-200/80 {{ $hoverBorder }} shadow-sm hover:shadow-2xl {{ $shadowHover }} transition-all duration-300 overflow-hidden flex flex-col justify-between">
                        <!-- Hero Background Image -->
                        <div class="relative w-full h-56 sm:h-64 lg:h-72 overflow-hidden bg-slate-900">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out opacity-90 group-hover:opacity-100"
                                src="{{ $item->image_url }}" alt="{{ $item->title }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/30 to-transparent"></div>

                            <!-- Level Badge -->
                            @if ($item->level)
                                <span class="absolute top-4 right-4 inline-flex items-center gap-1.5 px-3 py-1.5 {{ $badgeBg }} text-white rounded-full text-xs font-bold font-mono tracking-wider uppercase shadow-lg backdrop-blur-md">
                                    <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                                    {{ is_object($item->level) && method_exists($item->level, 'label') ? $item->level->label() : $item->level->value ?? $item->level }}
                                </span>
                            @endif

                            <span class="absolute top-4 left-4 inline-flex items-center gap-1 px-3 py-1 bg-slate-900/80 backdrop-blur-md border border-white/20 text-white rounded-full text-[10px] font-mono tracking-widest uppercase">
                                ★ UTAMA
                            </span>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 sm:p-8 flex-1 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-2 mb-3 font-mono text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    <span>{{ $item->category }}</span>
                                    <span class="text-slate-300">•</span>
                                    <span class="{{ $accentText }} font-bold">{{ $item->year }}</span>
                                </div>

                                <h3 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight leading-snug {{ $hoverAccentText }} transition-colors line-clamp-2">
                                    {{ $item->title }}
                                </h3>

                                <p class="mt-3 text-sm text-slate-600 leading-relaxed line-clamp-3">
                                    {{ $item->description }}
                                </p>
                            </div>

                            <div class="mt-8 pt-4 border-t border-slate-100 flex items-center justify-between text-xs sm:text-sm">
                                <span class="font-mono text-slate-500 font-medium truncate max-w-[60%]" title="{{ $item->organizer }}">
                                    {{ $item->organizer }}
                                </span>

                                <a href=""
                                    class="font-mono font-bold inline-flex items-center gap-1.5 {{ $accentText }} hover:opacity-80 transition-opacity group/link">
                                    <span>LIHAT DETAIL</span>
                                    <svg class="w-4 h-4 transition-transform duration-200 group-hover/link:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                @elseif($isWide)
                    <!-- WIDE BENTO CARD (2 Columns Span) -->
                    <div class="group relative md:col-span-2 lg:col-span-2 bg-white/90 backdrop-blur-md rounded-3xl border border-slate-200/80 {{ $hoverBorder }} p-6 sm:p-7 shadow-sm hover:shadow-xl {{ $shadowHover }} transition-all duration-300 overflow-hidden flex flex-col sm:flex-row gap-6 justify-between items-center">
                        <div class="relative w-full sm:w-48 sm:shrink-0 aspect-[16/10] sm:aspect-square rounded-2xl overflow-hidden bg-slate-100">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                                src="{{ $item->image_url }}" alt="{{ $item->title }}">
                            @if ($item->level)
                                <span class="absolute top-2.5 left-2.5 inline-flex items-center gap-1 px-2.5 py-0.5 {{ $badgeBg }} text-white rounded-full text-[10px] font-bold font-mono tracking-wider uppercase shadow-md">
                                    {{ is_object($item->level) && method_exists($item->level, 'label') ? $item->level->label() : $item->level->value ?? $item->level }}
                                </span>
                            @endif
                        </div>

                        <div class="flex-1 flex flex-col justify-between w-full h-full">
                            <div>
                                <div class="flex items-center gap-2 mb-2 font-mono text-[11px] font-semibold uppercase tracking-wider text-slate-500">
                                    <span>{{ $item->category }}</span>
                                    <span class="text-slate-300">•</span>
                                    <span class="{{ $accentText }}">{{ $item->year }}</span>
                                </div>

                                <h3 class="text-lg sm:text-xl font-bold text-slate-900 tracking-tight leading-snug {{ $hoverAccentText }} transition-colors line-clamp-2">
                                    {{ $item->title }}
                                </h3>

                                <p class="mt-2 text-xs sm:text-sm text-slate-600 leading-relaxed line-clamp-2">
                                    {{ $item->description }}
                                </p>
                            </div>

                            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                                <span class="font-mono text-slate-500 truncate max-w-[55%]" title="{{ $item->organizer }}">
                                    {{ $item->organizer }}
                                </span>

                                <a href=""
                                    class="font-mono font-bold inline-flex items-center gap-1 {{ $accentText }} hover:opacity-80 transition-opacity group/link">
                                    <span>DETAIL</span>
                                    <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover/link:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                @else
                    <!-- STANDARD COMPACT BENTO CARD (1 Column Span) -->
                    <div class="group relative md:col-span-1 lg:col-span-1 bg-white/80 backdrop-blur-md rounded-3xl border border-slate-200/80 {{ $hoverBorder }} p-5 sm:p-6 shadow-sm hover:shadow-xl {{ $shadowHover }} transition-all duration-300 overflow-hidden flex flex-col justify-between">
                        <div>
                            <div class="relative overflow-hidden rounded-2xl aspect-[16/10] mb-4 bg-slate-100">
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                                    src="{{ $item->image_url }}" alt="{{ $item->title }}">

                                @if ($item->level)
                                    <span class="absolute top-2.5 right-2.5 inline-flex items-center gap-1 px-2.5 py-0.5 {{ $badgeBg }} text-white rounded-full text-[9px] font-bold font-mono tracking-wider uppercase shadow-md">
                                        {{ is_object($item->level) && method_exists($item->level, 'label') ? $item->level->label() : $item->level->value ?? $item->level }}
                                    </span>
                                @endif
                            </div>

                            <div class="flex items-center gap-1.5 mb-2 font-mono text-[10px] font-semibold uppercase tracking-wider text-slate-500">
                                <span class="truncate max-w-[100px]">{{ $item->category }}</span>
                                <span class="text-slate-300">•</span>
                                <span class="{{ $accentText }}">{{ $item->year }}</span>
                            </div>

                            <h3 class="text-base font-bold text-slate-900 tracking-tight leading-snug {{ $hoverAccentText }} transition-colors line-clamp-2">
                                {{ $item->title }}
                            </h3>

                            <p class="mt-2 text-xs text-slate-600 leading-relaxed line-clamp-2">
                                {{ $item->description }}
                            </p>
                        </div>

                        <div class="mt-5 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                            <span class="font-mono text-slate-400 text-[11px] truncate max-w-[50%]" title="{{ $item->organizer }}">
                                {{ $item->organizer }}
                            </span>

                            <a href=""
                                class="font-mono font-bold text-[11px] inline-flex items-center gap-1 {{ $accentText }} hover:opacity-80 transition-opacity group/link">
                                <span>DETAIL</span>
                                <svg class="w-3 h-3 transition-transform duration-200 group-hover/link:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endif
            @empty
                <div class="col-span-full py-16 text-center text-slate-500 font-mono text-sm bg-white/40 rounded-3xl border border-dashed border-slate-300">
                    Belum ada data prestasi yang tersedia.
                </div>
            @endforelse

        </div>
    </div>
</section>