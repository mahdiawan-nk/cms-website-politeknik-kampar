<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SiteSetting;
use App\Models\Event;

class Agenda extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'tailwind';

    public string $title = 'Agenda & Kegiatan | Politeknik Kampar';
    public string $pageTitle = 'Agenda & Kegiatan Kampus';
    public ?string $coverImage = null;
    // State Filter & Search
    public string $search = '';
    public string $filter = 'upcoming'; // Options: 'upcoming', 'past', 'all'
    public bool $showDetailModal = false;
    public ?Event $selectedEvent = null;
    protected array $queryString = [
        'search' => ['except' => ''],
        'filter' => ['except' => 'upcoming'],
    ];

    /**
     * Reset halaman paginasi ketika kata kunci pencarian berubah
     */
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    /**
     * Mengubah filter tab (Mendatang, Berlalu, Semua)
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
        $this->selectedEvent = Event::findOrFail($id);
        $this->showDetailModal = true;
    }

    /**
     * Menutup modal detail
     */
    public function closeModal(): void
    {
        $this->showDetailModal = false;
        $this->selectedEvent = null;
    }

    public function render()
    {
        $this->coverImage = 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80';

        $locale = app()->getLocale();

        // Base Query hanya mengambil event yang statusnya published
        $query = Event::published();

        // 1. Filter Berdasarkan Kategori Waktu (Scope Event)
        if ($this->filter === 'upcoming') {
            $query->upcoming();
        } elseif ($this->filter === 'past') {
            $query->past();
        } else {
            $query->orderBy('event_date', 'desc');
        }

        // 2. Filter Search (Kompatibel PostgreSQL & Spatie Translatable)
        $query->when($this->search, function ($q) use ($locale) {
            $q->where(function ($sub) use ($locale) {
                $sub->where("title->{$locale}", 'ILIKE', '%' . $this->search . '%')
                    ->orWhere("location->{$locale}", 'ILIKE', '%' . $this->search . '%')
                    ->orWhere("content->{$locale}", 'ILIKE', '%' . $this->search . '%');
            });
        });

        $events = $query->paginate(8);

        return view('agenda', [
            'events' => $events,
        ])
            ->layout('components.layouts.app')
            ->layoutData([
                'title' => $this->title,
                'site_config' => SiteSetting::first(),
            ]);
    }
}
