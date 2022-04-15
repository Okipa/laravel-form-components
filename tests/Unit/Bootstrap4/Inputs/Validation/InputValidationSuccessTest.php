<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap4\Inputs\Validation;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelFormComponents\Components\Input;

class InputValidationSuccessTest extends \Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Validation\InputValidationSuccessTest
{
    /** @test */
    public function it_can_display_input_file_validation_success_when_allowed(): void
    {
        config()->set('form-components.display_validation_success', false);
        $messageBag = app(MessageBag::class)->add('other_field', 'Error test');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(Input::class, [
            'type' => 'file',
            'name' => 'first_name',
            'displayValidationSuccess' => true,
        ]);
        $this->assertSeeHtmlInOrder($html, [
            '<div class="custom-file is-valid">',
            '<input',
            ' class="custom-file-input"',
        ]);
    }
}
