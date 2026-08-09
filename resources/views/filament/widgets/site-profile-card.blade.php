<x-filament-widgets::widget>
    @php
        // Mengambil data pertama dari site_settings
        $setting = is_array($siteSettings) ? $siteSettings[0] ?? null : $siteSettings ?? null;

        // Helper untuk parse string JSON lokalikasi (id / en)
        $getLocaleText = function ($data) {
            if (is_string($data) && (str_starts_with($data, '{') || str_starts_with($data, '['))) {
                $decoded = json_decode($data, true);
                if (is_array($decoded)) {
                    return $decoded[app()->getLocale()] ??
                        ($decoded['id'] ?? ($decoded['en'] ?? (reset($decoded) ?? '-')));
                }
            }
            if (is_array($data)) {
                return $data[app()->getLocale()] ?? ($data['id'] ?? ($data['en'] ?? (reset($data) ?? '-')));
            }
            return $data ?? '-';
        };

        $siteName = $setting
            ? $getLocaleText($setting['site_name'] ?? ($setting->site_name ?? null))
            : 'POLITEKNIK KAMPAR';
        $siteTagline = $setting ? $getLocaleText($setting['site_tagline'] ?? ($setting->site_tagline ?? null)) : '';
        $email = $setting['email'] ?? ($setting->email ?? '-');
        $phone = $setting['phone'] ?? ($setting->phone ?? '-');
        $address = $setting ? $getLocaleText($setting['address'] ?? ($setting->address ?? null)) : '-';
        $workingHours = $setting ? $getLocaleText($setting['working_hours'] ?? ($setting->working_hours ?? null)) : '-';
        $isTopbarActive = $setting['is_topbar_active'] ?? ($setting->is_topbar_active ?? false);
        $isAnnouncementActive = $setting['is_announcement_active'] ?? ($setting->is_announcement_active ?? false);

        $logoPath = $setting['logo_light'] ?? ($setting->logo_light ?? null);
        $logoUrl = $logoPath ? asset('storage/' . $logoPath) : null;

        // Parse social links
        $rawSocials = $setting['social_links'] ?? ($setting->social_links ?? '[]');
        $socialLinks = is_string($rawSocials)
            ? json_decode($rawSocials, true)
            : (is_array($rawSocials)
                ? $rawSocials
                : []);
    @endphp

    <div
        class="relative overflow-hidden rounded-2xl border border-slate-200/80 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-sm transition-all duration-300">

        <!-- Header Banner / Accent Glow -->
        <div class="h-2 w-full bg-gradient-to-r from-emerald-500 via-teal-500 to-amber-500"></div>

        <div class="p-5 sm:p-6 space-y-6">

            <!-- SECTION 1: IDENTITAS UTAMA (Logo, Nama, Tagline & Action Edit) -->
            <div
                class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-5 border-b border-slate-100 dark:border-slate-800">
                <div class="flex items-center gap-4">
                    <!-- Logo / Avatar Placeholder -->
                    <div class="relative flex-shrink-0">
                        @if ($logoUrl)
                            <img src="{{ $logoUrl }}" alt="{{ $siteName }}"
                                class="h-14 w-14 rounded-2xl object-contain bg-slate-50 dark:bg-slate-800 p-2 border border-slate-200/60 dark:border-slate-700/60 shadow-sm">
                        @else
                            <div
                                class="h-14 w-14 rounded-2xl bg-gradient-to-br from-emerald-600 to-teal-700 text-white font-black flex items-center justify-center text-xl shadow-md shadow-emerald-500/20">
                                PK
                            </div>
                        @endif

                        <!-- Status indicator online -->
                        <span class="absolute -bottom-1 -right-1 flex h-4 w-4">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span
                                class="relative inline-flex rounded-full h-4 w-4 bg-emerald-500 border-2 border-white dark:border-slate-900"></span>
                        </span>
                    </div>

                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="text-lg font-black tracking-tight text-slate-900 dark:text-white">
                                {{ $siteName }}
                            </h3>
                            <span
                                class="px-2 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-widest bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 border border-emerald-200/80 dark:border-emerald-500/30">
                                Official Site
                            </span>
                        </div>
                        @if ($siteTagline)
                            <p
                                class="text-xs font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-400 mt-0.5">
                                {{ $siteTagline }}
                            </p>
                        @endif
                    </div>
                </div>

                <!-- Action Button ke Form Pengaturan -->
                <a href="{{ route('filament.cms.pages.manage-site-setting') }}"
                    class="self-start sm:self-auto inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-emerald-600 hover:text-white dark:bg-slate-800 dark:hover:bg-emerald-500 dark:hover:text-slate-950 text-slate-700 dark:text-slate-200 text-xs font-bold transition-all duration-200 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Kelola Settings
                </a>
            </div>

            <!-- SECTION 2: GRID INFORMASI PENTING (2 Kolom) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">

                <!-- Kontak & Operasional -->
                <div
                    class="p-4 rounded-xl bg-slate-50/70 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 space-y-2.5">
                    <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">Kontak Resmi</span>

                    <div class="flex items-center gap-2.5 text-slate-700 dark:text-slate-300">
                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        <span class="font-medium truncate">{{ $email }}</span>
                    </div>

                    <div class="flex items-center gap-2.5 text-slate-700 dark:text-slate-300">
                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
                        </svg>
                        <span class="font-medium">{{ $phone }}</span>
                    </div>

                    <div class="flex items-center gap-2.5 text-slate-700 dark:text-slate-300">
                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-medium truncate">{{ $workingHours }}</span>
                    </div>
                </div>

                <!-- Alamat & Status Modul -->
                <div
                    class="p-4 rounded-xl bg-slate-50/70 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 space-y-2.5 flex flex-col justify-between">
                    <div>
                        <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">Lokasi
                            Kampus</span>
                        <div class="flex items-start gap-2.5 text-slate-700 dark:text-slate-300 mt-1">
                            <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 shrink-0 mt-0.5" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="font-medium line-clamp-2 leading-relaxed">{{ $address }}</span>
                        </div>
                    </div>

                    <!-- Status Active Chips -->
                    <div class="flex items-center gap-2 pt-2 border-t border-slate-200/60 dark:border-slate-700/50">
                        <span
                            class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded text-[10px] font-bold {{ $isTopbarActive ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20' : 'bg-slate-200/60 text-slate-500' }}">
                            <span
                                class="w-1.5 h-1.5 rounded-full {{ $isTopbarActive ? 'bg-emerald-500 animate-pulse' : 'bg-slate-400' }}"></span>
                            Topbar
                        </span>

                        <span
                            class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded text-[10px] font-bold {{ $isAnnouncementActive ? 'bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20' : 'bg-slate-200/60 text-slate-500' }}">
                            <span
                                class="w-1.5 h-1.5 rounded-full {{ $isAnnouncementActive ? 'bg-amber-500 animate-pulse' : 'bg-slate-400' }}"></span>
                            Announcement
                        </span>
                    </div>
                </div>

            </div>

            <!-- SECTION 3: SOCIAL MEDIA LINKS SUMMARY -->
            @if (!empty($socialLinks))
                <div class="pt-2 flex items-center justify-between">
                    <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">Media Sosial
                        Terhubung</span>
                    <div class="flex items-center gap-2">
                        @foreach ($socialLinks as $social)
                            @php
                                $platform = strtolower($social['platform'] ?? 'link');
                                $url = $social['url'] ?? '#';
                            @endphp
                            <a href="{{ $url }}" target="_blank" rel="noopener noreferrer"
                                class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 text-[11px] font-bold capitalize transition-colors flex items-center gap-1">
                                <span>{{ $platform }}</span>
                                <svg class="w-3 h-3 opacity-60" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                    </path>
                                </svg>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-filament-widgets::widget>
