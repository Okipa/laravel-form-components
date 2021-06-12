<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Name;

use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Tests\TestCase;

class InputNameTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_set_input_name(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name']);
        self::assertStringContainsString(' name="first_name"', $html);
    }

    /** @test */
    public function it_can_set_input_localized_names(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'locales' => ['fr', 'en']]);
        self::assertStringContainsString(' name="first_name[fr]"', $html);
        self::assertStringContainsString(' name="first_name[en]"', $html);
    }
}
