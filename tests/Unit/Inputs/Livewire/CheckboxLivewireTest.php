<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\LivewireFormBinding;

use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\Tests\TestCase;

class CheckboxLivewireTest extends TestCase
{
    /** @test */
    public function it_can_remove_checkbox_name_html_attribute_when_wired(): void
    {
        $html = $this->renderComponent(
            componentClass: Checkbox::class,
            componentData: ['name' => 'active'],
            attributes: ['wire:model.lazy' => 'active']
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
        self::assertStringNotContainsString('value="', $html);
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
    public function it_can_define_checkbox_livewire_modifier_from_livewire_normal_binding(): void
    {
        $html = $this->renderComponent(
            componentClass: Checkbox::class,
            componentData: ['name' => 'active'],
            attributes: ['wire:model.lazy' => 'active']
        );
        self::assertStringContainsString('wire:model.lazy="active"', $html);
    }
}
