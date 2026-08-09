<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\{Get, Set};
use Illuminate\Support\Str;
use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\TwoGridLayout;
use Filament\Forms\Components\RichEditor;
use App\Filament\Support\PageLayoutSections;
class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Translations')
                    ->columnSpanFull()
                    ->tabs([
                        // --- TAB BAHASA INDONESIA ---
                        Tabs\Tab::make('🇮🇩 Indonesia (ID)')
                            ->schema([
                                TextInput::make('title.id')
                                    ->label('Judul Halaman')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(
                                        fn(string $operation, $state, Set $set) =>
                                        $operation === 'create' ? $set('slug.id', Str::slug($state)) : null
                                    ),

                                TextInput::make('slug.id')
                                    ->label('Slug / URL (ID)')
                                    ->required()
                                    ->unique(
                                        table: 'pages', // Tentukan nama tabelnya
                                        column: 'slug->id', // Gunakan syntax JSON path Laravel
                                        ignoreRecord: true
                                    ),

                                Textarea::make('seo.id.description')
                                    ->label('Meta Description (ID)')
                                    ->rows(3),
                            ])->columns(2),

                        // --- TAB ENGLISH ---
                        Tabs\Tab::make('🇬🇧 English (EN)')
                            ->schema([
                                TextInput::make('title.en')
                                    ->label('Page Title')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(
                                        fn(string $operation, $state, Set $set) =>
                                        $operation === 'create' ? $set('slug.en', Str::slug($state)) : null
                                    ),

                                TextInput::make('slug.en')
                                    ->label('Slug / URL (EN)')
                                    ->required()
                                    ->unique(
                                        table: 'pages',
                                        column: 'slug->en', // Gunakan syntax JSON path Laravel
                                        ignoreRecord: true
                                    ),

                                Textarea::make('seo.en.description')
                                    ->label('Meta Description (EN)')
                                    ->rows(3),
                            ])->columns(2),
                    ]),

                // SECTION GLOBAL (Tidak Multi-bahasa)
                Section::make('Konten & Status')
                    ->schema([
                        Select::make('content.layout_type')
                            ->label('Layout Type')
                            ->options([
                                'single_col'       => 'Single Column',
                                'two_col'          => 'Two Columns (1:1)',
                                'two_col_1_2'      => 'Two Columns (1/3 : 2/3)',
                                'two_col_2_1'      => 'Two Columns (2/3 : 1/3)',
                                'three_col'        => 'Three Columns',
                                'gallery_grid'     => 'Gallery Grid',
                                'kata_sambutan'    => 'Kata Sambutan Direktur'
                            ])
                            ->default('single_col')
                            ->live()
                            ->native(false)
                            ->required(),
                        ...PageLayoutSections::make(),
                    ]),
            ])
            ->columns(1);
    }
}
