<?php

namespace Okipa\LaravelFormComponents\Tests\Unit;

use Okipa\LaravelFormComponents\Components\Form;
use Okipa\LaravelFormComponents\Tests\TestCase;

class FormTest extends TestCase
{
    /** @test */
    public function it_can_setup_get_method_by_default(): void
    {
        $html = $this->renderComponent(Form::class);
        self::assertStringContainsString('<form method="GET"', $html);
    }

    /** @test */
    public function it_can_set_non_spoofing_method(): void
    {
        $html = $this->renderComponent(Form::class, ['method' => 'HEAD']);
        self::assertStringContainsString('<form method="HEAD"', $html);
        self::assertStringNotContainsString('<input type="hidden" name="_token"', $html);
        $html = $this->renderComponent(Form::class, ['method' => 'GET']);
        self::assertStringContainsString('<form method="GET"', $html);
        self::assertStringNotContainsString('<input type="hidden" name="_token"', $html);
        $html = $this->renderComponent(Form::class, ['method' => 'OPTIONS']);
        self::assertStringContainsString('<form method="OPTIONS"', $html);
        self::assertStringNotContainsString('<input type="hidden" name="_token"', $html);
        $html = $this->renderComponent(Form::class, ['method' => 'POST']);
        self::assertStringContainsString('<form method="POST"', $html);
        self::assertStringContainsString('<input type="hidden" name="_token"', $html);
    }

    /** @test */
    public function it_can_set_spoofing_method(): void
    {
        $html = $this->renderComponent(Form::class, ['method' => 'PUT']);
        self::assertStringContainsString('<form method="POST"', $html);
        self::assertStringContainsString('<input type="hidden" name="_token"', $html);
        self::assertStringContainsString('<input type="hidden" name="_method" value="PUT">', $html);
        $html = $this->renderComponent(Form::class, ['method' => 'PATCH']);
        self::assertStringContainsString('<form method="POST"', $html);
        self::assertStringContainsString('<input type="hidden" name="_token"', $html);
        self::assertStringContainsString('<input type="hidden" name="_method" value="PATCH">', $html);
        $html = $this->renderComponent(Form::class, ['method' => 'DELETE']);
        self::assertStringContainsString('<form method="POST"', $html);
        self::assertStringContainsString('<input type="hidden" name="_token"', $html);
        self::assertStringContainsString('<input type="hidden" name="_method" value="DELETE">', $html);
    }
}
