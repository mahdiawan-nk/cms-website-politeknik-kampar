<?php

namespace App\Enums;

enum AchievementType: string
{
    case COMPETITION = 'kompetisi';
    case RESEARCH_GRANT = 'hibah_penelitian';
    case PATENT = 'paten_hki';
    case PUBLICATION = 'publikasi';
    case AWARD = 'penghargaan';

    public function label(): string
    {
        return match ($this) {
            self::COMPETITION => 'Kompetisi / Lomba',
            self::RESEARCH_GRANT => 'Hibah Penelitian',
            self::PATENT => 'Paten & HKI',
            self::PUBLICATION => 'Publikasi Ilmiah',
            self::AWARD => 'Penghargaan / Rekognisi',
        };
    }
}
