<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\FloatingLabel;

use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\Tests\TestCase;

class TextareaFloatingLabelTest extends TestCase
{
    /** @test */
    public function it_can_globally_set_textarea_floating_label_mode_from_config(): void
    {
        config()->set('form-components.floating_label', true);
        $component = app(Textarea::class, ['name' => 'description']);
        self::assertTrue($component->shouldDisplayFloatingLabel());
        config()->set('form-components.floating_label', false);
        $component = app(Textarea::class, ['name' => 'description']);
        self::assertFalse($component->shouldDisplayFloatingLabel());
    }

    /** @test */
    public function it_can_set_textarea_non_floating_label_mode_and_override_config(): void
    {
        config()->set('form-components.floating_label', true);
        $html = $this->renderComponent(Textarea::class, ['name' => 'description', 'floatingLabel' => false]);
        self::assertStringNotContainsString('form-floating ', $html);
        $labelPosition = strrpos($html, '<label');
        $inputPosition = strrpos($html, '<textarea');
        self::assertLessThan($inputPosition, $labelPosition);
    }

    /** @test */
    public function it_can_set_textarea_floating_label_mode_and_override_config(): void
    {
        config()->set('form-components.floating_label', false);
        $html = $this->renderComponent(Textarea::class, ['name' => 'description', 'floatingLabel' => true]);
        self::assertStringContainsString('form-floating ', $html);
        $labelPosition = strrpos($html, '<label');
        $inputPosition = strrpos($html, '<textarea');
        self::assertLessThan($labelPosition, $inputPosition);
    }
}
