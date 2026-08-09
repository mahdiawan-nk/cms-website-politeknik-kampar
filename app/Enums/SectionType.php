<?php

namespace App\Enums;

enum SectionType: string
{
    case COVER = 'cover';
    case SEKILAS_PROFIL = 'sekilas_profil';
    case STATS = 'stats';
    case PRODI = 'prodi';
    case SERVICES = 'services';
    case STAFF = 'staff';
    case MITRA = 'mitra';
    case TESTIMONI = 'testimoni';
    case VIDEO = 'video';
}
