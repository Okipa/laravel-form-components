<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Label;

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

    /** @test */
    public function it_can_set_checkboxes_group_label_in_group_mode(): void
    {
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'technologies',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
        ]);
        self::assertEquals(
            1,
            substr_count($html, '<label class="form-label">validation.attributes.technologies</label>')
        );
    }

    /** @test */
    public function it_can_set_checkboxes_labels_in_group_mode(): void
    {
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'technologies',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
        ]);
        self::assertStringContainsString(' class="form-check-label">Laravel</label>', $html);
        self::assertStringContainsString(' class="form-check-label">Bootstrap</label>', $html);
        self::assertStringContainsString(' class="form-check-label">Tailwind</label>', $html);
        self::assertStringContainsString(' class="form-check-label">Livewire</label>', $html);
    }
}
