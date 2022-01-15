<?php

namespace Okipa\LaravelFormComponents\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Okipa\LaravelFormComponents\FormBinder;

class Form extends Component
{
    public function __construct(
        public string $method = 'GET',
        public array|object|null $bind = null,
        public string|null $errorBag = null,
        public string|null $wire = null
    ) {
        if ($bind) {
            app(FormBinder::class)->bindNewDataBatch($bind);
        }
        if ($errorBag) {
            app(FormBinder::class)->bindErrorBag($errorBag);
        }
        if ($wire) {
            app(FormBinder::class)->bindNewLivewireModifier($wire === '1' ? null : $wire);
        }
        $this->method = strtoupper($method);
    }

    public function render(): View
    {
        return view('form-components::form');
    }
}
