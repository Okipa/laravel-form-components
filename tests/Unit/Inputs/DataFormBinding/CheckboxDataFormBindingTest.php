<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\DataFormBinding;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelFormComponents\Components\Checkbox;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class CheckboxDataFormBindingTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_checkbox_checked_status_from_form_bound_model(): void
    {
        $bind = app(User::class)->forceFill(['active' => true]);
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active']);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkbox_checked_status_from_form_bound_array(): void
    {
        $bind = ['active' => true];
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active']);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkbox_checked_status_from_form_bound_collection(): void
    {
        $bind = collect(['active' => true]);
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active']);
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_retrieve_checkbox_checked_status_from_form_bound_object(): void
    {
        $bind = (object) ['active' => true];
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Checkbox::class, ['name' => 'active']);
        self::assertStringContainsString(' checked="checked"', $html);
    }
}
