<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Addons;

use Okipa\LaravelFormComponents\Components\Select;
use Okipa\LaravelFormComponents\Tests\TestCase;

class SelectAddonsTest extends TestCase
{
    /** @test */
    public function it_cant_display_select_addons_with_floating_label(): void
    {
        config()->set('form-components.floating_label', true);
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [],
            'prepend' => 'Test prepend',
            'append' => 'Test append',
        ]);
        self::assertStringNotContainsString('Test prepend', $html);
        self::assertStringNotContainsString('Test append', $html);
    }

    /** @test */
    public function it_can_position_label_above_input_group_with_prepend_select_addon(): void
    {
        config()->set('form-components.floating_label', false);
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'prepend' => 'Test prepend',
            'options' => [],
        ]);
        self::assertStringContainsString('<label', $html);
        $labelPosition = strrpos($html, '<label');
        $inputGroupPosition = strrpos($html, '<div class="input-group">');
        self::assertLessThan($inputGroupPosition, $labelPosition);
    }

    /** @test */
    public function it_can_position_label_above_input_group_with_append_select_addon(): void
    {
        config()->set('form-components.floating_label', false);
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'append' => 'Test append',
            'options' => [],
        ]);
        self::assertStringContainsString('<label', $html);
        $labelPosition = strrpos($html, '<label');
        $inputGroupPosition = strrpos($html, '<div class="input-group">');
        self::assertLessThan($inputGroupPosition, $labelPosition);
    }

    /** @test */
    public function it_can_set_select_prepend_addon(): void
    {
        config()->set('form-components.floating_label', false);
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [],
            'prepend' => 'Test prepend',
        ]);
        self::assertStringContainsString('<span class="input-group-text">Test prepend</span>', $html);
        $addonPosition = strrpos($html, 'input-group-text');
        $inputPosition = strrpos($html, '<select');
        self::assertLessThan($inputPosition, $addonPosition);
    }

    /** @test */
    public function it_can_set_select_closure_prepend_addon_with_disabled_multilingual(): void
    {
        config()->set('form-components.floating_label', false);
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [],
            'prepend' => fn(string $locale) => 'Test prepend ' . $locale,
        ]);
        self::assertStringContainsString('Test prepend ' . app()->getLocale(), $html);
    }

    /** @test */
    public function it_can_set_select_append_addon(): void
    {
        config()->set('form-components.floating_label', false);
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [],
            'append' => 'Test append',
        ]);
        self::assertStringContainsString('<span class="input-group-text">Test append</span>', $html);
        $addonPosition = strrpos($html, 'input-group-text');
        $inputPosition = strrpos($html, '<select');
        self::assertLessThan($addonPosition, $inputPosition);
    }

    /** @test */
    public function it_can_set_select_closure_append_addon_with_disabled_multilingual(): void
    {
        config()->set('form-components.floating_label', false);
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [],
            'append' => fn(string $locale) => 'Test append ' . $locale,
        ]);
        self::assertStringContainsString('Test append ' . app()->getLocale(), $html);
    }
}
