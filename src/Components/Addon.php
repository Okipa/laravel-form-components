<?php

namespace Okipa\LaravelFormComponents\Components;

class Addon extends AbstractComponent
{
    public function __construct(public string $addon)
    {
        //
    }

    protected function setViewPath(): string
    {
        return 'addon';
    }
}
