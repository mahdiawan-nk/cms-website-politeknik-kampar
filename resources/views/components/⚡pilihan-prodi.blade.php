<?php

use Livewire\Component;
use App\Models\HomePageContent;

new class extends Component {

    public function with(): array
    {
        $getListProdi = HomePageContent::where('section_type', 'prodi')->first();
        return [
            'departments' => [
                'header' => $getListProdi['header'],
                'listProdi' => $getListProdi['metadata']['prodi'],
            ],
        ];
    }
};
?>
<div>
    <x-thema.ecoindustrial.prodi.three-dimension :departments="$departments" />

</div>
