@php
    $type = $item['type'] ?? '';
    $data = $item['data'] ?? [];
@endphp

@switch($type)
    @case('badge')
        <div class="mb-4">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-emerald-50/80 backdrop-blur-sm text-emerald-700 text-[10px] font-extrabold tracking-widest uppercase rounded-full ring-1 ring-emerald-500/20 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-[#FF8C00]"></span>
                {{ $data['text'] ?? '' }}
            </span>
        </div>
    @break

    @case('heading')
        @php
            $level = $data['level'] ?? 'h2';
            $headingClasses =
                [
                    'h1' => 'text-4xl md:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.15] mb-6',
                    'h2' => 'text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight leading-snug mb-5',
                    'h3' => 'text-2xl md:text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-[#10B981] to-[#FF8C00] mb-4 mt-2',
                    'h4' => 'text-xl md:text-2xl font-bold text-slate-800 tracking-tight mb-3',
                    'h5' => 'text-sm font-extrabold text-slate-500 uppercase tracking-widest mb-2',
                ][$level] ?? 'text-2xl font-bold text-slate-900 mb-4';
        @endphp
        <{{ $level }} class="{{ $headingClasses }}">
            {{ $data['content'] ?? '' }}
        </{{ $level }}>
    @break

    @case('subtitle')
        <div class="relative mb-8 p-1">
            <div class="absolute inset-y-0 left-0 w-1.5 bg-gradient-to-b from-[#10B981] to-[#FF8C00] rounded-full"></div>
            <p class="text-lg md:text-xl text-slate-600 font-medium leading-relaxed pl-6 py-2 bg-gradient-to-r from-emerald-50/50 to-transparent rounded-r-2xl">
                {{ $data['content'] ?? '' }}
            </p>
        </div>
    @break

    @case('paragraph')
        <p class="text-base md:text-lg text-slate-600 leading-relaxed font-medium mb-6">
            {{ $data['content'] ?? '' }}
        </p>
    @break

    @case('richeditor')
        <div class="prose prose-lg max-w-none text-slate-600 prose-headings:font-extrabold prose-headings:tracking-tight prose-headings:text-slate-900 prose-a:text-[#10B981] prose-a:font-semibold hover:prose-a:text-emerald-700 prose-img:rounded-[2rem] prose-img:shadow-xl prose-img:ring-1 prose-img:ring-slate-900/5 mb-10 selection:bg-emerald-100 selection:text-emerald-900">
            {!! $data['content'] ?? '' !!}
        </div>
    @break

    @case('quote')
        <blockquote class="relative my-10 bg-white/60 backdrop-blur-md border border-slate-200/80 rounded-[2rem] p-8 md:p-10 shadow-sm overflow-hidden group hover:border-emerald-300 transition-colors duration-500">
            <!-- Decorative Large Quote Icon -->
            <div class="absolute -top-4 -right-2 text-[120px] leading-none text-slate-100 font-serif opacity-50 pointer-events-none group-hover:text-emerald-50 transition-colors duration-500">
                "
            </div>
            
            <p class="relative z-10 text-xl md:text-2xl font-medium text-slate-800 italic leading-snug">
                "{{ $data['content'] ?? '' }}"
            </p>
            
            @if (!empty($data['author']))
                <footer class="relative z-10 mt-6 flex items-center gap-4">
                    <div class="w-10 h-1 bg-gradient-to-r from-[#10B981] to-[#FF8C00] rounded-full"></div>
                    <span class="text-sm font-extrabold text-slate-900 uppercase tracking-widest">
                        {{ $data['author'] }}
                    </span>
                </footer>
            @endif
        </blockquote>
    @break

    @case('image')
        @if (!empty($data['url']))
            <figure class="my-10 relative group rounded-[2rem] overflow-hidden bg-slate-100 ring-1 ring-slate-900/5 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                <!-- Inner Shadow for Premium Framing -->
                <div class="absolute inset-0 border-[3px] border-black/5 pointer-events-none z-20 rounded-[2rem]"></div>
                
                <img src="{{ asset('storage/' . $data['url']) }}" alt="{{ $data['alt'] ?? 'Image' }}"
                    class="w-full h-auto object-cover transform transition-transform duration-700 ease-out group-hover:scale-[1.03]">
            </figure>
        @endif
    @break

    @case('button')
        <div class="my-8">
            <a href="{{ $data['url'] ?? '#' }}" target="{{ $data['target'] ?? '_self' }}"
                class="group relative inline-flex items-center justify-center px-8 py-3.5 bg-slate-900 text-white text-sm font-bold uppercase tracking-wider rounded-full overflow-hidden shadow-[0_10px_20px_-10px_rgba(0,0,0,0.3)] hover:shadow-[0_15px_30px_-10px_rgba(16,185,129,0.3)] transition-all duration-300 hover:-translate-y-1">
                
                <!-- Hover Gradient Effect inside button -->
                <div class="absolute inset-0 bg-gradient-to-r from-[#10B981] to-[#FF8C00] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                
                <span class="relative z-10 flex items-center">
                    {{ $data['text'] ?? 'Pelajari Lebih Lanjut' }}
                    <svg class="w-4 h-4 ml-2 transform transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </span>
            </a>
        </div>
    @break

    @case('divider')
        <div class="my-12 flex items-center justify-center relative py-4">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-slate-200/80"></div>
            </div>
            <div class="relative flex justify-center gap-2 bg-[#F8FAFC] px-4">
                <span class="w-2 h-2 rounded-full bg-[#10B981]"></span>
                <span class="w-2 h-2 rounded-full bg-slate-300"></span>
                <span class="w-2 h-2 rounded-full bg-[#FF8C00]"></span>
            </div>
        </div>
    @break

    @case('signature')
        <div class="mt-10 mb-8 max-w-sm bg-white/80 backdrop-blur-md border border-slate-200/80 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow">
            <p class="text-xl font-extrabold text-slate-900 tracking-tight">{{ $data['name'] ?? '' }}</p>
            <div class="mt-2 flex items-center gap-2">
                <span class="w-4 h-0.5 bg-[#10B981] rounded-full"></span>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">
                    {{ $data['position'] ?? '' }}
                </p>
            </div>
        </div>
    @break

    @case('statistic')
        <div class="relative flex flex-col p-8 bg-white border border-slate-200/80 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] my-6 text-center group hover:-translate-y-1 hover:shadow-xl transition-all duration-500 overflow-hidden">
            <!-- Background Glow -->
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-emerald-400/10 rounded-full blur-2xl group-hover:bg-emerald-400/20 transition-colors duration-500 pointer-events-none"></div>
            
            <span class="text-5xl md:text-6xl font-extrabold text-transparent bg-clip-text bg-gradient-to-br from-slate-800 to-slate-500 group-hover:from-[#10B981] group-hover:to-[#FF8C00] block mb-3 transition-colors duration-500">
                {{ $data['value'] ?? '' }}
            </span>
            <span class="text-xs md:text-sm font-bold text-slate-400 uppercase tracking-widest">
                {{ $data['label'] ?? '' }}
            </span>
        </div>
    @break

    @case('feature_card')
        <div class="group relative bg-white/60 backdrop-blur-md border border-slate-200/80 rounded-[2rem] p-8 shadow-sm hover:shadow-[0_20px_40px_-15px_rgba(16,185,129,0.2)] hover:border-emerald-300 transition-all duration-500 ease-out my-4 flex flex-col h-full hover:-translate-y-2">
            
            <!-- Hover Gradient Border -->
            <div class="absolute inset-0 rounded-[2rem] bg-gradient-to-br from-[#10B981] to-[#FF8C00] opacity-0 group-hover:opacity-5 transition-opacity duration-500 pointer-events-none"></div>

            @if (!empty($data['icon']))
                <div class="mb-6 inline-flex p-3.5 bg-slate-50 border border-slate-100 rounded-2xl shadow-sm group-hover:bg-[#10B981] transition-colors duration-500 w-fit">
                    <img src="{{ asset('storage/' . $data['icon']) }}" alt="Icon"
                        class="w-8 h-8 object-contain transition-all duration-500 group-hover:brightness-0 group-hover:invert">
                </div>
            @endif

            <h3 class="text-xl md:text-2xl font-extrabold text-slate-900 mb-3 group-hover:text-[#10B981] transition-colors duration-300 tracking-tight">
                {{ $data['title'] ?? '' }}
            </h3>

            @if (!empty($data['description']))
                <p class="text-slate-500 text-sm md:text-base font-medium leading-relaxed">
                    {{ $data['description'] }}
                </p>
            @endif
        </div>
    @break

    @default
        <!-- Tipe {{ $type }} belum diimplementasikan -->
@endswitch