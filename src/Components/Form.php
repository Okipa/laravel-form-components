<?php

namespace Okipa\LaravelFormComponents\Components;

use Okipa\LaravelFormComponents\Components\Abstracts\AbstractComponent;

class Form extends AbstractComponent
{
    public function __construct(public string $method = 'GET', public array|object|null $bind = null)
    {
        $this->method = strtoupper($method);
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'form';
    }
}
