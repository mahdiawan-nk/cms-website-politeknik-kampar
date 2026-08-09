<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\Page;
use Illuminate\Support\Facades\Session;
use App\Livewire\Artikel;
use App\Livewire\Agenda;
use App\Livewire\Pengumuman;
use App\Livewire\PostDetail;
use App\Livewire\Prestasi;

Route::get('/', Home::class)->name('home');
Route::get('/page/{slug}', page::class)->name('page');

Route::get('/locale/{lang}', function ($lang) {
    // Pastikan hanya menerima bahasa yang tersedia
    if (in_array($lang, ['en', 'id'])) {
        Session::put('locale', $lang);
    }
    return redirect()->back();
})->name('locale.switch');
Route::get('template', function () {
    return [
        [
            'title' => 'Title 1',
            'description' => 'title 1'
        ]
    ];
})->name('template');
Route::get('/artikel/{category?}', Artikel::class)->name('artikel');
Route::get('/agenda', Agenda::class)->name('agenda');
Route::get('/pengumuman', Pengumuman::class)->name('pengumuman');
Route::get('/detail-artikel/{slug}', PostDetail::class)->name('posts.show');
Route::get('/prestasi', Prestasi::class)->name('prestasi');