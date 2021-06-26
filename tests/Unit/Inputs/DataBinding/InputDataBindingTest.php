<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\DataBinding;

use Illuminate\Foundation\Auth\User;
use Okipa\LaravelFormComponents\Components\Input;
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
        $bind = app(User::class)->forceFill(['first_name' => 'Test first name']);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'bind' => $bind]);
        self::assertStringContainsString(' value="Test first name"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_value_from_direct_bound_array(): void
    {
        $bind = ['first_name' => 'Test first name'];
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'bind' => $bind]);
        self::assertStringContainsString(' value="Test first name"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_value_from_direct_bound_collection(): void
    {
        $bind = collect(['first_name' => 'Test first name']);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'bind' => $bind]);
        self::assertStringContainsString(' value="Test first name"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_value_from_direct_bound_object(): void
    {
        $bind = (object) ['first_name' => 'Test first name'];
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'bind' => $bind]);
        self::assertStringContainsString(' value="Test first name"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_value_from_global_bound_model(): void
    {
        $bind = app(User::class)->forceFill(['first_name' => 'Test first name']);
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name']);
        self::assertStringContainsString(' value="Test first name"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_value_from_global_bound_array(): void
    {
        $bind = ['first_name' => 'Test first name'];
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name']);
        self::assertStringContainsString(' value="Test first name"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_value_from_global_bound_collection(): void
    {
        $bind = collect(['first_name' => 'Test first name']);
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name']);
        self::assertStringContainsString(' value="Test first name"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_value_from_global_bound_object(): void
    {
        $bind = (object) ['first_name' => 'Test first name'];
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name']);
        self::assertStringContainsString(' value="Test first name"', $html);
    }

    /** @test */
    public function it_can_override_global_input_binding_by_direct_bound_data(): void
    {
        $globallyBoundModel = app(User::class)->forceFill(['first_name' => 'Test first name globally bound']);
        $directBoundModel = app(User::class)->forceFill(['first_name' => 'Test first name directly bound']);
        app(FormBinder::class)->bindNewDataBatch($globallyBoundModel);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'bind' => $directBoundModel]);
        self::assertStringContainsString(' value="Test first name directly bound"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_localized_value_from_bound_model(): void
    {
        $bind = app(User::class)->forceFill([
            'first_name' => [
                'fr' => 'Test first name FR',
                'en' => 'Test first name EN',
            ],
        ]);
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'bind' => $bind,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('value="Test first name FR"', $html);
        self::assertStringContainsString('value="Test first name EN"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_localized_value_from_bound_array(): void
    {
        $bind = ['first_name' => ['fr' => 'Test first name FR', 'en' => 'Test first name EN']];
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'bind' => $bind,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('value="Test first name FR"', $html);
        self::assertStringContainsString('value="Test first name EN"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_localized_value_from_bound_collection(): void
    {
        $bind = collect(['first_name' => ['fr' => 'Test first name FR', 'en' => 'Test first name EN']]);
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'bind' => $bind,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('value="Test first name FR"', $html);
        self::assertStringContainsString('value="Test first name EN"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_localized_value_from_bound_object(): void
    {
        $bind = (object) ['first_name' => ['fr' => 'Test first name FR', 'en' => 'Test first name EN']];
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'bind' => $bind,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('value="Test first name FR"', $html);
        self::assertStringContainsString('value="Test first name EN"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_localized_null_value_from_bound_model(): void
    {
        $bind = app(User::class)->forceFill(['first_name' => ['fr' => 'Test first name FR']]);
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'bind' => $bind,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('value="Test first name FR"', $html);
        self::assertStringContainsString('value=""', $html);
    }

    /** @test */
    public function it_can_retrieve_input_localized_null_value_from_bound_array(): void
    {
        $bind = ['first_name' => ['fr' => 'Test first name FR']];
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'bind' => $bind,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('value="Test first name FR"', $html);
        self::assertStringContainsString('value=""', $html);
    }

    /** @test */
    public function it_can_retrieve_input_localized_null_value_from_bound_collection(): void
    {
        $bind = collect(['first_name' => ['fr' => 'Test first name FR']]);
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'bind' => $bind,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('value="Test first name FR"', $html);
        self::assertStringContainsString('value=""', $html);
    }

    /** @test */
    public function it_can_retrieve_input_localized_null_value_from_bound_object(): void
    {
        $bind = (object) ['first_name' => ['fr' => 'Test first name FR']];
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'bind' => $bind,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('value="Test first name FR"', $html);
        self::assertStringContainsString('value=""', $html);
    }
}
