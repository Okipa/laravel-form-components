<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap4\Inputs\Addons;

use Okipa\LaravelFormComponents\Components\Input;

class InputAddonsTest extends \Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Addons\InputAddonsTest
{
    /** @test */
    public function it_can_set_input_prepend_addon(): void
    {
        config()->set('form-components.floating_label', false);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'prepend' => 'Test prepend']);
        self::assertStringContainsString('<div class="input-group-prepend">', $html);
        self::assertStringContainsString('<span class="input-group-text">Test prepend</span>', $html);
        $addonPosition = strrpos($html, 'input-group-text');
        $inputPosition = strrpos($html, '<input');
        self::assertLessThan($inputPosition, $addonPosition);
    }

    /** @test */
    public function it_can_set_input_append_addon(): void
    {
        config()->set('form-components.floating_label', false);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'append' => 'Test append']);
        self::assertStringContainsString('<div class="input-group-append">', $html);
        self::assertStringContainsString('<span class="input-group-text">Test append</span>', $html);
        $addonPosition = strrpos($html, 'input-group-text');
        $inputPosition = strrpos($html, '<input');
        self::assertLessThan($addonPosition, $inputPosition);
    }
}
