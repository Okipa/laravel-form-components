<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Checked;

use Illuminate\Foundation\Auth\User;
use Okipa\LaravelFormComponents\Components\ToggleSwitch;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ToggleSwitchCheckedTest extends TestCase
{
    /** @test */
    public function it_can_set_toggle_switch_checked_and_override_bound_model_value(): void
    {
        $user = app(User::class)->forceFill(['active' => false]);
        $html = $this->renderComponent(ToggleSwitch::class, [
            'name' => 'active',
            'bind' => $user,
            'checked' => true,
        ]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_set_toggle_switch_unchecked_and_override_bound_model_value(): void
    {
        $user = app(User::class)->forceFill(['active' => true]);
        $html = $this->renderComponent(ToggleSwitch::class, [
            'name' => 'active',
            'bind' => $user,
            'checked' => false,
        ]);
        self::assertStringNotContainsString(' checked="checked"', $html);
    }
}
