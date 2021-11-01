<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Checked;

use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\Tests\TestCase;

class CheckboxInlineTest extends TestCase
{
    /** @test */
    public function it_can_set_checkbox_stacked_mode_by_default(): void
    {
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active']);
        self::assertStringNotContainsString('class="form-check form-check-inline', $html);
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
        self::assertStringNotContainsString('class="form-check form-check-inline', $html);
    }

    /** @test */
    public function it_can_set_checkbox_inlined_mode(): void
    {
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'inline' => true]);
        self::assertStringContainsString(' class="form-check form-check-inline', $html);
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
            'inline' => true
        ]);
        self::assertEquals(4, substr_count($html, ' class="form-check form-check-inline'));
    }
}
