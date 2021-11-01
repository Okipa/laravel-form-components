<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\LivewireComponentBinding;

use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class TextareaLivewireComponentBindingTest extends TestCase
{
    /** @test */
    public function it_can_remove_textarea_name_html_attribute_when_wired(): void
    {
        $html = $this->renderComponent(
            componentClass: Textarea::class,
            componentData: ['name' => 'description'],
            attributes: ['wire:model.lazy' => 'description']
        );
        self::assertStringNotContainsString('name="', $html);
    }

    /** @test */
    public function it_can_remove_textarea_value_html_attribute_when_wired(): void
    {
        $html = $this->renderComponent(
            componentClass: Textarea::class,
            componentData: ['name' => 'description'],
            attributes: ['wire' => 'lazy']
        );
        self::assertStringNotContainsString(' value="', $html);
    }

    /** @test */
    public function it_cant_define_checkbox_livewire_modifier_by_default(): void
    {
        $html = $this->renderComponent(
            componentClass: Textarea::class,
            componentData: ['name' => 'description'],
        );
        self::assertStringNotContainsString('wire:model', $html);
    }

    /** @test */
    public function it_can_define_textarea_livewire_modifier_from_name(): void
    {
        $html = $this->renderComponent(
            componentClass: Textarea::class,
            componentData: ['name' => 'description'],
            attributes: ['wire' => 'lazy']
        );
        self::assertStringContainsString('wire:model.lazy="description"', $html);
    }

    /** @test */
    public function it_can_define_textarea_livewire_modifier_from_livewire_normal_binding(): void
    {
        $html = $this->renderComponent(
            componentClass: Textarea::class,
            componentData: ['name' => 'description'],
            attributes: ['wire:model.lazy' => 'description']
        );
        self::assertStringContainsString('wire:model.lazy="description"', $html);
    }

    /** @test */
    public function it_can_override_textarea_form_livewire_modifier_binding_from_component_livewire_modifier(): void
    {
        app(FormBinder::class)->bindNewLivewireModifier('debounce.150ms');
        $html = $this->renderComponent(
            componentClass: Textarea::class,
            componentData: ['name' => 'description'],
            attributes: ['wire' => 'lazy']
        );
        self::assertStringContainsString('wire:model.lazy="description"', $html);
    }

    /** @test */
    public function it_can_override_textarea_form_livewire_modifier_binding_from_component_livewire_null_modifier(): void
    {
        app(FormBinder::class)->bindNewLivewireModifier('debounce.150ms');
        $html = $this->renderComponent(
            componentClass: Textarea::class,
            componentData: ['name' => 'description'],
            attributes: ['wire' => null]
        );
        self::assertStringContainsString('wire:model="description"', $html);
    }
}
