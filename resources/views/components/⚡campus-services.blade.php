<?php

use Livewire\Component;
use App\Models\HomePageContent;
new class extends Component {
    // Menggunakan dummy data terstruktur terbagi berdasarkan target pengguna layanan
    public function with(): array
    {
        $getListServices = HomePageContent::where('section_type', 'services')->first();
        return [
            'services' => [
                'header'=>$getListServices['header'],
                'metadata'=>$getListServices['metadata']['services']
            ],
        ];
    }
}; ?>

<div>
    <x-thema.ecoindustrial.services.default :services="$services" />
</div>
