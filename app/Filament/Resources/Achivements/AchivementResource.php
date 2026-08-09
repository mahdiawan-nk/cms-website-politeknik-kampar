<?php

namespace App\Filament\Resources\Achivements;

use App\Filament\Resources\Achivements\Pages\CreateAchivement;
use App\Filament\Resources\Achivements\Pages\EditAchivement;
use App\Filament\Resources\Achivements\Pages\ListAchivements;
use App\Filament\Resources\Achivements\Schemas\AchivementForm;
use App\Filament\Resources\Achivements\Tables\AchivementsTable;
use App\Models\Achivement;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AchivementResource extends Resource
{
    protected static ?string $model = Achivement::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-trophy';
    protected static string|UnitEnum|null $navigationGroup = 'Akademik & Prestasi';
    protected static ?string $navigationLabel = 'Data Prestasi';
    protected static ?string $modelLabel = 'Prestasi';
    protected static ?string $pluralModelLabel = 'Data Prestasi';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return AchivementForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AchivementsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAchivements::route('/'),
            'create' => CreateAchivement::route('/create'),
            'edit' => EditAchivement::route('/{record}/edit'),
        ];
    }
}
