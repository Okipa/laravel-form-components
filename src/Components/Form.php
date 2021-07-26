<?php

namespace Okipa\LaravelFormComponents\Components;

use Okipa\LaravelFormComponents\Components\Abstracts\AbstractComponent;
use Okipa\LaravelFormComponents\FormBinder;

class Form extends AbstractComponent
{
    public function __construct(
        public string $method = 'GET',
        public array|object|null $bind = null,
        public string|null $errorBag = null
    ) {
        app(FormBinder::class)->bindNewDataBatch($bind);
        app(FormBinder::class)->bindNewErrorBag($errorBag);
        $this->method = strtoupper($method);
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'form';
    }
}
