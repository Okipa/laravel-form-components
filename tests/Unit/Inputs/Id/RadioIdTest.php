<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Id;

use Okipa\LaravelFormComponents\Components\Radio;
use Okipa\LaravelFormComponents\Tests\TestCase;

class RadioIdTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_setup_radio_default_id_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender',
            'group' => ['male' => 'Male', 'female' => 'Female'],
        ]);
        self::assertStringContainsString(' id="radio-gender-male"', $html);
        self::assertStringContainsString(' for="radio-gender-male"', $html);
        self::assertStringContainsString(' id="radio-gender-female"', $html);
        self::assertStringContainsString(' for="radio-gender-female"', $html);
    }

    /** @test */
    public function it_can_setup_radio_default_id_with_array_name_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Radio::class, [
            'name' => 'gender[0]',
            'group' => ['male' => 'Male', 'female' => 'Female'],
        ]);
        self::assertStringContainsString(' id="radio-gender-0-male"', $html);
        self::assertStringContainsString(' for="radio-gender-0-male"', $html);
        self::assertStringContainsString(' id="radio-gender-0-female"', $html);
        self::assertStringContainsString(' for="radio-gender-0-female"', $html);
    }

    /** @test */
    public function it_can_set_radio_id(): void
    {
        $html = $this->renderComponent(Radio::class, [
            'id' => 'test-id',
            'name' => 'gender',
            'group' => ['male' => 'Male', 'female' => 'Female'],
        ]);
        self::assertStringContainsString(' id="test-id-male"', $html);
        self::assertStringContainsString(' for="test-id-male"', $html);
        self::assertStringContainsString(' id="test-id-female"', $html);
        self::assertStringContainsString(' for="test-id-female"', $html);
    }
}
