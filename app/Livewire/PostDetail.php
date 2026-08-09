<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\SiteSetting;
use Illuminate\Support\Str;
use Livewire\Component;

class PostDetail extends Component
{
    public Post $post;
    public string $title = 'Politeknik Kampar';
    public string $pageTitle = 'Artikel & Informasi';
    public ?string $coverImage = null;

    public function mount(string $slug): void
    {
        $locale = app()->getLocale();
        $fallbackLocale = config('app.fallback_locale', 'id');

        // 1. Ambil data post terbit
        $this->post = Post::published()
            ->with(['category', 'author'])
            ->where(function ($query) use ($slug, $locale, $fallbackLocale) {
                $query->where("slug->{$locale}", $slug)
                    ->orWhere("slug->{$fallbackLocale}", $slug);
            })
            ->firstOrFail();

        // 2. Set $title dinamis (Prioritas: meta_title -> title artikel)
        $postTitle = !empty($this->post->meta_title) ? $this->post->meta_title : $this->post->title;
        $this->title = "{$postTitle} | Politeknik Kampar";

        // 3. Set $pageTitle dinamis (Judul Utama / Kategori jika ada)
        $this->pageTitle = $this->post->category?->name ?? 'Detail Artikel';

        // 4. Set $coverImage dinamis (Prioritas: featured_image_url -> Unsplash Default)
        $this->coverImage = $this->post->featured_image_url 
            ?: 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80';
    }

    public function render()
    {
        // Mengambil 3 artikel terkait berdasarkan kategori yang sama
        $relatedPosts = Post::published()
            ->where('id', '!=', $this->post->id)
            ->when($this->post->category_id, function ($query) {
                $query->where('category_id', $this->post->category_id);
            })
            ->latest('published_at')
            ->take(3)
            ->get();

        // Ambil meta description atau fallback dari excerpt / potongan isi konten
        $metaDescription = !empty($this->post->meta_description) 
            ? $this->post->meta_description 
            : ($this->post->excerpt ?? Str::limit(strip_tags($this->post->content), 160));

        return view('post-detail', [
            'relatedPosts' => $relatedPosts,
        ])
            ->layout('components.layouts.app', [
                'title' => $this->title,
                'description' => $metaDescription,
                'site_config' => SiteSetting::first(),
            ]);
    }
}