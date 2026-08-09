<?php

use Livewire\Component;
use App\Models\Navigation;
use Illuminate\Support\Collection;
use App\Models\SiteSetting;
new class extends Component {
    public array $menus = [];
    public $siteSetting;
    public function mount($config = null)
    {
        $this->siteSetting = $config;
        // 1. Definisikan Static Menu: Awal (Beranda)
        $firstMenu = [
            [
                'label' => 'Beranda',
                'url' => '/',
                'newtab' => false,
                'children' => [],
            ],
        ];

        // 2. Ambil data menu dinamis dari Database
        // Menggunakan eager loading (with) agar efisien, ditambah filter active() & ordered() untuk sub-menunya
        $dbNavigations = Navigation::query()
            ->active()
            ->root()
            ->with([
                'children' => function ($query) {
                    $query
                        ->active()
                        ->ordered()
                        ->with([
                            'children' => function ($subQuery) {
                                $subQuery->active()->ordered();
                            },
                        ]);
                },
            ])
            ->ordered()
            ->get();

        // Format data model menjadi bentuk array yang sesuai dengan kebutuhan UI
        $dynamicMenus = $this->formatMenus($dbNavigations);

        // 3. Definisikan Static Menu: Akhir (Artikel & Pengumuman)
        $lastMenus = [
            [
                'label' => 'Informasi',
                'url' => '#',
                'newtab' => false,
                'children' => [
                    [
                        'label' => 'Artikel & Berita',
                        'url' => '/artikel',
                        'newtab' => false,
                        'children' => [],
                    ],
                    [
                        'label' => 'Pengumuman Resmi',
                        'url' => '/pengumuman',
                        'newtab' => false,
                        'children' => [],
                    ],
                    [
                        'label' => 'Agenda & Event',
                        'url' => '/agenda',
                        'newtab' => false,
                        'children' => [],
                    ],
                ],
            ],
        ];

        // 4. Gabungkan semuanya: Beranda + Menu Dinamis + Menu Akhir
        $this->menus = array_merge($firstMenu, $dynamicMenus, $lastMenus);
    }

    /**
     * Method bantuan (helper) untuk merubah Collection Model ke bentuk Array rekursif.
     */
    private function formatMenus(Collection $navigations): array
    {
        $formatted = [];

        foreach ($navigations as $nav) {
            // Gunakan url bawaan, jika nolink atau kosong maka jadi '#'
            // Jika format internal berupa "page/slug", pastikan sudah di-handle di routing frontend Anda,
            // atau tambahkan helper url() seperti: url($nav->url) jika diperlukan.
            $url = $nav->type === 'nolink' || empty($nav->url) ? '#' : $nav->url;

            // Tambahkan '/' di depan url internal jika belum ada (opsional, tergantung setup route)
            if ($nav->type === 'internal' && !str_starts_with($url, 'http') && !str_starts_with($url, '/')) {
                $url = '/' . $url;
            }

            $formatted[] = [
                'label' => $nav->label, // Mengambil label bahasa yang aktif (ID/EN)
                'url' => $url,
                'newtab' => $nav->type == 'external' ? true : false,
                // Lakukan rekursif jika memiliki sub-menu
                'children' => $nav->children->isNotEmpty() ? $this->formatMenus($nav->children) : [],
            ];
        }

        return $formatted;
    }
};
?>
<div>
    <x-thema.ecoindustrial.navbar.floating-smart-scroll :menus="$menus" :siteSetting="$siteSetting" />
</div>
