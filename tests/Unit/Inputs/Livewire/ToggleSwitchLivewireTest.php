<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\LivewireFormBinding;

use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\Components\ToggleSwitch;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ToggleSwitchLivewireTest extends TestCase
{
    /** @test */
    public function it_can_remove_toggle_switch_name_html_attribute_when_wired(): void
    {
        $html = $this->renderComponent(
            componentClass: ToggleSwitch::class,
            componentData: ['name' => 'active'],
            attributes: ['wire:model.lazy' => 'active']
        );
        self::assertStringNotContainsString('name="active"', $html);
    }

    /** @test */
    public function it_can_remove_toggle_switch_value_html_attribute_when_wired(): void
    {
        $html = $this->renderComponent(
            componentClass: ToggleSwitch::class,
            componentData: ['name' => 'active'],
            attributes: ['wire' => 'lazy']
        );
        self::assertStringNotContainsString('value="', $html);
    }

    /** @test */
    public function it_can_define_toggle_switch_livewire_modifier_from_name(): void
    {
        $html = $this->renderComponent(
            componentClass: ToggleSwitch::class,
            componentData: ['name' => 'active'],
            attributes: ['wire' => 'lazy']
        );
        self::assertStringContainsString('wire:model.lazy="active"', $html);
    }

    /** @test */
    public function it_can_define_toggle_switch_livewire_modifier_from_livewire_normal_binding(): void
    {
        $html = $this->renderComponent(
            componentClass: ToggleSwitch::class,
            componentData: ['name' => 'active'],
            attributes: ['wire:model.lazy' => 'active']
        );
        self::assertStringContainsString('wire:model.lazy="active"', $html);
    }
}
