<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\SiteSetting;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\{Grid, Section, Tabs};
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;
use BackedEnum;
use Filament\Support\Icons\Heroicon;
use UnitEnum;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Concerns\RestrictsFileUploadsToSchemaComponents;
use Filament\Schemas\Contracts\HasSchemas;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class ManageSiteSetting extends Page implements HasSchemas
{
    use InteractsWithSchemas;
    use RestrictsFileUploadsToSchemaComponents;
    use HasPageShield;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;
    protected static string | UnitEnum | null $navigationGroup = 'Pengaturan Sistem';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Konfigurasi Situs';

    protected static ?string $title = 'Pengaturan Situs Global';

    protected string $view = 'filament.pages.manage-site-setting';

    /**
     * Form state data.
     */
    public ?array $data = [];

    /**
     * Inisialisasi data saat halaman pertama kali dibuka.
     */
    public function mount(): void
    {
        $setting = SiteSetting::firstOrCreate(['id' => 1]);
        $this->form->fill($setting->toArray());
    }

    /**
     * Skema Form Filament
     */
    public function form(Schema $form): Schema
    {
        return $form
            ->components([
                Tabs::make('SiteSettingsTabs')
                    ->tabs([

                        // ==========================================
                        // TAB 1: BRANDING & IDENTITAS
                        // ==========================================
                        Tabs\Tab::make('Branding & Identitas')
                            ->icon('heroicon-o-paint-brush')
                            ->schema([
                                Section::make('Informasi Dasar (Multi-Bahasa)')
                                    ->description('Nama dan slogan utama situs.')
                                    ->schema([
                                        Tabs::make('site_identity_lang')
                                            ->tabs([
                                                Tabs\Tab::make('🇮🇩 Indonesia')
                                                    ->schema([
                                                        Grid::make(2)->schema([
                                                            TextInput::make('site_name.id')
                                                                ->label('Nama Situs (ID)')
                                                                ->placeholder('contoh: Politeknik Kampar')
                                                                ->required(),
                                                            TextInput::make('site_tagline.id')
                                                                ->label('Tagline / Slogan (ID)')
                                                                ->placeholder('contoh: Unggul, Inovatif, Terkemuka'),
                                                        ]),
                                                    ]),
                                                Tabs\Tab::make('🇬🇧 English')
                                                    ->schema([
                                                        Grid::make(2)->schema([
                                                            TextInput::make('site_name.en')
                                                                ->label('Site Name (EN)')
                                                                ->placeholder('e.g. Kampar Polytechnic'),
                                                            TextInput::make('site_tagline.en')
                                                                ->label('Tagline (EN)')
                                                                ->placeholder('e.g. Excellent, Innovative, Leading'),
                                                        ]),
                                                    ]),
                                            ]),
                                    ]),

                                Section::make('Media & Aset Logo')
                                    ->description('Unggah logo situs untuk tema terang, gelap, dan icon browser.')
                                    ->schema([
                                        Grid::make(3)->schema([
                                            FileUpload::make('logo_light')
                                                ->label('Logo Light (Background Terang)')
                                                ->image()
                                                ->directory('settings/logos')
                                                ->visibility('public')
                                                ->disk('public')
                                                ->imageEditor(),
                                            FileUpload::make('logo_dark')
                                                ->label('Logo Dark (Background Gelap)')
                                                ->image()
                                                ->directory('settings/logos')
                                                ->visibility('public')
                                                ->disk('public')
                                                ->imageEditor(),
                                            FileUpload::make('favicon')
                                                ->label('Favicon Browser')
                                                ->image()
                                                ->acceptedFileTypes(['image/x-icon', 'image/png', 'image/svg+xml'])
                                                ->directory('settings/favicons')
                                                ->visibility('public')
                                                ->disk('public'),
                                        ]),
                                    ]),
                            ]),

                        // ==========================================
                        // TAB 2: KONTAK & LOKASI
                        // ==========================================
                        Tabs\Tab::make('Kontak & Lokasi')
                            ->icon('heroicon-o-phone')
                            ->schema([
                                Section::make('Kontak Resmi')
                                    ->schema([
                                        Grid::make(3)->schema([
                                            TextInput::make('email')
                                                ->label('Email Utama')
                                                ->email(),
                                            TextInput::make('phone')
                                                ->label('Nomor Telepon')
                                                ->tel(),
                                            TextInput::make('whatsapp')
                                                ->label('Nomor WhatsApp')
                                                ->tel()
                                                ->placeholder('628xxxxxxxxxx'),
                                        ]),
                                    ]),

                                Section::make('Alamat & Operasional')
                                    ->schema([
                                        Tabs::make('contact_address_lang')
                                            ->tabs([
                                                Tabs\Tab::make('🇮🇩 Indonesia')
                                                    ->schema([
                                                        TextInput::make('working_hours.id')
                                                            ->label('Jam Operasional (ID)')
                                                            ->placeholder('contoh: Senin - Jumat (08:00 - 16:00 WIB)'),
                                                        Textarea::make('address.id')
                                                            ->label('Alamat Fisik Lengkap (ID)')
                                                            ->rows(3),
                                                    ]),
                                                Tabs\Tab::make('🇬🇧 English')
                                                    ->schema([
                                                        TextInput::make('working_hours.en')
                                                            ->label('Working Hours (EN)')
                                                            ->placeholder('e.g. Monday - Friday (08:00 AM - 04:00 PM)'),
                                                        Textarea::make('address.en')
                                                            ->label('Full Address (EN)')
                                                            ->rows(3),
                                                    ]),
                                            ]),

                                        Textarea::make('google_maps_embed')
                                            ->label('Google Maps Embed Code / Link')
                                            ->rows(3)
                                            ->helperText('Paste kode iFrame HTML dari Google Maps.'),
                                    ]),
                            ]),

                        // ==========================================
                        // TAB 3: TOP BAR & RUNNING TEXT
                        // ==========================================
                        Tabs\Tab::make('Running Text & Topbar')
                            ->icon('heroicon-o-megaphone')
                            ->schema([
                                Section::make('Kontrol Tampilan')
                                    ->schema([
                                        Grid::make(2)->schema([
                                            Toggle::make('is_topbar_active')
                                                ->label('Aktifkan Topbar')
                                                ->default(true),
                                            Toggle::make('is_announcement_active')
                                                ->label('Aktifkan Running Text / Ticker')
                                                ->default(true),
                                        ]),
                                    ]),

                                Section::make('Konten Pengumuman Ticker')
                                    ->schema([
                                        Tabs::make('topbar_announcement_lang')
                                            ->tabs([
                                                Tabs\Tab::make('🇮🇩 Indonesia')
                                                    ->schema([
                                                        Textarea::make('topbar_announcement.id')
                                                            ->label('Teks Running Text / Announcement (ID)')
                                                            ->rows(3)
                                                            ->placeholder('Tulis pesan running text pengumuman di sini...'),
                                                        TextInput::make('topbar_button_text.id')
                                                            ->label('Teks Tombol Aksi (ID)'),
                                                    ]),
                                                Tabs\Tab::make('🇬🇧 English')
                                                    ->schema([
                                                        Textarea::make('topbar_announcement.en')
                                                            ->label('Running Text / Announcement Content (EN)')
                                                            ->rows(3)
                                                            ->placeholder('Write running text announcement here...'),
                                                        TextInput::make('topbar_button_text.en')
                                                            ->label('Button Action Text (EN)'),
                                                    ]),
                                            ]),

                                        TextInput::make('topbar_button_url')
                                            ->label('URL Target Tombol')
                                            ->url()
                                            ->placeholder('https://...'),
                                    ]),
                            ]),

                        // ==========================================
                        // TAB 4: FOOTER & SOCIAL MEDIA
                        // ==========================================
                        Tabs\Tab::make('Footer & Social')
                            ->icon('heroicon-o-queue-list')
                            ->schema([
                                Section::make('Konten Footer')
                                    ->schema([
                                        Tabs::make('footer_lang')
                                            ->tabs([
                                                Tabs\Tab::make('🇮🇩 Indonesia')
                                                    ->schema([
                                                        Textarea::make('footer_description.id')
                                                            ->label('Deskripsi Singkat Footer (ID)')
                                                            ->rows(3),
                                                        TextInput::make('copyright_text.id')
                                                            ->label('Teks Copyright (ID)')
                                                            ->placeholder('© 2026 Politeknik Kampar. Hak Cipta Dilindungi.'),
                                                    ]),
                                                Tabs\Tab::make('🇬🇧 English')
                                                    ->schema([
                                                        Textarea::make('footer_description.en')
                                                            ->label('Short Footer Description (EN)')
                                                            ->rows(3),
                                                        TextInput::make('copyright_text.en')
                                                            ->label('Copyright Text (EN)')
                                                            ->placeholder('© 2026 Kampar Polytechnic. All Rights Reserved.'),
                                                    ]),
                                            ]),
                                    ]),

                                // ==========================================
                                // FITUR BARU: NAVIGASI FOOTER MULTI-KOLOM
                                // ==========================================
                                Section::make('Navigasi Footer Multi-Kolom')
                                    ->description('Kelola kelompok menu navigasi footer beserta tautan di dalamnya.')
                                    ->schema([
                                        Repeater::make('footer_navigation')
                                            ->label('Daftar Kolom Navigasi')
                                            ->grid(3)
                                            ->schema([
                                                // Judul Kolom Navigasi (Multi-Lang)
                                                Tabs::make('column_title_lang')
                                                    ->tabs([
                                                        Tabs\Tab::make('🇮🇩 Indonesia')
                                                            ->schema([
                                                                TextInput::make('title.id')
                                                                    ->label('Judul Kolom (ID)')
                                                                    ->placeholder('contoh: Tautan Cepat')
                                                                    ->required(),
                                                            ]),
                                                        Tabs\Tab::make('🇬🇧 English')
                                                            ->schema([
                                                                TextInput::make('title.en')
                                                                    ->label('Column Title (EN)')
                                                                    ->placeholder('e.g. Quick Links'),
                                                            ]),
                                                    ]),

                                                // Sub-Item Links dalam Kolom Ini
                                                Repeater::make('links')
                                                    ->label('Daftar Tautan')
                                                    ->schema([
                                                        Tabs::make('link_label_lang')
                                                            ->tabs([
                                                                Tabs\Tab::make('🇮🇩 Indonesia')
                                                                    ->schema([
                                                                        TextInput::make('label.id')
                                                                            ->label('Label Tautan (ID)')
                                                                            ->placeholder('contoh: Tentang Kami')
                                                                            ->required(),
                                                                    ]),
                                                                Tabs\Tab::make('🇬🇧 English')
                                                                    ->schema([
                                                                        TextInput::make('label.en')
                                                                            ->label('Link Label (EN)')
                                                                            ->placeholder('e.g. About Us'),
                                                                    ]),
                                                            ]),

                                                        Grid::make(2)->schema([
                                                            TextInput::make('url')
                                                                ->label('URL / Target Link')
                                                                ->placeholder('/tentang-kami atau https://...')
                                                                ->required(),
                                                            Toggle::make('open_in_new_tab')
                                                                ->label('Buka di Tab Baru (_blank)')
                                                                ->default(false),
                                                        ]),
                                                    ])
                                                    ->collapsible()
                                                    ->itemLabel(fn(array $state): ?string => $state['label']['id'] ?? $state['label']['en'] ?? 'Tautan Baru')
                                                    ->addActionLabel('Tambah Tautan Link'),
                                            ])
                                            ->collapsible()
                                            ->itemLabel(fn(array $state): ?string => $state['title']['id'] ?? $state['title']['en'] ?? 'Kolom Navigasi Baru')
                                            ->addActionLabel('Tambah Kolom Navigasi')
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Media Sosial')
                                    ->schema([
                                        Repeater::make('social_links')
                                            ->label('Daftar Media Sosial')
                                            ->schema([
                                                Select::make('platform')
                                                    ->options([
                                                        'facebook'  => 'Facebook',
                                                        'instagram' => 'Instagram',
                                                        'youtube'   => 'YouTube',
                                                        'tiktok'    => 'TikTok',
                                                        'linkedin'  => 'LinkedIn',
                                                        'x'         => 'X (Twitter)',
                                                    ])
                                                    ->required(),
                                                TextInput::make('url')
                                                    ->label('URL Profil')
                                                    ->url()
                                                    ->required(),
                                            ])
                                            ->columns(2)
                                            ->collapsible()
                                            ->itemLabel(fn(array $state): ?string => $state['platform'] ?? null)
                                            ->addActionLabel('Tambah Sosial Media'),
                                    ]),
                            ]),

                        // ==========================================
                        // TAB 5: OPTIMASI SEO & META
                        // ==========================================
                        Tabs\Tab::make('SEO & Social Share')
                            ->icon('heroicon-o-globe-alt')
                            ->schema([
                                Section::make('Pencarian Google (Meta Tag)')
                                    ->schema([
                                        Tabs::make('seo_meta_lang')
                                            ->tabs([
                                                Tabs\Tab::make('🇮🇩 Indonesia')
                                                    ->schema([
                                                        TextInput::make('meta_title.id')
                                                            ->label('Meta Title (ID)')
                                                            ->maxLength(60),
                                                        Textarea::make('meta_description.id')
                                                            ->label('Meta Description (ID)')
                                                            ->rows(3)
                                                            ->maxLength(160),
                                                        TextInput::make('meta_keywords.id')
                                                            ->label('Meta Keywords (ID)')
                                                            ->placeholder('politeknik, vokasi, kampus unggul'),
                                                    ]),
                                                Tabs\Tab::make('🇬🇧 English')
                                                    ->schema([
                                                        TextInput::make('meta_title.en')
                                                            ->label('Meta Title (EN)')
                                                            ->maxLength(60),
                                                        Textarea::make('meta_description.en')
                                                            ->label('Meta Description (EN)')
                                                            ->rows(3)
                                                            ->maxLength(160),
                                                        TextInput::make('meta_keywords.en')
                                                            ->label('Meta Keywords (EN)')
                                                            ->placeholder('polytechnic, vocational, campus'),
                                                    ]),
                                            ]),
                                    ]),

                                Section::make('Social Share (Open Graph & Twitter)')
                                    ->schema([
                                        Tabs::make('seo_og_lang')
                                            ->tabs([
                                                Tabs\Tab::make('🇮🇩 Indonesia')
                                                    ->schema([
                                                        TextInput::make('og_title.id')
                                                            ->label('OG Title (ID)'),
                                                        Textarea::make('og_description.id')
                                                            ->label('OG Description (ID)')
                                                            ->rows(2),
                                                    ]),
                                                Tabs\Tab::make('🇬🇧 English')
                                                    ->schema([
                                                        TextInput::make('og_title.en')
                                                            ->label('OG Title (EN)'),
                                                        Textarea::make('og_description.en')
                                                            ->label('OG Description (EN)')
                                                            ->rows(2),
                                                    ]),
                                            ]),

                                        Grid::make(2)->schema([
                                            Select::make('twitter_card_type')
                                                ->label('Tipe Twitter Card')
                                                ->options([
                                                    'summary' => 'Summary (Kecil)',
                                                    'summary_large_image' => 'Summary Large Image (Besar)',
                                                ])
                                                ->default('summary_large_image'),
                                            FileUpload::make('og_image')
                                                ->label('OG Image (Thumbnail saat link di-share)')
                                                ->image()
                                                ->directory('settings/seo'),
                                        ]),
                                    ]),

                                Section::make('Pengaturan Web Crawler (Robots)')
                                    ->schema([
                                        Grid::make(3)->schema([
                                            Toggle::make('seo_robots_index')
                                                ->label('Izinkan Indexing (Index)')
                                                ->default(true),
                                            Toggle::make('seo_robots_follow')
                                                ->label('Izinkan Follow Links (Follow)')
                                                ->default(true),
                                            TextInput::make('canonical_url')
                                                ->label('Canonical URL (Opsional)')
                                                ->url(),
                                        ]),
                                    ]),
                            ]),

                        // ==========================================
                        // TAB 6: ANALYTICS & SCRIPTS
                        // ==========================================
                        Tabs\Tab::make('Analytics & Scripts')
                            ->icon('heroicon-o-code-bracket')
                            ->schema([
                                Section::make('Tracking & Analytics ID')
                                    ->schema([
                                        Grid::make(2)->schema([
                                            TextInput::make('google_analytics_id')
                                                ->label('Google Analytics Measurement ID')
                                                ->placeholder('G-XXXXXXXXXX'),
                                            TextInput::make('google_tag_manager_id')
                                                ->label('Google Tag Manager ID')
                                                ->placeholder('GTM-XXXXXXX'),
                                        ]),
                                    ]),

                                Section::make('Injeksi Script Custom')
                                    ->description('Masukkan script CSS/JS pihak ketiga secara langsung.')
                                    ->schema([
                                        Textarea::make('custom_head_scripts')
                                            ->label('Script di dalam Tag <head>')
                                            ->rows(4)
                                            ->placeholder('<script>...</script> atau <style>...</style>'),
                                        Textarea::make('custom_body_scripts')
                                            ->label('Script sebelum penutup Tag </body>')
                                            ->rows(4)
                                            ->placeholder('<script>...</script>'),
                                    ]),
                            ]),

                    ])->columnSpanFull(),
            ])
            ->statePath('data');
    }

    /**
     * Action Tombol Simpan di Header
     */
    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Perubahan')
                ->submit('save')
                ->keyBindings(['mod+s']),
        ];
    }

    /**
     * Aksi Penyimpanan Data ke Database
     */
    public function save(): void
    {
        $data = $this->form->getState();

        $setting = SiteSetting::firstOrCreate(['id' => 1]);
        $setting->update($data);

        Notification::make()
            ->title('Pengaturan Berhasil Disimpan!')
            ->success()
            ->send();
    }
}
