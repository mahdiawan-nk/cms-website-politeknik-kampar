<?php

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
new class extends Component {
    // Data dummy terstruktur untuk keperluan pengujian UI
    public function with(): array
    {
        $locale = app()->getLocale();
        $cacheKey = "homepage_latest_news_{$locale}";

        $getLatestNews = Cache::remember($cacheKey, now()->addMinutes(15), function () {
            return Post::query()
                ->select(['id', 'category_id', 'author_id', 'title', 'slug', 'excerpt', 'featured_image', 'published_at'])
                ->with(['category:id,name', 'author:id,name'])
                ->published()
                ->byCategory(1)
                ->latest('published_at')
                ->limit(6)
                ->get()
                ->map(function ($post) {
                    // Mapping ke Array Murni (Aman dari Bug Unserialize & Sangat Ringan)
                    return [
                        'id' => $post->id,
                        'title' => $post->getTranslation('title', app()->getLocale()),
                        'slug' => $post->getTranslation('slug', app()->getLocale()),
                        'excerpt' => $post->getTranslation('excerpt', app()->getLocale()),
                        'featured_image_url' => $post->featured_image_url,
                        'category_name' => $post->category?->getTranslation('name', app()->getLocale()),
                        'author_name' => $post->author?->name,
                        'published_at' => $post->published_at?->format('d M Y'),
                    ];
                })
                ->toArray(); // Pastikan dikembalikan sebagai Array
        });
        return [
            'newsData' => $getLatestNews,
        ];
    }
}; ?>

<div>
    <x-thema.ecoindustrial.news.bento-grid :newsData="$newsData" :allNewsUrl="route('artikel')"/>
</div>
