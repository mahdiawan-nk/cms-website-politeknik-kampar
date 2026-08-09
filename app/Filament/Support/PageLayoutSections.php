<?php

namespace App\Filament\Support;

use Filament\Forms\Components\Builder;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\{Get, Set};
use App\Filament\Support\PageBuilderBlocks;
class PageLayoutSections
{
    public static function make(): array
    {
        return [
            static::singleColumn(),
            static::twoColumn(),
            static::twoColumnOneTwo(),
            static::twoColumnTwoOne(),
            static::threeColumn(),
            static::galleryGrid(),
        ];
    }

    protected static function builder(string $name, string $label): Builder
    {
        return Builder::make($name)
            ->label($label)
            ->blocks(PageBuilderBlocks::make())
            ->collapsible()
            ->cloneable()
            ->reorderable();
    }

    protected static function singleColumn(): Section
    {
        return Section::make('Single Column')
            ->visible(fn(Get $get) => $get('content.layout_type') === 'single_col')
            ->schema([
                static::builder('content.columns.main', 'Content'),
            ]);
    }

    protected static function twoColumn(): Section
    {
        return Section::make('Two Columns')
            ->columns(2)
            ->visible(fn(Get $get) => $get('content.layout_type') === 'two_col' || $get('content.layout_type')== 'kata_sambutan')
            ->schema([
                static::builder('content.columns.left', 'Left'),
                static::builder('content.columns.right', 'Right'),
            ]);
    }

    protected static function twoColumnOneTwo(): Section
    {
        return Section::make('Two Columns (1/3 : 2/3)')
            ->columns(3)
            ->visible(fn(Get $get) => $get('content.layout_type') === 'two_col_1_2')
            ->schema([
                static::builder('content.columns.left', 'Left')
                    ->columnSpan(1),

                static::builder('content.columns.right', 'Right')
                    ->columnSpan(2),
            ]);
    }

    protected static function twoColumnTwoOne(): Section
    {
        return Section::make('Two Columns (2/3 : 1/3)')
            ->columns(3)
            ->visible(fn(Get $get) => $get('content.layout_type') === 'two_col_2_1')
            ->schema([
                static::builder('content.columns.left', 'Left')
                    ->columnSpan(2),

                static::builder('content.columns.right', 'Right')
                    ->columnSpan(1),
            ]);
    }

    protected static function threeColumn(): Section
    {
        return Section::make('Three Columns')
            ->columns(3)
            ->visible(fn(Get $get) => $get('content.layout_type') === 'three_col')
            ->schema([
                static::builder('content.columns.col1', 'Column 1'),
                static::builder('content.columns.col2', 'Column 2'),
                static::builder('content.columns.col3', 'Column 3'),
            ]);
    }

    protected static function galleryGrid(): Section
    {
        return Section::make('Gallery Grid')
            ->visible(fn(Get $get) => $get('content.layout_type') === 'gallery_grid')
            ->schema([
                Builder::make('content.columns.gallery')
                    ->label('Gallery')
                    ->blocks([
                        PageBuilderBlocks::image(),
                    ])
                    ->cloneable()
                    ->reorderable(),
            ]);
    }
}
