<?php

namespace Okipa\LaravelFormComponents;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LaravelFormComponentsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'form-components');
        $this->publishes([
            __DIR__ . '/../config/form-components.php' => config_path('form-components.php'),
        ], 'form-components:config');
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/form-components'),
        ], 'form-components:views');
        $this->declareComponents();
        $this->declareBladeDirectives();
    }

    protected function declareComponents(): void
    {
        Blade::componentNamespace('Okipa\\LaravelFormComponents\\Components', 'form');
    }

    protected function declareBladeDirectives(): void
    {
        Blade::directive('bind', function ($dataBatch) {
            return '<?php app(Okipa\LaravelFormComponents\FormBinder::class)->bindNewDataBatch(' . $dataBatch . ') ?>';
        });
        Blade::directive('endbind', function () {
            return '<?php app(Okipa\LaravelFormComponents\FormBinder::class)->unbindLastDataBatch() ?>';
        });
        Blade::directive('errorbag', function ($errorBagKey) {
            return '<?php app(Okipa\LaravelFormComponents\FormBinder::class)->bindErrorBag(' . $errorBagKey . ') ?>';
        });
        Blade::directive('enderrorbag', function () {
            return '<?php app(Okipa\LaravelFormComponents\FormBinder::class)->unbindErrorBag() ?>';
        });
        Blade::directive('wire', function ($livewireModifier) {
            return '<?php app(Okipa\LaravelFormComponents\FormBinder::class)->bindLivewireModifier('
                . $livewireModifier . ') ?>';
        });
        Blade::directive('endwire', function () {
            return '<?php app(Okipa\LaravelFormComponents\FormBinder::class)->unbindLivewireModifier() ?>';
        });
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/form-components.php', 'form-components');
        $this->app->singleton(FormBinder::class, fn() => new FormBinder());
    }
}
