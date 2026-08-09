@props(['sambutan'])

<section class="w-full py-20 px-4 sm:px-6 lg:px-8 bg-stone-50 text-stone-800">

    <div class="max-w-7xl mx-auto">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

            <div class="lg:col-span-4 flex justify-center">
                <div class="relative w-full max-w-[340px] aspect-[4/5] group">
                    <div
                        class="absolute inset-0 transform translate-x-4 translate-y-4 transition-transform duration-300 group-hover:translate-x-2 group-hover:translate-y-2 bg-[#8C1515]/10 border-2 border-[#8C1515]">
                    </div>

                    <div class="relative w-full h-full overflow-hidden shadow-2xl bg-stone-300 rounded-2xl">
                        <img src="{{ $sambutan['foto'] }}" alt="{{ $sambutan['nama'] }}"
                            class="w-full h-full object-cover object-top transition-all duration-500 group-hover:scale-105">

                        <div class="absolute bottom-4 left-4 right-4 text-white lg:hidden">
                            <h4 class="font-bold text-lg leading-tight">{{ $sambutan['nama'] }}</h4>
                            <p class="text-xs text-white/80 mt-0.5">{{ $sambutan['jabatan'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8 flex flex-col justify-center">
                <span class="text-xs font-bold tracking-[0.2em] uppercase mb-3 block text-[#8C1515] font-sans">
                    Sekilas Profil & Sambutan
                </span>

                <h2 class="text-3xl sm:text-4xl font-serif text-[#8C1515] tracking-tight mb-8 leading-tight">
                    Membangun Masa Depan <br class="hidden sm:inline">Lewat <span
                        class="underline decoration-wavy decoration-1 text-amber-500 decoration-amber-500">Teknologi
                        Terapan</span>
                </h2>

                <div class="relative pl-8 border-l-4 border-[#8C1515] my-4">
                    <span
                        class="absolute -top-6 left-2 text-7xl font-serif select-none pointer-events-none opacity-10 text-[#8C1515]">“</span>
                    <p class="text-base sm:text-lg leading-relaxed italic font-light text-stone-700">
                        {{ $sambutan['kutipan'] }}
                    </p>
                </div>

                <p class="mt-4 text-sm sm:text-base font-medium text-stone-600 font-sans">
                    {{ $sambutan['salam_penutup'] }}
                </p>

                <div class="hidden lg:flex flex-col mt-8 border-t border-stone-200 pt-6">
                    <h4 class="text-lg font-bold tracking-wide text-stone-900 font-serif">
                        {{ $sambutan['nama'] }}
                    </h4>
                    <p class="text-xs uppercase tracking-wider mt-1 font-semibold text-stone-500">
                        {{ $sambutan['jabatan'] }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
