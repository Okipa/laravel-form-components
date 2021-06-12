<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Label;

use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\Tests\TestCase;

class TextareaLabelTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_setup_textarea_default_label_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'first_name']);
        self::assertStringContainsString(
            '<label for="textarea-first-name" class="form-label">validation.attributes.first_name</label>',
            $html
        );
    }

    /** @test */
    public function it_can_set_textarea_label(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'first_name', 'label' => 'Test label']);
        self::assertStringContainsString(
            '<label for="textarea-first-name" class="form-label">Test label</label>',
            $html
        );
    }

    /** @test */
    public function it_can_set_textarea_localized_label(): void
    {
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'first_name',
            'label' => 'Test label',
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString(
            '<label for="textarea-first-name-fr" class="form-label">Test label (FR)</label>',
            $html
        );
        self::assertStringContainsString(
            '<label for="textarea-first-name-en" class="form-label">Test label (EN)</label>',
            $html
        );
    }

    /** @test */
    public function it_can_hide_textarea_label(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'first_name', 'hideLabel' => 'Test label']);
        self::assertStringNotContainsString('<label', $html);
    }
}
