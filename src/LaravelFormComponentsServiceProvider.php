<?php

namespace Okipa\LaravelFormComponents;

use Illuminate\Database\Eloquent\Model;
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
        Blade::directive('model', function (Model $model) {
            return '<?php app(Okipa\LaravelFormComponents\FormBinder::class)->bindNewModel(' . $model . ') ?>';
        });
        Blade::directive('endmodel', function () {
            return '<?php app(Okipa\LaravelFormComponents\FormBinder::class)->unbindLastModel() ?>';
        });
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/form-components.php', 'form-components');
        $this->app->singleton(FormBinder::class, fn() => new FormBinder());
    }
}
