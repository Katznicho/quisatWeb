<?php

namespace App\Providers\Filament;

use App\Models\SchoolAdmin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class SchoolPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('school')
            ->path('school')
            ->login()
            // ->registration()
            ->colors([
                'primary' => [
                    50 => '#E6EBF2',
                    100 => '#B3C2D9',
                    200 => '#809AC0',
                    300 => '#4D71A6',
                    400 => '#1A498D',
                    500 => '#00295F',
                    600 => '#002456',
                    700 => '#001F4C',
                    800 => '#001942',
                    900 => '#001438',
                    950 => '#000F2E',
                ],
            ])
            ->brandName('School Portal')
            ->brandLogo(asset('assets/images/logo.jpeg'))
            ->brandLogoHeight('2.5rem')
            ->discoverResources(in: app_path('Filament/School/Resources'), for: 'App\\Filament\\School\\Resources')
            ->discoverPages(in: app_path('Filament/School/Pages'), for: 'App\\Filament\\School\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/School/Widgets'), for: 'App\\Filament\\School\\Widgets')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->authGuard('school')
            ->authPasswordBroker('school_admins');
    }
}
