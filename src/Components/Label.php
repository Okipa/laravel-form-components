<?php

namespace Okipa\LaravelFormComponents\Components;

class Label extends AbstractComponent
{
    public function __construct(public string $id, public string $label)
    {
        //
    }

    protected function setViewPath(): string
    {
        return 'label';
    }
}
