<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Caption;

use Okipa\LaravelFormComponents\Components\Select;
use Okipa\LaravelFormComponents\Tests\TestCase;

class SelectCaptionTest extends TestCase
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
            '<div id="select-hobby-id-caption" class="form-text">Test caption</div>',
            $html
        );
    }
}
