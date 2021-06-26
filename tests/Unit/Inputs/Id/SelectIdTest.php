<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Id;

use Okipa\LaravelFormComponents\Components\Select;
use Okipa\LaravelFormComponents\Tests\TestCase;

class SelectIdTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_setup_select_default_id_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Select::class, ['name' => 'hobby_id', 'options' => []]);
        self::assertStringContainsString(' id="select-hobby-id"', $html);
    }

    /** @test */
    public function it_can_set_select_id(): void
    {
        $html = $this->renderComponent(Select::class, [
            'id' => 'test-id',
            'name' => 'hobby_id',
            'options' => [],
        ]);
        self::assertStringContainsString(' id="test-id"', $html);
    }
}
