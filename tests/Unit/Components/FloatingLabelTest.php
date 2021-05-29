<?php

use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\Tests\TestCase;

class FloatingLabelTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_globally_set_input_floating_label_mode_from_config(): void
    {
        config()->set('form-components.floating_label', true);
        $component = app(Input::class, ['name' => 'first_name']);
        self::assertTrue($component->floatingLabel);
        config()->set('form-components.floating_label', false);
        $component = app(Input::class, ['name' => 'first_name']);
        self::assertFalse($component->floatingLabel);
    }

    /** @test */
    public function it_can_globally_set_textarea_floating_label_mode_from_config(): void
    {
        config()->set('form-components.floating_label', true);
        $component = app(Textarea::class, ['name' => 'first_name']);
        self::assertTrue($component->floatingLabel);
        config()->set('form-components.floating_label', false);
        $component = app(Textarea::class, ['name' => 'first_name']);
        self::assertFalse($component->floatingLabel);
    }

    /** @test */
    public function it_can_set_input_non_floating_label_mode_and_override_config(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'floatingLabel' => false]);
        self::assertStringNotContainsString(' form-floating', $html);
        $labelPosition = strrpos($html, '<label');
        $inputPosition = strrpos($html, '<input');
        self::assertLessThan($inputPosition, $labelPosition);
    }

    /** @test */
    public function it_can_set_textarea_non_floating_label_mode_and_override_config(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'first_name', 'floatingLabel' => false]);
        self::assertStringNotContainsString(' form-floating', $html);
        $labelPosition = strrpos($html, '<label');
        $inputPosition = strrpos($html, '<textarea');
        self::assertLessThan($inputPosition, $labelPosition);
    }

    /** @test */
    public function it_can_set_input_floating_label_mode_and_override_config(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'floatingLabel' => true]);
        self::assertStringContainsString(' form-floating', $html);
        $labelPosition = strrpos($html, '<label');
        $inputPosition = strrpos($html, '<input');
        self::assertLessThan($labelPosition, $inputPosition);
    }

    /** @test */
    public function it_can_set_textarea_floating_label_mode_and_override_config(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'first_name', 'floatingLabel' => true]);
        self::assertStringContainsString(' form-floating', $html);
        $labelPosition = strrpos($html, '<label');
        $inputPosition = strrpos($html, '<textarea');
        self::assertLessThan($labelPosition, $inputPosition);
    }
}