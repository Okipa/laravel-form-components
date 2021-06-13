<?php

namespace Okipa\LaravelFormComponents;

use Illuminate\Support\Arr;

class FormBinder
{
    public function __construct(protected array $boundDataBatches = [])
    {
        //
    }

    public function bindNewDataBatch(array|object|null $dataBatch): void
    {
        $this->boundDataBatches[] = $dataBatch;
    }

    public function getBoundDataBatch(): array|object|null
    {
        return Arr::last($this->boundDataBatches);
    }

    public function unbindLastDataBatch(): void
    {
        array_pop($this->boundDataBatches);
    }
}
