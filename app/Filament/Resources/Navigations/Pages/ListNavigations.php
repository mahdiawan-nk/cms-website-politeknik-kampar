<?php

namespace App\Filament\Resources\Navigations\Pages;

use App\Filament\Resources\Navigations\NavigationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;

class ListNavigations extends ListRecords
{
    protected static string $resource = NavigationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
    protected function getTableQuery(): Builder|Relation|null
    {
        $sql = static::getResource()::getEloquentQuery()
            ->addSelect([
                'parent_label' => DB::table('navigations as p')
                    ->selectRaw("p.label->>'id'")
                    ->whereColumn('p.id', 'navigations.parent_id')
                    ->limit(1),
            ]);
        // dd($sql->get());
        return $sql;
    }
}
