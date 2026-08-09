<?php

use Livewire\Component;
use App\Models\HomePageContent;
new class extends Component {
    public function with(): array
    {
        $getListParners = HomePageContent::query()->ofSection('mitra')->first();
        return [
            'headers' => $getListParners->header,
            'partners' => $getListParners->metadata['partners'],
        ];
    }
}; ?>

<x-thema.ecoindustrial.partners.default :partners="$partners" :headers="$headers" />
