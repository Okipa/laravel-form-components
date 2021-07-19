<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Id;

use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\Tests\TestCase;

class CheckboxIdTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_setup_checkbox_default_id_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active']);
        self::assertStringContainsString(' id="checkbox-active"', $html);
    }

    /** @test */
    public function it_can_setup_checkbox_default_id_with_array_name_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active[0]']);
        self::assertStringContainsString(' id="checkbox-active-0"', $html);
    }

    /** @test */
    public function it_can_set_checkbox_id(): void
    {
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'id' => 'test-id']);
        self::assertStringContainsString(' id="test-id"', $html);
    }
}
