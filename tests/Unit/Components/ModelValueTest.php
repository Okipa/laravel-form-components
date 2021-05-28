<?php

use Illuminate\Foundation\Auth\User;
use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ModelValueTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_retrieve_input_value_from_model(): void
    {
        $user = app(User::class)->forceFill(['first_name' => 'Test first name']);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'model' => $user]);
        self::assertStringContainsString(' value="Test first name"', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_value_from_model(): void
    {
        $user = app(User::class)->forceFill(['first_name' => 'Test first name']);
        $html = $this->renderComponent(Textarea::class, ['name' => 'first_name', 'model' => $user]);
        self::assertStringContainsString('>Test first name</textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_input_localized_value_from_model(): void
    {
        $user = app(User::class)->forceFill([
            'first_name' => [
                'fr' => 'Test first name FR',
                'en' => 'Test first name EN',
            ],
        ]);
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'model' => $user,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('value="Test first name FR"', $html);
        self::assertStringContainsString('value="Test first name EN"', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_localized_value_from_model(): void
    {
        $user = app(User::class)->forceFill([
            'first_name' => [
                'fr' => 'Test first name FR',
                'en' => 'Test first name EN',
            ],
        ]);
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'first_name',
            'model' => $user,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('>Test first name FR</textarea>', $html);
        self::assertStringContainsString('>Test first name EN</textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_input_localized_null_value_from_model(): void
    {
        $user = app(User::class)->forceFill(['first_name' => ['fr' => 'Test first name FR']]);
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'model' => $user,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('value="Test first name FR"', $html);
        self::assertStringContainsString('value=""', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_localized_null_value_from_model(): void
    {
        $user = app(User::class)->forceFill(['first_name' => ['fr' => 'Test first name FR']]);
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'first_name',
            'model' => $user,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('>Test first name FR</textarea>', $html);
        self::assertStringContainsString('></textarea>', $html);
    }
}
