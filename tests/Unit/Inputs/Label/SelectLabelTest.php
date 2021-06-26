<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Label;

use Okipa\LaravelFormComponents\Components\Select;
use Okipa\LaravelFormComponents\Tests\TestCase;

class SelectLabelTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_setup_select_default_label_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Select::class, ['name' => 'hobby_id', 'options' => []]);
        self::assertStringContainsString(
            '<label for="select-hobby-id" class="form-label">validation.attributes.hobby_id</label>',
            $html
        );
    }

    /** @test */
    public function it_can_set_select_label(): void
    {
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'label' => 'Test label',
            'options' => [],
        ]);
        self::assertStringContainsString(
            '<label for="select-hobby-id" class="form-label">Test label</label>',
            $html
        );
    }

    /** @test */
    public function it_can_hide_select_label(): void
    {
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'hideLabel' => 'Test label',
            'options' => [],
        ]);
        self::assertStringNotContainsString('<label', $html);
    }
}
