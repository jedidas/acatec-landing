<?php

namespace App\Providers\Filament;

use App\Filament\Resources\Banners\BannerResource;
use App\Filament\Resources\Emails\EmailResource;
use App\Filament\Resources\Pages\PageResource;
use App\Filament\Resources\Promotions\PromotionResource;
use App\Filament\Resources\Settings\SettingResource;
use App\Filament\Widgets\InformationWidget;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->topbar(false)
            ->colors([
                'primary' => Color::Purple,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                InformationWidget::class,
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
            ->authMiddleware([
                Authenticate::class,
            ])
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder->groups([
                    NavigationGroup::make('Website')
                        ->items([
                            NavigationItem::make('Principal')
                                ->url(route('filament.admin.pages.dashboard'), shouldOpenInNewTab: false)
                                ->icon('heroicon-o-home')
                                ->sort(3),

                            ...PageResource::getNavigationItems(),
                            ...EmailResource::getNavigationItems(),
                            ...PromotionResource::getNavigationItems(),
                            ...BannerResource::getNavigationItems(),
                            ...SettingResource::getNavigationItems(),
                            NavigationItem::make('Limpiar cache')
                                ->url(route('cache-clear.index'), shouldOpenInNewTab: false)
                                ->icon('heroicon-o-arrow-path')
                                ->sort(3),
                        ]),
                ]);
            });
    }
}
