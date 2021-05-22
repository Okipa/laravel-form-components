<?php

namespace Okipa\LaravelFormComponents\Components;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

abstract class AbstractComponent extends Component
{
    protected string $viewPath;

    abstract protected function setViewPath(): string;

    public function render(): View|Factory|Htmlable|Closure|string|Application
    {
        return view('form-components::' . config('form-components.ui') . '.' . $this->viewPath);
    }
}
