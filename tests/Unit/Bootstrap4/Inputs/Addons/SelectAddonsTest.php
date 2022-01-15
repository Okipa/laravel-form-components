<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap4\Inputs\Addons;

use Okipa\LaravelFormComponents\Components\Select;

class SelectAddonsTest extends \Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Addons\SelectAddonsTest
{
    /** @test */
    public function it_can_set_select_prepend_addon(): void
    {
        config()->set('form-components.floating_label', false);
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [],
            'prepend' => 'Test prepend',
        ]);
        self::assertStringContainsString('<div class="input-group-prepend">', $html);
        self::assertStringContainsString('<span class="input-group-text">Test prepend</span>', $html);
        $addonPosition = strrpos($html, 'input-group-text');
        $inputPosition = strrpos($html, '<select');
        self::assertLessThan($inputPosition, $addonPosition);
    }

    /** @test */
    public function it_can_set_select_append_addon(): void
    {
        config()->set('form-components.floating_label', false);
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [],
            'append' => 'Test append',
        ]);
        self::assertStringContainsString('<div class="input-group-append">', $html);
        self::assertStringContainsString('<span class="input-group-text">Test append</span>', $html);
        $addonPosition = strrpos($html, 'input-group-text');
        $inputPosition = strrpos($html, '<select');
        self::assertLessThan($addonPosition, $inputPosition);
    }
}
