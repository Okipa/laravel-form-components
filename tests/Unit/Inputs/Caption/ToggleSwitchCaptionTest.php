<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Caption;

use Okipa\LaravelFormComponents\Components\ToggleSwitch;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ToggleSwitchCaptionTest extends TestCase
{
    /** @test */
    public function it_can_set_toggle_switch_caption(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active', 'caption' => 'Test caption']);
        self::assertStringContainsString(' aria-describedby="toggle-switch-active-caption"', $html);
        self::assertStringContainsString(
            '<div id="toggle-switch-active-caption" class="form-text">Test caption</div>',
            $html
        );
    }

    /** @test */
    public function it_can_set_toggle_switches_group_caption_in_group_mode(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, [
            'name' => 'technologies',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
            'caption' => 'Test caption',
        ]);
        self::assertEquals(4, substr_count($html, ' aria-describedby="toggle-switch-technologies-caption"'));
        self::assertEquals(
            1,
            substr_count($html, '<div id="toggle-switch-technologies-caption" class="form-text">Test caption</div>')
        );
    }
}
