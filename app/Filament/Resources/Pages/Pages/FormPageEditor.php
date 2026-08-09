<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Filament\Resources\Pages\PageResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class FormPageEditor extends Page
{
    // use InteractsWithRecord;

    protected static string $resource = PageResource::class;

    protected string $view = 'filament.resources.pages.pages.form-page-editor';
    
}
