<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Name;

use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\Tests\TestCase;

class TextareaNameTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_set_textarea_name(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'first_name']);
        self::assertStringContainsString(' name="first_name"', $html);
    }

    /** @test */
    public function it_can_set_textarea_localized_names(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'first_name', 'locales' => ['fr', 'en']]);
        self::assertStringContainsString(' name="first_name[fr]"', $html);
        self::assertStringContainsString(' name="first_name[en]"', $html);
    }
}