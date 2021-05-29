<?php

namespace Okipa\LaravelFormComponents\Components\Partials;

use Okipa\LaravelFormComponents\Components\Abstracts\AbstractComponent;

class Label extends AbstractComponent
{
    public function __construct(public string $id, public string|null $label)
    {
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'partials.label';
    }
}
