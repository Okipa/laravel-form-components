<?php

namespace Okipa\LaravelFormComponents;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class FormBinder
{
    protected array $boundModels = [];

    public function bindNewModel(Model $model): void
    {
        $this->boundModels[] = $model;
    }

    public function getBoundModel(): Model|null
    {
        data_get();
        return Arr::last($this->boundModels);
    }

    public function unbindLastModel(): void
    {
        array_pop($this->boundModels);
    }
}
