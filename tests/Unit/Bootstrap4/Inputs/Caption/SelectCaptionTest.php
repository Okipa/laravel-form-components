<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap4\Inputs\Caption;

use Okipa\LaravelFormComponents\Components\Select;

class SelectCaptionTest extends \Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Caption\SelectCaptionTest
{
    /** @test */
    public function it_can_set_select_caption(): void
    {
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [],
            'caption' => 'Test caption',
        ]);
        self::assertStringContainsString(' aria-describedby="select-hobby-id-caption"', $html);
        self::assertStringContainsString(
            '<small id="select-hobby-id-caption" class="form-text text-muted">Test caption</small>',
            $html
        );
    }
}
