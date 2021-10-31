<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Validation;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\Tests\TestCase;

class CheckboxValidationSuccessTest extends TestCase
{
    /** @test */
    public function it_can_globally_set_display_checkbox_validation_success(): void
    {
        config()->set('form-components.display_validation_success', true);
        $component = app(Checkbox::class, ['name' => 'active']);
        self::assertTrue($component->shouldDisplayValidationSuccess());
        config()->set('form-components.display_validation_success', false);
        $component = app(Checkbox::class, ['name' => 'active']);
        self::assertFalse($component->shouldDisplayValidationSuccess());
    }

    /** @test */
    public function it_can_display_checkbox_validation_success_when_allowed(): void
    {
        config()->set('form-components.display_validation_success', false);
        $messageBag = app(MessageBag::class)->add('other_field', 'Error test');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'active',
            'displayValidationSuccess' => true,
        ]);
        self::assertStringContainsString(' is-valid', $html);
    }

    /** @test */
    public function it_can_display_checkboxes_validation_success_when_allowed_in_group_mode(): void
    {
        config()->set('form-components.display_validation_success', false);
        $messageBag = app(MessageBag::class)->add('other_field', 'Error test');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'technologies',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
            'displayValidationSuccess' => true,
        ]);
        self::assertEquals(1, substr_count($html, ' is-valid'));
    }

    /** @test */
    public function it_cant_display_checkbox_validation_success_when_disallowed(): void
    {
        config()->set('form-components.display_validation_success', true);
        $messageBag = app(MessageBag::class)->add('other_field', 'Error test');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'active',
            'displayValidationSuccess' => false,
        ]);
        self::assertStringNotContainsString(' is-valid', $html);
    }
}
