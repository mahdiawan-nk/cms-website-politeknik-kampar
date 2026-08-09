<?php

use Livewire\Component;
use App\Models\HomePageContent;
new class extends Component {

    // Mengisi data saat komponen diinisialisasi
    public function with()
    {
        $getPageContent = HomePageContent::query()->ofSection('video')->first();
        return [
            'headers'=>$getPageContent->header,
            'videos'=>$getPageContent->metadata['videos']
        ];
    }
};
?>

<x-thema.ecoindustrial.video-gallery.default :videos="$videos" :headers="$headers"/>
