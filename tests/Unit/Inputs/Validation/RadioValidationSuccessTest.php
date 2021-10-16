<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Validation;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\Components\Radio;
use Okipa\LaravelFormComponents\Tests\TestCase;

class RadioValidationSuccessTest extends TestCase
{
    /** @test */
    public function it_can_globally_set_display_radio_validation_success(): void
    {
        config()->set('form-components.display_validation_success', true);
        $component = app(Radio::class, [
            'name' => 'gender',
            'group' => ['female' => 'Female', 'male' => 'Male'],
        ]);
        self::assertTrue($component->shouldDisplayValidationSuccess());
        config()->set('form-components.display_validation_success', false);
        $component = app(Radio::class, [
            'name' => 'gender',
            'group' => ['female' => 'Female', 'male' => 'Male'],
        ]);
        self::assertFalse($component->shouldDisplayValidationSuccess());
    }

    /** @test */
    public function it_can_display_radio_validation_success_when_allowed(): void
    {
        config()->set('form-components.display_validation_success', false);
        $messageBag = app(MessageBag::class)->add('other_field', 'Error test');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['female' => 'Female', 'male' => 'Male'],
            'displayValidationSuccess' => true,
        ]);
        self::assertStringContainsString(' is-valid', $html);
    }

    /** @test */
    public function it_cant_display_radio_validation_success_when_disallowed(): void
    {
        config()->set('form-components.display_validation_success', true);
        $messageBag = app(MessageBag::class)->add('other_field', 'Error test');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['female' => 'Female', 'male' => 'Male'],
            'displayValidationSuccess' => false,
        ]);
        self::assertStringNotContainsString(' is-valid', $html);
    }
}
