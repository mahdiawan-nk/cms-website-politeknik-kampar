<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            // Urutan default: Artikel terbaru di atas
            ->defaultSort('created_at', 'desc')
            ->columns([
                // 1. Thumbnail Gambar Utama
                ImageColumn::make('featured_image_url')
                    ->label('Gambar')
                    ->square()
                    ->size(48)
                    ->disk('public'),

                // 2. Judul Artikel (Multi-Bahasa) + Sub-text Slug
                TextColumn::make('title')
                    ->label('Judul Artikel')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->wrap()
                    ->description(fn($record): string => $record->getTranslation('slug', app()->getLocale()) ?? '-'),

                // 3. Kategori (Multi-Bahasa Badge)
                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->formatStateUsing(fn($record) => $record->category?->getTranslation('name', app()->getLocale()) ?? '-')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),

                // 4. Penulis / Author
                TextColumn::make('author.name')
                    ->label('Penulis')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                // 5. Status Publikasi Badge
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'published' => 'success',
                        'draft'     => 'warning',
                        'archived'  => 'danger',
                        default     => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'published' => 'Dipublikasikan',
                        'draft'     => 'Draft',
                        'archived'  => 'Diarsipkan',
                        default     => $state,
                    })
                    ->sortable(),

                // 6. Waktu Publikasi
                TextColumn::make('published_at')
                    ->label('Tanggal Rilis')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(),

                // 7. Status Index Google (SEO)
                IconColumn::make('is_indexable')
                    ->label('Index Google')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->toggleable(isToggledHiddenByDefault: true),

                // 8. Timestamps
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

            /* -------------------------------------------------------------------------- */
            /*                                   FILTERS                                  */
            /* -------------------------------------------------------------------------- */
            ->filters([
                // 1. Filter Status (Draft, Published, Archived)
                SelectFilter::make('status')
                    ->label('Status Publikasi')
                    ->options([
                        'published' => 'Dipublikasikan',
                        'draft'     => 'Draft',
                        'archived'  => 'Diarsipkan',
                    ]),

                // 2. Filter berdasarkan Kategori Multi-Bahasa
                SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->getOptionLabelFromRecordUsing(fn($record) => $record->getTranslation('name', app()->getLocale()))
                    ->searchable()
                    ->preload(),

                // 3. Filter berdasarkan Penulis / Author
                SelectFilter::make('author_id')
                    ->label('Penulis')
                    ->relationship('author', 'name')
                    ->searchable()
                    ->preload(),

                // 4. Filter Status SEO (Allowed vs NoIndex)
                TernaryFilter::make('is_indexable')
                    ->label('Status Index SEO')
                    ->placeholder('Semua Artikel')
                    ->trueLabel('Hanya yang Ter-index')
                    ->falseLabel('Hanya NoIndex'),
            ])

            /* -------------------------------------------------------------------------- */
            /*                                   ACTIONS                                  */
            /* -------------------------------------------------------------------------- */
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
