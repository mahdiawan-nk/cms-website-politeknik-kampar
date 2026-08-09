<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Support\Enums\Width;
use Filament\Navigation\NavigationItem;
use App\Filament\Resources\HomePageContents\HomePageContentResource;
use App\Filament\Pages\CustomLogin;
use App\Models\HomePageContent;

class CmsPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('cms')
            ->path('cms')
            ->viteTheme('resources/css/filament/cms/theme.css')
            ->login(CustomLogin::class)
            // ->topNavigation()
            ->breadcrumbs(false)
            ->brandName(fn() => view('filament.admin.logo'))
            ->maxContentWidth(Width::Full)
            ->sidebarCollapsibleOnDesktop()
            ->sidebarWidth('15rem')
            ->colors([
                'primary' => Color::Emerald,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                // AccountWidget::class,
                // FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make()
                ->navigationGroup('Pengaturan Sistem')
                ->navigationLabel('Manajemen Akses'),
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->navigationItems($this->getHomePageNavigationItems());
    }

    /**
     * Generates navigation items for Home Page content sections with unique icons.
     *
     * @return array<NavigationItem>
     */
    private function getHomePageNavigationItems(): array
    {
        // Struktur array: Record ID => [Label Menu, Nama Ikon Heroicon]
        $items = [
            1 => ['label' => 'Cover',          'icon' => 'heroicon-o-photo','group' => 'Beranda Website'],
            2 => ['label' => 'Sekilas Profil', 'icon' => 'heroicon-o-information-circle','group' => 'Beranda Website'],
            3 => ['label' => 'Statistik Kampus',          'icon' => 'heroicon-o-chart-bar','group' => 'Beranda Website'],
            4 => ['label' => 'Program Studi',  'icon' => 'heroicon-o-academic-cap','group' => 'Akademik & Prestasi'],
            5 => ['label' => 'Layanan Kampus',       'icon' => 'heroicon-o-briefcase','group' => 'Beranda Website'],
            6 => ['label' => 'Dosen & Staff',  'icon' => 'heroicon-o-user-group','group' => 'Akademik & Prestasi'],
            7 => ['label' => 'Testimoni',      'icon' => 'heroicon-o-chat-bubble-bottom-center-text','group' => 'Beranda Website'],
            8 => ['label' => 'Mitra Kerja',          'icon' => 'heroicon-o-building-office-2','group' => 'Beranda Website'],
            9 => ['label' => 'Galeri Video',          'icon' => 'heroicon-o-video-camera','group' => 'Beranda Website'],
        ];

        return collect($items)->map(function (array $item, int $recordId): NavigationItem {
            return NavigationItem::make($item['label'])
                ->url(fn(): string => HomePageContentResource::getUrl('edit', ['record' => $recordId]))
                ->icon($item['icon'])
                ->isActiveWhen(function () use ($recordId): bool {
                    $record = request()->route('record');
                    $routeRecordId = $record?->id ?? $record;

                    return request()->routeIs('filament.cms.resources.home-page-contents.edit')
                        && (string) $routeRecordId === (string) $recordId;
                })
                ->group($item['group'])
                ->sort($recordId)
                // UBAH BARIS INI: Panggil Policy 'update' menggunakan instance Model
                ->visible(fn(): bool => auth()->user()?->can('update', new HomePageContent) ?? false);
        })->values()->toArray();
    }
}
