<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap4\Inputs\Inline;

use Okipa\LaravelFormComponents\Components\Checkbox;

class CheckboxInlineTest extends \Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Inline\CheckboxInlineTest
{
    /** @test */
    public function it_can_set_checkbox_stacked_mode_by_default(): void
    {
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active']);
        self::assertStringNotContainsString('class="custom-control custom-checkbox custom-control-inline', $html);
    }

    /** @test */
    public function it_can_set_checkboxes_stacked_mode_by_default_in_group_mode(): void
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
        self::assertStringNotContainsString('class="custom-control custom-checkbox custom-control-inline', $html);
    }

    /** @test */
    public function it_can_set_checkbox_inlined_mode(): void
    {
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'inline' => true]);
        self::assertStringContainsString(' class="custom-control custom-checkbox custom-control-inline', $html);
    }

    /** @test */
    public function it_can_set_checkboxes_inlined_mode_in_group_mode(): void
    {
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'technologies',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
            'inline' => true,
        ]);
        self::assertEquals(4, mb_substr_count($html, ' class="custom-control custom-checkbox custom-control-inline'));
    }
}
