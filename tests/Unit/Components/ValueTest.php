<?php

use Illuminate\Foundation\Auth\User;
use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ValueTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_set_input_value_and_override_model_value(): void
    {
        $user = app(User::class)->forceFill(['first_name' => 'Test first name']);
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'model' => $user,
            'value' => 'Test value',
        ]);
        self::assertStringContainsString(' value="Test value"', $html);
    }

    /** @test */
    public function it_can_set_textarea_value_and_override_model_value(): void
    {
        $user = app(User::class)->forceFill(['first_name' => 'Test first name']);
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'first_name',
            'model' => $user,
            'value' => 'Test value',
        ]);
        self::assertStringContainsString('>Test value</textarea>', $html);
    }

    /** @test */
    public function it_can_set_input_zero_value(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'value' => 0]);
        self::assertStringContainsString(' value="0"', $html);
    }

    /** @test */
    public function it_can_set_textarea_zero_value(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'first_name', 'value' => 0]);
        self::assertStringContainsString('>0</textarea>', $html);
    }

    /** @test */
    public function it_can_set_input_empty_string_value(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'value' => '']);
        self::assertStringContainsString(' value=""', $html);
    }

    /** @test */
    public function it_can_set_textarea_empty_string_value(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'first_name', 'value' => '']);
        self::assertStringContainsString('></textarea>', $html);
    }

    /** @test */
    public function it_can_set_input_null_value(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'value' => null]);
        self::assertStringContainsString(' value=""', $html);
    }

    /** @test */
    public function it_can_set_textarea_null_value(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'first_name', 'value' => null]);
        self::assertStringContainsString('></textarea>', $html);
    }

    /** @test */
    public function it_can_set_input_value_from_closure_with_disabled_multilingual(): void
    {
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'value' => fn(string $locale) => 'Test value ' . $locale,
        ]);
        self::assertStringContainsString(' value="Test value ' . app()->getLocale() . '"', $html);
    }

    /** @test */
    public function it_can_set_textarea_value_from_closure_with_disabled_multilingual(): void
    {
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'first_name',
            'value' => fn(string $locale) => 'Test value ' . $locale,
        ]);
        self::assertStringContainsString('>Test value ' . app()->getLocale() . '</textarea>', $html);
    }

    /** @test */
    public function it_can_set_input_localized_value(): void
    {
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'locales' => ['fr', 'en'],
            'value' => fn(string $locale) => 'Test value ' . $locale,
        ]);
        self::assertStringContainsString(' value="Test value fr"', $html);
        self::assertStringContainsString(' value="Test value en"', $html);
    }

    /** @test */
    public function it_can_set_textarea_localized_value(): void
    {
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'first_name',
            'locales' => ['fr', 'en'],
            'value' => fn(string $locale) => 'Test value ' . $locale,
        ]);
        self::assertStringContainsString('>Test value fr</textarea>', $html);
        self::assertStringContainsString('>Test value en</textarea>', $html);
    }
}
