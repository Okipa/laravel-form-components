<?php

namespace Okipa\LaravelFormComponents;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class FormBinder
{
    protected array $boundModels = [];

    public function bindModel(Model $model): void
    {
        $this->boundModels[] = $model;
    }

    public function getBoundModel(): Model|null
    {
        return Arr::last($this->boundModels);
    }

    public function unbindLastModel(): void
    {
        array_pop($this->boundModels);
    }
}
