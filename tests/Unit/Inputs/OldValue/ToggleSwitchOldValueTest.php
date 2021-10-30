<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\OldValue;

use Okipa\LaravelFormComponents\Components\ToggleSwitch;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ToggleSwitchOldValueTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_toggle_switch_old_checked_status(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge(['active' => true])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(ToggleSwitch::class, [
            'name' => 'active',
            'value' => true,
        ]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_toggle_switch_old_checked_status_with_array_name(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge(['active[0]' => true])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(ToggleSwitch::class, [
            'name' => 'active[0]',
            'value' => true,
        ]);
        self::assertStringContainsString(' checked="checked"', $html);
    }
}
