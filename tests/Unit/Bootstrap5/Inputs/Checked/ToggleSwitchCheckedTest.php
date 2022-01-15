<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Checked;

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
    public function it_can_set_toggle_switches_checked_status_from_int_and_override_bound_model_value_in_group_mode(): void
    {
        $user = app(User::class)->forceFill(['technologies' => [1, 4]]);
        $html = $this->renderComponent(ToggleSwitch::class, [
            'name' => 'technologies',
            'group' => [1 => 'Laravel', 2 => 'Bootstrap', 3 => 'Tailwind', 4 => 'Livewire'],
            'bind' => $user,
            'checked' => ['2', 3],
        ]);
        self::assertStringContainsString(' value="2" checked="checked"', $html);
        self::assertStringContainsString(' value="3" checked="checked"', $html);
    }

    /** @test */
    public function it_can_set_toggle_switches_checked_status_from_string_and_override_bound_model_value_in_group_mode(): void
    {
        $user = app(User::class)->forceFill(['technologies' => ['laravel', 'tailwind']]);
        $html = $this->renderComponent(ToggleSwitch::class, [
            'name' => 'technologies',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
            'bind' => $user,
            'checked' => ['bootstrap', 'livewire'],
        ]);
        self::assertStringContainsString(' value="bootstrap" checked="checked"', $html);
        self::assertStringContainsString(' value="livewire" checked="checked"', $html);
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
        self::assertStringNotContainsString('checked="checked"', $html);
    }

    /** @test */
    public function it_can_set_toggle_switches_unchecked_and_override_bound_model_value_in_group_mode(): void
    {
        $user = app(User::class)->forceFill(['technologies' => ['laravel', 'livewire']]);
        $html = $this->renderComponent(ToggleSwitch::class, [
            'name' => 'active',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
            'bind' => $user,
            'checked' => [],
        ]);
        self::assertStringNotContainsString('checked="checked"', $html);
    }
}
