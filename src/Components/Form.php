<?php

namespace Okipa\LaravelFormComponents\Components;

use Okipa\LaravelFormComponents\Components\Abstracts\AbstractComponent;
use Okipa\LaravelFormComponents\FormBinder;

class Form extends AbstractComponent
{
    public function __construct(
        public string $method = 'GET',
        array|object|null $bind = null,
        string|null $errorBag = null,
        string|null $wire = null
    ) {
        app(FormBinder::class)->bindNewDataBatch($bind);
        app(FormBinder::class)->bindErrorBag($errorBag);
        app(FormBinder::class)->bindNewLivewireModifier($wire);
        $this->method = strtoupper($method);
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'form';
    }
}
