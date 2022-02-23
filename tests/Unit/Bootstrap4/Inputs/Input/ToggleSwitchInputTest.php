<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap4\Inputs\Input;

use Okipa\LaravelFormComponents\Components\ToggleSwitch;

class ToggleSwitchInputTest extends \Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Input\ToggleSwitchInputTest
{
    /** @test */
    public function it_can_set_toggle_switch_input_class(): void
    {
        $html = $this->renderComponent(ToggleSwitch::class, ['name' => 'active']);
        self::assertStringContainsString('<input id="toggle-switch-active" class="custom-control-input"', $html);
    }
}
