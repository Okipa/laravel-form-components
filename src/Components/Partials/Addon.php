<?php

namespace Okipa\LaravelFormComponents\Components\Partials;

use Closure;
use Okipa\LaravelFormComponents\Components\Abstracts\AbstractComponent;

class Addon extends AbstractComponent
{
    public function __construct(public string|Closure $addon)
    {
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'partials.addon';
    }
}
