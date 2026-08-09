@php
    $type = $item['type'] ?? '';
    $data = $item['data'] ?? [];
@endphp

@switch($type)
    @case('badge')
        <div class="mb-3">
            <span class="inline-block px-3 py-1 bg-[#8C1515] text-white text-xs font-bold tracking-widest uppercase shadow-sm">
                {{ $data['text'] ?? '' }}
            </span>
        </div>
    @break

    @case('heading')
        @php
            $level = $data['level'] ?? 'h2';
            $headingClasses =
                [
                    'h1' => 'text-4xl md:text-5xl font-serif font-bold text-gray-900 leading-tight mb-6',
                    'h2' => 'text-3xl md:text-4xl font-serif font-bold text-gray-900 leading-snug mb-4',
                    'h3' => 'text-2xl md:text-3xl font-serif font-semibold text-[#8C1515] mb-4 mt-2',
                    'h4' => 'text-xl md:text-2xl font-serif font-semibold text-gray-800 mb-3',
                    'h5' => 'text-lg font-bold text-gray-900 uppercase tracking-wide mb-2',
                ][$level] ?? 'text-2xl font-serif text-gray-900 mb-4';
        @endphp
        <{{ $level }} class="{{ $headingClasses }}">
            {{ $data['content'] ?? '' }}
            </{{ $level }}>
        @break

        @case('subtitle')
            <p class="text-xl md:text-2xl text-gray-600 font-light leading-relaxed mb-6 border-l-2 border-[#8C1515] pl-4">
                {{ $data['content'] ?? '' }}
            </p>
        @break

        @case('paragraph')
            <p class="text-base text-gray-800 leading-relaxed font-sans mb-6">
                {{ $data['content'] ?? '' }}
            </p>
        @break

        @case('richeditor')
            {{-- Membutuhkan plugin @tailwindcss/typography di tailwind.config.js --}}
            <div
                class="prose prose-lg max-w-none text-gray-800 prose-headings:font-serif prose-a:text-[#8C1515] hover:prose-a:text-red-900 prose-img:shadow-sm mb-8">
                {!! $data['content'] ?? '' !!}
            </div>
        @break

        @case('quote')
            <blockquote class="my-8 bg-stone-50 border-l-4 border-[#8C1515] p-6 shadow-sm">
                <p class="text-2xl font-serif text-gray-800 italic leading-snug">
                    "{{ $data['content'] ?? '' }}"
                </p>
                @if (!empty($data['author']))
                    <footer class="mt-4 flex items-center">
                        <div class="w-8 h-px bg-[#8C1515] mr-3"></div>
                        <span class="text-sm font-bold text-gray-900 uppercase tracking-widest">
                            {{ $data['author'] }}
                        </span>
                    </footer>
                @endif
            </blockquote>
        @break

        @case('image')
            @if (!empty($data['url']))
                <figure class="my-8 relative group">
                    {{-- Gunakan asset('storage/...') jika gambar tersimpan di public disk --}}
                    <img src="{{ asset('storage/' . $data['url']) }}" alt="{{ $data['alt'] ?? 'Image' }}"
                        class="w-full h-auto object-cover border-b-4 border-[#8C1515] shadow-md">
                    {{-- @if (!empty($data['alt']))
                        <figcaption class="text-sm text-gray-500 italic mt-2 text-right">
                            {{ $data['alt'] }}
                        </figcaption>
                    @endif --}}
                </figure>
            @endif
        @break

        @case('button')
            <div class="my-6">
                <a href="{{ $data['url'] ?? '#' }}" target="{{ $data['target'] ?? '_self' }}"
                    class="inline-flex items-center justify-center px-8 py-3 bg-[#8C1515] text-white text-sm font-bold uppercase tracking-wider hover:bg-red-900 transition-colors duration-200 border-2 border-transparent hover:border-red-950 focus:ring-2 focus:ring-offset-2 focus:ring-[#8C1515]">
                    {{ $data['text'] ?? 'Learn More' }}
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        @break

        @case('divider')
            <div class="my-10 flex items-center">
                <div class="h-1 w-16 bg-[#8C1515]"></div>
                <div class="h-px flex-1 bg-gray-300"></div>
            </div>
        @break

        @case('signature')
            <div class="mt-8 mb-6 bg-white p-4 border border-gray-100 shadow-sm max-w-sm">
                <p class="text-xl font-serif font-bold text-gray-900">{{ $data['name'] ?? '' }}</p>
                <p class="text-sm font-sans text-[#8C1515] font-semibold uppercase tracking-wide mt-1">
                    {{ $data['position'] ?? '' }}</p>
            </div>
        @break

        @case('statistic')
            <div class="flex flex-col p-6 bg-white border-t-4 border-[#8C1515] shadow-sm my-6 text-center">
                <span class="text-5xl font-serif font-bold text-[#8C1515] block mb-2">
                    {{ $data['value'] ?? '' }}
                </span>
                <span class="text-sm font-bold text-gray-600 uppercase tracking-widest">
                    {{ $data['label'] ?? '' }}
                </span>
            </div>
        @break

        @case('feature_card')
            <div
                class="bg-stone-50 border border-gray-200 p-6 sm:p-8 hover:bg-white hover:shadow-lg hover:border-[#8C1515] transition-all duration-300 group my-4 flex flex-col h-full">
                @if (!empty($data['icon']))
                    <div
                        class="mb-5 inline-flex p-3 bg-white border border-gray-100 rounded-sm shadow-sm group-hover:bg-[#8C1515] transition-colors duration-300">
                        <img src="{{ asset('storage/' . $data['icon']) }}" alt="Icon"
                            class="w-8 h-8 object-contain transition-all group-hover:brightness-0 group-hover:invert">
                    </div>
                @endif

                <h3 class="text-xl font-serif font-bold text-gray-900 mb-3 group-hover:text-[#8C1515] transition-colors">
                    {{ $data['title'] ?? '' }}
                </h3>

                @if (!empty($data['description']))
                    <p class="text-gray-600 text-sm leading-relaxed">
                        {{ $data['description'] }}
                    </p>
                @endif
            </div>
        @break

        @default
            {{-- Fallback untuk block yang tidak terdaftar --}}
            <!-- Tipe {{ $type }} belum diimplementasikan -->
    @endswitch
