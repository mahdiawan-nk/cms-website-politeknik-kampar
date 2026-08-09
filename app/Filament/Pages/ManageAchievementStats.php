<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use UnitEnum;
use BackedEnum;
use App\Enums\ColorTheme;
use App\Models\AchivementStat;
use Filament\Actions\Action;
use Filament\Schemas\Components\{Grid, Tabs};
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema as Form;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class ManageAchievementStats extends Page
{
    use HasPageShield;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';
    protected static string | UnitEnum | null $navigationGroup = 'Akademik & Prestasi';
    protected static ?string $navigationLabel = 'Statistik Prestasi';
    protected static ?string $title = 'Kelola Statistik Prestasi';
    protected string $view = 'filament.pages.manage-achievement-stats';

    public ?array $data = [];

    public function mount(): void
    {
        // Ambil semua data statistik dari database
        $stats = AchivementStat::ordered()->get();

        if ($stats->isNotEmpty()) {
            // Jika data sudah ada, format data untuk diisikan ke Form State
            $formattedStats = $stats->map(function ($stat) {
                return [
                    'id' => $stat->id,
                    'value' => $stat->value,
                    'suffix' => $stat->suffix,
                    'color_theme' => $stat->color_theme->value ?? $stat->color_theme,
                    'label_id' => $stat->getTranslation('label', 'id', false),
                    'label_en' => $stat->getTranslation('label', 'en', false),
                ];
            })->toArray();

            $this->form->fill(['stats' => $formattedStats]);
        } else {
            // Jika data masih kosong, inisialisasi form kosong
            $this->form->fill(['stats' => []]);
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Repeater::make('stats')
                    ->label('Daftar Angka & Statistik')
                    ->grid(2)
                    ->schema([
                        Hidden::make('id'),
                        Tabs::make('Translasi Label')
                            ->tabs([
                                Tabs\Tab::make('Bahasa Indonesia')
                                    ->icon('heroicon-m-language')
                                    ->schema([
                                        TextInput::make('label_id')
                                            ->label('Label')
                                            ->required()
                                            ->placeholder('Contoh: Juara Internasional'),
                                    ]),

                                Tabs\Tab::make('Bahasa Inggris')
                                    ->icon('heroicon-m-globe-alt')
                                    ->schema([
                                        TextInput::make('label_en')
                                            ->label('Label')
                                            ->required()
                                            ->placeholder('Contoh: International Champions'),
                                    ]),
                            ])
                            ->columnSpanFull(),
                        Grid::make(3)->schema([
                            TextInput::make('value')
                                ->label('Nilai / Angka')
                                ->numeric()
                                ->required()
                                ->placeholder('Contoh: 120'),

                            TextInput::make('suffix')
                                ->label('Akhiran / Suffix')
                                ->placeholder('Contoh: +')
                                ->maxLength(10),
                            Select::make('color_theme')
                                ->label('Tema Warna Kartu')
                                ->options(collect(ColorTheme::cases())->mapWithKeys(fn($theme) => [
                                    $theme->value => $theme->label(),
                                ]))
                                ->required()
                                ->default(ColorTheme::EMERALD->value),
                        ]),


                    ])
                    ->orderColumn('sort_order')
                    ->defaultItems(1)
                    ->addActionLabel('Tambah Item Statistik')
                    ->reorderableWithButtons()
                    ->maxItems(4)
                    ->collapsible()
                    ->itemLabel(
                        fn(array $state): ?string =>
                        isset($state['value'])
                            ? "{$state['value']}" . ($state['suffix'] ?? '') . " — " . ($state['label_id'] ?? 'Statistik Baru')
                            : 'Statistik Baru'
                    ),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $state = $this->form->getState();
        $statsData = $state['stats'] ?? [];

        DB::transaction(function () use ($statsData) {
            // Ambil semua ID yang ada di form
            $submittedIds = collect($statsData)->pluck('id')->filter()->toArray();

            // Hapus data dari DB jika item dihapus dari repeater oleh user
            AchivementStat::whereNotIn('id', $submittedIds)->delete();

            // Prosess Upsert (Insert jika baru, Update jika sudah ada)
            foreach ($statsData as $index => $item) {
                $stat = AchivementStat::findOrNew($item['id'] ?? null);

                $stat->value = $item['value'];
                $stat->suffix = $item['suffix'] ?? null;
                $stat->color_theme = $item['color_theme'];
                $stat->sort_order = $index + 1;

                // Set translasi multi-bahasa Spatie
                $stat->setTranslation('label', 'id', $item['label_id']);
                $stat->setTranslation('label', 'en', $item['label_en']);

                $stat->save();
            }
        });

        Notification::make()
            ->title('Berhasil Disimpan')
            ->body('Data statistik prestasi telah diperbarui.')
            ->success()
            ->send();

        // Refresh form state agar ID baru terisi
        $this->mount();
    }
}
