<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\OldValue;

use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Tests\TestCase;

class InputOldValueTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_input_old_value(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge(['first_name' => 'Test old first name'])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'value' => 'Test old first name',
        ]);
        self::assertStringContainsString(' value="Test old first name"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_old_value_with_array_name(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge(['first_name[0]' => 'Test old first name'])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name[0]',
            'value' => 'Test old first name',
        ]);
        self::assertStringContainsString(' value="Test old first name"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_old_value_from_null(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge(['first_name' => null])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'value' => 'Test first name',
        ]);
        self::assertStringContainsString(' value=""', $html);
    }

    /** @test */
    public function it_can_retrieve_input_old_localized_values(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge([
                'first_name' => [
                    'fr' => 'Test old first name FR',
                    'en' => 'Test old first name EN',
                ],
            ])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'locales' => ['fr', 'en'],
            'value' => fn(string $locale) => 'Test value ' . $locale,
        ]);
        self::assertStringContainsString(' value="Test old first name FR"', $html);
        self::assertStringContainsString(' value="Test old first name EN"', $html);
    }

    public function it_can_retrieve_input_old_localized_values_from_null(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge([
                'first_name' => [
                    'fr' => 'Test old first name FR',
                    'en' => null,
                ],
            ])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'locales' => ['fr', 'en'],
            'value' => fn(string $locale) => 'Test value ' . $locale,
        ]);
        self::assertStringContainsString(' value="Test old first name FR"', $html);
        self::assertStringContainsString(' value=""', $html);
    }
}
