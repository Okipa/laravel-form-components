<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Name;

use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\Tests\TestCase;

class TextareaNameTest extends TestCase
{
    /** @test */
    public function it_can_set_textarea_name(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'description']);
        self::assertStringContainsString(' name="description"', $html);
    }

    /** @test */
    public function it_can_set_textarea_localized_names(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'description', 'locales' => ['fr', 'en']]);
        self::assertStringContainsString(' name="description[fr]"', $html);
        self::assertStringContainsString(' name="description[en]"', $html);
    }
}
