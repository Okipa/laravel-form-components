<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap4\Inputs\Label;

use Okipa\LaravelFormComponents\Components\ToggleSwitch;

class ToggleSwitchLabelTest extends \Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Label\ToggleSwitchLabelTest
{
    /** @test */
    public function it_can_setup_toggle_switch_default_label_when_none_is_defined(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active']);
        self::assertStringContainsString(' class="custom-control-label">validation.attributes.active</label>', $html);
    }

    /** @test */
    public function it_can_setup_toggle_switch_default_label_with_array_name_when_none_is_defined(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active[0]']);
        self::assertStringContainsString(' class="custom-control-label">validation.attributes.active</label>', $html);
    }

    /** @test */
    public function it_can_set_toggle_switch_label(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active', 'label' => 'Test label']);
        self::assertStringContainsString(' class="custom-control-label">Test label</label>', $html);
    }

    /** @test */
    public function it_can_set_toggle_switches_labels_in_group_mode(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, [
            'name' => 'technologies',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
        ]);
        self::assertStringContainsString(' class="custom-control-label">Laravel</label>', $html);
        self::assertStringContainsString(' class="custom-control-label">Bootstrap</label>', $html);
        self::assertStringContainsString(' class="custom-control-label">Tailwind</label>', $html);
        self::assertStringContainsString(' class="custom-control-label">Livewire</label>', $html);
    }
}
