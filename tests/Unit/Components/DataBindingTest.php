<?php

use Illuminate\Foundation\Auth\User;
use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Components\Textarea;
use Okipa\LaravelFormComponents\FormBinder;
use Okipa\LaravelFormComponents\Tests\TestCase;

class DataBindingTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_retrieve_input_value_from_direct_bound_model(): void
    {
        $user = app(User::class)->forceFill(['first_name' => 'Test first name']);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'bind' => $user]);
        self::assertStringContainsString(' value="Test first name"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_value_from_direct_bound_array(): void
    {
        $data = ['first_name' => 'Test first name'];
        $html = $this->renderComponent(Input::class, ['name' => 'first_name', 'bind' => $data]);
        self::assertStringContainsString(' value="Test first name"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_value_from_global_bound_model(): void
    {
        $user = app(User::class)->forceFill(['first_name' => 'Test first name']);
        app(FormBinder::class)->bindNewDataBatch($user);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name']);
        self::assertStringContainsString(' value="Test first name"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_value_from_global_bound_array(): void
    {
        $data = ['first_name' => 'Test first name'];
        app(FormBinder::class)->bindNewDataBatch($data);
        $html = $this->renderComponent(Input::class, ['name' => 'first_name']);
        self::assertStringContainsString(' value="Test first name"', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_value_from_direct_bound_model(): void
    {
        $user = app(User::class)->forceFill(['first_name' => 'Test first name']);
        $html = $this->renderComponent(Textarea::class, ['name' => 'first_name', 'bind' => $user]);
        self::assertStringContainsString('>Test first name</textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_value_from_direct_bound_array(): void
    {
        $data = ['first_name' => 'Test first name'];
        $html = $this->renderComponent(Textarea::class, ['name' => 'first_name', 'bind' => $data]);
        self::assertStringContainsString('>Test first name</textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_value_from_global_bound_model(): void
    {
        $user = app(User::class)->forceFill(['first_name' => 'Test first name']);
        app(FormBinder::class)->bindNewDataBatch($user);
        $html = $this->renderComponent(Textarea::class, ['name' => 'first_name']);
        self::assertStringContainsString('>Test first name</textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_value_from_global_bound_array(): void
    {
        $data = ['first_name' => 'Test first name'];
        app(FormBinder::class)->bindNewDataBatch($data);
        $html = $this->renderComponent(Textarea::class, ['name' => 'first_name']);
        self::assertStringContainsString('>Test first name</textarea>', $html);
    }

    /** @test */
    public function it_can_override_global_input_binding_by_direct_bound_data(): void
    {
        $boundModel = app(User::class)->forceFill(['first_name' => 'Test first name bound']);
        $componentModel = app(User::class)->forceFill(['first_name' => 'Test first name component']);
        app(FormBinder::class)->bindNewDataBatch($boundModel);
        $component = app(Input::class, ['name' => 'first_name', 'bind' => $componentModel]);
        self::assertSame($componentModel, $component->bind);
    }

    /** @test */
    public function it_can_override_global_textarea_binding_by_direct_bound_data(): void
    {
        $boundModel = app(User::class)->forceFill(['first_name' => 'Test first name bound']);
        $componentModel = app(User::class)->forceFill(['first_name' => 'Test first name component']);
        app(FormBinder::class)->bindNewDataBatch($boundModel);
        $component = app(Textarea::class, ['name' => 'first_name', 'bind' => $componentModel]);
        self::assertSame($componentModel, $component->bind);
    }

    /** @test */
    public function it_can_retrieve_input_localized_value_from_bound_model(): void
    {
        $user = app(User::class)->forceFill([
            'first_name' => [
                'fr' => 'Test first name FR',
                'en' => 'Test first name EN',
            ],
        ]);
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'bind' => $user,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('value="Test first name FR"', $html);
        self::assertStringContainsString('value="Test first name EN"', $html);
    }

    /** @test */
    public function it_can_retrieve_input_localized_value_from_bound_array(): void
    {
        $user = ['first_name' => ['fr' => 'Test first name FR', 'en' => 'Test first name EN']];
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'bind' => $user,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('value="Test first name FR"', $html);
        self::assertStringContainsString('value="Test first name EN"', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_localized_value_from_bound_model(): void
    {
        $user = app(User::class)->forceFill([
            'first_name' => [
                'fr' => 'Test first name FR',
                'en' => 'Test first name EN',
            ],
        ]);
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'first_name',
            'bind' => $user,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('>Test first name FR</textarea>', $html);
        self::assertStringContainsString('>Test first name EN</textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_localized_value_from_bound_array(): void
    {
        $user = ['first_name' => ['fr' => 'Test first name FR', 'en' => 'Test first name EN']];
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'first_name',
            'bind' => $user,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('>Test first name FR</textarea>', $html);
        self::assertStringContainsString('>Test first name EN</textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_input_localized_null_value_from_bound_model(): void
    {
        $user = app(User::class)->forceFill(['first_name' => ['fr' => 'Test first name FR']]);
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'bind' => $user,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('value="Test first name FR"', $html);
        self::assertStringContainsString('value=""', $html);
    }

    /** @test */
    public function it_can_retrieve_input_localized_null_value_from_bound_array(): void
    {
        $user = ['first_name' => ['fr' => 'Test first name FR']];
        $html = $this->renderComponent(Input::class, [
            'name' => 'first_name',
            'bind' => $user,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('value="Test first name FR"', $html);
        self::assertStringContainsString('value=""', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_localized_null_value_from_bound_model(): void
    {
        $user = app(User::class)->forceFill(['first_name' => ['fr' => 'Test first name FR']]);
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'first_name',
            'bind' => $user,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('>Test first name FR</textarea>', $html);
        self::assertStringContainsString('></textarea>', $html);
    }

    /** @test */
    public function it_can_retrieve_textarea_localized_null_value_from_bound_array(): void
    {
        $user = ['first_name' => ['fr' => 'Test first name FR']];
        $html = $this->renderComponent(Textarea::class, [
            'name' => 'first_name',
            'bind' => $user,
            'locales' => ['fr', 'en'],
        ]);
        self::assertStringContainsString('>Test first name FR</textarea>', $html);
        self::assertStringContainsString('></textarea>', $html);
    }
}
