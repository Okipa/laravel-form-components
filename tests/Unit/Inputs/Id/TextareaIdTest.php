<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Id;

use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\Tests\TestCase;

class TextareaIdTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_setup_textarea_default_id_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'first_name']);
        self::assertStringContainsString(' id="textarea-first-name"', $html);
    }

    /** @test */
    public function it_can_setup_textarea_default_id_with_array_name_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'first_name[0]']);
        self::assertStringContainsString(' id="textarea-first-name-0"', $html);
    }

    /** @test */
    public function it_can_setup_textarea_default_localized_id_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'first_name', 'locales' => ['fr', 'en']]);
        self::assertStringContainsString(' id="textarea-first-name-fr"', $html);
        self::assertStringContainsString(' id="textarea-first-name-en"', $html);
    }

    /** @test */
    public function it_can_set_textarea_id(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'first_name', 'id' => 'test-id']);
        self::assertStringContainsString(' id="test-id"', $html);
    }

    /** @test */
    public function it_can_set_textarea_localized_id(): void
    {
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'first_name',
            'id' => 'test-id',
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString(' id="test-id-fr"', $html);
        self::assertStringContainsString(' id="test-id-en"', $html);
    }
}
