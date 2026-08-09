<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SiteSetting;
use App\Models\Post;
use App\Models\Category;

class Artikel extends Component
{
    use WithPagination;

    // Tema pagination Livewire (default: tailwind, ganti ke 'bootstrap' jika pakai Bootstrap)
    protected string $paginationTheme = 'tailwind';

    public string $title = 'Artikel | Politeknik Kampar';
    public string $pageTitle = 'Artikel';
    public ?string $coverImage = null;

    // Filter & Search State
    public string $search = '';
    public ?int $categoryId = 1; // Default Category ID = 1

    /**
     * Query String URL sync
     */
    protected array $queryString = [
        'search' => ['except' => ''],
        'categoryId' => ['except' => 1],
    ];

    /**
     * Resets pagination ketika kata kunci pencarian berubah
     */
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    /**
     * Mount method dengan parameter category slug (opsional)
     */
    public function mount(?string $category = null): void
    {
        $this->coverImage = 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80';

        if (! empty($category)) {
            $locale = app()->getLocale();
            $fallbackLocale = config('app.fallback_locale', 'id');

            // Query khusus kolom JSON/Translatable untuk PostgreSQL
            $categoryModel = Category::where("slug->{$locale}", $category)
                ->orWhere("slug->{$fallbackLocale}", $category)
                ->first();

            if ($categoryModel) {
                $this->categoryId = $categoryModel->id;
                $this->pageTitle = 'Kategori: ' . ($categoryModel->name ?? 'Artikel');
            } else {
                $this->categoryId = 1; // Fallback jika slug tidak ditemukan
            }
        } else {
            $this->categoryId = 1; // Default ID 1 jika category null
        }
    }

    /**
     * Mengubah/mereset kategori dari UI
     */
    public function selectCategory(?int $id = null): void
    {
        $this->categoryId = $id;
        $this->resetPage();
    }

    public function render()
    {
        $locale = app()->getLocale();

        $posts = Post::published()
            ->with(['category', 'author'])
            // Filter berdasarkan Kategori (jika ada)
            ->when($this->categoryId, function ($query) {
                $query->byCategory($this->categoryId);
            })
            // Filter Search (Mendukung Spatie Translatable Field)
            ->when($this->search, function ($query) use ($locale) {
                $query->where(function ($q) use ($locale) {
                    $q->where("title->{$locale}", 'like', '%' . $this->search . '%')
                        ->orWhere("excerpt->{$locale}", 'like', '%' . $this->search . '%')
                        ->orWhere("content->{$locale}", 'like', '%' . $this->search . '%');
                });
            })
            ->latest('published_at')
            ->paginate(8); // Paginate 6 item per halaman

        $categories = Category::all();

        return view('artikel', [
            'posts' => $posts,
            'categories' => $categories,
        ])
            ->layout('components.layouts.app')
            ->layoutData([
                'title' => $this->title,
                'site_config' => SiteSetting::first(),
            ]);
    }
}
