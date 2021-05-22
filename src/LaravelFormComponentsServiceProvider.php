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
        // B
        foreach (config('form-components.components') as $component)
        {
            Blade::component($component);
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/form-components.php', 'form-components');
    }
}
