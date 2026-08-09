<?php

namespace App\Filament\Resources\Achivements\Pages;

use App\Filament\Resources\Achivements\AchivementResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAchivements extends ListRecords
{
    protected static string $resource = AchivementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
