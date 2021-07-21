<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Id;

use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\Tests\TestCase;

class InputIdTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_setup_input_default_id_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name']);
        self::assertStringContainsString(' id="text-first-name"', $html);
        self::assertStringContainsString(' for="text-first-name"', $html);
    }

    /** @test */
    public function it_can_setup_input_default_id_with_array_name_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name[0]']);
        self::assertStringContainsString(' id="text-first-name-0"', $html);
        self::assertStringContainsString(' for="text-first-name-0"', $html);
    }

    /** @test */
    public function it_can_setup_input_default_localized_id_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'locales' => ['fr', 'en']]);
        self::assertStringContainsString(' id="text-first-name-fr"', $html);
        self::assertStringContainsString(' for="text-first-name-fr"', $html);
        self::assertStringContainsString(' id="text-first-name-en"', $html);
        self::assertStringContainsString(' for="text-first-name-en"', $html);
    }

    /** @test */
    public function it_can_set_input_id(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'id' => 'test-id']);
        self::assertStringContainsString(' id="test-id"', $html);
        self::assertStringContainsString(' for="test-id"', $html);
    }

    /** @test */
    public function it_can_set_input_localized_id(): void
    {
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'id' => 'test-id',
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString(' id="test-id-fr"', $html);
        self::assertStringContainsString(' for="test-id-fr"', $html);
        self::assertStringContainsString(' id="test-id-en"', $html);
        self::assertStringContainsString(' for="test-id-en"', $html);
    }
}
