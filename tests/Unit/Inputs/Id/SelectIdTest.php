<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Id;

use Okipa\LaravelFormComponents\Components\Select;
use Okipa\LaravelFormComponents\Tests\TestCase;

class SelectIdTest extends TestCase
{
    /** @test */
    public function it_can_setup_select_default_id_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Select::class, ['name' => 'hobby_id', 'options' => []]);
        self::assertStringContainsString(' id="select-hobby-id"', $html);
        self::assertStringContainsString(' for="select-hobby-id"', $html);
    }

    /** @test */
    public function it_can_setup_select_default_id_with_array_name_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Select::class, ['name' => 'hobby_id[0]', 'options' => []]);
        self::assertStringContainsString(' id="select-hobby-id-0"', $html);
        self::assertStringContainsString(' for="select-hobby-id-0"', $html);
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
        self::assertStringContainsString(' for="test-id"', $html);
    }
}
