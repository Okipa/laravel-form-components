<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Buttons\Title;

use Okipa\LaravelFormComponents\Components\Button\Link;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ButtonLinkHrefTest extends TestCase
{
    /** @test */
    public function it_can_show_button_link_href(): void
    {
        $html = $this->renderComponent(Link::class, attributes: ['url' => 'https://example.com']);
        self::assertStringContainsString('href="https://example.com"', $html);
        self::assertStringNotContainsString('url="https://example.com"', $html);
    }
}
