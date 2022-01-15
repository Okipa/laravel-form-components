<?php

namespace Okipa\LaravelFormComponents\Components\Partials;

use Okipa\LaravelFormComponents\Components\Abstracts\AbstractComponent;

class Label extends AbstractComponent
{
    public function __construct(public string|null $label, public string|null $id = null)
    {
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'partials.label';
    }
}
