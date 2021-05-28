<?php

use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\Tests\TestCase;

class OldValueTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_retrieve_input_old_value_from_string(): void
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
    public function it_can_retrieve_textarea_old_value_from_string(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge(['first_name' => 'Test old first name'])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'first_name',
            'value' => 'Test old first name',
        ]);
        self::assertStringContainsString('>Test old first name</textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_input_old_value_from_array(): void
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
    public function it_can_retrieve_textarea_old_value_from_array(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge(['first_name[0]' => 'Test old first name'])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'first_name[0]',
            'value' => 'Test old first name',
        ]);
        self::assertStringContainsString('>Test old first name</textarea>', $html);
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
    public function it_can_retrieve_textarea_old_value_from_null(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge(['first_name' => null])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'first_name',
            'value' => 'Test first name',
        ]);
        self::assertStringContainsString('></textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_input_old_localized_values_from_string(): void
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

    /** @test */
    public function it_can_retrieve_textarea_old_localized_values_from_string(): void
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
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'first_name',
            'locales' => ['fr', 'en'],
            'value' => fn(string $locale) => 'Test value ' . $locale,
        ]);
        self::assertStringContainsString('>Test old first name FR</textarea>', $html);
        self::assertStringContainsString('>Test old first name EN</textarea>', $html);
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

    public function it_can_retrieve_textarea_old_localized_values_from_null(): void
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
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'first_name',
            'locales' => ['fr', 'en'],
            'value' => fn(string $locale) => 'Test value ' . $locale,
        ]);
        self::assertStringContainsString('>Test old first name FR</textarea>', $html);
        self::assertStringContainsString('></textarea>', $html);
    }
}
