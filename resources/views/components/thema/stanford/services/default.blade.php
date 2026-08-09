@props(['services'])

<div class="w-full py-16 bg-white">
    <div class="max-w-7xl mx-auto">

        {{-- Header Seksi Layanan --}}
        <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between border-b border-stone-200 pb-6">
            <div>
                <p class="font-sans text-sm font-semibold tracking-wider text-[#8C1515]">
                    Layanan Integrasi Digital
                </p>
                <h2 class="mt-2 text-4xl font-serif font-bold tracking-tight text-stone-900">
                    Layanan Kampus
                </h2>
            </div>
        </div>

        {{-- Grid Layanan Modular --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($services as $service)
                <div
                    class="group flex flex-col justify-between border border-stone-100 p-6 rounded-2xl bg-stone-50/50 hover:bg-white hover:shadow-md transition-all duration-300">
                    <div>
                        {{-- Icon & Audience Badge --}}
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="p-3 bg-red-50 text-[#8C1515] rounded-xl group-hover:bg-[#8C1515] group-hover:text-white transition-colors duration-300">
                                {!! $service['icon'] !!}
                            </div>
                            <span
                                class="text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 font-sans bg-stone-200/60 text-stone-600 rounded-full">
                                {{ $service['audience'] }}
                            </span>
                        </div>

                        {{-- Judul Layanan --}}
                        <h3
                            class="text-md font-bold tracking-tight text-stone-900 font-serif group-hover:text-[#8C1515] transition-colors duration-200">
                            {{ $service['title'] }}
                        </h3>

                        {{-- Deskripsi --}}
                        <p class="mt-2 text-sm leading-relaxed text-stone-600 font-sans line-clamp-3">
                            {{ $service['description'] }}
                        </p>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="mt-6 pt-4 border-t border-stone-100">
                        <a href="{{ $service['url'] }}"
                            class="inline-flex items-center w-full justify-between text-xs font-bold tracking-widest uppercase font-sans text-[#8C1515] hover:translate-x-1 transition-all">
                            <span>Akses Layanan</span>
                            <svg class="w-4 h-4 transform transition-transform group-hover:translate-x-1" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>
