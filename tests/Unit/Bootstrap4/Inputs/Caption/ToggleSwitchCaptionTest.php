<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap4\Inputs\Caption;

use Okipa\LaravelFormComponents\Components\ToggleSwitch;

class ToggleSwitchCaptionTest extends \Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Caption\ToggleSwitchCaptionTest
{
    /** @test */
    public function it_can_set_toggle_switch_caption(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active', 'caption' => 'Test caption']);
        self::assertStringContainsString(' aria-describedby="toggle-switch-active-caption"', $html);
        self::assertStringContainsString(
            '<small id="toggle-switch-active-caption" class="form-text text-muted">Test caption</small>',
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
        self::assertEquals(4, mb_substr_count($html, ' aria-describedby="toggle-switch-technologies-caption"'));
        self::assertEquals(
            1,
            mb_substr_count($html, '<small id="toggle-switch-technologies-caption" class="form-text text-muted">Test caption</small>')
        );
    }
}
