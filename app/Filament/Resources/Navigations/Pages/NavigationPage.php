<?php

namespace App\Filament\Resources\Navigations\Pages;

use App\Filament\Resources\Navigations\NavigationResource;
use Filament\Resources\Pages\Page;
use Filament\Actions\Action;
use App\Models\Navigation;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Forms\Form;
use Filament\Schemas\Schema;

class NavigationPage extends Page
{
    protected static string $resource = NavigationResource::class;

    protected string $view = 'filament.resources.navigations.pages.navigation-page';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make('tambahNavigasi')
                ->label('Tambah Navigasi')
                ->icon('heroicon-o-plus')
                ->color('primary')
                ->model(Navigation::class)
                // Mengambil komponen form dari NavigationResource
                ->schema(fn(Schema $form) => static::$resource::form($form)->getComponents()),
        ];
    }
    /**
     * Action Modal Edit (Mengambil data record & schema dari Resource)
     */
    public function editAction(): EditAction
    {
        return EditAction::make('edit')
            ->modalHeading('Edit Navigasi')
            ->record(fn(array $arguments) => Navigation::find($arguments['record'] ?? null))
            ->schema(fn(Schema $form) => static::$resource::form($form)->getComponents())
            ->successNotificationTitle('Navigasi berhasil diperbarui');
    }

    /**
     * Action Modal Delete
     */
    public function deleteAction(): DeleteAction
    {
        return DeleteAction::make('delete')
            ->modalHeading('Hapus Navigasi')
            ->modalDescription('Apakah Anda yakin ingin menghapus navigasi ini? Semua sub-menu di dalamnya juga akan terhapus.')
            ->record(fn(array $arguments) => Navigation::find($arguments['record'] ?? null))
            ->successNotificationTitle('Navigasi berhasil dihapus');
    }
    /**
     * Mengirim data ke custom blade view
     */
    protected function getViewData(): array
    {
        return [
            // Jika navigasi Anda hanya 2 level (Parent -> Submenu)
            'navigations' => Navigation::query()
                ->root() // Ambil yang parent_id nya null
                ->with('children.children') // Eager load relasi children
                ->ordered() // Urutkan berdasarkan kolom order
                ->get(),

            // CATATAN: Jika tree Anda multi-level (> 2 level kedalaman), 
            // ubah ->with('children') menjadi ->with('children.children') dst.
        ];
    }
}
