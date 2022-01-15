<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap4\Inputs\Addons;

use Okipa\LaravelFormComponents\Components\Textarea;

class TextareaAddonsTest extends \Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Addons\TextareaAddonsTest
{
    /** @test */
    public function it_can_set_textarea_prepend_addon(): void
    {
        config()->set('form-components.floating_label', false);
        $html = $this->renderComponent(Textarea::class, ['name' => 'description', 'prepend' => 'Test prepend']);
        self::assertStringContainsString('<div class="input-group-prepend">', $html);
        self::assertStringContainsString('<span class="input-group-text">Test prepend</span>', $html);
        $addonPosition = strrpos($html, 'input-group-text');
        $inputPosition = strrpos($html, '<textarea');
        self::assertLessThan($inputPosition, $addonPosition);
    }

    /** @test */
    public function it_can_set_textarea_append_addon(): void
    {
        config()->set('form-components.floating_label', false);
        $html = $this->renderComponent(Textarea::class, ['name' => 'description', 'append' => 'Test append']);
        self::assertStringContainsString('<div class="input-group-append">', $html);
        self::assertStringContainsString('<span class="input-group-text">Test append</span>', $html);
        $addonPosition = strrpos($html, 'input-group-text');
        $inputPosition = strrpos($html, '<textarea');
        self::assertLessThan($addonPosition, $inputPosition);
    }
}
