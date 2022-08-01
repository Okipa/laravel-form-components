<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\Addons;

use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Tests\TestCase;

class InputAddonsTest extends TestCase
{
    /** @test */
    public function it_cant_display_input_addons_with_floating_label(): void
    {
        config()->set('form-components.floating_label', true);
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'prepend' => 'Test prepend',
            'append' => 'Test append',
        ]);
        self::assertStringNotContainsString('Test prepend', $html);
        self::assertStringNotContainsString('Test append', $html);
    }

    /** @test */
    public function it_can_position_label_above_input_group_with_prepend_input_addon(): void
    {
        config()->set('form-components.floating_label', false);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'prepend' => 'Test prepend']);
        $this->assertSeeHtmlInOrder($html, [
            '<label',
            '<div class="input-group">',
        ]);
    }

    /** @test */
    public function it_can_position_label_above_input_group_with_append_input_addon(): void
    {
        config()->set('form-components.floating_label', false);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'append' => 'Test append']);
        $this->assertSeeHtmlInOrder($html, [
            '<label',
            '<div class="input-group">',
        ]);
    }

    /** @test */
    public function it_can_set_input_prepend_addon(): void
    {
        config()->set('form-components.floating_label', false);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'prepend' => 'Test prepend']);
        $this->assertSeeHtmlInOrder($html, [
            '<span class="input-group-text">Test prepend</span>',
            '<input',
        ]);
    }

    /** @test */
    public function it_can_set_input_closure_prepend_addon_with_disabled_multilingual(): void
    {
        config()->set('form-components.floating_label', false);
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'prepend' => fn (string $locale) => 'Test prepend ' . $locale,
        ]);
        self::assertStringContainsString('Test prepend ' . app()->getLocale(), $html);
    }

    /** @test */
    public function it_can_set_input_localized_prepend_addon(): void
    {
        config()->set('form-components.floating_label', false);
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'locales' => ['fr', 'en'],
            'prepend' => fn (string $locale) => 'Test prepend ' . $locale,
        ]);
        $this->assertSeeHtmlInOrder($html, [
            'Test prepend fr',
            'Test prepend en',
        ]);
    }

    /** @test */
    public function it_can_set_input_append_addon(): void
    {
        config()->set('form-components.floating_label', false);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'append' => 'Test append']);
        $this->assertSeeHtmlInOrder($html, [
            '<input',
            '<span class="input-group-text">Test append</span>',
        ]);
    }

    /** @test */
    public function it_can_set_input_closure_append_addon_with_disabled_multilingual(): void
    {
        config()->set('form-components.floating_label', false);
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'append' => fn (string $locale) => 'Test append ' . $locale,
        ]);
        self::assertStringContainsString('Test append ' . app()->getLocale(), $html);
    }

    /** @test */
    public function it_can_set_input_localized_append_addon(): void
    {
        config()->set('form-components.floating_label', false);
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'locales' => ['fr', 'en'],
            'append' => fn (string $locale) => 'Test append ' . $locale,
        ]);
        $this->assertSeeHtmlInOrder($html, [
            'Test append fr',
            'Test append en',
        ]);
    }
}
