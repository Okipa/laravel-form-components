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
        self::assertStringContainsString(' class="form-label">validation.attributes.first_name</label>', $html);
    }

    /** @test */
    public function it_can_setup_textarea_default_label_with_array_name_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'first_name[0]']);
        self::assertStringContainsString(' class="form-label">validation.attributes.first_name</label>', $html);
    }

    /** @test */
    public function it_can_set_textarea_label(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'first_name', 'label' => 'Test label']);
        self::assertStringContainsString(' class="form-label">Test label</label>', $html);
    }

    /** @test */
    public function it_can_set_textarea_localized_label(): void
    {
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'first_name',
            'label' => 'Test label',
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString(' class="form-label">Test label (FR)</label>', $html);
        self::assertStringContainsString(' class="form-label">Test label (EN)</label>', $html);
    }

    /** @test */
    public function it_can_hide_textarea_label(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'first_name', 'hideLabel' => true]);
        self::assertStringNotContainsString('<label', $html);
    }
}
