<?php

use Livewire\Component;
use App\Models\HomePageContent;
new class extends Component {
    public function with(): array
    {
        $getListStaff = HomePageContent::where('section_type','staff')->first();
        return [
            'staffs' =>[
                'header'=>$getListStaff->header,
                'metadata'=>$getListStaff->metadata['staff']
            ]
        ];
    }
}; ?>

<div>
    <x-thema.ecoindustrial.staff-slider.three-dimension :staffs="$staffs"/>
</div>
