<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Label;

use Okipa\LaravelFormComponents\Components\ToggleSwitch;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ToggleSwitchLabelTest extends TestCase
{
    /** @test */
    public function it_can_setup_toggle_switch_default_label_when_none_is_defined(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active']);
        self::assertStringContainsString(' class="form-check-label">validation.attributes.active</label>', $html);
    }

    /** @test */
    public function it_can_setup_toggle_switch_default_label_with_array_name_when_none_is_defined(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active[0]']);
        self::assertStringContainsString(' class="form-check-label">validation.attributes.active</label>', $html);
    }

    /** @test */
    public function it_can_set_toggle_switch_label(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active', 'label' => 'Test label']);
        self::assertStringContainsString(' class="form-check-label">Test label</label>', $html);
    }

    /** @test */
    public function it_can_hide_toggle_switch_label(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active', 'label' => false]);
        self::assertStringNotContainsString('<label', $html);
    }

    /** @test */
    public function it_can_set_toggle_switches_group_label_in_group_mode(): void
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
        self::assertEquals(
            1,
            mb_substr_count($html, '<label class="form-label">validation.attributes.technologies</label>')
        );
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
        self::assertStringContainsString(' class="form-check-label">Laravel</label>', $html);
        self::assertStringContainsString(' class="form-check-label">Bootstrap</label>', $html);
        self::assertStringContainsString(' class="form-check-label">Tailwind</label>', $html);
        self::assertStringContainsString(' class="form-check-label">Livewire</label>', $html);
    }
}
