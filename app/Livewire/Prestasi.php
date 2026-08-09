<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SiteSetting;
use App\Models\AchivementStat;
use App\Models\Achivement;

class Prestasi extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'tailwind';
    public ?string $coverImage = null;
    public string $title = 'Prestasi & Penghargaan | Politeknik Kampar';
    public string $pageTitle = 'Prestasi & Kebanggaan Kampus';

    // State Filter & Search
    public string $search = '';
    public string $type = 'all'; // Filter jenis prestasi (e.g., 'academic', 'non_academic', 'all')
    public string $year = 'all';

    public bool $showDetailModal = false;
    public ?Achivement $selectedAchievement = null;

    protected array $queryString = [
        'search' => ['except' => ''],
        'type' => ['except' => 'all'],
        'year' => ['except' => 'all'],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingType(): void
    {
        $this->resetPage();
    }

    public function updatingYear(): void
    {
        $this->resetPage();
    }

    public function clearFilters(): void
    {
        $this->reset(['search', 'type', 'year']);
        $this->resetPage();
    }

    public function showDetail(int $id): void
    {
        $this->selectedAchievement = Achivement::findOrFail($id);
        $this->showDetailModal = true;
    }

    public function closeModal(): void
    {
        $this->showDetailModal = false;
        $this->selectedAchievement = null;
    }

    public function render()
    {
        $this->coverImage = 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80';

        $locale = app()->getLocale();

        // 1. Ambil Data Statistik untuk Counter Section
        $stats = AchivementStat::ordered()->get();

        // 2. Ambil daftar tahun unik untuk opsi filter dropdown
        $availableYears = Achivement::query()
            ->select('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // 3. Query Utama Prestasi
        $query = Achivement::query();

        // Filter Type
        // if ($this->type !== 'all') {
        //     $query->ofType($this->type);
        // }

        // Filter Tahun
        if ($this->year !== 'all') {
            $query->ofYear((int) $this->year);
        }

        // Search Filter (Support JSON Translatable Spatie)
        $query->when($this->search, function ($q) use ($locale) {
            $q->where(function ($sub) use ($locale) {
                $sub->where("title->{$locale}", 'ILIKE', '%' . $this->search . '%')
                    ->orWhere("category->{$locale}", 'ILIKE', '%' . $this->search . '%')
                    ->orWhere("organizer->{$locale}", 'ILIKE', '%' . $this->search . '%')
                    ->orWhere("description->{$locale}", 'ILIKE', '%' . $this->search . '%');
            });
        });

        // Urutkan: Featured lebih dulu, lalu tahun terbaru
        $achievements = $query->orderBy('is_featured', 'desc')
            ->orderBy('year', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('prestasi', [
            'stats' => $stats,
            'availableYears' => $availableYears,
            'achievements' => $achievements,
        ])
            ->layout('components.layouts.app')
            ->layoutData([
                'title' => $this->title,
                'site_config' => SiteSetting::first(),
            ]);
    }
}
