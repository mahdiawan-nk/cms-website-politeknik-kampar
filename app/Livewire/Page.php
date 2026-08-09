<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Page as Pages;
use App\Models\SiteSetting;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection; // 1. Tambahkan import Collection

class Page extends Component
{
    public string $slug;
    public string $title = 'Beranda | Politeknik Kampar'; // Title untuk <head> HTML
    public string $pageTitle = '';                         // Title dinamis untuk <h1> di Blade
    public ?string $coverImage = null;                     // Gambar cover (opsional)

    public ?Pages $pageRecord = null;
    public array $content = [];
    public ?Collection $relatedPosts = null;               // 2. Ubah tipe data ?Post menjadi ?Collection

    public function mount(string $slug)
    {
        $this->getRelatedPost();
        $this->slug = $slug;

        // 1. Cari record halaman berdasarkan slug
        $this->pageRecord = Pages::where('slug->id', $slug)
            ->orWhere('slug->en', $slug)
            ->firstOrFail();

        // 2. Decode content JSON jika bentuknya string
        $this->content = is_string($this->pageRecord->content)
            ? json_decode($this->pageRecord->content, true)
            : ($this->pageRecord->content ?? []);

        // 3. Extract Judul Halaman
        if (is_array($this->pageRecord->title)) {
            $this->pageTitle = $this->pageRecord->title['id']
                ?? $this->pageRecord->title['en']
                ?? 'Halaman';
        } else {
            $this->pageTitle = $this->pageRecord->title ?? 'Halaman';
        }

        // Set meta title untuk browser tab
        $this->title = $this->pageTitle . ' | Politeknik Kampar';

        // 4. Extract Cover Image
        if (!empty($this->pageRecord->cover_image)) {
            $this->coverImage = asset('storage/' . $this->pageRecord->cover_image);
        } else {
            // Fallback image jika tidak ada cover
            $this->coverImage = 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80';
        }
    }

    public function getRelatedPost(): void
    {
        $this->relatedPosts = Post::published()
            ->latest('published_at')
            ->take(3)
            ->get();
    }

    public function render()
    {
        return view('page')
            ->layout('components.layouts.app')
            ->layoutData([
                'title' => $this->title,
                'site_config' => SiteSetting::first(),
            ]);
    }
}