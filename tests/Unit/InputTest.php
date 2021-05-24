<?php

namespace Okipa\LaravelFormComponents\Tests\Unit;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelFormComponents\Components\Input;
use Okipa\LaravelFormComponents\Tests\TestCase;

class InputTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    /** @test */
    public function it_can_set_name(): void
    {
        $html = $this->renderComponent(['name' => 'first_name']);
        self::assertStringContainsString(' name="first_name"', $html);
    }

    /** @test */
    public function it_can_setup_default_text_type_when_none_is_defined(): void
    {
        $html = $this->renderComponent(['name' => 'first_name']);
        self::assertStringContainsString(' type="text"', $html);
    }

    /** @test */
    public function it_can_set_type(): void
    {
        $html = $this->renderComponent(['name' => 'first_name', 'type' => 'color']);
        self::assertStringContainsString(' type="color"', $html);
    }

    /** @test */
    public function it_can_setup_default_id_when_none_is_defined(): void
    {
        $html = $this->renderComponent(['name' => 'first_name']);
        self::assertStringContainsString(' id="text-first-name"', $html);
    }

    /** @test */
    public function it_can_set_id(): void
    {
        $html = $this->renderComponent(['name' => 'first_name', 'id' => 'test-id']);
        self::assertStringContainsString(' id="test-id"', $html);
    }

    /** @test */
    public function it_can_setup_default_label_when_none_is_defined(): void
    {
        $html = $this->renderComponent(['name' => 'first_name']);
        self::assertStringContainsString(
            '<label for="text-first-name" class="form-label">validation.attributes.first_name</label>',
            $html
        );
    }

    /** @test */
    public function it_can_set_label(): void
    {
        $html = $this->renderComponent(['name' => 'first_name', 'label' => 'Test label']);
        self::assertStringContainsString(
            '<label for="text-first-name" class="form-label">Test label</label>',
            $html
        );
    }

    /** @test */
    public function it_can_hide_label(): void
    {
        $html = $this->renderComponent(['name' => 'first_name', 'hideLabel' => 'Test label']);
        self::assertStringNotContainsString('<label', $html);
    }

    /** @test */
    public function it_can_globally_set_floating_label_mode_from_config(): void
    {
        config()->set('form-components.floating_label', true);
        $input = app(Input::class, ['name' => 'first_name']);
        self::assertTrue($input->floatingLabel);
        config()->set('form-components.floating_label', false);
        $input = app(Input::class, ['name' => 'first_name']);
        self::assertFalse($input->floatingLabel);
    }

    /** @test */
    public function it_can_set_non_floating_label_mode_and_override_config(): void
    {
        $html = $this->renderComponent(['name' => 'first_name', 'floatingLabel' => false]);
        self::assertStringNotContainsString(' form-floating', $html);
        $labelPosition = strrpos($html, '<label');
        $inputPosition = strrpos($html, '<input');
        self::assertLessThan($inputPosition, $labelPosition);
    }

    /** @test */
    public function it_can_set_floating_label_mode_and_override_config(): void
    {
        $html = $this->renderComponent(['name' => 'first_name', 'floatingLabel' => true]);
        self::assertStringContainsString(' form-floating', $html);
        $labelPosition = strrpos($html, '<label');
        $inputPosition = strrpos($html, '<input');
        self::assertLessThan($labelPosition, $inputPosition);
    }

    /** @test */
    public function it_cant_display_addons_with_floating_label(): void
    {
        config()->set('form-components.floating_label', true);
        $html = $this->renderComponent([
            'name' => 'first_name',
            'prepend' => 'Test prepend',
            'append' => 'Test append',
        ]);
        self::assertStringNotContainsString('Test prepend', $html);
        self::assertStringNotContainsString('Test append', $html);
    }

    /** @test */
    public function it_can_setup_default_placeholder_with_string_name_when_none_is_defined(): void
    {
        $html = $this->renderComponent(['name' => 'first_name']);
        self::assertStringContainsString('placeholder="validation.attributes.first_name"', $html);
    }

    /** @test */
    public function it_can_setup_default_placeholder_with_array_name_when_none_is_defined(): void
    {
        $html = $this->renderComponent(['name' => 'first_name[fr]']);
        self::assertStringContainsString('placeholder="validation.attributes.first_name"', $html);
    }

    /** @test */
    public function it_can_setup_default_placeholder_from_defined_label(): void
    {
        $html = $this->renderComponent(['name' => 'first_name', 'label' => 'Test label']);
        self::assertStringContainsString('placeholder="Test label"', $html);
    }

    /** @test */
    public function it_can_hide_placeholder(): void
    {
        $html = $this->renderComponent(['name' => 'first_name', 'hidePlaceholder' => true]);
        self::assertStringNotContainsString('placeholder', $html);
    }

    /** @test */
    public function it_can_set_placeholder(): void
    {
        $html = $this->renderComponent(['name' => 'first_name', 'placeholder' => 'Test placeholder']);
        self::assertStringContainsString('placeholder="Test placeholder"', $html);
    }

    /** @test */
    public function it_can_set_prepend_addon(): void
    {
        config()->set('form-components.floating_label', false);
        $html = $this->renderComponent(['name' => 'first_name', 'prepend' => 'Test prepend']);
        self::assertStringContainsString('<span class="input-group-text">Test prepend</span>', $html);
        $addonPosition = strrpos($html, 'input-group-text');
        $inputPosition = strrpos($html, '<input');
        self::assertLessThan($inputPosition, $addonPosition);
    }

    /** @test */
    public function it_can_set_closure_prepend_addon(): void
    {
        config()->set('form-components.floating_label', false);
        $html = $this->renderComponent([
            'name' => 'first_name',
            'prepend' => fn(string $locale) => 'Test prepend ' . $locale,
        ]);
        self::assertStringContainsString('Test prepend ' . app()->getLocale(), $html);
    }

    public function it_can_set_append_addon(): void
    {
        config()->set('form-components.floating_label', false);
        $html = $this->renderComponent(['name' => 'first_name', 'append' => 'Test append']);
        self::assertStringContainsString('<span class="input-group-text">Test append</span>', $html);
        $addonPosition = strrpos($html, 'input-group-text');
        $inputPosition = strrpos($html, '<input');
        self::assertLessThan($addonPosition, $inputPosition);
    }

    /** @test */
    public function it_can_set_closure_append_addon(): void
    {
        config()->set('form-components.floating_label', false);
        $html = $this->renderComponent([
            'name' => 'first_name',
            'append' => fn(string $locale) => 'Test append ' . $locale,
        ]);
        self::assertStringContainsString('Test append ' . app()->getLocale(), $html);
    }

    /** @test */
    public function it_can_set_caption(): void
    {
        $html = $this->renderComponent(['name' => 'first_name', 'caption' => 'Test caption']);
        self::assertStringContainsString('aria-describedby="text-first-name-caption"', $html);
        self::assertStringContainsString(
            '<div id="text-first-name-caption" class="form-text">Test caption</div>',
            $html
        );
    }

    /** @test */
    public function it_can_retrieve_value_from_model(): void
    {
        $user = app(User::class)->forceFill(['first_name' => 'Test first name']);
        $html = $this->renderComponent(['name' => 'first_name', 'model' => $user]);
        self::assertStringContainsString(' value="Test first name"', $html);
    }

    /** @test */
    public function it_can_set_value_and_override_model_value(): void
    {
        $user = app(User::class)->forceFill(['first_name' => 'Test first name']);
        $html = $this->renderComponent(['name' => 'first_name', 'model' => $user, 'value' => 'Test value']);
        self::assertStringContainsString(' value="Test value"', $html);
    }

    /** @test */
    public function it_can_set_zero_value(): void
    {
        $html = $this->renderComponent(['name' => 'first_name', 'value' => 0]);
        self::assertStringContainsString(' value="0"', $html);
    }

    /** @test */
    public function it_can_set_empty_string_value(): void
    {
        $html = $this->renderComponent(['name' => 'first_name', 'value' => '']);
        self::assertStringContainsString(' value=""', $html);
    }

    /** @test */
    public function it_can_set_null_value(): void
    {
        $html = $this->renderComponent(['name' => 'first_name', 'value' => null]);
        self::assertStringContainsString(' value=""', $html);
    }

    /** @test */
    public function it_can_set_value_from_closure_with_disabled_multilingual(): void
    {
        $html = $this->renderComponent([
            'name' => 'first_name',
            'value' => fn(string $locale) => 'Test value ' . $locale,
        ]);
        self::assertStringContainsString(' value="Test value ' . app()->getLocale() . '"', $html);
    }

    /** @test */
    public function it_can_retrieve_old_value_from_string(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge(['first_name' => 'Test old first name'])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(['name' => 'first_name', 'value' => 'Test old first name']);
        self::assertStringContainsString(' value="Test old first name"', $html);
    }

    /** @test */
    public function it_can_take_old_value_from_null(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge(['first_name' => null])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(['name' => 'first_name', 'value' => 'Test first name']);
        self::assertStringContainsString(' value=""', $html);
    }

    /** @test */
    public function it_can_retrieve_old_value_from_array(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web',
            'uses' => fn() => request()->merge(['first_name' => ['fr' => 'Test old first name']])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->renderComponent(['name' => 'first_name[fr]', 'value' => 'Test first name']);
        self::assertStringContainsString(' value="Test old first name"', $html);
    }

    /** @test */
    public function it_can_globally_set_display_validation_success(): void
    {
        config()->set('form-components.display_validation_success', true);
        $input = app(Input::class, ['name' => 'first_name']);
        self::assertTrue($input->displayValidationSuccess);
        config()->set('form-components.display_validation_success', false);
        $input = app(Input::class, ['name' => 'first_name']);
        self::assertFalse($input->displayValidationSuccess);
    }

    /** @test */
    public function it_can_display_validation_success_when_allowed(): void
    {
        config()->set('form-components.display_validation_success', false);
        $messageBag = app(MessageBag::class)->add('other_field', 'Error test');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(['name' => 'first_name', 'displayValidationSuccess' => true]);
        self::assertStringContainsString(' is-valid', $html);
    }

    /** @test */
    public function it_cant_display_validation_success_when_disallowed(): void
    {
        config()->set('form-components.display_validation_success', true);
        $messageBag = app(MessageBag::class)->add('other_field', 'Error test');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(['name' => 'first_name', 'displayValidationSuccess' => false]);
        self::assertStringNotContainsString(' is-valid', $html);
    }

    /** @test */
    public function it_can_globally_set_display_validation_failure(): void
    {
        config()->set('form-components.display_validation_failure', true);
        $input = app(Input::class, ['name' => 'first_name']);
        self::assertTrue($input->displayValidationFailure);
        config()->set('form-components.display_validation_failure', false);
        $input = app(Input::class, ['name' => 'first_name']);
        self::assertFalse($input->displayValidationFailure);
    }

    /** @test */
    public function it_can_display_validation_failure_when_allowed(): void
    {
        config()->set('form-components.display_validation_failure', false);
        $messageBag = app(MessageBag::class)->add('first_name', 'Error test');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(['name' => 'first_name', 'displayValidationFailure' => true]);
        self::assertStringContainsString(' is-invalid', $html);
        self::assertStringContainsString('<div class="invalid-feedback">Error test</div>', $html);
    }

    /** @test */
    public function it_cant_display_validation_failure_when_disallowed(): void
    {
        config()->set('form-components.display_validation_failure', true);
        $messageBag = app(MessageBag::class)->add('first_name', 'Error test');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        session()->put(compact('errors'));
        $this->executeWebMiddlewareGroup();
        $html = $this->renderComponent(['name' => 'first_name', 'displayValidationFailure' => false]);
        self::assertStringNotContainsString(' is-invalid', $html);
        self::assertStringNotContainsString('<div class="invalid-feedback">Error test</div>', $html);
    }
}
