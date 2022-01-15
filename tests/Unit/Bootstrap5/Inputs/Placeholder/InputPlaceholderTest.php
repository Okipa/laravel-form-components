<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Placeholder;

use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Tests\TestCase;

class InputPlaceholderTest extends TestCase
{
    /** @test */
    public function it_can_setup_input_default_placeholder_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name']);
        self::assertStringContainsString(' placeholder="validation.attributes.first_name"', $html);
    }

    /** @test */
    public function it_can_setup_input_default_localized_placeholder_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'locales' => ['fr', 'en']]);
        self::assertStringContainsString(' placeholder="validation.attributes.first_name (FR)"', $html);
        self::assertStringContainsString(' placeholder="validation.attributes.first_name (EN)"', $html);
    }

    /** @test */
    public function it_can_setup_input_default_placeholder_with_array_name_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name[0]']);
        self::assertStringContainsString(' placeholder="validation.attributes.first_name"', $html);
    }

    /** @test */
    public function it_can_setup_input_default_placeholder_from_defined_label(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'label' => 'Test label']);
        self::assertStringContainsString(' placeholder="Test label"', $html);
    }

    /** @test */
    public function it_can_setup_input_default_placeholder_when_label_is_hidden(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'label' => false]);
        self::assertStringContainsString(' placeholder="validation.attributes.first_name"', $html);
    }

    /** @test */
    public function it_can_hide_input_placeholder(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'placeholder' => false]);
        self::assertStringNotContainsString('placeholder', $html);
    }

    /** @test */
    public function it_can_set_input_placeholder(): void
    {
        $html = $this->renderComponent(
            Input::class,
            ['name' => 'first_name', 'placeholder' => 'Test placeholder']
        );
        self::assertStringContainsString(' placeholder="Test placeholder"', $html);
    }
}
