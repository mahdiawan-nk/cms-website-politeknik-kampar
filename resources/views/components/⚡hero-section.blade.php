<?php

use Livewire\Component;
use App\Models\HeroSlide;
use App\Models\HomePageContent;
new class extends Component {
    public $slides;
    public int $currentSlide = 0;

    public function mount()
    {
        // Fetch slide dari Database
        $dbSlides = HeroSlide::active()->ordered()->get();
        // Data Fallback jika DB kosong
        if ($dbSlides->isEmpty()) {
            $this->slides = collect([
                (object) [
                    'image_url' => 'https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=1920&auto=format&fit=crop',
                    'tagline' => 'Pioneering Technology & Sustainable Industry',
                    'title' => 'Membangun Generasi Unggul di Industri Sawit & Teknologi',
                    'description' => 'Politeknik Kampar menghadirkan pendidikan vokasi berbasis kompetensi riil industri dengan dukungan fasilitas teknologi mutakhir dan kemitraan strategis global.',
                    'primary_button_text' => 'Penerimaan Mahasiswa Baru',
                    'primary_button_url' => '/pmb',
                    'secondary_button_text' => 'Jelajahi Program Studi',
                    'secondary_button_url' => '/akademik',
                    'show_tagline' => true,
                    'show_title' => true,
                    'show_description' => true,
                    'show_primary_button' => true,
                    'show_secondary_button' => true,
                ],
            ]);
        } else {
            $this->slides = $dbSlides;
        }
    }

    public function with()
    {
        return [
            'setting_cover' => HomePageContent::where('section_type', 'cover')->first(),
        ];
    }

    public function nextSlide()
    {
        $count = count($this->slides);
        if ($count > 0) {
            $this->currentSlide = ($this->currentSlide + 1) % $count;
        }
    }

    public function prevSlide()
    {
        $count = count($this->slides);
        if ($count > 0) {
            $this->currentSlide = ($this->currentSlide - 1 + $count) % $count;
        }
    }
};
?>



<div>
    @switch($setting_cover->metadata['layout'])
        @case('split_screen')
            <x-thema.ecoindustrial.hero.split-screen :slides="$slides" />
        @break

        @case('three_dimension')
            <x-thema.ecoindustrial.hero.three-dimension :slides="$slides" />
        @break

        @case('video_bg')
            <x-thema.ecoindustrial.hero.video :metadata="$setting_cover->metadata"/>
        @break

        @default
            <x-thema.ecoindustrial.hero.default :slides="$slides" />
    @endswitch
</div>
