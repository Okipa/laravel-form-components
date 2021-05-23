<?php

namespace Okipa\LaravelFormComponents\Components;

class Label extends AbstractComponent
{
    public function __construct(public string $id, public string|null $label)
    {
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'label';
    }
}
