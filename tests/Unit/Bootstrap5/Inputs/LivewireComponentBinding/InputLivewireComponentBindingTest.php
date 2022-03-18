<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\LivewireComponentBinding;

use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class InputLivewireComponentBindingTest extends TestCase
{
    /** @test */
    public function it_can_remove_input_value_html_attribute_when_wired(): void
    {
        $html = $this->renderComponent(
            componentClass: Input::class,
            componentData: ['name' => 'first_name'],
            attributes: ['wire' => 'lazy']
        );
        self::assertStringNotContainsString(' value="', $html);
    }

    /** @test */
    public function it_cant_define_input_livewire_modifier_by_default(): void
    {
        $html = $this->renderComponent(
            componentClass: Input::class,
            componentData: ['name' => 'first_name'],
        );
        self::assertStringNotContainsString('wire:model', $html);
    }

    /** @test */
    public function it_can_define_input_livewire_modifier_from_name(): void
    {
        $html = $this->renderComponent(
            componentClass: Input::class,
            componentData: ['name' => 'first_name'],
            attributes: ['wire' => 'lazy']
        );
        self::assertStringContainsString('wire:model.lazy="first_name"', $html);
    }

    /** @test */
    public function it_can_define_input_livewire_modifier_from_livewire_native_binding(): void
    {
        $html = $this->renderComponent(
            componentClass: Input::class,
            componentData: ['name' => 'first_name'],
            attributes: ['wire:model.lazy' => 'first_name']
        );
        self::assertStringContainsString('wire:model.lazy="first_name"', $html);
    }

    /** @test */
    public function it_can_override_input_form_livewire_modifier_binding_from_component_livewire_modifier(): void
    {
        app(FormBinder::class)->bindNewLivewireModifier('debounce.150ms');
        $html = $this->renderComponent(
            componentClass: Input::class,
            componentData: ['name' => 'first_name'],
            attributes: ['wire' => 'lazy']
        );
        self::assertStringContainsString('wire:model.lazy="first_name"', $html);
    }

    /** @test */
    public function it_can_override_input_form_livewire_modifier_binding_from_component_livewire_null_modifier(): void
    {
        app(FormBinder::class)->bindNewLivewireModifier('debounce.150ms');
        $html = $this->renderComponent(
            componentClass: Input::class,
            componentData: ['name' => 'first_name'],
            attributes: ['wire' => true]
        );
        self::assertStringContainsString('wire:model="first_name"', $html);
    }
}
