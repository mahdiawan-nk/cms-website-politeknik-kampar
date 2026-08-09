<?php

namespace App\Filament\Resources\HeroSlides\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class HeroSlidesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order', 'asc')
            ->columns([
                // 1. Media Preview
                ImageColumn::make('image_url')
                    ->label('Image')
                    ->square()
                    ->size(60),

                // 2. Translatable Text Content (Tagline, Title, Description)
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->weight('bold')
                    ->wrap()
                    ->limit(50)
                    ->description(fn($record): string => $record->tagline ? "Tagline: " . $record->tagline : ''),

                TextColumn::make('description')
                    ->label('Description')
                    ->searchable()
                    ->limit(60)
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),

                // 3. Status Toggle (Dapat diubah langsung dari tabel)
                ToggleColumn::make('is_active')
                    ->label('Active'),

                // 4. Ordering
                TextColumn::make('sort_order')
                    ->label('Order')
                    ->numeric()
                    ->sortable()
                    ->alignCenter(),

                // 5. Visibility Indicators (Digabung dalam kolom tersembunyi agar tabel tidak semak)
                IconColumn::make('show_tagline')
                    ->label('Tagline Visible')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('show_title')
                    ->label('Title Visible')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('show_description')
                    ->label('Desc Visible')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('show_primary_button')
                    ->label('Btn 1 Visible')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('show_secondary_button')
                    ->label('Btn 2 Visible')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),

                // 6. URLs
                TextColumn::make('primary_button_url')
                    ->label('Primary Link')
                    ->icon('heroicon-m-link')
                    ->limit(20)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('secondary_button_url')
                    ->label('Secondary Link')
                    ->icon('heroicon-m-link')
                    ->limit(20)
                    ->toggleable(isToggledHiddenByDefault: true),

                // 7. Timestamps
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        true => 'Active Only',
                        false => 'Inactive Only',
                    ]),
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
