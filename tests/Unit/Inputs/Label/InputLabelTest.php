<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Label;

use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Tests\TestCase;

class InputLabelTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_setup_input_default_label_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name']);
        self::assertStringContainsString(
            ' class="form-label">validation.attributes.first_name</label>',
            $html
        );
    }

    /** @test */
    public function it_can_setup_input_default_label_with_array_name_when_none_is_defined(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name[0]']);
        self::assertStringContainsString(' class="form-label">validation.attributes.first_name</label>', $html);
    }

    /** @test */
    public function it_can_set_input_label(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'label' => 'Test label']);
        self::assertStringContainsString(' class="form-label">Test label</label>', $html);
    }

    /** @test */
    public function it_can_set_input_localized_label(): void
    {
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'label' => 'Test label',
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString(' class="form-label">Test label (FR)</label>', $html);
        self::assertStringContainsString(' class="form-label">Test label (EN)</label>', $html);
    }

    /** @test */
    public function it_can_hide_input_label(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'label' => false]);
        self::assertStringNotContainsString('<label', $html);
    }
}
