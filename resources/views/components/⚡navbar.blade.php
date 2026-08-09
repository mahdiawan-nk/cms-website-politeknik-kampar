<?php

use Livewire\Component;
use App\Models\Navigation;
use App\Models\SiteSetting;
use App\Models\HomePageContent;
use Illuminate\Support\Collection;

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

        $dynamicMenus = $this->formatMenus($dbNavigations);

        // 3. Ambil data Layanan Kampus menggunakan scope ofSection dari Model HomePageContent
        $servicesContent = HomePageContent::query()->ofSection('services')->first();

        $servicesMenu = $this->formatServicesMenu($servicesContent);

        // 4. Definisikan Static Menu: Akhir (Informasi)
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

        // 5. Gabungkan semua menu: Beranda + Menu Dinamis + Layanan Kampus + Informasi
        $this->menus = array_merge($firstMenu, $dynamicMenus, $servicesMenu, $lastMenus);
    }

    /**
     * Helper untuk memformat Layanan Kampus dari metadata HomePageContent
     */
    private function formatServicesMenu(?HomePageContent $contentRecord): array
    {
        if (!$contentRecord) {
            return [];
        }

        // Memanfaatkan helper method getMeta() dari Model HomePageContent
        // Kolom 'metadata' sudah otomatis di-cast menjadi array oleh Eloquent
        $services = $contentRecord->getMeta('services', []);

        if (empty($services) || !is_array($services)) {
            return [];
        }

        $serviceItems = [];
        foreach ($services as $item) {
            $serviceItems[] = [
                'label' => $item['name_services'] ?? '',
                'url' => $item['url'] ?? '#',
                'newtab' => true,
                'children' => [],
            ];
        }

        return [
            [
                'label' => 'Layanan Kampus',
                'url' => '#',
                'newtab' => false,
                'children' => $serviceItems,
            ],
        ];
    }

    /**
     * Helper untuk merubah Collection Model ke bentuk Array rekursif.
     */
    private function formatMenus(Collection $navigations): array
    {
        $formatted = [];

        foreach ($navigations as $nav) {
            $url = $nav->type === 'nolink' || empty($nav->url) ? '#' : $nav->url;

            if ($nav->type === 'internal' && !str_starts_with($url, 'http') && !str_starts_with($url, '/')) {
                $url = '/' . $url;
            }

            $formatted[] = [
                'label' => $nav->label,
                'url' => $url,
                'newtab' => $nav->type === 'external',
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
