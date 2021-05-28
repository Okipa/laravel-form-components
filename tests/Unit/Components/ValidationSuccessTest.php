<?php

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ValidationSuccessTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_globally_set_display_input_validation_success(): void
    {
        config()->set('form-components.display_validation_success', true);
        $input = app(Input::class, ['name' => 'first_name']);
        self::assertTrue($input->displayValidationSuccess);
        config()->set('form-components.display_validation_success', false);
        $input = app(Input::class, ['name' => 'first_name']);
        self::assertFalse($input->displayValidationSuccess);
    }

    /** @test */
    public function it_can_globally_set_display_textarea_validation_success(): void
    {
        config()->set('form-components.display_validation_success', true);
        $textarea = app(Textarea::class, ['name' => 'first_name']);
        self::assertTrue($textarea->displayValidationSuccess);
        config()->set('form-components.display_validation_success', false);
        $textarea = app(Textarea::class, ['name' => 'first_name']);
        self::assertFalse($textarea->displayValidationSuccess);
    }

    /** @test */
    public function it_can_display_input_validation_success_when_allowed(): void
    {
        config()->set('form-components.display_validation_success', false);
        $messageBag = app(MessageBag::class)->add('other_field', 'Error test');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'displayValidationSuccess' => true
        ]);
        self::assertStringContainsString(' is-valid', $html);
    }

    /** @test */
    public function it_can_display_textarea_validation_success_when_allowed(): void
    {
        config()->set('form-components.display_validation_success', false);
        $messageBag = app(MessageBag::class)->add('other_field', 'Error test');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'first_name',
            'displayValidationSuccess' => true
        ]);
        self::assertStringContainsString(' is-valid', $html);
    }

    /** @test */
    public function it_cant_display_input_validation_success_when_disallowed(): void
    {
        config()->set('form-components.display_validation_success', true);
        $messageBag = app(MessageBag::class)->add('other_field', 'Error test');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'displayValidationSuccess' => false
        ]);
        self::assertStringNotContainsString(' is-valid', $html);
    }

    /** @test */
    public function it_cant_display_textarea_validation_success_when_disallowed(): void
    {
        config()->set('form-components.display_validation_success', true);
        $messageBag = app(MessageBag::class)->add('other_field', 'Error test');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'first_name',
            'displayValidationSuccess' => false
        ]);
        self::assertStringNotContainsString(' is-valid', $html);
    }
}
