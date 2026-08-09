<div class="grid grid-cols-2 gap-6 rounded-lg border border-gray-300 p-4 bg-white">

    @foreach (['left' => 'Left Column', 'right' => 'Right Column'] as $column => $title)
        <div class="rounded-md border border-dashed border-gray-300 p-4 h-auto">
            <div class="mb-3 text-sm font-semibold text-gray-600">
                {{ $title }}
            </div>

            @forelse($data[$column] ?? [] as $block)
                @switch($block['type'])
                    @case('heading')
                        @php
                            $level = $block['data']['level'] ?? 'h2';
                            $content = $block['data']['content'] ?? '';
                        @endphp

                        <div class="font-bold text-gray-900">
                            {{ strtoupper($level) }} — {{ $content }}
                        </div>
                    @break

                    @case('paragraph')
                        <p class="text-sm text-gray-600 line-clamp-3">
                            {{ $block['data']['content'] ?? '' }}
                        </p>
                    @break

                    @case('image')
                        @if (!empty($block['data']['url']))
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($block['data']['url']) }}"
                                class="rounded w-full h-full object-cover">
                        @endif
                    @break
                    @case('richeditor')
                        <div class="prose prose-sm max-w-none overflow-hidden max-h-48">
                            {!! $block['data']['content'] ?? '' !!}
                            {{-- ini rich editor --}}
                        </div>
                    @break
                @endswitch
                @empty
                    <p class="text-sm text-gray-400">
                        Empty
                    </p>
                @endforelse
            </div>
        @endforeach

    </div>
