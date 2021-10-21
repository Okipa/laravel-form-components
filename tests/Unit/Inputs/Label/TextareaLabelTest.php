<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Label;

use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\Tests\TestCase;

class TextareaLabelTest extends TestCase
{
    /** @test */
    public function it_can_setup_textarea_default_label_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'description']);
        self::assertStringContainsString(' class="form-label">validation.attributes.description</label>', $html);
    }

    /** @test */
    public function it_can_setup_textarea_default_label_with_array_name_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'description[0]']);
        self::assertStringContainsString(' class="form-label">validation.attributes.description</label>', $html);
    }

    /** @test */
    public function it_can_set_textarea_label(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'description', 'label' => 'Test label']);
        self::assertStringContainsString(' class="form-label">Test label</label>', $html);
    }

    /** @test */
    public function it_can_set_textarea_localized_label(): void
    {
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'description',
            'label' => 'Test label',
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString(' class="form-label">Test label (FR)</label>', $html);
        self::assertStringContainsString(' class="form-label">Test label (EN)</label>', $html);
    }

    /** @test */
    public function it_can_hide_textarea_label(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'description', 'label' => false]);
        self::assertStringNotContainsString('<label', $html);
    }
}
