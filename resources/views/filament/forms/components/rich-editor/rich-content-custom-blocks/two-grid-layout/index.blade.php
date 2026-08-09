<div class="grid grid-cols-1 md:grid-cols-2 gap-8">

    @foreach (['left', 'right'] as $column)
        <div>

            @foreach ($data[$column] ?? [] as $block)
                @switch($block['type'])
                    @case('heading')
                        @php
                            $level = $block['data']['level'] ?? 'h2';
                            $content = $block['data']['content'] ?? '';
                        @endphp

                        <<?= $level ?>>
                            {{ $content }}
                        </<?= $level ?>>
                    @break

                    @case('paragraph')
                        <p>
                            {!! nl2br(e($block['data']['content'] ?? '')) !!}
                        </p>
                    @break

                    @case('image')
                        @php
                            $url = $block['data']['url'] ?? null;
                            $alt = $block['data']['alt'] ?? '';
                        @endphp

                        @if ($url)
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($url) }}" alt="{{ $alt }}"
                                class="max-w-full h-auto rounded">
                        @endif
                    @break

                    @case('richeditor')
                        <div class="prose prose-sm max-w-none overflow-hidden max-h-48">
                            {!! $block['data']['content'] ?? '' !!}
                            {{-- ini rich editor --}}
                        </div>
                    @break
                @endswitch
            @endforeach

        </div>
    @endforeach

</div>
