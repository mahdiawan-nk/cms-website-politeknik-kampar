<?php

namespace App\Filament\Resources\HomePageContents\Schemas;

use App\Enums\SectionType;
use Filament\Schemas\Components\{Grid, Section, Tabs, Flex};
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\{Get, Set};
use App\Filament\Resources\HomePageContents\Schemas\Blocks\CoverBlock;
use App\Filament\Resources\HomePageContents\Schemas\Blocks\SekilasProfilBlock;
use App\Filament\Resources\HomePageContents\Schemas\Blocks\StatsBlock;
use App\Filament\Resources\HomePageContents\Schemas\Blocks\ProdiBlock;
use App\Filament\Resources\HomePageContents\Schemas\Blocks\ServicesBlock;
use App\Filament\Resources\HomePageContents\Schemas\Blocks\StaffBlock;
use App\Filament\Resources\HomePageContents\Schemas\Blocks\TestimoniBlock;
use App\Filament\Resources\HomePageContents\Schemas\Blocks\MitraBlock;
use App\Filament\Resources\HomePageContents\Schemas\Blocks\GalleryVideoBlock;
use App\Filament\Actions\GenerateAiSampleAction;

class HomePageContentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Flex::make([

                    // KOLOM KIRI (1/3): Pengaturan Utama
                    Section::make()
                        ->visible(false)
                        ->schema([
                            Select::make('section_type')
                                ->label('Tipe Seksi (Section)')
                                ->options(SectionType::class)
                                ->searchable()
                                ->required()
                                ->live(), // Supaya dinamis jika ingin menambah logika kondisional nanti

                            TextInput::make('sort_order')
                                ->label('Urutan Tampil')
                                ->numeric()
                                ->default(0)
                                ->required()
                                ->helperText('Angka lebih kecil akan tampil lebih dulu.'),

                            Toggle::make('is_active')
                                ->label('Status Aktif')
                                ->default(true)
                                ->required(),
                        ])->grow(false),

                    // KOLOM KANAN (2/3): Konten Multi-Bahasa
                    Grid::make(1)
                        ->schema([
                            Section::make('Konten Header')
                                ->description('Isi teks dan media utama untuk section ini.')
                                ->headerActions([
                                    GenerateAiSampleAction::make('generateHeaderAi')
                                        ->label('Generate Konten AI')
                                        ->targetField('header') // Mengisi state 'header.id' dan 'header.en' sekaligus
                                        ->form([
                                            // 1. Opsi Template Topik
                                            Select::make('template')
                                                ->label('Pilih Template Topik Header')
                                                ->options([
                                                    'testimonials'  => '🎓 Testimoni Alumni',
                                                    'prodi'         => '📚 Pilihan Program Studi',
                                                    'services'      => '💻 Layanan Digital Kampus',
                                                    'staff'         => '👨‍🏫 Sivitas Pengajar & Tendik Staff',
                                                    'partners'      => '🤝 Mitra Partner Kampus',
                                                    'video_gallery' => '🎥 Galeri Video',
                                                    'custom'        => '✍️ Custom / Prompt Bebas',
                                                ])
                                                ->default('berita')
                                                ->required(),

                                            // 2. Custom Prompt / Instruksi Tambahan
                                            Textarea::make('custom_prompt')
                                                ->label('Instruksi / Prompt Tambahan (Opsional)')
                                                ->placeholder('Contoh: Fokuskan pada inovasi teknologi dan akreditasi A...')
                                                ->rows(3),
                                        ])
                                        ->prompt(function (array $data): string {
                                            $templates = [
                                                'testimonials'  => 'Testimoni Alumni: Kisah sukses alumni, pengalaman berkuliah, dan pencapaian karir di industri',
                                                'prodi'         => 'Pilihan Program Studi: Informasi jurusan/prodi unggulan kampus, keahlian, dan prospek karir masa depan',
                                                'services'      => 'Layanan Digital Kampus: Portal akademik SIAKAD, e-learning, perpustakaan digital, dan fasilitas IT',
                                                'staff'         => 'Sivitas Pengajar & Tendik Staff: Profesi profil dosen pengajar, kualifikasi akademik, dan tenaga kependidikan',
                                                'partners'      => 'Mitra Partner Kampus: Kerja sama perusahaan, instansi pemerintah, dan jaringan industri kampus',
                                                'video_gallery' => 'Galeri Video: Dokumentasi kegiatan mahasiswa, tur kampus digital, dan liputan video acara resmi',
                                                'custom'        => 'Informasi umum universitas',
                                            ];

                                            $selectedTopic = $templates[$data['template']] ?? $templates['custom'];
                                            $extraInstruction = ! empty($data['custom_prompt'])
                                                ? "Instruksi spesifik dari pengguna: {$data['custom_prompt']}"
                                                : "";

                                            return "Buatkan konten header halaman depan website universitas dalam 2 BAHASA SEKALIGUS (Bahasa Indonesia 'id' dan Bahasa Inggris 'en') bertema: '{$selectedTopic}'. {$extraInstruction} " .
                                                "Format output HARUS JSON Object persis seperti struktur ini: " .
                                                "{" .
                                                "  \"id\": {\"badge\": \"...\", \"title\": \"...\", \"title_higlight\": \"...\", \"description\": \"...\"}," .
                                                "  \"en\": {\"badge\": \"...\", \"title\": \"...\", \"title_higlight\": \"...\", \"description\": \"...\"}" .
                                                "} " .
                                                "Aturan Teks: " .
                                                "- badge: 1-3 kata menarik (Contoh ID: 'Jejak Alumni' | EN: 'Alumni Stories') " .
                                                "- title: 2-3 kata awal judul utama " .
                                                "- title_higlight: 1-3 kata penutup/penjelas yang ditegaskan " .
                                                "- description: 1-2 kalimat deskripsi ringkas, informatif, dan persuasif.";
                                        }),
                                ])
                                ->schema([
                                    Tabs::make('Bahasa')
                                        ->tabs([
                                            // Tab Bahasa Indonesia
                                            Tabs\Tab::make('Indonesia (ID)')
                                                ->icon('heroicon-m-language')
                                                ->schema(self::getTranslatableFields('id')),

                                            // Tab Bahasa Inggris
                                            Tabs\Tab::make('English (EN)')
                                                ->icon('heroicon-m-language')
                                                ->schema(self::getTranslatableFields('en')),
                                        ])
                                        ->activeTab(1),
                                ]),
                        ]),
                ]),
                Section::make('Metadata / Konfigurasi Khusus')
                    ->schema([
                        Grid::make(1)
                            ->visible(fn(Get $get): bool => $get('section_type') === SectionType::COVER->value || $get('section_type') === SectionType::COVER)
                            ->schema(CoverBlock::schema()),
                        Grid::make(1)
                            ->visible(fn(Get $get): bool => $get('section_type') === SectionType::SEKILAS_PROFIL->value || $get('section_type') === SectionType::SEKILAS_PROFIL)
                            ->schema(SekilasProfilBlock::schema()),
                        Grid::make(1)
                            ->visible(fn(Get $get): bool => $get('section_type') === SectionType::STATS->value || $get('section_type') === SectionType::STATS)
                            ->schema(StatsBlock::schema()),
                        Grid::make(1)
                            ->visible(fn(Get $get): bool => $get('section_type') === SectionType::PRODI->value || $get('section_type') === SectionType::PRODI)
                            ->schema(ProdiBlock::schema()),
                        Grid::make(1)
                            ->visible(fn(Get $get): bool => $get('section_type') === SectionType::SERVICES->value || $get('section_type') === SectionType::SERVICES)
                            ->schema(ServicesBlock::schema()),
                        Grid::make(1)
                            ->visible(fn(Get $get): bool => $get('section_type') === SectionType::STAFF->value || $get('section_type') === SectionType::STAFF)
                            ->schema(StaffBlock::schema()),
                        Grid::make(1)
                            ->visible(fn(Get $get): bool => $get('section_type') === SectionType::TESTIMONI->value || $get('section_type') === SectionType::TESTIMONI)
                            ->schema(TestimoniBlock::schema()),
                        Grid::make(1)
                            ->visible(fn(Get $get): bool => $get('section_type') === SectionType::MITRA->value || $get('section_type') === SectionType::MITRA)
                            ->schema(MitraBlock::schema()),
                        Grid::make(1)
                            ->visible(fn(Get $get): bool => $get('section_type') === SectionType::VIDEO->value || $get('section_type') === SectionType::VIDEO)
                            ->schema(GalleryVideoBlock::schema()),
                    ])
                    ->collapsible(),


            ])
            ->columns(1);
    }

    /**
     * Method helper agar form tidak DRY (Don't Repeat Yourself)
     * Meng-generate field input secara otomatis berdasarkan kode bahasa ($locale)
     */
    private static function getTranslatableFields(string $locale): array
    {
        return [
            Grid::make(3)
                ->schema([
                    // 1. Badge (Lebar Penuh)
                    TextInput::make("header.{$locale}.badge")
                        ->label('Badge / Label Atas')
                        ->placeholder('Contoh: Kabar Kampus')
                        ->maxLength(255)
                        ->columnSpan(1),

                    // 2. Judul Utama (Kolom 1)
                    TextInput::make("header.{$locale}.title")
                        ->label('Judul Utama (Title)')
                        ->placeholder('Contoh: Informasi &')
                        ->maxLength(255)
                        ->columnSpan(1),

                    // 3. Judul Highlight (Kolom 2)
                    TextInput::make("header.{$locale}.title_higlight")
                        ->label('Judul Highlight')
                        ->placeholder('Contoh: Berita Terkini')
                        ->maxLength(255)
                        ->columnSpan(1),

                    // 4. Deskripsi (Lebar Penuh)
                    Textarea::make("header.{$locale}.description")
                        ->label('Deskripsi Singkat')
                        ->placeholder('Contoh: Ikuti perkembangan terbaru dan wawasan ilmiah dari lingkungan kampus kami...')
                        ->rows(3)
                        ->columnSpanFull(),
                ]),
        ];
    }
}
