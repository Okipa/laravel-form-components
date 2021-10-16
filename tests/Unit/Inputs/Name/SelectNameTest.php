<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Name;

use Okipa\LaravelFormComponents\Components\Select;
use Okipa\LaravelFormComponents\Tests\TestCase;

class SelectNameTest extends TestCase
{
    /** @test */
    public function it_can_set_select_name_in_single_mode(): void
    {
        $html = $this->renderComponent(Select::class, ['name' => 'hobby_id', 'options' => []]);
        self::assertStringContainsString(' name="hobby_id"', $html);
    }

    /** @test */
    public function it_can_set_select_name_in_multiple_mode(): void
    {
        $html = $this->renderComponent(
            componentClass: Select::class,
            componentData: ['name' => 'hobby_ids', 'options' => []],
            attributes: ['multiple' => 'multiple']
        );
        self::assertStringContainsString(' name="hobby_ids[]"', $html);
    }
}
