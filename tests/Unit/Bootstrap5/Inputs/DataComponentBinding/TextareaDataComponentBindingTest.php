<?php

namespace Okipa\LaravelFormComponents\Tests\Unit\Bootstrap5\Inputs\DataComponentBinding;

use Illuminate\Foundation\Auth\User;
use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class TextareaDataComponentBindingTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_textarea_value_from_component_bound_model(): void
    {
        $bind = app(User::class)->forceFill(['description' => 'Test description']);
        $html = $this->renderComponent(Textarea::class, ['name' => 'description', 'bind' => $bind]);
        self::assertStringContainsString('>Test description</textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_value_from_component_bound_array(): void
    {
        $bind = ['description' => 'Test description'];
        $html = $this->renderComponent(Textarea::class, ['name' => 'description', 'bind' => $bind]);
        self::assertStringContainsString('>Test description</textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_value_from_component_bound_collection(): void
    {
        $bind = collect(['description' => 'Test description']);
        $html = $this->renderComponent(Textarea::class, ['name' => 'description', 'bind' => $bind]);
        self::assertStringContainsString('>Test description</textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_value_from_component_bound_object(): void
    {
        $bind = (object) ['description' => 'Test description'];
        $html = $this->renderComponent(Textarea::class, ['name' => 'description', 'bind' => $bind]);
        self::assertStringContainsString('>Test description</textarea>', $html);
    }

    /** @test */
    public function it_can_override_textarea_form_data_binding_from_component_bound_data(): void
    {
        $formBoundModel = app(User::class)->forceFill(['description' => 'Test description bound']);
        $componentBoundModel = app(User::class)->forceFill(['description' => 'Test description component']);
        app(FormBinder::class)->bindNewDataBatch($formBoundModel);
        $component = app(Textarea::class, ['name' => 'description', 'bind' => $componentBoundModel]);
        self::assertEquals($componentBoundModel->description, $component->getValue());
    }

    /** @test */
    public function it_can_retrieve_textarea_localized_value_from_component_bound_model(): void
    {
        $bind = app(User::class)->forceFill([
            'description' => [
                'fr' => 'Test description FR',
                'en' => 'Test description EN',
            ],
        ]);
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'description',
            'bind' => $bind,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('>Test description FR</textarea>', $html);
        self::assertStringContainsString('>Test description EN</textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_localized_value_from_component_bound_array(): void
    {
        $bind = ['description' => ['fr' => 'Test description FR', 'en' => 'Test description EN']];
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'description',
            'bind' => $bind,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('>Test description FR</textarea>', $html);
        self::assertStringContainsString('>Test description EN</textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_localized_value_from_component_bound_collection(): void
    {
        $bind = collect(['description' => ['fr' => 'Test description FR', 'en' => 'Test description EN']]);
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'description',
            'bind' => $bind,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('>Test description FR</textarea>', $html);
        self::assertStringContainsString('>Test description EN</textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_localized_value_from_component_bound_object(): void
    {
        $bind = (object) ['description' => ['fr' => 'Test description FR', 'en' => 'Test description EN']];
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'description',
            'bind' => $bind,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('>Test description FR</textarea>', $html);
        self::assertStringContainsString('>Test description EN</textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_localized_null_value_from_component_bound_model(): void
    {
        $bind = app(User::class)->forceFill(['description' => ['fr' => 'Test description FR']]);
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'description',
            'bind' => $bind,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('>Test description FR</textarea>', $html);
        self::assertStringContainsString('></textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_localized_null_value_from_component_bound_array(): void
    {
        $bind = ['description' => ['fr' => 'Test description FR']];
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'description',
            'bind' => $bind,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('>Test description FR</textarea>', $html);
        self::assertStringContainsString('></textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_localized_null_value_from_component_bound_collection(): void
    {
        $bind = collect(['description' => ['fr' => 'Test description FR']]);
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'description',
            'bind' => $bind,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('>Test description FR</textarea>', $html);
        self::assertStringContainsString('></textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_localized_null_value_from_component_bound_object(): void
    {
        $bind = (object) ['description' => ['fr' => 'Test description FR']];
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'description',
            'bind' => $bind,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('>Test description FR</textarea>', $html);
        self::assertStringContainsString('></textarea>', $html);
    }
}
