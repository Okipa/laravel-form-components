<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\OldValue;

use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\Components\ToggleSwitch;
use Okipa\LaravelFormComponents\Tests\TestCase;

class CheckboxOldValueTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_checkbox_old_checked_status(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge(['active' => true])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active']);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkboxes_old_checked_status_in_group_mode(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge(['technologies' => ['laravel', 'livewire']])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(Checkbox::class, [
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
    public function it_can_retrieve_checkbox_old_checked_status_with_array_name(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge(['active[0]' => true])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active[0]']);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkboxes_old_checked_status_with_array_name_in_group_mode(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge(['technologies[0]' => ['laravel', 'livewire']])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(Checkbox::class, [
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
