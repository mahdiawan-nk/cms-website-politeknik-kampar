<?php

namespace App\Filament\Pages;

use Filament\Auth\Pages\Login;
use App\Models\SiteSetting;

class CustomLogin extends Login
{
    protected string $view = 'filament.pages.custom-login';
    public ?SiteSetting $siteSetting = null;
    public function mount(): void
    {
        parent::mount();

        // Ambil data pertama dari tabel site_settings
        $siteSetting = SiteSetting::first();

        $this->siteSetting = $siteSetting;

        // Bagikan data ke view
    }

    // protected function getViewData(): array
    // {
    //     // Ambil data pertama dari tabel site_settings
    //     $siteSetting = SiteSetting::first();

    //     return array_merge(parent::getViewData(), [
    //         'siteSetting' => $siteSetting,
    //     ]);
    // }
}
