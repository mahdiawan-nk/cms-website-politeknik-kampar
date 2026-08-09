<?php

namespace App\Filament\Resources\HomePageContents\Pages;

use App\Filament\Resources\HomePageContents\HomePageContentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditHomePageContent extends EditRecord
{
    protected static string $resource = HomePageContentResource::class;

    /**
     * Custom Judul Halaman berdasarkan Record ID
     */
    public function getTitle(): string | Htmlable
    {
        $record = $this->getRecord();

        $sections = [
            1 => 'Cover',
            2 => 'Sekilas Profil',
            3 => 'Stats',
            4 => 'Prodi',
            5 => 'Services',
            6 => 'Staff',
            7 => 'Testimoni',
            8 => 'Mitra',
            9 => 'Video',
        ];

        $sectionName = $sections[$record->id] ?? "Section #{$record->id}";

        return "Section: {$sectionName}";
    }

    protected function getHeaderActions(): array
    {
        return [
            // DeleteAction::make(),
        ];
    }
}
