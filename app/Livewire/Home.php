<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SiteSetting;

class Home extends Component
{
    /**
     * Properti untuk menyimpan judul halaman.
     */
    public string $title = 'Beranda | Politeknik Kampar';
    public array $site_config=[];

    public function render()
    {
        return view('welcome')
            ->layout('components.layouts.app')
            ->layoutData([
                'title' => $this->title,
                'site_config' => SiteSetting::first(),
            ]);
    }
}
