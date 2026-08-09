<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            // Urutan default berdasarkan 'sort_order'
            ->defaultSort('sort_order', 'asc')
            // Aktifkan fitur drag & drop untuk mengubah urutan secara langsung
            ->reorderable('sort_order')
            ->columns([
                // 1. Badge Urutan Tampilan
                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable()
                    ->alignCenter()
                    ->badge()
                    ->color('gray'),

                // 2. Nama Kategori (Multi-Bahasa) + Sub-Deskripsi
                TextColumn::make('name')
                    ->label('Nama Kategori')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn($record): string => $record->getTranslation('description', app()->getLocale()) ?? '-'),

                // 3. Slug URL (Dengan Fitur Copy to Clipboard)
                TextColumn::make('slug')
                    ->label('Slug / URL')
                    ->searchable()
                    ->badge()
                    ->color('info')
                    ->fontFamily('mono')
                    ->copyable()
                    ->copyMessage('Slug berhasil disalin!')
                    ->copyMessageDuration(1500),

                // 4. Hitung Jumlah Artikel / Post di Kategori Ini
                TextColumn::make('posts_count')
                    ->label('Total Artikel')
                    ->counts('posts')
                    ->sortable()
                    ->alignCenter()
                    ->badge()
                    ->color('success'),

                // 5. Waktu Dibuat & Diperbarui
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
