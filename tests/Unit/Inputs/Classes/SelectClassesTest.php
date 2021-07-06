<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Classes;

use Okipa\LaravelFormComponents\Components\Select;
use Okipa\LaravelFormComponents\Tests\TestCase;

class SelectClassesTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_setup_component_classes_on_select(): void
    {
        $html = $this->renderComponent(Select::class, ['name' => 'hobby_id', 'options' => []]);
        self::assertStringContainsString(' class="component-container mb-3"', $html);
        self::assertStringContainsString(' class="component ', $html);
    }
}
