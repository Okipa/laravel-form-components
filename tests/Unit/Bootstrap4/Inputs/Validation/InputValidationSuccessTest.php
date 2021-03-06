<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap4\Inputs\Validation;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelFormComponents\Components\Input;

class InputValidationSuccessTest extends \Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Validation\InputValidationSuccessTest
{
    /** @test */
    public function it_can_display_input_file_validation_success(): void
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

    /** @test */
    public function it_can_display_input_file_validation_success_with_prepend_addon(): void
    {
        config()->set('form-components.display_validation_success', false);
        $messageBag = app(MessageBag::class)->add('other_field', 'Error test');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(Input::class, [
            'type' => 'file',
            'name' => 'first_name',
            'prepend' => 'Test prepend',
            'displayValidationSuccess' => true,
        ]);
        $this->assertSeeHtmlInOrder($html, [
            '<div class="input-group is-valid">',
            '<div class="custom-file">',
            '<input',
            ' class="custom-file-input"',
        ]);
    }

    /** @test */
    public function it_can_display_input_file_validation_success_with_append_addon(): void
    {
        config()->set('form-components.display_validation_success', false);
        $messageBag = app(MessageBag::class)->add('other_field', 'Error test');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(Input::class, [
            'type' => 'file',
            'name' => 'first_name',
            'append' => 'Test append',
            'displayValidationSuccess' => true,
        ]);
        $this->assertSeeHtmlInOrder($html, [
            '<div class="input-group is-valid">',
            '<div class="custom-file">',
            '<input',
            ' class="custom-file-input"',
        ]);
    }
}
