<?php

namespace Okipa\LaravelFormComponents\Components;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

abstract class AbstractComponent extends Component
{
    protected string $viewPath;

    public function __construct()
    {
        $this->viewPath = $this->setViewPath();
    }

    abstract protected function setViewPath(): string;

    protected function shouldDisplaySucceededValidation(): bool
    {
        return is_null($this->displayFailure)
            ? config('form-components.display_succeeded_validation', true)
            : $this->displayFailure;
    }

    public function render(): View|Factory|Htmlable|Closure|string|Application
    {
        return view('form-components::' . config('form-components.ui') . '.' . $this->viewPath);
    }
}
