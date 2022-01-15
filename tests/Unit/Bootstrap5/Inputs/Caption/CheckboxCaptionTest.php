<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Caption;

use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\Components\Radio;
use Okipa\LaravelFormComponents\Tests\TestCase;

class CheckboxCaptionTest extends TestCase
{
    /** @test */
    public function it_can_set_checkbox_caption(): void
    {
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'caption' => 'Test caption']);
        self::assertStringContainsString(' aria-describedby="checkbox-active-caption"', $html);
        self::assertStringContainsString(
            '<div id="checkbox-active-caption" class="form-text">Test caption</div>',
            $html
        );
    }

    /** @test */
    public function it_can_set_checkboxes_group_caption_in_group_mode(): void
    {
        $html = $this->renderComponent(Checkbox::class, [
            'name' => 'technologies',
            'group' => [
                'laravel' => 'Laravel',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind',
                'livewire' => 'Livewire',
            ],
            'caption' => 'Test caption',
        ]);
        self::assertEquals(4, substr_count($html, ' aria-describedby="checkbox-technologies-caption"'));
        self::assertEquals(
            1,
            substr_count($html, '<div id="checkbox-technologies-caption" class="form-text">Test caption</div>')
        );
    }
}
