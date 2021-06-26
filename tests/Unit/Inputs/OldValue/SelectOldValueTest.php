<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\OldValue;

use Okipa\LaravelFormComponents\Components\Select;
use Okipa\LaravelFormComponents\Tests\TestCase;

class SelectOldValueTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_retrieve_select_old_value(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge(['hobby_id' => 2])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [1 => 'Music', 2 => 'Travels', 3 => 'Movies', 4 => 'Literature'],
        ]);
        self::assertStringContainsString('<option value="1">Music</option>', $html);
        self::assertStringContainsString('<option value="2" selected="selected">Travels</option>', $html);
        self::assertStringContainsString('<option value="3">Movies</option>', $html);
        self::assertStringContainsString('<option value="4">Literature</option>', $html);
    }

    /** @test */
    public function it_can_retrieve_select_old_value_with_array_name(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge(['hobby_id[0]' => 2])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id[0]',
            'options' => [1 => 'Music', 2 => 'Travels', 3 => 'Movies', 4 => 'Literature'],
        ]);
        self::assertStringContainsString('<option value="1">Music</option>', $html);
        self::assertStringContainsString('<option value="2" selected="selected">Travels</option>', $html);
        self::assertStringContainsString('<option value="3">Movies</option>', $html);
        self::assertStringContainsString('<option value="4">Literature</option>', $html);
    }

    /** @test */
    public function it_can_retrieve_select_old_value_from_array(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge(['hobby_ids' => [1, 2]])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_ids',
            'options' => [1 => 'Music', 2 => 'Travels', 3 => 'Movies', 4 => 'Literature'],
        ]);
        self::assertStringContainsString('<option value="1" selected="selected">Music</option>', $html);
        self::assertStringContainsString('<option value="2" selected="selected">Travels</option>', $html);
        self::assertStringContainsString('<option value="3">Movies</option>', $html);
        self::assertStringContainsString('<option value="4">Literature</option>', $html);
    }

    /** @test */
    public function it_can_retrieve_select_old_value_from_null(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge(['hobby_id' => null])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(Select::class, [
            'name' => 'hobby_id',
            'options' => [1 => 'Music', 2 => 'Travels', 3 => 'Movies', 4 => 'Literature'],
        ]);
        self::assertStringContainsString('<option value="1">Music</option>', $html);
        self::assertStringContainsString('<option value="2">Travels</option>', $html);
        self::assertStringContainsString('<option value="3">Movies</option>', $html);
        self::assertStringContainsString('<option value="4">Literature</option>', $html);
    }
}
