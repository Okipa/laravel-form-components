<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\DataFormBinding;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class InputDataFormBindingTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_input_value_from_form_bound_model(): void
    {
        $bind = app(User::class)->forceFill(['first_name' => 'Test first name']);
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name']);
        self::assertStringContainsString(' value="Test first name"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_value_from_form_bound_array(): void
    {
        $bind = ['first_name' => 'Test first name'];
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name']);
        self::assertStringContainsString(' value="Test first name"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_value_from_form_bound_collection(): void
    {
        $bind = collect(['first_name' => 'Test first name']);
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name']);
        self::assertStringContainsString(' value="Test first name"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_value_from_form_bound_object(): void
    {
        $bind = (object) ['first_name' => 'Test first name'];
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name']);
        self::assertStringContainsString(' value="Test first name"', $html);
    }
}
