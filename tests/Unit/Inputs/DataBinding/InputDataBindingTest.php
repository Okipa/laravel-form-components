<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\DataBinding;

use Illuminate\Foundation\Auth\User;
use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class InputDataBindingTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_retrieve_input_value_from_direct_bound_model(): void
    {
        $user = app(User::class)->forceFill(['first_name' => 'Test first name']);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'bind' => $user]);
        self::assertStringContainsString(' value="Test first name"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_value_from_direct_bound_array(): void
    {
        $data = ['first_name' => 'Test first name'];
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'bind' => $data]);
        self::assertStringContainsString(' value="Test first name"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_value_from_global_bound_model(): void
    {
        $user = app(User::class)->forceFill(['first_name' => 'Test first name']);
        app(FormBinder::class)->bindNewDataBatch($user);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name']);
        self::assertStringContainsString(' value="Test first name"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_value_from_global_bound_array(): void
    {
        $data = ['first_name' => 'Test first name'];
        app(FormBinder::class)->bindNewDataBatch($data);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name']);
        self::assertStringContainsString(' value="Test first name"', $html);
    }

    /** @test */
    public function it_can_override_global_input_binding_by_direct_bound_data(): void
    {
        $globallyBoundModel = app(User::class)->forceFill(['first_name' => 'Test first name bound']);
        $directBoundModel = app(User::class)->forceFill(['first_name' => 'Test first name component']);
        app(FormBinder::class)->bindNewDataBatch($globallyBoundModel);
        $component = app(Input::class, ['name' => 'first_name', 'bind' => $directBoundModel]);
        self::assertSame($directBoundModel, $component->bind);
    }

    /** @test */
    public function it_can_retrieve_input_localized_value_from_bound_model(): void
    {
        $user = app(User::class)->forceFill([
            'first_name' => [
                'fr' => 'Test first name FR',
                'en' => 'Test first name EN',
            ],
        ]);
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'bind' => $user,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('value="Test first name FR"', $html);
        self::assertStringContainsString('value="Test first name EN"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_localized_value_from_bound_array(): void
    {
        $user = ['first_name' => ['fr' => 'Test first name FR', 'en' => 'Test first name EN']];
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'bind' => $user,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('value="Test first name FR"', $html);
        self::assertStringContainsString('value="Test first name EN"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_localized_null_value_from_bound_model(): void
    {
        $user = app(User::class)->forceFill(['first_name' => ['fr' => 'Test first name FR']]);
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'bind' => $user,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('value="Test first name FR"', $html);
        self::assertStringContainsString('value=""', $html);
    }

    /** @test */
    public function it_can_retrieve_input_localized_null_value_from_bound_array(): void
    {
        $user = ['first_name' => ['fr' => 'Test first name FR']];
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'bind' => $user,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('value="Test first name FR"', $html);
        self::assertStringContainsString('value=""', $html);
    }
}
