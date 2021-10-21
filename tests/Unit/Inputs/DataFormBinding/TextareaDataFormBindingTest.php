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
    public function it_can_retrieve_textarea_value_from_direct_bound_model(): void
    {
        $bind = app(User::class)->forceFill(['description' => 'Test description']);
        $html = $this->renderComponent(Textarea::class, ['name' => 'description', 'bind' => $bind]);
        self::assertStringContainsString('>Test description</textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_value_from_direct_bound_array(): void
    {
        $bind = ['description' => 'Test description'];
        $html = $this->renderComponent(Textarea::class, ['name' => 'description', 'bind' => $bind]);
        self::assertStringContainsString('>Test description</textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_value_from_direct_bound_collection(): void
    {
        $bind = collect(['description' => 'Test description']);
        $html = $this->renderComponent(Textarea::class, ['name' => 'description', 'bind' => $bind]);
        self::assertStringContainsString('>Test description</textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_value_from_direct_bound_object(): void
    {
        $bind = (object) ['description' => 'Test description'];
        $html = $this->renderComponent(Textarea::class, ['name' => 'description', 'bind' => $bind]);
        self::assertStringContainsString('>Test description</textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_value_from_global_bound_model(): void
    {
        $bind = app(User::class)->forceFill(['description' => 'Test description']);
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Textarea::class, ['name' => 'description']);
        self::assertStringContainsString('>Test description</textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_value_from_global_bound_array(): void
    {
        $bind = ['description' => 'Test description'];
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Textarea::class, ['name' => 'description']);
        self::assertStringContainsString('>Test description</textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_value_from_global_bound_collection(): void
    {
        $bind = collect(['description' => 'Test description']);
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Textarea::class, ['name' => 'description']);
        self::assertStringContainsString('>Test description</textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_value_from_global_bound_object(): void
    {
        $bind = (object) ['description' => 'Test description'];
        app(FormBinder::class)->bindNewDataBatch($bind);
        $html = $this->renderComponent(Textarea::class, ['name' => 'description']);
        self::assertStringContainsString('>Test description</textarea>', $html);
    }

    /** @test */
    public function it_can_override_textarea_global_data_binding_from_direct_bound_data(): void
    {
        $globallyBoundModel = app(User::class)->forceFill(['description' => 'Test description bound']);
        $directBoundModel = app(User::class)->forceFill(['description' => 'Test description component']);
        app(FormBinder::class)->bindNewDataBatch($globallyBoundModel);
        $component = app(Textarea::class, ['name' => 'description', 'bind' => $directBoundModel]);
        self::assertEquals($directBoundModel->description, $component->getValue());
    }

    /** @test */
    public function it_can_retrieve_textarea_localized_value_from_bound_model(): void
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
    public function it_can_retrieve_textarea_localized_value_from_bound_array(): void
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
    public function it_can_retrieve_textarea_localized_value_from_bound_collection(): void
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
    public function it_can_retrieve_textarea_localized_value_from_bound_object(): void
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
    public function it_can_retrieve_textarea_localized_null_value_from_bound_model(): void
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
    public function it_can_retrieve_textarea_localized_null_value_from_bound_array(): void
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
    public function it_can_retrieve_textarea_localized_null_value_from_bound_collection(): void
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
    public function it_can_retrieve_textarea_localized_null_value_from_bound_object(): void
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

    /** @test */
    public function it_can_override_textarea_global_error_bag_binding_from_component_error_bag(): void
    {
        config()->set('form-components.display_validation_failure', true);
        $globalMessageBag = app(MessageBag::class)->add('description', 'Global error test');
        $componentMessageBag = app(MessageBag::class)->add('description', 'Component error test');
        $errors = app(ViewErrorBag::class)->put('global_error_bag', $globalMessageBag);
        $errors->put('component_error_bag', $componentMessageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        app(FormBinder::class)->bindErrorBag('global_error_bag');
        $html = $this->renderComponent(Textarea::class, ['name' => 'description', 'errorBag' => 'component_error_bag']);
        self::assertStringContainsString('<div class="invalid-feedback">Component error test</div>', $html);
    }
}
