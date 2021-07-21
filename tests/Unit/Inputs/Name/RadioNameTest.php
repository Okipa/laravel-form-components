<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Name;

use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\Components\Radio;
use Okipa\LaravelFormComponents\Tests\TestCase;

class RadioNameTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_set_radio_name(): void
    {
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['male' => 'Male', 'female' => 'Female'],
        ]);
        self::assertStringContainsString(' name="gender"', $html);
    }
}
