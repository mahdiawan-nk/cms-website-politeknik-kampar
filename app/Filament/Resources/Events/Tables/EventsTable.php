<?php

namespace App\Filament\Resources\Events\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class EventsTable
{
    public static function configure(Table $table): Table
    {
        $locale = app()->getLocale();

        return $table
            ->columns([
                // 1. POSTER / GAMBAR UTAMA
                ImageColumn::make('featured_image_url')
                    ->label('Poster')
                    ->square()
                    ->disk('public')
                    ->toggleable(),

                // 2. JUDUL AGENDA (Multi-Lang Support)
                TextColumn::make("title")
                    ->label('Judul Agenda')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->wrap()
                    ->limit(50)
                    ->tooltip(fn($record): string => $record->getTranslation('title', $locale) ?? ''),

                // 3. LOKASI ACARA (Multi-Lang Support)
                TextColumn::make("location")
                    ->label('Lokasi')
                    ->icon('heroicon-o-map-pin')
                    ->iconColor('primary')
                    ->searchable()
                    ->limit(30)
                    ->toggleable(),

                // 4. TANGGAL PELAKSANAAN
                TextColumn::make('event_date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                // 5. RENTANG WAKTU
                TextColumn::make('formatted_time')
                    ->label('Waktu')
                    ->icon('heroicon-o-clock')
                    ->state(fn($record): string => $record->formatted_time ?? '-'),

                // 6. STATUS PUBLIKASI
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

                // 7. TIMESTAMPS (Hidden by default)
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
            ->defaultSort('event_date', 'asc')
            ->filters([
                // FILTER STATUS
                SelectFilter::make('status')
                    ->label('Status Agenda')
                    ->options([
                        'published' => 'Dipublikasikan',
                        'draft'     => 'Draf',
                        'archived'  => 'Diarsipkan',
                    ]),

                // FILTER AGENDA MENDATANG
                Filter::make('upcoming')
                    ->label('Agenda Mendatang')
                    ->query(fn(Builder $query): Builder => $query->where('event_date', '>=', now()->startOfDay())),

                // FILTER AGENDA SELESAI
                Filter::make('past')
                    ->label('Agenda Selesai')
                    ->query(fn(Builder $query): Builder => $query->where('event_date', '<', now()->startOfDay())),
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
            ->emptyStateHeading('Belum Ada Agenda / Event')
            ->emptyStateDescription('Buat agenda kegiatan baru untuk memunculkannya di jadwal kampus.')
            ->emptyStateIcon('heroicon-o-calendar');
    }
}
