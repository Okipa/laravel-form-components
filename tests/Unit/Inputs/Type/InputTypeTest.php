<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Type;

use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Tests\TestCase;

class InputTypeTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_set_input_type(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'type' => 'number']);
        self::assertStringContainsString(' type="number"', $html);
    }

    /** @test */
    public function it_can_setup_input_default_text_type_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name']);
        self::assertStringContainsString(' type="text"', $html);
    }
}
