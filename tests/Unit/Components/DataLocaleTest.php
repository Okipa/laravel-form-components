<?php

use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\Tests\TestCase;

class DataLocaleTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_cant_setup_data_locale_attribute_on_input_when_not_multilingual(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'locales' => ['fr', 'en']]);
        self::assertStringContainsString('data-locale="fr"', $html);
        self::assertStringContainsString('data-locale="en"', $html);
    }

    /** @test */
    public function it_can_setup_data_locale_attribute_on_input_when_multilingual(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'locales' => ['fr', 'en']]);
        self::assertStringContainsString('data-locale="fr"', $html);
        self::assertStringContainsString('data-locale="en"', $html);
    }

    /** @test */
    public function it_cant_setup_data_locale_attribute_on_textarea_when_not_multilingual(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'first_name', 'locales' => ['fr', 'en']]);
        self::assertStringContainsString('data-locale="fr"', $html);
        self::assertStringContainsString('data-locale="en"', $html);
    }

    /** @test */
    public function it_can_setup_component_classes_by_default_on_textarea_when_multilingual(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'first_name', 'locales' => ['fr', 'en']]);
        self::assertStringContainsString('data-locale="fr"', $html);
        self::assertStringContainsString('data-locale="en"', $html);
    }
}
