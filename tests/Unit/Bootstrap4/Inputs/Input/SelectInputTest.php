<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap4\Inputs\Input;

use Okipa\LaravelFormComponents\Components\Select;

class SelectInputTest extends \Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Input\SelectInputTest
{
    /** @test */
    public function it_can_set_select_input_class(): void
    {
        $html = $this->renderComponent(Select::class, ['name' => 'hobby_id', 'options' => []]);
        self::assertStringContainsString('<select id="select-hobby-id" class="custom-select"', $html);
    }
}
