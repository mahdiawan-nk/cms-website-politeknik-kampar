@props(['testimonials'])

<div class="w-full py-16 px-4 bg-stone-50 text-stone-800">
    <div class="max-w-7xl mx-auto">

        <div class="mb-12 text-center">
            <span class="text-sm font-semibold text-[#8C1515] uppercase tracking-wider">Kisah Sukses Alumni</span>
            <h2 class="text-4xl font-serif font-normal mt-2 text-stone-900">Apa Kata Mereka Tentang Politeknik Kampar
            </h2>
        </div>

        <div x-data="{
            active: 0,
            loop() {
                this.active = (this.active + 1) % {{ count($testimonials) }};
            },
            interval: null,
            start() {
                this.interval = setInterval(() => { this.loop() }, 4000);
            },
            stop() {
                clearInterval(this.interval);
            }
        }" x-init="start()" @mouseenter="stop()" @mouseleave="start()"
            class="relative overflow-hidden">

            <div class="relative flex transition-transform duration-700 ease-in-out"
                :style="'transform: translateX(-' + (active * 100) + '%)'">

                @foreach ($testimonials as $index => $item)
                    <div class="w-full flex-shrink-0 px-2">
                        <div
                            class="w-full max-w-4xl mx-auto bg-white shadow-md hover:shadow-lg rounded-2xl p-10 transition-shadow duration-300 border border-stone-100">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 items-center">

                                <div class="flex flex-col items-center md:items-start text-center md:text-left">
                                    <div class="relative group">
                                        <img src="{{ $item['avatar'] }}" alt="{{ $item['name'] }}"
                                            class="object-cover w-24 h-24 rounded-full border-4 border-stone-100 duration-500 transform group-hover:scale-105 transition-all">
                                    </div>
                                    <h4 class="mt-4 font-bold text-lg font-serif text-stone-900">
                                        {{ $item['name'] }}
                                    </h4>
                                    <p class="text-xs mt-1 text-stone-500">
                                        {{ $item['major'] }} ({{ $item['graduation_year'] }})
                                    </p>
                                </div>

                                <div class="md:col-span-3 relative md:pl-4">
                                    <span
                                        class="absolute -top-6 -left-2 text-6xl select-none opacity-20 font-serif text-[#8C1515]">“</span>
                                    <blockquote
                                        class="relative z-10 text-lg leading-relaxed italic font-serif text-stone-700">
                                        &ldquo;{{ $item['quote'] }}&rdquo;
                                    </blockquote>
                                    <div class="mt-4 flex items-center justify-between">
                                        <div
                                            class="text-xs uppercase tracking-wider font-sans font-medium text-stone-400">
                                            Bekerja di: <span
                                                class="text-[#8C1515] font-semibold">{{ $item['company'] }}</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-center space-x-2 mt-8">
                @foreach ($testimonials as $index => $item)
                    <button @click="active = {{ $index }}" class="h-2 transition-all duration-300 rounded-full"
                        :class="active === {{ $index }} ? 'w-8 bg-[#8C1515]' : 'w-2 bg-stone-300'"
                        aria-label="Go to slide {{ $index + 1 }}">
                    </button>
                @endforeach
            </div>

        </div>
    </div>
</div>
