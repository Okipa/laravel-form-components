<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\DataComponentBinding;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class InputDataComponentBindingTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_input_value_from_component_bound_model(): void
    {
        $bind = app(User::class)->forceFill(['first_name' => 'Test first name']);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'bind' => $bind]);
        self::assertStringContainsString(' value="Test first name"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_value_from_component_bound_array(): void
    {
        $bind = ['first_name' => 'Test first name'];
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'bind' => $bind]);
        self::assertStringContainsString(' value="Test first name"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_value_from_component_bound_collection(): void
    {
        $bind = collect(['first_name' => 'Test first name']);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'bind' => $bind]);
        self::assertStringContainsString(' value="Test first name"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_value_from_component_bound_object(): void
    {
        $bind = (object) ['first_name' => 'Test first name'];
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'bind' => $bind]);
        self::assertStringContainsString(' value="Test first name"', $html);
    }

    /** @test */
    public function it_can_override_input_form_data_binding_from_component_bound_data(): void
    {
        $globallyBoundModel = app(User::class)->forceFill(['first_name' => 'Test first name globally bound']);
        $directBoundModel = app(User::class)->forceFill(['first_name' => 'Test first name directly bound']);
        app(FormBinder::class)->bindNewDataBatch($globallyBoundModel);
        $component = app(Input::class, ['name' => 'first_name', 'bind' => $directBoundModel]);
        self::assertEquals($directBoundModel->first_name, $component->getValue());
    }

    /** @test */
    public function it_can_retrieve_input_localized_value_from_component_bound_model(): void
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
    public function it_can_retrieve_input_localized_value_from_component_bound_array(): void
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
    public function it_can_retrieve_input_localized_value_from_component_bound_collection(): void
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
    public function it_can_retrieve_input_localized_value_from_component_bound_object(): void
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
    public function it_can_retrieve_input_localized_null_value_from_component_bound_model(): void
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
    public function it_can_retrieve_input_localized_null_value_from_component_bound_array(): void
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
    public function it_can_retrieve_input_localized_null_value_from_component_bound_collection(): void
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
    public function it_can_retrieve_input_localized_null_value_from_component_bound_object(): void
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
