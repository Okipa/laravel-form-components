<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\OldValue;

use Okipa\LaravelFormComponents\Components\Checkbox;
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
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'gender',
            'group' => ['male' => 'Male', 'female' => 'Female'],
        ]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

//    /** @test */
//    public function it_can_retrieve_radio_old_checked_with_array_name(): void
//    {
//        $this->app['router']->get('test', [
//            'middleware' => 'web',
//            'uses' => fn() => request()->merge(['active[0]' => true])->flash(),
//        ]);
//        $this->call('GET', 'test');
//        $html = $this->renderComponent(Checkbox::class, [
//            'name' => 'active[0]',
//            'group' => ['male' => 'Male', 'female' => 'Female'],
//        ]);
//        self::assertStringContainsString(' checked="checked"', $html);
//    }
}
