<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\LivewireFormBinding;

use Okipa\LaravelFormComponents\Components\ToggleSwitch;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ToggleSwitchLivewireFormBindingTest extends TestCase
{
    /** @test */
    public function it_can_override_toggle_switch_global_livewire_modifier_binding_from_component_livewire_modifier(): void
    {
        app(FormBinder::class)->bindNewLivewireModifier('debounce.150ms');
        $html = $this->renderComponent(
            componentClass: ToggleSwitch::class,
            componentData: ['name' => 'active'],
            attributes: ['wire' => 'lazy']
        );
        self::assertStringContainsString('wire:model.lazy="active"', $html);
    }

    /** @test */
    public function it_can_override_toggle_switch_global_livewire_modifier_binding_from_component_livewire_null_modifier(): void
    {
        app(FormBinder::class)->bindNewLivewireModifier('debounce.150ms');
        $html = $this->renderComponent(
            componentClass: ToggleSwitch::class,
            componentData: ['name' => 'active'],
            attributes: ['wire' => null]
        );
        self::assertStringContainsString('wire:model="active"', $html);
    }

    /** @test */
    public function it_can_override_toggle_switch_global_modifier_with_another_global_null_modifier(): void
    {
        app(FormBinder::class)->bindNewLivewireModifier('debounce.150ms');
        $html = $this->renderComponent(
            componentClass: ToggleSwitch::class,
            componentData: ['name' => 'active'],
        );
        self::assertStringContainsString('wire:model.debounce.150ms="active"', $html);
        app(FormBinder::class)->bindNewLivewireModifier(null);
        $html = $this->renderComponent(
            componentClass: ToggleSwitch::class,
            componentData: ['name' => 'active'],
        );
        self::assertStringContainsString('wire:model="active"', $html);
        app(FormBinder::class)->unbindLastLivewireModifier();
        $html = $this->renderComponent(
            componentClass: ToggleSwitch::class,
            componentData: ['name' => 'active'],
        );
        self::assertStringContainsString('wire:model.debounce.150ms="active"', $html);
    }
}
