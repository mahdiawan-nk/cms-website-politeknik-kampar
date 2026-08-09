<?php

namespace App\Filament\Resources\Navigations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Grouping\Group;

class NavigationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('order')
            ->groups([
                Group::make('parent_id')
                    ->label('Parent')
                    ->collapsible()
                    ->getTitleFromRecordUsing(
                        fn($record) => $record->parent_label
                    ),
            ])

            ->defaultGroup('parent_id')
            ->columns([
                TextColumn::make('label')
                    ->label('Nama Menu')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('type')
                    ->searchable(),
                TextColumn::make('page.title')
                    ->searchable(),
                TextColumn::make('url')
                    ->searchable(),
                TextColumn::make('parent_label')
                    ->label('Parent')
                    ->searchable(),
                TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
