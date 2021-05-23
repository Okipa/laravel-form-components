<?php

namespace Okipa\LaravelFormComponents\Components;

use Closure;

class Addon extends AbstractComponent
{
    public function __construct(public string|Closure $addon)
    {
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'addon';
    }
}
