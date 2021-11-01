<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\MarginBottom;

use Okipa\LaravelFormComponents\Components\ToggleSwitch;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ToggleSwitchMarginBottomTest extends TestCase
{
    /** @test */
    public function it_can_enable_toggle_switch_margin_bottom_by_default(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active']);
        self::assertStringContainsString('mb-3', $html);
    }

    /** @test */
    public function it_can_enable_toggle_switches_group_margin_bottom_by_default_in_group_mode(): void
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
        self::assertEquals(1, substr_count($html, '<div class="mb-3">'));
    }

    /** @test */
    public function it_can_disable_toggle_switch_margin_bottom(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active', 'marginBottom' => false]);
        self::assertStringNotContainsString('mb-3', $html);
    }

    /** @test */
    public function it_can_disable_toggle_switches_group_margin_bottom_in_group_mode(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, [
            'name' => 'technologies',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
            'marginBottom' => false,
        ]);
        self::assertStringNotContainsString('<div class="mb-3">', $html);
    }
}
