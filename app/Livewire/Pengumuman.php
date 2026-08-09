<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SiteSetting;
use App\Models\Announcement;

class Pengumuman extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'tailwind';

    public string $title = 'Pengumuman Resmi | Politeknik Kampar';
    public string $pageTitle = 'Pengumuman & Informasi Kampus';
    public ?string $coverImage = null;

    // State Filter & Search
    public string $search = '';
    public string $filter = 'all'; // Options: 'all', 'important'

    public bool $showDetailModal = false;
    public ?Announcement $selectedAnnouncement = null;

    protected array $queryString = [
        'search' => ['except' => ''],
        'filter' => ['except' => 'all'],
    ];

    /**
     * Reset halaman paginasi ketika kata kunci pencarian berubah
     */
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    /**
     * Mengubah filter tab pengumuman
     */
    public function setFilter(string $filter): void
    {
        $this->filter = $filter;
        $this->resetPage();
    }

    /**
     * Bersihkan input pencarian
     */
    public function clearSearch(): void
    {
        $this->search = '';
        $this->resetPage();
    }

    /**
     * Membuka modal dan memuat detail agenda
     */
    public function showDetail(int $id): void
    {
        $this->selectedAnnouncement = Announcement::findOrFail($id);
        $this->showDetailModal = true;
    }

    /**
     * Menutup modal detail
     */
    public function closeModal(): void
    {
        $this->showDetailModal = false;
        $this->selectedAnnouncement = null;
    }

    public function render()
    {
        $this->coverImage = 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80';

        $locale = app()->getLocale();

        // Base Query hanya mengambil pengumuman yang sudah terbit
        $query = Announcement::published();

        // 1. Filter Pengumuman Penting
        if ($this->filter === 'important') {
            $query->important();
        }

        // 2. Filter Search (Kompatibel PostgreSQL & Spatie Translatable)
        $query->when($this->search, function ($q) use ($locale) {
            $q->where(function ($sub) use ($locale) {
                $sub->where("title->{$locale}", 'ILIKE', '%' . $this->search . '%')
                    ->orWhere("badge->{$locale}", 'ILIKE', '%' . $this->search . '%')
                    ->orWhere("content->{$locale}", 'ILIKE', '%' . $this->search . '%');
            });
        });

        // Urutkan pengumuman penting terlebih dahulu, lalu berdasarkan tanggal rilis terbaru
        $announcements = $query->orderBy('is_important', 'desc')
            ->orderBy('published_at', 'desc')
            ->paginate(8);

        return view('pengumuman', [
            'announcements' => $announcements,
        ])
            ->layout('components.layouts.app')
            ->layoutData([
                'title' => $this->title,
                'site_config' => SiteSetting::first(),
            ]);
    }
}
