@props(['menus'])
<div x-data="{ mobileOpen: false, activeDropdown: null }"
    class="sticky top-0 z-50 w-full bg-white font-sans text-stone-800 border-b border-stone-200 shadow-sm">

    <!-- Top Bar (Disembunyikan di Mobile, Muncul di Layar sm/md ke atas) -->
    <div
        class="hidden md:block w-full text-[12px] font-medium tracking-wide border-b transition-colors duration-300 {{ $theme === 'mit' ? 'bg-[#1A1A1A] text-stone-300 border-stone-800' : 'bg-[#ff9100] text-stone-100/90 border-[#ff9100]' }}">
        <div class="container mx-auto  h-9 flex items-center justify-between">

            <!-- Kiri: Info Kontak (Telp & Email) -->
            <div class="flex items-center gap-5">
                <!-- Nomor Telepon -->
                <a href="tel:+6281234567890"
                    class="flex items-center gap-1.5 hover:text-white hover:underline transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                        </path>
                    </svg>
                    +62 812-3456-7890
                </a>

                <!-- Email -->
                <a href="mailto:info@kampus.ac.id"
                    class="flex items-center gap-1.5 hover:text-white hover:underline transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                    info@kampus.ac.id
                </a>
            </div>

            <!-- Kanan: Sosial Media -->
            <div class="flex items-center gap-4">
                <span>Ikuti Kami:</span>
                <span class="text-white/30">|</span>

                <!-- Instagram -->
                <a href="https://instagram.com/kampus" target="_blank" class="hover:text-white transition-all"
                    aria-label="Instagram">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5" stroke-width="2">
                        </rect>
                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" stroke-width="2"></path>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" stroke-width="2"
                            stroke-linecap="round"></line>
                    </svg>
                </a>

                <!-- Facebook -->
                <a href="https://facebook.com/kampus" target="_blank" class="hover:text-white transition-all"
                    aria-label="Facebook">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </a>

                <!-- Twitter / X -->
                <a href="https://twitter.com/kampus" target="_blank" class="hover:text-white transition-all"
                    aria-label="Twitter">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </a>

                <!-- YouTube -->
                <a href="https://youtube.com/kampus" target="_blank" class="hover:text-white transition-all"
                    aria-label="YouTube">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M22.54 6.42a2.78 2.78 0 00-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 00-1.94 2A29 29 0 001 11.75a29 29 0 00.46 5.33 2.78 2.78 0 001.94 2c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 001.94-2 29 29 0 00.46-5.33 29 29 0 00-.46-5.33z"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"></polygon>
                    </svg>
                </a>
            </div>

        </div>
    </div>

    <!-- Main Header -->
    <header class="w-full xl:container mx-auto px-4 bg-white">
        <div class="flex justify-between items-center h-24">
            <div class="flex items-center">
                <a href="/" class="flex items-center gap-3 sm:gap-4 group">
                    <!-- Logo (Tetap muncul di semua ukuran layar) -->
                    <div class="transition-transform duration-300 group-hover:scale-110">
                        <img src="{{ asset('img/logo-plkm.png') }}" alt="Logo" @class([
                            'object-contain',
                            'w-10 h-10' => $theme === 'mit',
                            'w-12 h-12' => $theme === 'stanford',
                        ])>
                    </div>

                    <!-- Teks (Tetap Muncul di Mobile dengan penyesuaian ukuran) -->
                    <div class="flex flex-col border-l border-stone-300 pl-3 sm:pl-4">
                        <!-- Nama Kampus: Ukuran text-lg di mobile, membesar jadi text-2xl di layar sm ke atas -->
                        <span
                            class="text-[16px] sm:text-2xl tracking-wide leading-none transition-all {{ $theme === 'mit' ? 'font-sans font-black uppercase text-[#1A1A1A]' : 'font-serif font-normal text-[#8C1515]' }}">
                            Politeknik <span
                                class="{{ $theme === 'mit' ? 'text-[#FF851B]' : 'text-[#FF851B] font-medium' }}">Kampar</span>
                        </span>

                        <!-- Tagline: Disembunyikan di mobile agar tidak terlalu sumpek, muncul di layar sm ke atas -->
                        <span
                            class="text-[8px] sm:text-[10px] font-sans font-semibold tracking-[0.25em] text-stone-500 uppercase mt-1 sm:mt-1.5">
                            Unggul Inovatif Terkemuka
                        </span>
                    </div>
                </a>
            </div>

            <!-- RIGHT SECTION: Nav + Lang Switcher + Mobile Toggle -->
            <div class="flex items-center gap-2 sm:gap-4">

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center space-x-2">
                    @foreach ($menus as $index => $menu)
                        @if (empty($menu['children']))
                            <a href="{{ $menu['url'] }}" target="{{ $menu['newtab'] ? '_blank' : '' }}" wire:navigate
                                class="px-4 py-2 text-[14px] font-medium transition-all duration-200 {{ $theme === 'mit' ? 'text-stone-900 hover:bg-[#1A1A1A] hover:text-white rounded-none font-bold uppercase tracking-wider text-xs' : 'text-stone-700 hover:text-[#8C1515] rounded-md hover:bg-stone-50' }}">
                                {{ $menu['label'] }}
                            </a>
                        @else
                            <div class="relative" @mouseenter="activeDropdown = {{ $index }}"
                                @mouseleave="activeDropdown = null">
                                <button
                                    class="flex items-center gap-1 px-4 py-2 text-[14px] font-medium transition-all duration-200"
                                    :class="[
                                        activeDropdown === {{ $index }} ? ('{{ $theme }}'
                                            === 'mit' ? 'bg-[#1A1A1A] text-white' : 'bg-stone-50 text-[#8C1515]'
                                        ) :
                                        '',
                                        '{{ $theme }}'
                                        === 'mit' ?
                                        'text-stone-900 rounded-none font-bold uppercase tracking-wider text-xs' :
                                        'text-stone-700 rounded-md'
                                    ]">
                                    <span>{{ $menu['label'] }}</span>
                                    <svg class="w-3 h-3 text-stone-400 transition-transform duration-200"
                                        :class="activeDropdown === {{ $index }} ? 'rotate-180 text-current' : ''"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <div x-show="activeDropdown === {{ $index }}"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95 transform -translate-y-1"
                                    x-transition:enter-end="opacity-100 scale-100 transform translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 scale-100 transform translate-y-0"
                                    x-transition:leave-end="opacity-0 scale-95 transform -translate-y-1"
                                    class="absolute left-0 top-full mt-1 w-64 bg-white border border-stone-200/80 shadow-xl z-50 p-1.5 {{ $theme === 'mit' ? 'rounded-none border-2 border-stone-900' : 'rounded-lg' }}"
                                    style="display: none;">

                                    <x-thema.stanford.navbar.menu-tree :items="$menu['children']" :theme="$theme" />
                                </div>
                            </div>
                        @endif
                    @endforeach
                </nav>

                <!-- Language Switcher Dropdown -->
                <div x-data="{ langOpen: false }" class="relative" @click.away="langOpen = false">
                    <button @click="langOpen = !langOpen"
                        class="flex items-center gap-1.5 px-3 py-2 text-[14px] transition-all duration-200 border {{ $theme === 'mit' ? 'border-stone-900 rounded-none font-bold hover:bg-[#1A1A1A] hover:text-white' : 'border-stone-200 rounded-md hover:bg-stone-50 font-medium text-stone-700 hover:text-[#8C1515]' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129">
                            </path>
                        </svg>
                        <span class="uppercase">{{ app()->getLocale() ?? 'id' }}</span>
                        <svg class="w-3 h-3 transition-transform duration-200" :class="langOpen ? 'rotate-180' : ''"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <!-- Dropdown Options -->
                    <div x-show="langOpen" x-transition x-cloak
                        class="absolute right-0 mt-2 w-28 bg-white border border-stone-200/80 shadow-xl z-50 py-1 {{ $theme === 'mit' ? 'rounded-none border-2 border-stone-900' : 'rounded-lg' }}"
                        style="display: none;">

                        <a href="{{ route('locale.switch', 'id') }}"
                            class="flex items-center px-4 py-2 text-sm text-stone-700 hover:bg-stone-50 hover:text-[#8C1515] {{ app()->getLocale() === 'id' ? 'font-bold bg-stone-50' : '' }}">
                            🇮🇩 <span class="ml-2">ID</span>
                        </a>

                        <a href="{{ route('locale.switch', 'en') }}"
                            class="flex items-center px-4 py-2 text-sm text-stone-700 hover:bg-stone-50 hover:text-[#8C1515] {{ app()->getLocale() === 'en' ? 'font-bold bg-stone-50' : '' }}">
                            🇬🇧 <span class="ml-2">EN</span>
                        </a>
                    </div>
                </div>

                <!-- Mobile Hamburger Button -->
                <div class="flex items-center lg:hidden">
                    <button @click="mobileOpen = !mobileOpen"
                        class="text-stone-700 focus:outline-none p-2 hover:bg-stone-50 {{ $theme === 'mit' ? 'rounded-none' : 'rounded-md' }}">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="mobileOpen" x-cloak stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

            </div>
        </div>
    </header>

    <!-- Mobile Navigation (Tree Support) -->
    <div x-show="mobileOpen" x-transition
        class="md:hidden border-t border-stone-200 bg-white/95 backdrop-blur-md max-h-[calc(100vh-132px)] overflow-y-auto"
        x-cloak>
        <div class="px-4 pt-3 pb-6 space-y-1">
            @foreach ($menus as $menu)
                @if (empty($menu['children']))
                    <a href="{{ $menu['url'] }}"
                        class="block px-3 py-2 text-base font-medium text-stone-700 hover:text-[#8C1515] {{ $theme === 'mit' ? 'font-bold uppercase rounded-none' : 'rounded-md' }}">
                        {{ $menu['label'] }}
                    </a>
                @else
                    <div x-data="{ subOpen: false }" class="w-full">
                        <button @click="subOpen = !subOpen"
                            class="w-full flex justify-between items-center px-3 py-2 text-base font-medium text-stone-700 hover:text-[#8C1515] {{ $theme === 'mit' ? 'font-bold uppercase rounded-none' : 'rounded-md' }}">
                            <span>{{ $menu['label'] }}</span>
                            <svg class="w-4 h-4 transform transition-transform"
                                :class="subOpen ? 'rotate-180 text-[#8C1515]' : ''" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="subOpen" x-transition
                            class="pl-4 mt-1 bg-white border-l-2 border-stone-200 space-y-1">
                            @foreach ($menu['children'] as $child)
                                @include('components.mobile-menu-item', [
                                    'item' => $child,
                                    'theme' => $theme,
                                ])
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
