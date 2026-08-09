<?php

namespace App\Filament\Widgets;

use App\Models\SiteSetting;
use Filament\Widgets\Widget;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class RuningText extends Widget
{
    use HasWidgetShield;
    protected string $view = 'filament.widgets.runing-text';

    // Membuat widget mengambil lebar penuh di dashboard
    protected int | string | array $columnSpan = 'full';

    /**
     * Mengirimkan data site settings ke Blade View
     */
    protected function getViewData(): array
    {
        return [
            'setting' => SiteSetting::first(),
        ];
    }
}