<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\DataComponentBinding;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class CheckboxDataComponentBindingTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_checkbox_checked_status_from_component_bound_model(): void
    {
        $bind = app(User::class)->forceFill(['active' => true]);
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'bind' => $bind]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkbox_checked_status_from_component_bound_array(): void
    {
        $bind = ['active' => true];
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'bind' => $bind]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkbox_checked_status_from_component_bound_collection(): void
    {
        $bind = collect(['active' => true]);
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'bind' => $bind]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkbox_checked_status_from_component_bound_object(): void
    {
        $bind = (object) ['active' => true];
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active', 'bind' => $bind]);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_override_checkbox_form_data_binding_from_component_bound_data(): void
    {
        $globallyBoundModel = app(User::class)->forceFill(['active' => false]);
        $directBoundModel = app(User::class)->forceFill(['active' => true]);
        app(FormBinder::class)->bindNewDataBatch($globallyBoundModel);
        $component = app(Checkbox::class, ['name' => 'active', 'bind' => $directBoundModel]);
        self::assertEquals($directBoundModel->active, $component->getChecked());
    }
}
