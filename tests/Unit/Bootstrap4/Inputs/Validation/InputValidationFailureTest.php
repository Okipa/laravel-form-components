<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap4\Inputs\Validation;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelFormComponents\Components\Input;

class InputValidationFailureTest extends \Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Validation\InputValidationFailureTest
{
    /** @test */
    public function it_can_display_input_file_validation_failure_when_allowed(): void
    {
        config()->set('form-components.display_validation_failure', false);
        $messageBag = app(MessageBag::class)->add('first_name', 'Error test');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(Input::class, [
            'type' => 'file',
            'name' => 'first_name',
            'displayValidationFailure' => true,
        ]);
        $this->assertSeeHtmlInOrder($html, [
            '<div class="custom-file is-invalid">',
            '<input',
            ' class="custom-file-input"',
            '<div class="invalid-feedback">Error test</div>',
        ]);
    }
}
