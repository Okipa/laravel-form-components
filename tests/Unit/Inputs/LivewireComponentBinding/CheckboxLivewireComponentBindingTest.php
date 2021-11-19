<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\LivewireComponentBinding;

use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class CheckboxLivewireComponentBindingTest extends TestCase
{
    /** @test */
    public function it_can_remove_checkbox_name_html_attribute_when_wired(): void
    {
        $html = $this->renderComponent(
            componentClass: Checkbox::class,
            componentData: ['name' => 'active'],
            attributes: ['wire' => 'lazy']
        );
        self::assertStringNotContainsString('name="', $html);
    }

    /** @test */
    public function it_can_remove_checkbox_value_html_attribute_when_wired(): void
    {
        $html = $this->renderComponent(
            componentClass: Checkbox::class,
            componentData: ['name' => 'active'],
            attributes: ['wire' => 'lazy']
        );
        self::assertStringNotContainsString(' value="', $html);
    }

    /** @test */
    public function it_cant_define_checkbox_livewire_modifier_by_default(): void
    {
        $html = $this->renderComponent(
            componentClass: Checkbox::class,
            componentData: ['name' => 'active'],
        );
        self::assertStringNotContainsString('wire:model', $html);
    }

    /** @test */
    public function it_can_define_checkbox_livewire_modifier_from_name(): void
    {
        $html = $this->renderComponent(
            componentClass: Checkbox::class,
            componentData: ['name' => 'active'],
            attributes: ['wire' => 'lazy']
        );
        self::assertStringContainsString('wire:model.lazy="active"', $html);
    }

    /** @test */
    public function it_can_define_checkbox_livewire_modifier_from_livewire_native_binding(): void
    {
        $html = $this->renderComponent(
            componentClass: Checkbox::class,
            componentData: ['name' => 'active'],
            attributes: ['wire:model.lazy' => 'active']
        );
        self::assertStringContainsString('wire:model.lazy="active"', $html);
    }

    /** @test */
    public function it_can_override_checkbox_form_livewire_modifier_binding_from_component_livewire_modifier(): void
    {
        app(FormBinder::class)->bindNewLivewireModifier('debounce.150ms');
        $html = $this->renderComponent(
            componentClass: Checkbox::class,
            componentData: ['name' => 'active'],
            attributes: ['wire' => 'lazy']
        );
        self::assertStringContainsString('wire:model.lazy="active"', $html);
    }

    /** @test */
    public function it_can_override_checkbox_form_livewire_modifier_binding_from_component_livewire_null_modifier(): void
    {
        app(FormBinder::class)->bindNewLivewireModifier('debounce.150ms');
        $html = $this->renderComponent(
            componentClass: Checkbox::class,
            componentData: ['name' => 'active'],
            attributes: ['wire' => true]
        );
        self::assertStringContainsString('wire:model="active"', $html);
    }
}
