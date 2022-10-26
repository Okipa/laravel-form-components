<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap4\Inputs\Label;

use Okipa\LaravelFormComponents\Components\Checkbox;

class CheckboxLabelTest extends \Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Label\CheckboxLabelTest
{

    /** @test */
    public function it_can_setup_checkbox_default_label_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active']);
        self::assertStringContainsString(' class="custom-control-label">validation.attributes.active</label>', $html);
    }

    /** @test */
    public function it_can_setup_checkbox_default_label_with_array_name_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active[0]']);
        self::assertStringContainsString(' class="custom-control-label">validation.attributes.active</label>', $html);
    }

    /** @test */
    public function it_can_set_checkbox_label(): void
    {
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'label' => 'Test label']);
        self::assertStringContainsString(' class="custom-control-label">Test label</label>', $html);
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
        self::assertStringContainsString(' class="custom-control-label">Laravel</label>', $html);
        self::assertStringContainsString(' class="custom-control-label">Bootstrap</label>', $html);
        self::assertStringContainsString(' class="custom-control-label">Tailwind</label>', $html);
        self::assertStringContainsString(' class="custom-control-label">Livewire</label>', $html);
    }
}
