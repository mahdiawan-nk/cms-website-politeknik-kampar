@props(['videos'])

<div class="py-10 bg-white transition-colors duration-500">
    <div class="max-w-7xl mx-auto px-4">
        {{-- Header Stanford Style --}}
        <h2 class="text-3xl mb-8 font-serif text-[#8C1515] text-center">
            Galeri Video Kampus
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($videos as $video)
                <div class="overflow-hidden group rounded-2xl shadow-lg hover:shadow-2xl transition-all">
                    {{-- YouTube Embed dengan Lazy Loading --}}
                    <div class="aspect-video w-full">
                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $video['id'] }}"
                            loading="lazy" allowfullscreen></iframe>
                    </div>
                    <div class="p-4 bg-white">
                        <h3 class="font-serif font-bold text-lg text-stone-800">
                            {{ $video['title'] }}
                        </h3>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
