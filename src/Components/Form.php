<?php

namespace Okipa\LaravelFormComponents\Components;

use Okipa\LaravelFormComponents\Components\Abstracts\AbstractComponent;
use Okipa\LaravelFormComponents\FormBinder;

class Form extends AbstractComponent
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
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'form';
    }
}
