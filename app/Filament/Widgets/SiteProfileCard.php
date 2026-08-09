<?php

namespace App\Filament\Widgets;

use App\Models\SiteSetting;
use Filament\Widgets\Widget;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
class SiteProfileCard extends Widget
{
    use HasWidgetShield;
    // Mengatur nama Blade View
    protected string $view = 'filament.widgets.site-profile-card';
    protected static ?int $sort = 1;
    // (Opsional) Mengatur lebar widget agar penuh 1 baris
    protected int | string | array $columnSpan = 'full';

    /**
     * Mengirimkan data site settings ke Blade View
     */
    protected function getViewData(): array
    {
        return [
            // Mengambil record pertama dari tabel site_settings
            'siteSettings' => SiteSetting::first(),
        ];
    }
}
