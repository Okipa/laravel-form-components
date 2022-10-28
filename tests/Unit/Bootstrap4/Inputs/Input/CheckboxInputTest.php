<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap4\Inputs\Input;

use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\Tests\TestCase;

class CheckboxInputTest extends TestCase
{
    /** @test */
    public function it_can_set_checkbox_input_class(): void
    {
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active']);
        self::assertStringContainsString('<div class="custom-control custom-checkbox', $html);
        self::assertStringContainsString('<input id="checkbox-active" class="custom-control-input"', $html);
    }
}
