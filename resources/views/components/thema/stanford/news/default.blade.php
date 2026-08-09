@props(['newsData'])
<div class="w-full py-12 bg-white transition-colors duration-300">
    <div class="max-w-7xl mx-auto">

        {{-- Bagian Header Sekilas Berita --}}
        <div class="mb-12 lg:mb-16 max-w-2xl">
            <h2 class="text-xs font-bold tracking-widest uppercase mb-3 font-sans text-amber-600">
                News Room
            </h2>
            <h3 class="text-3xl sm:text-4xl tracking-tight font-bold font-serif text-[#8C1515]">
                Berita Terbaru
            </h3>
        </div>

        @php
            $highlight = $newsData[0] ?? null;
            $subList = array_slice($newsData, 1);
        @endphp

        {{-- Grid Utama Asimetris --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- 1 CARD HIGHLIGHT --}}
            @if ($highlight)
                <div
                    class="lg:col-span-2 group flex flex-col justify-between overflow-hidden border border-stone-100 bg-stone-50/60 rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="relative overflow-hidden aspect-video">
                        <img src="{{ $highlight['image'] }}" alt="{{ $highlight['title'] }}"
                            class="w-full h-full object-cover transition-transform duration-700 ease-in-out group-hover:scale-105" />
                        <div class="absolute top-4 left-4">
                            <span
                                class="px-3 py-1 text-xs uppercase tracking-wider text-white bg-[#8C1515] font-sans font-medium rounded-sm">
                                {{ $highlight['category'] }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6 md:p-8 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center space-x-2 mb-3 text-xs font-sans text-stone-500">
                                <span>{{ $highlight['date'] }}</span>
                            </div>
                            <h3
                                class="text-2xl md:text-3xl font-bold tracking-tight leading-tight font-serif text-stone-900 group-hover:text-[#8C1515] transition-colors duration-200">
                                <a href="#">{{ $highlight['title'] }}</a>
                            </h3>
                            <p class="mt-4 text-sm leading-relaxed text-stone-600 font-sans">
                                {{ $highlight['excerpt'] }}
                            </p>
                        </div>

                        <div class="mt-6 pt-6 border-t border-stone-200">
                            <a href="#"
                                class="inline-flex items-center text-sm font-semibold tracking-wider group/btn font-sans text-[#8C1515]">
                                Baca Selengkapnya
                                <span
                                    class="ml-2 transform group-hover/btn:translate-x-1 transition-transform duration-200">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            {{-- 3 CARD BERITA TERBARU --}}
            <div class="space-y-6 flex flex-col justify-between">
                @foreach ($subList as $news)
                    <div
                        class="group flex flex-col sm:flex-row gap-4 p-4 border border-stone-100 bg-white rounded-xl hover:shadow-sm transition-all duration-300">

                        <div
                            class="sm:w-28 sm:h-28 aspect-video sm:aspect-square overflow-hidden flex-shrink-0 rounded-lg">
                            <img src="{{ $news['image'] }}" alt="{{ $news['title'] }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                        </div>

                        <div class="flex flex-col justify-between flex-1">
                            <div>
                                <span class="text-[10px] uppercase font-bold tracking-wider font-sans text-stone-400">
                                    {{ $news['category'] }}
                                </span>
                                <h4
                                    class="mt-1 text-sm font-bold leading-snug line-clamp-2 font-serif text-stone-900 group-hover:text-[#8C1515]">
                                    <a href="#">{{ $news['title'] }}</a>
                                </h4>
                            </div>

                            <div class="mt-2 flex items-center justify-between text-[11px] font-sans text-stone-400">
                                <span>{{ $news['date'] }}</span>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
