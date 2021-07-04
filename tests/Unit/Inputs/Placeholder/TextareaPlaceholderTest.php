<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Placeholder;

use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\Tests\TestCase;

class TextareaPlaceholderTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_setup_textarea_default_placeholder_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'description']);
        self::assertStringContainsString(' placeholder="validation.attributes.description"', $html);
    }

    /** @test */
    public function it_can_setup_textarea_default_localized_placeholder_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'description', 'locales' => ['fr', 'en']]);
        self::assertStringContainsString(' placeholder="validation.attributes.description (FR)"', $html);
        self::assertStringContainsString(' placeholder="validation.attributes.description (EN)"', $html);
    }

    /** @test */
    public function it_can_setup_textarea_default_placeholder_with_array_name_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'description[0]']);
        self::assertStringContainsString(' placeholder="validation.attributes.description"', $html);
    }

    /** @test */
    public function it_can_setup_textarea_default_placeholder_from_defined_label(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'description', 'label' => 'Test label']);
        self::assertStringContainsString(' placeholder="Test label"', $html);
    }

    /** @test */
    public function it_can_setup_textarea_default_placeholder_when_label_is_hidden(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'description', 'hideLabel' => true]);
        self::assertStringContainsString(' placeholder="validation.attributes.description"', $html);
    }

    /** @test */
    public function it_can_hide_textarea_placeholder(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'description', 'hidePlaceholder' => true]);
        self::assertStringNotContainsString('placeholder', $html);
    }

    /** @test */
    public function it_can_set_textarea_placeholder(): void
    {
        $html = $this->renderComponent(
            Textarea::class,
            ['name' => 'description', 'placeholder' => 'Test placeholder']
        );
        self::assertStringContainsString(' placeholder="Test placeholder"', $html);
    }
}
