@props(['menus'])

<div 
    x-data="{ isScrolled: false, mobileOpen: false, activeDropdown: null }"
    @scroll.window="isScrolled = (window.pageYOffset > 10)"
    class="sticky top-0 z-50 w-full font-sans text-[#111827] transition-all duration-300"
    :class="isScrolled ? 'bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-md shadow-slate-900/5' : 'bg-white border-b border-[#F8FAFC] shadow-[0_4px_20px_-10px_rgba(0,0,0,0.05)]'"
>

    <!-- Top Bar: Vibrant Palm Green background with White text -->
    <div 
        class="hidden md:block w-full text-[12px] font-medium tracking-wide bg-[#047857] text-white transition-all duration-300 overflow-hidden"
        :class="isScrolled ? 'max-h-0 opacity-0' : 'max-h-10 opacity-100'"
    >
        <div class="container mx-auto h-10 flex items-center justify-between px-4">

            <!-- Kiri: Info Kontak -->
            <div class="flex items-center gap-6">
                <!-- Nomor Telepon -->
                <a href="tel:+6281234567890"
                    class="flex items-center gap-2 hover:text-[#FF8C00] transition-colors duration-200">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                        </path>
                    </svg>
                    +62 812-3456-7890
                </a>

                <!-- Email -->
                <a href="mailto:info@polkam.ac.id"
                    class="flex items-center gap-2 hover:text-[#FF8C00] transition-colors duration-200">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                    info@polkam.ac.id
                </a>
            </div>

            <!-- Kanan: Sosial Media -->
            <div class="flex items-center gap-4">
                <span class="opacity-80">Ikuti Kami:</span>
                <span class="text-white/20">|</span>

                <div class="flex items-center gap-3">
                    <a href="#" target="_blank" class="hover:text-[#FF8C00] transition-colors duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5" stroke-width="2"></rect>
                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" stroke-width="2"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" stroke-width="2" stroke-linecap="round"></line>
                        </svg>
                    </a>
                    <a href="#" target="_blank" class="hover:text-[#FF8C00] transition-colors duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                    <a href="#" target="_blank" class="hover:text-[#FF8C00] transition-colors duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                    <a href="#" target="_blank" class="hover:text-[#FF8C00] transition-colors duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M22.54 6.42a2.78 2.78 0 00-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 00-1.94 2A29 29 0 001 11.75a29 29 0 00.46 5.33 2.78 2.78 0 001.94 2c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 001.94-2 29 29 0 00.46-5.33 29 29 0 00-.46-5.33z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></polygon>
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- Main Header -->
    <header class="w-full xl:container mx-auto px-4">
        <div 
            class="flex justify-between items-center transition-all duration-300"
            :class="isScrolled ? 'h-16 sm:h-20' : 'h-20 sm:h-24'"
        >

            <!-- Logo & Title -->
            <div class="flex items-center">
                <a href="/" class="flex items-center gap-3 sm:gap-4 group">
                    <div class="transition-transform duration-300 group-hover:scale-105">
                        <img src="{{ asset('img/logo-plkm.png') }}" alt="Logo Polkam"
                            class="object-contain transition-all duration-300 drop-shadow-sm"
                            :class="isScrolled ? 'w-10 h-10 sm:w-12 sm:h-12' : 'w-12 h-12 sm:w-14 sm:h-14'"
                        >
                    </div>

                    <div class="flex flex-col border-l-2 border-[#10B981] pl-3 sm:pl-4">
                        <span
                            class="font-sans font-bold tracking-tight text-[#111827] leading-none transition-all duration-300"
                            :class="isScrolled ? 'text-[16px] sm:text-[20px]' : 'text-[18px] sm:text-[22px]'"
                        >
                            POLITEKNIK <span class="text-[#FF8C00]">KAMPAR</span>
                        </span>

                        <span
                            class="text-[8px] sm:text-[10px] font-sans font-bold tracking-[0.2em] text-[#047857] uppercase mt-1"
                        >
                            Unggul Inovatif Terkemuka
                        </span>
                    </div>
                </a>
            </div>

            <!-- RIGHT SECTION: Nav + Lang Switcher + Mobile Toggle -->
            <div class="flex items-center gap-3 sm:gap-5">

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center space-x-1">
                    @foreach ($menus as $index => $menu)
                        @if (empty($menu['children']))
                            <a href="{{ $menu['url'] }}" target="{{ $menu['newtab'] ? '_blank' : '' }}" wire:navigate
                                class="px-4 py-2 text-[14px] font-semibold rounded-lg transition-all duration-200 text-[#111827] hover:bg-[#F8FAFC] hover:text-[#047857]">
                                {{ $menu['label'] }}
                            </a>
                        @else
                            <div class="relative" @mouseenter="activeDropdown = {{ $index }}"
                                @mouseleave="activeDropdown = null">
                                <button
                                    class="flex items-center gap-1.5 px-4 py-2 text-[14px] font-semibold rounded-lg transition-all duration-200"
                                    :class="activeDropdown === {{ $index }} ? 'bg-[#F8FAFC] text-[#047857]' :
                                        'text-[#111827] hover:bg-[#F8FAFC] hover:text-[#047857]'">
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
                                <div x-show="activeDropdown === {{ $index }}"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95 transform -translate-y-2"
                                    x-transition:enter-end="opacity-100 scale-100 transform translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 scale-100 transform translate-y-0"
                                    x-transition:leave-end="opacity-0 scale-95 transform -translate-y-2"
                                    class="absolute left-0 top-full mt-2 w-64 bg-white/95 backdrop-blur-md border border-[#F8FAFC] shadow-xl rounded-xl z-50 p-2"
                                    style="display: none;">

                                    <x-thema.ecoindustrial.navbar.menu-tree :items="$menu['children']" />
                                </div>
                            </div>
                        @endif
                    @endforeach
                </nav>

                <!-- Pendaftaran / CTA Button -->
                <a href="/pmb"
                    class="hidden lg:flex items-center justify-center px-5 py-2.5 bg-[#FF8C00] text-white text-[14px] font-bold rounded-lg hover:bg-[#F97316] hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                    Daftar Sekarang
                </a>

                <!-- Language Switcher -->
                <div x-data="{ langOpen: false }" class="relative" @click.away="langOpen = false">
                    <button @click="langOpen = !langOpen"
                        class="flex items-center gap-1.5 px-3 py-2.5 text-[13px] transition-all duration-200 border border-gray-200 rounded-lg text-[#111827] font-semibold hover:border-[#10B981] hover:text-[#047857] hover:bg-[#F8FAFC]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129">
                            </path>
                        </svg>
                        <span class="uppercase">{{ app()->getLocale() ?? 'id' }}</span>
                    </button>

                    <div x-show="langOpen" x-transition x-cloak
                        class="absolute right-0 mt-2 w-28 bg-white border border-[#F8FAFC] shadow-lg rounded-xl z-50 py-1.5"
                        style="display: none;">

                        <a href="{{ route('locale.switch', 'id') }}"
                            class="flex items-center px-4 py-2 text-sm text-[#111827] font-medium hover:bg-[#F8FAFC] hover:text-[#10B981] {{ app()->getLocale() === 'id' ? 'text-[#10B981] bg-[#F8FAFC]' : '' }}">
                            🇮🇩 <span class="ml-2">ID</span>
                        </a>

                        <a href="{{ route('locale.switch', 'en') }}"
                            class="flex items-center px-4 py-2 text-sm text-[#111827] font-medium hover:bg-[#F8FAFC] hover:text-[#10B981] {{ app()->getLocale() === 'en' ? 'text-[#10B981] bg-[#F8FAFC]' : '' }}">
                            🇬🇧 <span class="ml-2">EN</span>
                        </a>
                    </div>
                </div>

                <!-- Mobile Hamburger -->
                <div class="flex items-center lg:hidden">
                    <button @click="mobileOpen = !mobileOpen"
                        class="text-[#111827] focus:outline-none p-2 rounded-lg hover:bg-[#F8FAFC] transition-colors">
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

    <!-- Mobile Navigation -->
    <div x-show="mobileOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        class="lg:hidden border-t border-gray-100 bg-white/95 backdrop-blur-md max-h-[calc(100vh-100px)] overflow-y-auto shadow-inner"
        x-cloak>
        <div class="px-4 pt-3 pb-6 space-y-1">
            @foreach ($menus as $menu)
                @if (empty($menu['children']))
                    <a href="{{ $menu['url'] }}"
                        class="block px-3 py-2.5 text-base font-semibold text-[#111827] rounded-lg hover:bg-[#F8FAFC] hover:text-[#047857] transition-colors">
                        {{ $menu['label'] }}
                    </a>
                @else
                    <div x-data="{ subOpen: false }" class="w-full">
                        <button @click="subOpen = !subOpen"
                            class="w-full flex justify-between items-center px-3 py-2.5 text-base font-semibold rounded-lg transition-colors"
                            :class="subOpen ? 'text-[#047857] bg-[#F8FAFC]' :
                                'text-[#111827] hover:bg-[#F8FAFC] hover:text-[#047857]'">
                            <span>{{ $menu['label'] }}</span>
                            <svg class="w-4 h-4 transform transition-transform duration-200"
                                :class="subOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="subOpen" x-transition
                            class="pl-4 mt-1 bg-white border-l-2 border-[#10B981] space-y-1 ml-3">
                            @foreach ($menu['children'] as $child)
                                @include('components.mobile-menu-item', [
                                    'item' => $child,
                                ])
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach

            <!-- Mobile CTA -->
            <div class="mt-6 pt-4 border-t border-gray-100 px-3">
                <a href="/pmb"
                    class="flex w-full items-center justify-center px-4 py-3 bg-[#FF8C00] text-white text-[15px] font-bold rounded-xl hover:bg-[#F97316] transition-colors shadow-md">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </div>
</div>