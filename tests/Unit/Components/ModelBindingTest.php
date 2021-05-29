<?php

use Illuminate\Foundation\Auth\User;
use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class ModelBindingTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_retrieve_input_value_from_bound_model(): void
    {
        $user = app(User::class)->forceFill(['first_name' => 'Test first name']);
        app(FormBinder::class)->bindNewModel($user);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name']);
        self::assertStringContainsString(' value="Test first name"', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_value_from_bound_model(): void
    {
        $user = app(User::class)->forceFill(['first_name' => 'Test first name']);
        app(FormBinder::class)->bindNewModel($user);
        $html = $this->renderComponent(Textarea::class, ['name' => 'first_name']);
        self::assertStringContainsString('>Test first name</textarea>', $html);
    }

    /** @test */
    public function it_can_set_input_model_and_override_bound_model(): void
    {
        $boundModel = app(User::class)->forceFill(['first_name' => 'Test first name bound']);
        $componentModel = app(User::class)->forceFill(['first_name' => 'Test first name component']);
        app(FormBinder::class)->bindNewModel($boundModel);
        $component = app(Input::class, ['name' => 'first_name', 'model' => $componentModel]);
        self::assertSame($componentModel, $component->model);
    }

    /** @test */
    public function it_can_set_textarea_model_and_override_bound_model(): void
    {
        $boundModel = app(User::class)->forceFill(['first_name' => 'Test first name bound']);
        $componentModel = app(User::class)->forceFill(['first_name' => 'Test first name component']);
        app(FormBinder::class)->bindNewModel($boundModel);
        $component = app(Textarea::class, ['name' => 'first_name', 'model' => $componentModel]);
        self::assertSame($componentModel, $component->model);
    }
}
