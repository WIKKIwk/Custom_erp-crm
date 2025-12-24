<?php

namespace App\Providers;

use App\Services\Cache\Cache;
use App\Services\Cache\RedisCache;
use Filament\Support\Assets\Css;
use Illuminate\Support\Facades\Blade;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\ServiceProvider;
use App\Services\Cache\FileCache;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Services\Cache\Cache::class, function () {
            return new FileCache();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
//        Model::preventLazyLoading(! $this->app->isProduction());

        FilamentAsset::register([
            Css::make('custom-stylesheet', __DIR__ . '/../../resources/css/custom.css'),
        ]);

        FilamentView::registerRenderHook(
            PanelsRenderHook::BODY_END,
            fn (): string => Blade::render('@livewire("confirm-supply-modal")')
        );
    }
}
