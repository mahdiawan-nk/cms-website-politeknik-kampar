@php
    // Helper pengambilan data dinamis Site Setting dengan fallback default
    $siteName = $siteSetting?->getTranslation('site_name') ?? 'POLITEKNIK KAMPAR';
    $siteTagline = $siteSetting?->getTranslation('site_tagline') ?? 'UNGGUL INOVATIF TERKEMUKA';
    $announcement =
        $siteSetting?->getTranslation('topbar_announcement') ??
        'Terwujudnya Politeknik yang Unggul, Inovatif dan Terkemuka Berbasis Teknologi Terapan pada Tahun 2032';
    $footerDesc =
        $siteSetting?->getTranslation('footer_description') ??
        'Menjadi institusi pendidikan vokasi unggulan yang menghasilkan sumber daya manusia profesional, berkarakter, dan berdaya saing global.';
    $copyright =
        $siteSetting?->getTranslation('copyright_text') ??
        '© ' . date('Y') . ' Kampar Polytechnic. All Rights Reserved';

    // Path URL Logo & Favicon
    $logoLight = $siteSetting?->logo_light ? Storage::url($siteSetting->logo_light) : asset('images/logo-plkm.png');
    $logoDark = $siteSetting?->logo_dark ? Storage::url($siteSetting->logo_dark) : $logoLight;
@endphp

<!-- ALPINE STATE MANAGEMENT (THEME & PREFERENCE) -->
<div x-data="{
    darkMode: localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
    toggleTheme() {
        this.darkMode = !this.darkMode;
        localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
    }
}" :class="{ 'dark': darkMode }"
    class="relative min-h-screen w-full flex items-center justify-center overflow-hidden bg-slate-100 dark:bg-[#060c0a] font-sans selection:bg-emerald-500 selection:text-white transition-colors duration-500">

    <!-- ☀️ / 🌙 THEME TOGGLE BUTTON -->
    <div class="absolute top-5 right-5 sm:top-6 sm:right-6 z-50">
        <button @click="toggleTheme()" type="button" title="Ganti Tema Tampilan"
            class="group relative p-2.5 rounded-2xl bg-white/80 dark:bg-zinc-900/90 border border-slate-200 dark:border-emerald-500/40 text-slate-700 dark:text-emerald-400 shadow-xl backdrop-blur-xl hover:scale-105 active:scale-95 transition-all duration-300">

            <div
                class="absolute inset-0 rounded-2xl bg-emerald-500/10 opacity-0 group-hover:opacity-100 transition-opacity">
            </div>

            <!-- SUN ICON (Dark Mode Active) -->
            <svg x-show="darkMode"
                class="w-5 h-5 relative z-10 text-emerald-400 drop-shadow-[0_0_8px_rgba(52,211,153,0.8)]" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" x-cloak>
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>

            <!-- MOON ICON (Light Mode Active) -->
            <svg x-show="!darkMode" class="w-5 h-5 relative z-10 text-slate-700" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21.752 15.002A9 9 0 019.288 3.75 9.001 9.001 0 1021.752 15.002z" />
            </svg>
        </button>
    </div>

    <!-- 🖼️ ULTRA BACKGROUND & TECHNICAL GRID OVERLAY -->
    <div class="absolute inset-0 z-0 pointer-events-none">
        <img src="/images/bg-01.png" alt="Politeknik Kampar Background"
            class="w-full h-full object-cover scale-105 blur-[12px] opacity-15 dark:opacity-20 transition-opacity duration-700">

        <!-- Industrial Tech Grid Pattern -->
        <div
            class="absolute inset-0 bg-[linear-gradient(to_right,#05966912_1px,transparent_1px),linear-gradient(to_bottom,#05966912_1px,transparent_1px)] dark:bg-[linear-gradient(to_right,#10b98118_1px,transparent_1px),linear-gradient(to_bottom,#10b98118_1px,transparent_1px)] bg-[size:32px_32px]">
        </div>
    </div>

    <!-- 🌌 DARK / LIGHT ECO AMBIENT OVERLAY -->
    <div
        class="absolute inset-0 bg-gradient-to-br from-emerald-50/70 via-slate-100/90 to-teal-50/70 dark:from-[#060c0a]/95 dark:via-[#0b1712]/90 dark:to-[#040807]/95 transition-colors duration-500">
    </div>

    <!-- 🔵 GLOWING LIGHT BLOBS (AMBIENT GLOW) -->
    <div
        class="absolute -top-40 -left-40 w-[600px] h-[600px] bg-emerald-400/20 dark:bg-emerald-500/20 rounded-full blur-[140px] pointer-events-none animate-pulse">
    </div>
    <div
        class="absolute -bottom-40 -right-40 w-[600px] h-[600px] bg-teal-400/20 dark:bg-teal-500/20 rounded-full blur-[140px] pointer-events-none">
    </div>
    <div
        class="absolute top-1/2 left-1/4 -translate-y-1/2 w-[300px] h-[300px] bg-emerald-500/10 dark:bg-emerald-400/15 rounded-full blur-[100px] pointer-events-none">
    </div>

    <!-- 📦 MAIN CONTAINER 2-GRID LAYOUT -->
    <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 my-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">

            <!-- =================================================== -->
            <!-- 🌿 KOLOM KIRI: PLATFORM & BRANDING (DISAMBUNGIK TAMPILAN HP) -->
            <!-- =================================================== -->
            <div class="hidden lg:block lg:col-span-7 space-y-8 text-left pr-0 lg:pr-4">

                <!-- BRANDING & LOGO -->
                <div class="space-y-4">

                    <!-- Dynamic Badge Pengumuman / Visi -->
                    @if ($siteSetting?->is_announcement_active)
                        <div
                            class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-emerald-600/10 dark:bg-emerald-500/15 border border-emerald-600/20 dark:border-emerald-500/30 text-emerald-800 dark:text-emerald-300 text-xs font-medium tracking-wide backdrop-blur-md shadow-[0_0_15px_rgba(16,185,129,0.15)]">
                            <span class="relative flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                            <span>Eco-Industrial Campus Platform</span>
                        </div>
                    @endif

                    <!-- Dynamic Logo (Switching Light / Dark Mode) -->
                    <div class="flex items-center gap-4 pt-1">
                        <div
                            class="p-3.5 rounded-2xl bg-white/90 dark:bg-zinc-900/90 border border-slate-200/80 dark:border-emerald-500/30 shadow-xl backdrop-blur-xl">
                            <!-- Logo Light Mode -->
                            <img x-show="!darkMode" src="{{ $logoLight }}" alt="{{ $siteName }}"
                                class="h-12 sm:h-14 w-auto object-contain">
                            <!-- Logo Dark Mode -->
                            <img x-show="darkMode" src="{{ $logoDark }}" alt="{{ $siteName }}"
                                class="h-12 sm:h-14 w-auto object-contain" x-cloak>
                        </div>
                        <div>
                            <h2
                                class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white tracking-wider uppercase drop-shadow-sm">
                                {{ $siteName }}
                            </h2>
                            <p
                                class="text-xs sm:text-sm text-emerald-600 dark:text-emerald-400 font-bold tracking-widest uppercase">
                                {{ $siteTagline }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- HEADLINE PLATFORM -->
                <div class="space-y-3">
                    <h1
                        class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
                        Pusat Kendali <br class="hidden sm:inline">
                        <span
                            class="bg-clip-text text-transparent bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-700 dark:from-emerald-400 dark:via-teal-300 dark:to-emerald-400 drop-shadow-[0_0_25px_rgba(16,185,129,0.2)]">
                            Administrasi & Konten Digital
                        </span>
                    </h1>
                    <p class="text-sm sm:text-base text-slate-600 dark:text-zinc-400 leading-relaxed max-w-2xl">
                        {{ $footerDesc }}
                    </p>
                </div>

                <!-- CARDS VISI & HIGHLIGHTS -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    <!-- Visi/Announcement Box -->
                    <div
                        class="sm:col-span-2 p-4 sm:p-5 rounded-2xl bg-white/80 dark:bg-zinc-900/40 border border-slate-200/80 dark:border-emerald-500/20 shadow-sm backdrop-blur-md hover:border-emerald-500/40 transition-all duration-300">
                        <div class="flex items-start gap-3.5">
                            <div
                                class="p-2.5 rounded-xl bg-emerald-500/10 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 shrink-0">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                </svg>
                            </div>
                            <div>
                                <h4
                                    class="text-xs font-bold text-slate-900 dark:text-emerald-400 uppercase tracking-wider">
                                    Visi Kampus Utama</h4>
                                <p class="text-xs text-slate-600 dark:text-zinc-300 mt-1 leading-relaxed">
                                    "{{ $announcement }}"
                                </p>
                            </div>
                        </div>
                    </div>
                   
                </div>

            </div>

            <!-- ========================================== -->
            <!-- 🧊 KOLOM KANAN: CARD FORM LOGIN ULTRA      -->
            <!-- ========================================== -->
            <div class="lg:col-span-5 w-full max-w-md mx-auto lg:max-w-none">

                <!-- OUTER GLOW WRAPPER -->
                <div
                    class="relative rounded-3xl p-[1px] bg-gradient-to-b from-slate-200 via-emerald-500/30 to-slate-200 dark:from-emerald-500/50 dark:via-emerald-400/20 dark:to-teal-500/40 shadow-2xl dark:shadow-[0_0_50px_rgba(16,185,129,0.15)] transition-all duration-300">

                    <div
                        class="relative rounded-[23px] bg-white/95 dark:bg-zinc-950/80 backdrop-blur-2xl p-6 sm:p-8 overflow-hidden">

                        <!-- Top Accent Line -->
                        <div
                            class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-emerald-500 via-teal-400 to-amber-500">
                        </div>

                        <!-- 📱 BRANDING RINGKAS KHUSUS MOBILE (Tampil Saat HP) -->
                        <div class="lg:hidden flex flex-col items-center text-center mb-6 pt-2">
                            <div
                                class="p-3 rounded-2xl bg-white/90 dark:bg-zinc-900/90 border border-slate-200 dark:border-emerald-500/30 shadow-lg backdrop-blur-xl mb-3">
                                <img x-show="!darkMode" src="{{ $logoLight }}" alt="{{ $siteName }}"
                                    class="h-10 w-auto object-contain">
                                <img x-show="darkMode" src="{{ $logoDark }}" alt="{{ $siteName }}"
                                    class="h-10 w-auto object-contain" x-cloak>
                            </div>
                            <h2 class="text-base font-black text-slate-900 dark:text-white tracking-wider uppercase">
                                {{ $siteName }}
                            </h2>
                            <p
                                class="text-[10px] text-emerald-600 dark:text-emerald-400 font-bold tracking-widest uppercase">
                                {{ $siteTagline }}
                            </p>
                        </div>

                        <!-- HEADER FORM -->
                        <div class="mb-7 text-center lg:text-left">
                            <h3 class="text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight">Admin
                                Portal</h3>
                            <p class="text-xs text-slate-500 dark:text-zinc-400 mt-1">Otentikasi akses administrator
                                sistem.</p>
                        </div>

                        <!-- FORM AUTHENTICATION -->
                        <form wire:submit.prevent="authenticate" class="space-y-5">

                            <!-- EMAIL INPUT -->
                            <div class="relative group">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 dark:text-zinc-400 group-focus-within:text-emerald-600 dark:group-focus-within:text-emerald-400 transition-colors">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                    </svg>
                                </div>

                                <input type="email" wire:model.defer="data.email" required placeholder=" "
                                    class="peer w-full rounded-xl bg-slate-100/80 dark:bg-zinc-900/90 border border-slate-200 dark:border-zinc-800 text-slate-900 dark:text-white pl-11 pr-4 pt-5 pb-2 text-sm
                                    focus:outline-none focus:ring-2 focus:ring-emerald-500/40 dark:focus:ring-emerald-400/30 focus:border-emerald-500 dark:focus:border-emerald-400
                                    transition-all duration-200">

                                <label
                                    class="absolute left-11 top-1.5 text-[11px] font-medium text-slate-500 dark:text-zinc-400 
                                    transition-all peer-placeholder-shown:top-3.5 
                                    peer-placeholder-shown:text-xs peer-placeholder-shown:text-slate-400 dark:peer-placeholder-shown:text-zinc-400
                                    peer-focus:top-1.5 peer-focus:text-[11px] peer-focus:text-emerald-600 dark:peer-focus:text-emerald-400">
                                    Email Administrator
                                </label>

                                @error('data.email')
                                    <p
                                        class="text-red-500 dark:text-red-400 text-xs mt-1.5 flex items-center gap-1 font-medium">
                                        <span>•</span> {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- PASSWORD INPUT -->
                            <div class="relative group" x-data="{ showPassword: false }">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 dark:text-zinc-400 group-focus-within:text-emerald-600 dark:group-focus-within:text-emerald-400 transition-colors">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                    </svg>
                                </div>

                                <input :type="showPassword ? 'text' : 'password'"
                                    x-bind:type="showPassword ? 'text' : 'password'" wire:model.defer="data.password"
                                    required placeholder=" "
                                    class="peer w-full rounded-xl bg-slate-100/80 dark:bg-zinc-900/90 border border-slate-200 dark:border-zinc-800 text-slate-900 dark:text-white pl-11 pr-12 pt-5 pb-2 text-sm
                                    focus:outline-none focus:ring-2 focus:ring-emerald-500/40 dark:focus:ring-emerald-400/30 focus:border-emerald-500 dark:focus:border-emerald-400
                                    transition-all duration-200">

                                <label
                                    class="absolute left-11 top-1.5 text-[11px] font-medium text-slate-500 dark:text-zinc-400 
                                    transition-all peer-placeholder-shown:top-3.5 
                                    peer-placeholder-shown:text-xs peer-placeholder-shown:text-slate-400 dark:peer-placeholder-shown:text-zinc-400
                                    peer-focus:top-1.5 peer-focus:text-[11px] peer-focus:text-emerald-600 dark:peer-focus:text-emerald-400">
                                    Kata Sandi
                                </label>

                                <!-- TOGGLE EYE BUTTON -->
                                <button type="button" @click="showPassword = !showPassword"
                                    class="absolute right-3.5 top-3.5 text-slate-400 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 transition"
                                    x-cloak>
                                    <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 010-.644C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .644C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3.98 8.223A10.477 10.477 0 002.036 12.322c-.07.207-.07.431 0 .644C3.423 16.49 7.36 19.5 12 19.5c1.886 0 3.676-.484 5.226-1.338M6.228 6.228A10.45 10.45 0 0112 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .644a10.477 10.477 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l12.544 12.544M9.88 9.88a3 3 0 104.243 4.243" />
                                    </svg>
                                </button>

                                @error('data.password')
                                    <p
                                        class="text-red-500 dark:text-red-400 text-xs mt-1.5 flex items-center gap-1 font-medium">
                                        <span>•</span> {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- REMEMBER ME CHECKBOX -->
                            <div class="flex items-center justify-between text-xs pt-1">
                                <label
                                    class="flex items-center gap-2.5 text-slate-600 dark:text-zinc-300 cursor-pointer select-none">
                                    <input type="checkbox" wire:model="data.remember"
                                        class="w-4 h-4 rounded border-slate-300 dark:border-zinc-700 bg-slate-100 dark:bg-zinc-900 text-emerald-600 focus:ring-emerald-500 focus:ring-offset-white dark:focus:ring-offset-zinc-900 transition">
                                    <span>Ingat kredensial saya</span>
                                </label>
                            </div>

                            <!-- SUBMIT BUTTON WITH SHIMMER EFFECT -->
                            <button type="submit" wire:loading.attr="disabled"
                                class="group relative w-full overflow-hidden rounded-xl 
    bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-700 dark:from-emerald-500 dark:via-teal-400 dark:to-emerald-500
    text-white font-bold text-sm shadow-xl
    hover:shadow-[0_0_30px_rgba(16,185,129,0.4)] hover:scale-[1.01]
    active:scale-[0.99] disabled:opacity-70 disabled:cursor-not-allowed
    transition-all duration-300 flex items-center justify-center mt-2 h-[46px]">

                                <!-- Animated Shimmer Overlay -->
                                <div
                                    class="absolute inset-0 w-1/2 h-full bg-white/20 skew-x-12 -translate-x-full group-hover:translate-x-[300%] transition-transform duration-1000 ease-in-out pointer-events-none">
                                </div>

                                <!-- 1. TAMPILAN NORMAL (Wajib ada class 'flex' agar rapi dari awal) -->
                                <span wire:loading.remove class="relative z-10 flex items-center justify-center gap-2">
                                    <span>Masuk Sesi</span>
                                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform shrink-0"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                    </svg>
                                </span>

                                <!-- 2. TAMPILAN LOADING (Gunakan wire:loading.flex agar Livewire menerapkan display: flex saat aktif) -->
                                <span wire:loading.flex class="relative z-10 items-center justify-center gap-2">
                                    <svg class="animate-spin h-5 w-5 text-white shrink-0" viewBox="0 0 24 24"
                                        fill="none">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z">
                                        </path>
                                    </svg>
                                    <span>Memverifikasi...</span>
                                </span>
                            </button>

                        </form>

                        <!-- TOAST ERROR FLOATING -->
                        @if ($errors->any())
                            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition
                                class="fixed top-5 right-5 z-50 bg-red-600 dark:bg-red-900/95 backdrop-blur-md text-white dark:text-red-100 border border-red-500/30 px-4 py-3 rounded-2xl shadow-2xl flex items-center gap-3">
                                <svg class="w-5 h-5 text-white dark:text-red-400 shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                </svg>
                                <span class="text-xs font-semibold">Gagal masuk. Periksa kredensial Anda.</span>
                            </div>
                        @endif

                        <!-- DYNAMIC COPYRIGHT FOOTER -->
                        <div
                            class="mt-8 text-center text-[11px] text-slate-500 dark:text-zinc-400 border-t border-slate-200/80 dark:border-zinc-800/80 pt-4">
                            {{ $copyright }}
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
