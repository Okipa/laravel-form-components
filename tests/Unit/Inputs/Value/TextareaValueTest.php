<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\Value;

use Illuminate\Foundation\Auth\User;
use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\Tests\TestCase;

class TextareaValueTest extends TestCase
{
    /** @test */
    public function it_can_set_textarea_value_and_override_bound_model_value(): void
    {
        $user = app(User::class)->forceFill(['description' => 'Test description']);
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'first_name',
            'bind' => $user,
            'value' => 'Test value',
        ]);
        self::assertStringContainsString('>Test value</textarea>', $html);
    }

    /** @test */
    public function it_can_set_textarea_zero_value(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'description', 'value' => 0]);
        self::assertStringContainsString('>0</textarea>', $html);
    }

    /** @test */
    public function it_can_set_textarea_empty_string_value(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'description', 'value' => '']);
        self::assertStringContainsString('></textarea>', $html);
    }

    /** @test */
    public function it_can_set_textarea_null_value(): void
    {
        $html = $this->renderComponent(Textarea::class, ['name' => 'description', 'value' => null]);
        self::assertStringContainsString('></textarea>', $html);
    }

    /** @test */
    public function it_can_set_textarea_value_from_closure_with_disabled_multilingual(): void
    {
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'description',
            'value' => fn(string $locale) => 'Test value ' . $locale,
        ]);
        self::assertStringContainsString('>Test value ' . app()->getLocale() . '</textarea>', $html);
    }

    /** @test */
    public function it_can_set_textarea_localized_value(): void
    {
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'description',
            'locales' => ['fr', 'en'],
            'value' => fn(string $locale) => 'Test value ' . $locale,
        ]);
        self::assertStringContainsString('>Test value fr</textarea>', $html);
        self::assertStringContainsString('>Test value en</textarea>', $html);
    }
}
