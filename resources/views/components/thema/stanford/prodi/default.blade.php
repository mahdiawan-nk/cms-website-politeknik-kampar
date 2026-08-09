@props(['$departments'])

<section class="w-full py-20 px-4 sm:px-6 lg:px-8 bg-stone-50 text-stone-800">
    <div class="max-w-7xl mx-auto">

        <livewire:ui.header-section badge="Program Akademik" title="Pilihan Program Studi"
            description="Mempersiapkan lulusan siap kerja dengan kurikulum berbasis industri terapan dan laboratorium berstandar internasional." />

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach ($departments as $prodi)
                <div
                    class="group relative flex flex-col justify-between p-8 bg-white border border-stone-200 hover:border-stone-300 shadow-sm hover:shadow-md transition-all duration-300 rounded-2xl">
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <span
                                class="text-xs font-sans font-bold px-3 py-1 border border-amber-200 text-amber-700 rounded-lg bg-amber-50/50 tracking-wide">
                                {{ $prodi['code'] }}
                            </span>

                            <div class="text-[#8C1515]">
                                @if ($prodi['icon'] === 'cpu')
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21M6.75 6.75h10.5a2.25 2.25 0 0 1 2.25 2.25v10.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V9a2.25 2.25 0 0 1 2.25-2.25Z" />
                                    </svg>
                                @elseif($prodi['icon'] === 'code')
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" />
                                    </svg>
                                @elseif($prodi['icon'] === 'droplet')
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                @else
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M20.25 14.15v4.25c0 .621-.504 1.125-1.125 1.125H4.875A1.125 1.125 0 0 1 3.75 19.5v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38c-1.87.63-4.102.9-6.177.9-2.074 0-4.307-.27-6.177-.9a3.123 3.123 0 0 1-.673-.38m0 0a2.18 2.18 0 0 1-.75-1.661V8.706c0-1.081.768-2.015 1.837-2.175a48.114 48.114 0 0 1 3.413-.387m11.125 4.158v-4.158m-11 4.158v-4.158m11-4.158c-.18-.011-.36-.024-.54-.037M5.43 6.368c.18-.011.36-.024.54-.037m3.93 0a48.694 48.694 0 0 1 4.2-.1c.53 0 1.062.011 1.592.037m-5.792-.037a48.396 48.396 0 0 1 4.2-.1" />
                                    </svg>
                                @endif
                            </div>
                        </div>

                        <h4
                            class="text-lg font-sans font-bold text-stone-900 mb-2 group-hover:text-[#8C1515] transition-colors">
                            {{ $prodi['title'] }}
                        </h4>

                        <div class="mb-4">
                            <span
                                class="inline-flex items-center text-[10px] font-sans font-bold uppercase bg-stone-100 text-stone-600 px-2 py-0.5 rounded-md">
                                Akreditasi: {{ $prodi['accreditation'] }}
                            </span>
                        </div>

                        <p class="text-xs font-sans leading-relaxed text-stone-500 mb-8">
                            {{ $prodi['desc'] }}
                        </p>
                    </div>

                    <a href="/prodi/{{ $prodi['slug'] }}"
                        class="inline-flex items-center text-xs font-sans font-bold text-[#8C1515] group/link">
                        <span>Selengkapnya</span>
                        <svg class="w-4 h-4 ml-2 transition-transform duration-200 transform group-hover/link:translate-x-1"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
</section>
