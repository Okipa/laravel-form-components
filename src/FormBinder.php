<?php

namespace Okipa\LaravelFormComponents;

use Illuminate\Support\Arr;

class FormBinder
{
    public function __construct(protected array $boundDataBatches = [], protected string|null $errorBagKey = null)
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

    public function bindNewErrorBag(string|null $errorBagKey): void
    {
        $this->errorBagKey = $errorBagKey;
    }

    public function getBoundErrorBag(): string|null
    {
        return $this->errorBagKey;
    }

    public function unbindErrorBag(): void
    {
        $this->errorBagKey = null;
    }
}
