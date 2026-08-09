<?php

namespace App\Filament\Resources\Navigations\Schemas;

use App\Models\Navigation;
use Filament\Schemas\Components\{Section, Tabs};
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Utilities\{Get, Set};
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Page;
use Illuminate\Support\HtmlString;

class NavigationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(12)
            ->components([

                Section::make('Navigation Information')
                    ->columnSpan(8)
                    ->schema([

                        Tabs::make('translations')
                            ->contained(false)
                            ->tabs([

                                Tab::make('Indonesia')
                                    ->icon('heroicon-o-language')
                                    ->schema([
                                        TextInput::make('label.id')
                                            ->label('Menu Label')
                                            ->placeholder('Contoh: Profil')
                                            ->required(),
                                    ]),

                                Tab::make('English')
                                    ->icon('heroicon-o-language')
                                    ->schema([
                                        TextInput::make('label.en')
                                            ->label('Menu Label')
                                            ->placeholder('Example: Profile')
                                            ->required(),
                                    ]),

                            ]),

                        Select::make('type')
                            ->label('Link Type')
                            ->options([
                                'internal' => 'Internal Page',
                                'external' => 'External URL',
                                'nolink'   => 'No Link (Dropdown / Text Only)', // Tambahan Opsi Untuk Parent Tanpa Link
                            ])
                            ->default('internal')
                            ->live()
                            ->afterStateUpdated(function (Set $set, Get $get, ?string $state) {
                                if ($state === 'external') {
                                    $set('url', null);
                                } elseif ($state === 'nolink') {
                                    $set('url', '#'); // Set menjadi hashtag jika hanya dropdown
                                    $set('page_id', null);
                                } elseif ($state === 'internal' && $get('page_id')) {
                                    $page = Page::find($get('page_id'));
                                    if ($page) {
                                        $set('url', 'page/' . $page->slug);
                                    }
                                }
                            })
                            ->required(),

                        Select::make('page_id')
                            ->label('Page')
                            ->relationship('page', 'title')
                            ->searchable()
                            ->preload()
                            ->visible(fn(Get $get) => $get('type') === 'internal')
                            ->live()
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                if ($state) {
                                    $page = Page::find($state);
                                    if ($page) {
                                        $set('url', 'page/' . $page->slug);
                                    }
                                } else {
                                    $set('url', null);
                                }
                            }),

                        TextInput::make('url')
                            ->label(fn(Get $get) => $get('type') === 'internal' ? 'Generated Internal URL' : 'External URL')
                            ->placeholder(fn(Get $get) => $get('type') === 'internal' ? 'Otomatis diisi dari halaman...' : 'https://example.com')
                            // Readonly jika tipenya internal atau nolink
                            ->readOnly(fn(Get $get) => in_array($get('type'), ['internal', 'nolink']))
                            // Sembunyikan field URL sepenuhnya jika tipenya nolink agar form lebih rapi
                            ->visible(fn(Get $get) => $get('type') !== 'nolink')
                            ->dehydrated() // Memastikan nilai URL (contoh: '#') tetap disimpan ke DB meski visible-nya false
                            ->required(fn(Get $get) => $get('type') !== 'nolink')
                            ->rules([
                                fn(Get $get) => $get('type') === 'external' ? 'url' : null,
                            ]),

                    ]),

                Section::make('Navigation Settings')
                    ->columnSpan(4)
                    ->schema([

                        // INDIKATOR HIERARKI MENU DINAMIS
                        Placeholder::make('menu_level')
                            ->label('Posisi Menu (Hierarchy)')
                            ->content(function (Get $get) {
                                $parentId = $get('parent_id');

                                // Jika tidak ada parent, berarti ini adalah Root
                                if (! $parentId) {
                                    return new HtmlString('<span class="text-primary-600 font-medium">✨ Level 1 (Parent / Root Menu)</span><br><span class="text-xs text-gray-500">Menu utama pada navigasi.</span>');
                                }

                                $parent = Navigation::find($parentId);
                                if (! $parent) return '-';

                                // Jika parent-nya tidak punya parent lagi, berarti ini Level 2
                                if ($parent->parent_id === null) {
                                    return new HtmlString('<span class="text-success-600 font-medium">↳ Level 2 (Sub Menu)</span><br><span class="text-xs text-gray-500">Berada di bawah menu utama.</span>');
                                }

                                // Jika parent-nya punya parent, berarti ini Level 3
                                return new HtmlString('<span class="text-warning-600 font-medium">↳ Level 3 (Child Menu)</span><br><span class="text-xs text-gray-500">Sub-menu terdalam.</span>');
                            }),

                        Select::make('parent_id')
                            ->label('Parent Menu')
                            ->options(fn() => static::getNavigationOptions())
                            ->searchable()
                            ->placeholder('Jadikan sebagai Root Menu (Kosongkan)')
                            ->live(), // Tambahkan live() agar Placeholder menu_level di atas bisa langsung ter-update

                        TextInput::make('order')
                            ->label('Display Order')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->required(),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),

                    ]),
            ]);
    }

    protected static function getNavigationOptions(): array
    {
        $menus = Navigation::query()
            ->orderBy('order')
            ->get();

        return static::buildTreeOptions($menus);
    }

    protected static function buildTreeOptions($menus, $parentId = null, $prefix = '')
    {
        $options = [];

        foreach ($menus->where('parent_id', $parentId) as $menu) {

            $label = data_get($menu->label, 'id')
                ?? data_get($menu->label, 'en')
                ?? 'Untitled';

            $options[$menu->id] = $prefix . $menu->getTranslation('label', 'id');

            $options += static::buildTreeOptions(
                $menus,
                $menu->id,
                $prefix . '— '
            );
        }

        return $options;
    }
}
