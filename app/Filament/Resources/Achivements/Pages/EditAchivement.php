<?php

namespace App\Filament\Resources\Achivements\Pages;

use App\Filament\Resources\Achivements\AchivementResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAchivement extends EditRecord
{
    protected static string $resource = AchivementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
