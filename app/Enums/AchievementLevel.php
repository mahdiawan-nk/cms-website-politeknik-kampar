<?php

namespace App\Enums;

enum AchievementLevel: string
{
    case INTERNATIONAL = 'internasional';
    case NATIONAL = 'nasional';
    case REGIONAL = 'regional';
    case LOCAL = 'lokal';

    public function label(): string
    {
        return match ($this) {
            self::INTERNATIONAL => 'Internasional',
            self::NATIONAL => 'Nasional',
            self::REGIONAL => 'Regional',
            self::LOCAL => 'Lokal',
        };
    }
}
