<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Placeholder;

use Okipa\LaravelFormComponents\Components\Select;
use Okipa\LaravelFormComponents\Tests\TestCase;

class SelectPlaceholderTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_setup_select_default_placeholder_with_string_name_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Select::class, ['name' => 'hobby_id', 'options' => []]);
        self::assertStringContainsString(
            '<option value="" selected disabled hidden>validation.attributes.hobby_id</option>',
            $html
        );
    }

    /** @test */
    public function it_can_setup_select_default_placeholder_with_array_name_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Select::class, ['name' => 'hobby_id[0]', 'options' => []]);
        self::assertStringContainsString(
            '<option value="" selected disabled hidden>validation.attributes.hobby_id</option>',
            $html
        );
    }

    /** @test */
    public function it_can_setup_select_default_placeholder_from_defined_label(): void
    {
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'label' => 'Test label',
            'options' => [],
        ]);
        self::assertStringContainsString(
            '<option value="" selected disabled hidden>Test label</option>',
            $html
        );
    }

    /** @test */
    public function it_can_hide_select_placeholder(): void
    {
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [],
            'hidePlaceholder' => true,
        ]);
        self::assertStringNotContainsString('<option value="" selected disabled hidden>', $html);
    }

    /** @test */
    public function it_can_set_select_placeholder(): void
    {
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [],
            'placeholder' => 'Test placeholder',
        ]);
        self::assertStringContainsString(
            '<option value="" selected disabled hidden>Test placeholder</option>',
            $html
        );
    }
}
