<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\DataLocaleAttribute;

use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Tests\TestCase;

class InputDataLocaleAttributeTest extends TestCase
{
    /** @test */
    public function it_cant_setup_data_locale_attribute_on_input_when_not_multilingual(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'hobby_id', 'locales' => ['fr', 'en']]);
        self::assertStringContainsString('data-locale="fr"', $html);
        self::assertStringContainsString('data-locale="en"', $html);
    }

    /** @test */
    public function it_can_setup_data_locale_attribute_on_input_when_multilingual(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'hobby_id', 'locales' => ['fr', 'en']]);
        self::assertStringContainsString('data-locale="fr"', $html);
        self::assertStringContainsString('data-locale="en"', $html);
    }
}
