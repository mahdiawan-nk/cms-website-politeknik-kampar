<?php

namespace App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks;

use Filament\Actions\Action;
use Filament\Forms\Components\Builder;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\RichEditor\RichContentCustomBlock;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use Filament\Forms\Components\RichEditor;
use App\Filament\Support\PageBuilderBlocks;
class TwoGridLayout extends RichContentCustomBlock
{
    public static function getId(): string
    {
        return 'two_grid_layout';
    }

    public static function getLabel(): string
    {
        return 'Two grid layout';
    }

    public static function configureEditorAction(Action $action): Action
    {
        return $action
            ->modalDescription('Configure the two grid layout')
            ->modalWidth('full')
            ->schema([
                Grid::make(3)
                    ->schema([
                        Builder::make('left')
                            ->label('Left Column')
                            ->blocks(
                                PageBuilderBlocks::make()
                            )
                            ->collapsible()
                            ->cloneable()
                            ->reorderable(),

                        Builder::make('right')
                            ->label('Right Column')
                            ->blocks(
                                PageBuilderBlocks::make()
                            )
                            ->columnSpan('2')
                            ->collapsible()
                            ->cloneable()
                            ->reorderable(),
                    ]),
            ]);
    }

    public static function toPreviewHtml(array $config): string
    {
        return view('filament.forms.components.rich-editor.rich-content-custom-blocks.two-grid-layout.preview', [
            'data' => $config
        ])->render();
    }

    public static function toHtml(array $config, array $data): string
    {
        return view('filament.forms.components.rich-editor.rich-content-custom-blocks.two-grid-layout.index', [
            'data' => $config
        ])->render();
    }

    public static function blockBuilder(): array
    {
        return [
            Block::make('heading')
                ->schema([
                    TextInput::make('content')
                        ->label('Heading')
                        ->required(),
                    Select::make('level')
                        ->options([
                            'h1' => 'Heading 1',
                            'h2' => 'Heading 2',
                            'h3' => 'Heading 3',
                            'h4' => 'Heading 4',
                            'h5' => 'Heading 5',
                            'h6' => 'Heading 6',
                        ])
                        ->required(),
                ])
                ->columns(2),
            Block::make('paragraph')
                ->schema([
                    Textarea::make('content')
                        ->label('Paragraph')
                        ->required(),
                ]),
            Block::make('image')
                ->schema([
                    FileUpload::make('url')
                        ->label('Image')
                        ->disk('public')
                        ->directory('atachment')
                        ->visibility('public')
                        ->image()
                        ->required(),
                    TextInput::make('alt')
                        ->label('Alt text')
                        ->required(),

                ]),
        ];
    }
}
