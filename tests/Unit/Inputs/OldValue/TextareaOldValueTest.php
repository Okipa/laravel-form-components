<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\OldValue;

use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\Tests\TestCase;

class TextareaOldValueTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_textarea_old_value(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge(['description' => 'Test old description'])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'description',
            'value' => 'Test old description',
        ]);
        self::assertStringContainsString('>Test old description</textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_old_value_with_array_name(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge(['description[0]' => 'Test old description'])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'description[0]',
            'value' => 'Test old description',
        ]);
        self::assertStringContainsString('>Test old description</textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_old_value_from_null(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge(['description' => null])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'description',
            'value' => 'Test description',
        ]);
        self::assertStringContainsString('></textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_old_localized_values(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge([
                'description' => [
                    'fr' => 'Test old description FR',
                    'en' => 'Test old description EN',
                ],
            ])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'description',
            'locales' => ['fr', 'en'],
            'value' => fn(string $locale) => 'Test value ' . $locale,
        ]);
        self::assertStringContainsString('>Test old description FR</textarea>', $html);
        self::assertStringContainsString('>Test old description EN</textarea>', $html);
    }

    public function it_can_retrieve_textarea_old_localized_values_from_null(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge([
                'description' => [
                    'fr' => 'Test old description FR',
                    'en' => null,
                ],
            ])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'description',
            'locales' => ['fr', 'en'],
            'value' => fn(string $locale) => 'Test value ' . $locale,
        ]);
        self::assertStringContainsString('>Test old description FR</textarea>', $html);
        self::assertStringContainsString('></textarea>', $html);
    }
}
