<?php

namespace App\Filament\Resources\Announcements\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class AnnouncementsTable
{
    public static function configure(Table $table): Table
    {
        $locale = app()->getLocale();

        return $table
            ->columns([
                // 1. PIN PENTING (Icon Column)
                IconColumn::make('is_important')
                    ->label('Penting')
                    ->boolean()
                    ->trueIcon('heroicon-o-exclamation-triangle')
                    ->falseIcon('heroicon-o-minus-circle')
                    ->trueColor('warning')
                    ->falseColor('gray')
                    ->sortable(),

                // 2. JUDUL PENGUMUMAN (Multi-Lang Support)
                TextColumn::make("title")
                    ->label('Judul Pengumuman')
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->wrap()
                    ->limit(60)
                    ->tooltip(fn($record): string => $record->getTranslation('title', $locale) ?? ''),

                // 3. BADGE / KATEGORI (Multi-Lang Support)
                TextColumn::make("badge")
                    ->label('Kategori')
                    ->badge()
                    ->color('info')
                    ->searchable()
                    ->placeholder('-'),

                // 4. STATUS PUBLIKASI
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
                        'draft'     => 'Draf',
                        'archived'  => 'Diarsipkan',
                        default     => $state,
                    })
                    ->sortable(),

                // 5. TANGGAL RILIS
                TextColumn::make('published_at')
                    ->label('Tanggal Rilis')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->placeholder('Belum dirilis'),

                // 6. TIMESTAMPS (Hidden by default)
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
            ->defaultSort('published_at', 'desc')
            ->filters([
                // FILTER STATUS
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'published' => 'Dipublikasikan',
                        'draft'     => 'Draf',
                        'archived'  => 'Diarsipkan',
                    ]),

                // FILTER PENGUMUMAN PENTING
                TernaryFilter::make('is_important')
                    ->label('Tandai Penting')
                    ->boolean()
                    ->trueLabel('Pengumuman Penting')
                    ->falseLabel('Pengumuman Biasa'),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum Ada Pengumuman')
            ->emptyStateDescription('Buat pengumuman baru untuk menampilkan informasi di halaman utama.')
            ->emptyStateIcon('heroicon-o-megaphone');
    }
}
