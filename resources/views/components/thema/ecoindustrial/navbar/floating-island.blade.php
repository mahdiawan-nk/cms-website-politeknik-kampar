@props(['menus', 'siteSetting'])
<div x-data="{ mobileOpen: false, activeDropdown: null, isScrolled: false }" @scroll.window="isScrolled = (window.pageYOffset > 20)"
    class="fixed top-0 inset-x-0 z-50 pt-4 px-4 sm:px-6 lg:px-8 font-sans text-[#111827] pointer-events-none">

    <!-- Container Floating: Selalu melayang, memiliki border-radius, dan efek glassmorphism -->
    <div
        class="pointer-events-auto w-full sm:max-w-7xl lg:container mx-auto bg-white/95 backdrop-blur-md shadow-[0_8px_30px_rgb(0,0,0,0.12)] border border-gray-100 rounded-2xl transition-all duration-300">

        <!-- Top Bar: Berada di dalam container membulat. Menyusut & hilang saat di-scroll untuk menghemat ruang -->
        @if ($siteSetting->is_topbar_active)
            <div class="hidden md:block w-full text-[12px] font-medium tracking-wide bg-[#047857] text-white transition-all duration-500 ease-in-out origin-top rounded-t-2xl"
                :class="isScrolled ? 'max-h-0 opacity-0' : 'max-h-12 opacity-100'">
                <div class="h-10 flex items-center justify-between px-5 xl:px-8">
                    <!-- Kiri: Info Kontak -->
                    <div class="flex items-center gap-6">
                        <a href="tel:+6281234567890"
                            class="flex items-center gap-2 hover:text-[#FF8C00] transition-colors duration-200">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                            {{ $siteSetting->phone }}
                        </a>
                        <a href="mailto:info@polkam.ac.id"
                            class="flex items-center gap-2 hover:text-[#FF8C00] transition-colors duration-200">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            {{ $siteSetting->email }}
                        </a>
                    </div>

                    <!-- Kanan: Sosial Media -->
                    <div class="flex items-center gap-4">
                        <span class="opacity-80">Ikuti Kami:</span>
                        <span class="text-white/20">|</span>
                        <div class="flex items-center gap-3">
                            <!-- Instagram -->
                            @php
                                $platforms = [
                                    'instagram' =>
                                        '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5" stroke-width="2"></rect><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" stroke-width="2"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5" stroke-width="2" stroke-linecap="round"></line></svg>',
                                    'facebook' =>
                                        '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>',
                                    'x' =>
                                        '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>',
                                    'youtube' =>
                                        '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M22.54 6.42a2.78 2.78 0 00-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 00-1.94 2A29 29 0 001 11.75a29 29 0 00.46 5.33 2.78 2.78 0 001.94 2c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 001.94-2 29 29 0 00.46-5.33 29 29 0 00-.46-5.33z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></polygon></svg>',
                                    'tiktok' =>
                                        '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>',
                                    'linkedin' =>
                                        '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><rect x="2" y="9" width="4" height="12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></rect><circle cx="4" cy="4" r="2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></circle></svg>',
                                ];
                            @endphp
                            @foreach ($siteSetting->social_links as $social)
                                <a href="{{ $social['url'] }}" target="_blank"
                                    class="hover:text-[#FF8C00] transition-colors duration-200" title="Instagram">
                                    {!! $platforms[$social['platform']] !!}
                                </a>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Header -->
        <header class="w-full px-5 xl:px-8">
            <div class="flex justify-between items-center transition-all duration-500 h-20 ease-in-out"
                :class="isScrolled ? 'h-16' : 'h-20'">

                <!-- Logo & Title -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center gap-3 group">
                        <div class="transition-transform duration-300 group-hover:scale-105">
                            <img src="{{ asset('storage/' . $siteSetting->logo_light) }}" alt="Logo Polkam"
                                class="object-contain drop-shadow-sm transition-all duration-500 w-12 h-12"
                                :class="isScrolled ? 'w-10 h-10' : 'w-12 h-12'">
                        </div>

                        <div class="flex flex-col border-l-2 border-[#10B981] pl-3 transition-all duration-500">
                            @php
                                $siteName = trim($siteSetting->site_name ?? 'POLITEKNIK KAMPAR');
                                $hasSpace = str_contains($siteName, ' ');

                                // Memisahkan kata utama dan kata terakhir
                                $firstPart = $hasSpace
                                    ? \Illuminate\Support\Str::beforeLast($siteName, ' ')
                                    : $siteName;
                                $highlightPart = $hasSpace ? \Illuminate\Support\Str::afterLast($siteName, ' ') : '';
                            @endphp

                            <span
                                class="font-sans font-bold tracking-tight text-[#111827] leading-none transition-all duration-500"
                                :class="isScrolled ? 'text-[16px]' : 'text-[18px] sm:text-[20px]'">
                                {{ $firstPart }}
                                @if ($highlightPart)
                                    <span class="text-[#FF8C00]">{{ $highlightPart }}</span>
                                @endif
                            </span>

                            <span
                                class="font-sans font-bold tracking-[0.2em] text-[#047857] uppercase mt-1 transition-all duration-500"
                                :class="isScrolled ? 'text-[7px] sm:text-[8px]' : 'text-[8px] sm:text-[9px]'">
                                {{ $siteSetting->site_tagline }}
                            </span>
                        </div>
                    </a>
                </div>

                <!-- RIGHT SECTION: Nav + Lang Switcher + Mobile Toggle -->
                <div class="flex items-center gap-2 sm:gap-4 lg:gap-5">

                    <!-- Desktop Navigation -->
                    <nav class="hidden lg:flex items-center space-x-1">
                        @foreach ($menus as $index => $menu)
                            @if (empty($menu['children']))
                                <a href="{{ $menu['url'] }}" target="{{ $menu['newtab'] ? '_blank' : '' }}"
                                    wire:navigate
                                    class="px-4 py-2 text-[14px] font-semibold rounded-lg transition-all duration-200 text-[#111827] hover:bg-gray-100 hover:text-[#047857]">
                                    {{ $menu['label'] }}
                                </a>
                            @else
                                <div class="relative" @mouseenter="activeDropdown = {{ $index }}"
                                    @mouseleave="activeDropdown = null">
                                    <button
                                        class="flex items-center gap-1.5 px-4 py-2 text-[14px] font-semibold rounded-lg transition-all duration-200"
                                        :class="activeDropdown === {{ $index }} ? 'bg-gray-100 text-[#047857]' :
                                            'text-[#111827] hover:bg-gray-100 hover:text-[#047857]'">
                                        <span>{{ $menu['label'] }}</span>
                                        <svg class="w-3.5 h-3.5 transition-transform duration-200"
                                            :class="activeDropdown === {{ $index }} ? 'rotate-180 text-[#047857]' :
                                                'text-gray-400'"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>

                                    <!-- Dropdown Sub-menu -->
                                    <div x-show="activeDropdown === {{ $index }}" x-cloak
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 scale-95 -translate-y-2 -translate-x-1/2"
                                        x-transition:enter-end="opacity-100 scale-100 translate-y-0 -translate-x-1/2"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100 scale-100 translate-y-0 -translate-x-1/2"
                                        x-transition:leave-end="opacity-0 scale-95 -translate-y-2 -translate-x-1/2"
                                        class="absolute left-1/2 -translate-x-1/2 top-full mt-2 w-auto bg-white/95 backdrop-blur-md border border-gray-100 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] rounded-[2rem] z-50">

                                        <x-thema.ecoindustrial.navbar.mega-menu :items="$menu['children']" />
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </nav>

                    <!-- Pendaftaran / CTA Button -->
                    <a href="https://pmb.poltek-kampar.ac.id" target="_blank"
                        class="hidden lg:flex items-center justify-center px-5 py-2.5 bg-[#FF8C00] text-white text-[14px] font-bold rounded-lg hover:bg-[#F97316] hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                        Daftar Sekarang
                    </a>

                    <!-- Language Switcher -->
                    <div x-data="{ langOpen: false }" class="relative" @click.away="langOpen = false">
                        <button @click="langOpen = !langOpen"
                            class="flex items-center gap-1.5 px-3 py-2 text-[13px] transition-all duration-200 border border-gray-200 rounded-lg text-[#111827] font-semibold hover:border-[#10B981] hover:text-[#047857] hover:bg-gray-50">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129">
                                </path>
                            </svg>
                            <span class="uppercase hidden sm:block">{{ app()->getLocale() ?? 'id' }}</span>
                        </button>

                        <div x-show="langOpen" x-transition x-cloak
                            class="absolute right-0 mt-2 w-28 bg-white border border-gray-100 shadow-lg rounded-xl z-50 py-1.5"
                            style="display: none;">
                            <a href="{{ route('locale.switch', 'id') }}"
                                class="flex items-center px-4 py-2 text-sm text-[#111827] font-medium hover:bg-gray-50 hover:text-[#10B981] {{ app()->getLocale() === 'id' ? 'text-[#10B981] bg-gray-50' : '' }}">
                                🇮🇩 <span class="ml-2">ID</span>
                            </a>
                            <a href="{{ route('locale.switch', 'en') }}"
                                class="flex items-center px-4 py-2 text-sm text-[#111827] font-medium hover:bg-gray-50 hover:text-[#10B981] {{ app()->getLocale() === 'en' ? 'text-[#10B981] bg-gray-50' : '' }}">
                                🇬🇧 <span class="ml-2">EN</span>
                            </a>
                        </div>
                    </div>

                    <!-- Mobile Hamburger -->
                    <div class="flex items-center lg:hidden">
                        <button @click="mobileOpen = !mobileOpen"
                            class="text-[#111827] focus:outline-none p-2 rounded-lg hover:bg-gray-100 transition-colors">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
                                <path x-show="mobileOpen" x-cloak stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Mobile Navigation (Diletakkan di dalam container membulat) -->
        <div x-show="mobileOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-[70vh]"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 max-h-[70vh]"
            x-transition:leave-end="opacity-0 max-h-0"
            class="lg:hidden border-t border-gray-100 bg-white overflow-y-auto" x-cloak>
            <div class="px-4 pt-3 pb-6 space-y-1">
                @foreach ($menus as $menu)
                    @if (empty($menu['children']))
                        <a href="{{ $menu['url'] }}"
                            class="block px-3 py-2.5 text-base font-semibold text-[#111827] rounded-lg hover:bg-gray-100 hover:text-[#047857] transition-colors">
                            {{ $menu['label'] }}
                        </a>
                    @else
                        <div x-data="{ subOpen: false }" class="w-full">
                            <button @click="subOpen = !subOpen"
                                class="w-full flex justify-between items-center px-3 py-2.5 text-base font-semibold rounded-lg transition-colors"
                                :class="subOpen ? 'text-[#047857] bg-gray-50' :
                                    'text-[#111827] hover:bg-gray-100 hover:text-[#047857]'">
                                <span>{{ $menu['label'] }}</span>
                                <svg class="w-4 h-4 transform transition-transform duration-200"
                                    :class="subOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <div x-show="subOpen" x-transition
                                class="pl-4 mt-1 space-y-1 ml-3 border-l-2 border-[#10B981]">
                                @foreach ($menu['children'] as $child)
                                    @include('components.mobile-menu-item', ['item' => $child])
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach

                <div class="mt-6 pt-4 border-t border-gray-100 px-3">
                    <a href="https://pmb.poltek-kampar.ac.id" target="_blank"
                        class="flex w-full items-center justify-center px-4 py-3 bg-[#FF8C00] text-white text-[15px] font-bold rounded-xl hover:bg-[#F97316] transition-colors shadow-md">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
