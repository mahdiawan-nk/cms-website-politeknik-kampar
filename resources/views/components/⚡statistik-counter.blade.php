<?php

use Livewire\Component;
use App\Models\HomePageContent;
new class extends Component {
   
    public function with(): array
    {
        return [
            'stats'=>HomePageContent::where('section_type','stats')->first()->metadata
        ];
    }
};
?>
<div>
    <x-thema.ecoindustrial.statistik.default :stats="$stats['stats']"/>
</div>
