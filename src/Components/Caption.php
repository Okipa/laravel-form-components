<?php

namespace Okipa\LaravelFormComponents\Components;

use Okipa\LaravelFormComponents\Components\Abstracts\AbstractComponent;

class Caption extends AbstractComponent
{
    public function __construct(public string $inputId, public string|null $caption)
    {
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'caption';
    }
}
