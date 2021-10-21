<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\LivewireFormBinding;

use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class InputLivewireFormBindingTest extends TestCase
{
    /** @test */
    public function it_can_override_input_global_livewire_modifier_binding_from_component_livewire_modifier(): void
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
    public function it_can_override_input_global_livewire_modifier_binding_from_component_livewire_null_modifier(): void
    {
        app(FormBinder::class)->bindNewLivewireModifier('debounce.150ms');
        $html = $this->renderComponent(
            componentClass: Input::class,
            componentData: ['name' => 'first_name'],
            attributes: ['wire' => null]
        );
        self::assertStringContainsString('wire:model="first_name"', $html);
    }

    /** @test */
    public function it_can_override_input_global_modifier_with_another_global_null_modifier(): void
    {
        app(FormBinder::class)->bindNewLivewireModifier('debounce.150ms');
        $html = $this->renderComponent(
            componentClass: Input::class,
            componentData: ['name' => 'first_name'],
        );
        self::assertStringContainsString('wire:model.debounce.150ms="first_name"', $html);
        app(FormBinder::class)->bindNewLivewireModifier(null);
        $html = $this->renderComponent(
            componentClass: Input::class,
            componentData: ['name' => 'first_name'],
        );
        self::assertStringContainsString('wire:model="first_name"', $html);
        app(FormBinder::class)->unbindLastLivewireModifier();
        $html = $this->renderComponent(
            componentClass: Input::class,
            componentData: ['name' => 'first_name'],
        );
        self::assertStringContainsString('wire:model.debounce.150ms="first_name"', $html);
    }
}
