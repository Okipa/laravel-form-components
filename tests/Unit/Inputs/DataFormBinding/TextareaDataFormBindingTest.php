<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Inputs\DataFormBinding;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class TextareaDataFormBindingTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_textarea_value_from_form_bound_model(): void
    {
        $bind = app(User::class)->forceFill(['description' => 'Test description']);
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Textarea::class, ['name' => 'description']);
        self::assertStringContainsString('>Test description</textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_value_from_form_bound_array(): void
    {
        $bind = ['description' => 'Test description'];
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Textarea::class, ['name' => 'description']);
        self::assertStringContainsString('>Test description</textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_value_from_form_bound_collection(): void
    {
        $bind = collect(['description' => 'Test description']);
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Textarea::class, ['name' => 'description']);
        self::assertStringContainsString('>Test description</textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_value_from_form_bound_object(): void
    {
        $bind = (object) ['description' => 'Test description'];
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Textarea::class, ['name' => 'description']);
        self::assertStringContainsString('>Test description</textarea>', $html);
    }
}
