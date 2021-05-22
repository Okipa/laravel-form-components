<?php

namespace Okipa\LaravelFormComponents\Components;

class Caption extends AbstractComponent
{
    public function __construct(public string $caption)
    {
        //
    }

    protected function setViewPath(): string
    {
        return 'caption';
    }
}
