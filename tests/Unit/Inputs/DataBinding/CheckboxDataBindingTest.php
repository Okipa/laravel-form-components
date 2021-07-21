<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\DataBindings;

use Illuminate\Foundation\Auth\User;
use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class CheckboxDataBindingTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_retrieve_checkbox_checked_status_from_direct_bound_model(): void
    {
        $bind = app(User::class)->forceFill(['active' => true]);
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'bind' => $bind]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkbox_value_from_direct_bound_array(): void
    {
        $bind = ['active' => true];
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'bind' => $bind]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkbox_value_from_direct_bound_collection(): void
    {
        $bind = collect(['active' => true]);
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'bind' => $bind]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkbox_value_from_direct_bound_object(): void
    {
        $bind = (object) ['active' => true];
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'bind' => $bind]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkbox_value_from_global_bound_model(): void
    {
        $bind = app(User::class)->forceFill(['active' => true]);
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active']);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkbox_value_from_global_bound_array(): void
    {
        $bind = ['active' => true];
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active']);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkbox_value_from_global_bound_collection(): void
    {
        $bind = collect(['active' => true]);
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active']);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkbox_value_from_global_bound_object(): void
    {
        $bind = (object) ['active' => true];
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active']);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_override_global_checkbox_binding_by_direct_bound_data(): void
    {
        $globallyBoundModel = app(User::class)->forceFill(['active' => false]);
        $directBoundModel = app(User::class)->forceFill(['active' => true]);
        app(FormBinder::class)->bindNewDataBatch($globallyBoundModel);
        $component = app(Checkbox::class, ['name' => 'active', 'bind' => $directBoundModel]);
        self::assertEquals($directBoundModel->active, $component->getChecked());
    }
}
