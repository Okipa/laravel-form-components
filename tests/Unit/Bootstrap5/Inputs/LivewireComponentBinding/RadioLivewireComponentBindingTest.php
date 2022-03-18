<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\LivewireComponentBinding;

use Okipa\LaravelFormComponents\Components\Radio;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class RadioLivewireComponentBindingTest extends TestCase
{
    /** @test */
    public function it_cant_define_radio_livewire_modifier_by_default_in_group_mode(): void
    {
        $html = $this->renderComponent(
            componentClass: Radio::class,
            componentData: [
                'name' => 'gender',
                'group' => [1 => 'Male', 2 => 'Female'],
            ],
        );
        self::assertStringNotContainsString('wire:model', $html);
    }

    /** @test */
    public function it_can_define_radio_livewire_modifier_from_name_in_group_mode(): void
    {
        $html = $this->renderComponent(
            componentClass: Radio::class,
            componentData: [
                'name' => 'gender',
                'group' => [1 => 'Male', 2 => 'Female'],
            ],
            attributes: ['wire' => 'lazy']
        );
        self::assertEquals(2, substr_count($html, ' wire:model.lazy="gender"'));
    }

    /** @test */
    public function it_can_define_radio_livewire_modifier_from_livewire_native_binding_in_group_mode(): void
    {
        $html = $this->renderComponent(
            componentClass: Radio::class,
            componentData: [
                'name' => 'gender',
                'group' => [1 => 'Male', 2 => 'Female'],
            ],
            attributes: ['wire:model.lazy' => 'gender']
        );
        self::assertEquals(2, substr_count($html, ' wire:model.lazy="gender"'));
    }

    /** @test */
    public function it_can_override_radio_form_livewire_modifier_binding_from_component_livewire_modifier_in_group_mode(): void
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
        self::assertEquals(2, substr_count($html, ' wire:model.lazy="gender"'));
    }

    /** @test */
    public function it_can_override_radio_form_livewire_modifier_binding_from_component_livewire_null_modifier_in_group_mode(): void
    {
        app(FormBinder::class)->bindNewLivewireModifier('debounce.150ms');
        $html = $this->renderComponent(
            componentClass: Radio::class,
            componentData: [
                'name' => 'gender',
                'group' => [1 => 'Male', 2 => 'Female'],
            ],
            attributes: ['wire' => true]
        );
        self::assertEquals(2, substr_count($html, ' wire:model="gender"'));
    }
}
