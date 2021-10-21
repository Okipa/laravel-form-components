<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\LivewireFormBinding;

use Okipa\LaravelFormComponents\Components\Radio;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class RadioLivewireFormBindingTest extends TestCase
{
    /** @test */
    public function it_can_override_radio_global_livewire_modifier_binding_from_component_livewire_modifier(): void
    {
        app(FormBinder::class)->bindNewLivewireModifier('debounce.150ms');
        $html = $this->renderComponent(
            componentClass: Radio::class,
            componentData: [
                'name' => 'gender',
                'group' => [1 => 'Male', 2 => 'Female'],
            ],
            attributes: ['wire' => 'lazy']
        );
        self::assertStringContainsString('wire:model.lazy="gender"', $html);
    }

    /** @test */
    public function it_can_override_radio_global_livewire_modifier_binding_from_component_livewire_null_modifier(): void
    {
        app(FormBinder::class)->bindNewLivewireModifier('debounce.150ms');
        $html = $this->renderComponent(
            componentClass: Radio::class,
            componentData: [
                'name' => 'gender',
                'group' => [1 => 'Male', 2 => 'Female'],
            ],
            attributes: ['wire' => null]
        );
        self::assertStringContainsString('wire:model="gender"', $html);
    }

    /** @test */
    public function it_can_override_radio_global_modifier_with_another_global_null_modifier(): void
    {
        app(FormBinder::class)->bindNewLivewireModifier('debounce.150ms');
        $html = $this->renderComponent(
            componentClass: Radio::class,
            componentData: [
                'name' => 'gender',
                'group' => [1 => 'Male', 2 => 'Female'],
            ],
        );
        self::assertStringContainsString('wire:model.debounce.150ms="gender"', $html);
        app(FormBinder::class)->bindNewLivewireModifier(null);
        $html = $this->renderComponent(
            componentClass: Radio::class,
            componentData: [
                'name' => 'gender',
                'group' => [1 => 'Male', 2 => 'Female'],
            ],
        );
        self::assertStringContainsString('wire:model="gender"', $html);
        app(FormBinder::class)->unbindLastLivewireModifier();
        $html = $this->renderComponent(
            componentClass: Radio::class,
            componentData: [
                'name' => 'gender',
                'group' => [1 => 'Male', 2 => 'Female'],
            ],
        );
        self::assertStringContainsString('wire:model.debounce.150ms="gender"', $html);
    }
}
