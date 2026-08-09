<?php

namespace App\Filament\Support;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use AmidEsfahani\FilamentTinyEditor\TinyEditor;

class PageBuilderBlocks
{
    public static function make(): array
    {
        return [

            static::badge(),

            static::heading(),

            static::subtitle(),

            static::paragraph(),

            static::richEditor(),

            static::quote(),

            static::image(),

            static::button(),

            static::divider(),

            static::signature(),

            static::statistic(),

            static::featureCard(),

        ];
    }

    protected static function badge(): Block
    {
        return Block::make('badge')
            ->label('Badge')
            ->schema([
                TextInput::make('text')
                    ->label('Badge Text')
                    ->required(),
            ]);
    }

    protected static function heading(): Block
    {
        return Block::make('heading')
            ->label('Heading')
            ->schema([
                TextInput::make('content')
                    ->required(),

                Select::make('level')
                    ->options([
                        'h1' => 'Heading 1',
                        'h2' => 'Heading 2',
                        'h3' => 'Heading 3',
                        'h4' => 'Heading 4',
                        'h5' => 'Heading 5',
                    ])
                    ->default('h2')
                    ->required(),
            ])
            ->columns(2);
    }

    protected static function subtitle(): Block
    {
        return Block::make('subtitle')
            ->label('Subtitle')
            ->schema([
                TextInput::make('content')
                    ->required(),
            ]);
    }

    protected static function paragraph(): Block
    {
        return Block::make('paragraph')
            ->label('Paragraph')
            ->schema([
                Textarea::make('content')
                    ->rows(5)
                    ->required(),
            ]);
    }

    protected static function richEditor(): Block
    {
        return Block::make('richeditor')
            ->label('Rich Editor')
            ->schema([
                // RichEditor::make('content')
                //     ->fileAttachmentsDisk('public')
                //     ->fileAttachmentsDirectory('attachments')
                //     ->fileAttachmentsVisibility('public')
                //     ->columnSpanFull(),
                TinyEditor::make("content")
                    ->label('Konten')
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsVisibility('public')
                    ->fileAttachmentsDirectory('attachments')
                    ->profile('full')
                    ->direction('ltr') // Set RTL or use ->direction('auto|rtl|ltr')
                    ->columnSpan('full')
                    ->required(),

            ]);
    }

    protected static function quote(): Block
    {
        return Block::make('quote')
            ->label('Quote')
            ->schema([
                Textarea::make('content')
                    ->rows(4)
                    ->required(),

                TextInput::make('author'),
            ]);
    }

    public static function image(): Block
    {
        return Block::make('image')
            ->label('Image')
            ->schema([
                FileUpload::make('url')
                    ->disk('public')
                    ->directory('attachments')
                    ->visibility('public')
                    ->image()
                    ->required(),

                TextInput::make('alt'),
            ]);
    }

    protected static function button(): Block
    {
        return Block::make('button')
            ->label('Button')
            ->schema([
                TextInput::make('text')
                    ->required(),

                TextInput::make('url')
                    ->label('Link')
                    ->required(),

                Select::make('target')
                    ->options([
                        '_self' => 'Same Tab',
                        '_blank' => 'New Tab',
                    ])
                    ->default('_self'),
            ]);
    }

    protected static function divider(): Block
    {
        return Block::make('divider')
            ->label('Divider')
            ->schema([]);
    }

    protected static function signature(): Block
    {
        return Block::make('signature')
            ->label('Signature')
            ->schema([
                TextInput::make('name')
                    ->required(),

                TextInput::make('position')
                    ->required(),
            ]);
    }

    protected static function statistic(): Block
    {
        return Block::make('statistic')
            ->label('Statistic')
            ->schema([
                TextInput::make('value')
                    ->required(),

                TextInput::make('label')
                    ->required(),
            ]);
    }

    protected static function featureCard(): Block
    {
        return Block::make('feature_card')
            ->label('Feature Card')
            ->schema([
                FileUpload::make('icon')
                    ->disk('public')
                    ->directory('attachments')
                    ->visibility('public')
                    ->image(),

                TextInput::make('title')
                    ->required(),

                Textarea::make('description')
                    ->rows(3),
            ]);
    }
}
