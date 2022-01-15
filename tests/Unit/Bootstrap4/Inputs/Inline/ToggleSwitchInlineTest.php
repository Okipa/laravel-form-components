<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap4\Inputs\Inline;

use Okipa\LaravelFormComponents\Components\ToggleSwitch;

class ToggleSwitchInlineTest extends \Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Inline\ToggleSwitchInlineTest
{
    /** @test */
    public function it_can_set_toggle_switch_stacked_mode_by_default(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active']);
        self::assertStringNotContainsString('class="custom-check custom-switch form-check-inline', $html);
    }

    /** @test */
    public function it_can_set_toggle_switches_stacked_mode_by_default_in_group_mode(): void
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
        self::assertStringNotContainsString('class="custom-check custom-switch form-check-inline', $html);
    }

    /** @test */
    public function it_can_set_toggle_switch_inlined_mode(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active', 'inline' => true]);
        self::assertStringContainsString(' class="custom-check custom-switch form-check-inline', $html);
    }

    /** @test */
    public function it_can_set_toggle_switches_inlined_mode_in_group_mode(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, [
            'name' => 'technologies',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
            'inline' => true
        ]);
        self::assertEquals(4, substr_count($html, ' class="custom-check custom-switch form-check-inline'));
    }
}
