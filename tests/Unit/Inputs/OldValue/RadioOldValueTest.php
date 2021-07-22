<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\OldValue;

use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\Components\Radio;
use Okipa\LaravelFormComponents\Components\ToggleSwitch;
use Okipa\LaravelFormComponents\Tests\TestCase;

class RadioOldValueTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_retrieve_radio_old_checked(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge(['gender' => 'female'])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['female' => 'Female', 'male' => 'Male'],
        ]);
        self::assertStringContainsString(' value="female" checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_radio_old_checked_with_array_name(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge(['gender[0]' => 'female'])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender[0]',
            'group' => ['female' => 'Female', 'male' => 'Male'],
        ]);
        self::assertStringContainsString(' value="female" checked="checked"', $html);
    }
}
