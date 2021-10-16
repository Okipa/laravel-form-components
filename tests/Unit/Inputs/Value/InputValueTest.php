<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Value;

use Illuminate\Foundation\Auth\User;
use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\Tests\TestCase;

class InputValueTest extends TestCase
{
    /** @test */
    public function it_can_set_input_value_and_override_bound_model_value(): void
    {
        $user = app(User::class)->forceFill(['first_name' => 'Test first name']);
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'bind' => $user,
            'value' => 'Test value',
        ]);
        self::assertStringContainsString(' value="Test value"', $html);
    }

    /** @test */
    public function it_can_set_input_zero_value(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'value' => 0]);
        self::assertStringContainsString(' value="0"', $html);
    }

    /** @test */
    public function it_can_set_input_empty_string_value(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'value' => '']);
        self::assertStringContainsString(' value=""', $html);
    }

    /** @test */
    public function it_can_set_input_null_value(): void
    {
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'value' => null]);
        self::assertStringContainsString(' value=""', $html);
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
}
