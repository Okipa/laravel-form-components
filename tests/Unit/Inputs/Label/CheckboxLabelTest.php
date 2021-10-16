<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Label;

use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\Tests\TestCase;

class CheckboxLabelTest extends TestCase
{
    /** @test */
    public function it_can_setup_checkbox_default_label_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active']);
        self::assertStringContainsString(' class="form-check-label">validation.attributes.active</label>', $html);
    }

    /** @test */
    public function it_can_setup_checkbox_default_label_with_array_name_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active[0]']);
        self::assertStringContainsString(' class="form-check-label">validation.attributes.active</label>', $html);
    }

    /** @test */
    public function it_can_set_checkbox_label(): void
    {
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'label' => 'Test label']);
        self::assertStringContainsString(' class="form-check-label">Test label</label>', $html);
    }

    /** @test */
    public function it_can_hide_checkbox_label(): void
    {
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'label' => false]);
        self::assertStringNotContainsString('<label', $html);
    }
}
