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
    public function it_can_retrieve_toggle_switches_old_checked_status_in_group_mode(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge(['technologies' => ['laravel', 'livewire']])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(ToggleSwitch::class, [
            'name' => 'technologies',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
        ]);
        self::assertStringContainsString(' name="technologies[laravel]" checked="checked"', $html);
        self::assertStringContainsString(' name="technologies[livewire]" checked="checked"', $html);
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

    /** @test */
    public function it_can_retrieve_toggle_switches_old_checked_status_with_array_name_in_group_mode(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge(['technologies[0]' => ['laravel', 'livewire']])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(ToggleSwitch::class, [
            'name' => 'technologies[0]',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
        ]);
        self::assertStringContainsString(' name="technologies[0][laravel]" checked="checked"', $html);
        self::assertStringContainsString(' name="technologies[0][livewire]" checked="checked"', $html);
    }
}
