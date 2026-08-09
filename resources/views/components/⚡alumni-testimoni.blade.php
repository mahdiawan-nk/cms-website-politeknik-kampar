<?php

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\HomePageContent;
new class extends Component {
    public function with(): array
    {
        $getListTestimonials = HomePageContent::query()->ofSection('testimoni')->first();
        return [
            'testimonials' => [
                'header'=>$getListTestimonials->header,
                'metadata'=>$getListTestimonials->metadata['testimonials']
            ],
        ];
    }
};
?>
<div>
    <x-thema.ecoindustrial.testimoni.default :testimonials="$testimonials" />

</div>
