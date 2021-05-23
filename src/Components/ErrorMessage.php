<?php

namespace Okipa\LaravelFormComponents\Components;

use Illuminate\Support\ViewErrorBag;

class ErrorMessage extends AbstractComponent
{
    public string|null $errorMessage;

    public function __construct(public ViewErrorBag|null $errors)
    {
        $this->errorMessage = $this->errorMessage($errors);
        parent::__construct();
    }

    protected function errorMessage(ViewErrorBag|null $errors): string|null
    {
        if (! $errors) {
            return null;
        }
        if (! $this->shouldDisplayFailedValidation()) {
            return null;
        }

        return $this->getErrorMessageBag($errors)->first($this->getNameWithArrayNotationConvertedInto());
    }

    protected function setViewPath(): string
    {
        return 'error-message';
    }
}
