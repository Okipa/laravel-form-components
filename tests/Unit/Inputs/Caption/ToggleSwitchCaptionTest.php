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
}
