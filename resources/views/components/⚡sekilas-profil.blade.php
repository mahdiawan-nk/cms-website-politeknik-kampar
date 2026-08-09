<?php

use Livewire\Component;
use App\Models\Page;
use App\Models\HomePageContent;
use Illuminate\Support\Facades\Storage;
new class extends Component {
    // Data statis sambutan (bisa dihubungkan ke database/Eloquent nanti)
    // public array $sambutan = [
    //     'nama' => 'Purwono, M.T.',
    //     'jabatan' => 'Direktur Politeknik Kampar',
    //     'foto' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&q=80&w=600&h=700',
    //     'kutipan' => 'Pioneering Technology & Industry bukan sekadar slogan, melainkan komitmen nyata komparasi akademik kami. Kami mendidik generasi muda untuk tidak hanya siap kerja, tetapi siap membentuk masa depan industri nasional melalui penguasaan teknologi terapan yang inklusif.',
    //     'salam_penutup' => 'Selamat datang di Politeknik Kampar, tempat inovasi dan integritas bersinergi.',
    // ];
    public function with()
    {
        $page = Page::findOrFail(2);
        $setting = HomePageContent::where('section_type', 'sekilas_profil')->first()->metadata;
        $content = $page->content;

        $left = collect($content['columns']['left'] ?? []);
        $right = collect($content['columns']['right'] ?? []);

        $image = $left->firstWhere('type', 'image');

        $badge = $right->firstWhere('type', 'badge');
        $heading = $right->firstWhere('type', 'heading');
        $quote = $right->firstWhere('type', 'quote');
        $subtitle = $right->firstWhere('type', 'subtitle');
        $signature = $right->firstWhere('type', 'signature');

        return [
            'setting' => $setting,
            'sambutan' => [
                'badge' => $setting['tagline'] ?? '',

                'judul' => $setting['title'] ?? '',

                'higliht_text' => $setting['title_higliht'] ?? '-',

                'foto' => isset($setting['foto']) ? Storage::url($setting['foto']) : null,

                'alt' => $setting['title'] ?? '',

                'kutipan' => $setting['quote'] ?? '',

                'salam_penutup' => $setting['text_welcome'] ?? '',

                'nama' => $setting['name_signature'] ?? '',

                'jabatan' => $setting['jabatan_signature'] ?? '',
            ],
        ];
    }
}; ?>


<div>
    <x-thema.ecoindustrial.sekilas-profil.default :sambutan="$sambutan" />

</div>
