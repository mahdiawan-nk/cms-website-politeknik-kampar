@props(['announcements'])

<div class="w-full py-16 bg-stone-50">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            {{-- SEKSI KIRI: PENGUMUMAN --}}
            <div class="lg:col-span-7">
                <div class="mb-6 border-b border-stone-200 pb-4">
                    <h3 class="text-2xl font-bold tracking-tight font-serif text-[#8C1515]">
                        Pengumuman Kampus
                    </h3>
                </div>

                <div class="space-y-4">
                    @foreach ($announcements as $announcement)
                        <div
                            class="p-5 border rounded-xl border-stone-100 bg-white hover:shadow-sm transition-all duration-200">
                            <div class="flex flex-wrap items-center gap-2 mb-2">
                                <span
                                    class="px-2 py-0.5 text-[10px] font-bold tracking-wider font-sans bg-stone-100 text-stone-600 rounded-sm">
                                    {{ $announcement['badge'] }}
                                </span>
                                @if ($announcement['is_important'])
                                    <span
                                        class="px-2 py-0.5 text-[10px] font-bold tracking-wider font-sans bg-red-100 text-red-600 rounded-sm">
                                        PENTING
                                    </span>
                                @endif
                                <span class="text-xs text-stone-400 font-sans ml-auto">
                                    {{ $announcement['date'] }}
                                </span>
                            </div>

                            <h4
                                class="text-base font-bold leading-snug text-stone-800 font-serif hover:text-[#8C1515] transition-colors">
                                <a href="#" class="focus:outline-none">{{ $announcement['title'] }}</a>
                            </h4>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    <a href="#"
                        class="inline-flex items-center text-xs font-bold tracking-widest font-sans text-[#8C1515] hover:text-red-700">
                        Semua Pengumuman Arsip →
                    </a>
                </div>
            </div>

            {{-- SEKSI KANAN: AGENDA KEGIATAN --}}
            <div class="lg:col-span-5">
                <div class="mb-6 border-b border-stone-200 pb-4">
                    <h3 class="text-2xl font-bold tracking-tight font-serif text-[#8C1515]">
                        Agenda Kegiatan
                    </h3>
                </div>

                <div class="space-y-6">
                    @foreach ($events as $event)
                        <div class="flex items-start gap-4 group">
                            {{-- Blok Kalender --}}
                            <div
                                class="flex flex-col items-center justify-center w-16 h-16 flex-shrink-0 border rounded-xl border-stone-200 bg-white group-hover:bg-[#8C1515] group-hover:border-[#8C1515] group-hover:text-white transition-all duration-300">
                                <span class="text-xl font-black tracking-tighter font-sans">
                                    {{ $event['day'] }}
                                </span>
                                <span
                                    class="text-[10px] font-bold tracking-widest font-sans text-stone-500 group-hover:text-red-200">
                                    {{ $event['month'] }}
                                </span>
                            </div>

                            {{-- Detail Konten Agenda --}}
                            <div class="flex flex-col justify-center">
                                <h4
                                    class="text-sm font-bold leading-snug text-stone-900 font-serif group-hover:text-[#8C1515] transition-colors duration-200">
                                    <a href="#">{{ $event['title'] }}</a>
                                </h4>

                                <div class="mt-1 flex items-center gap-3 text-xs text-stone-500 font-sans">
                                    <span class="flex items-center">
                                        {{ $event['time'] }}
                                    </span>
                                    <span class="text-stone-300">|</span>
                                    <span class="flex items-center line-clamp-1">
                                        {{ $event['location'] }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8 pt-6 border-t border-stone-100">
                    <a href="#"
                        class="inline-flex items-center text-xs font-bold tracking-widest font-sans text-[#8C1515]">
                        Buka Kalender Kegiatan Kampus →
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
