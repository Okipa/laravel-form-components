<?php

namespace Okipa\LaravelFormComponents\Tests;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Illuminate\Testing\Constraints\SeeInOrder;
use Okipa\LaravelFormComponents\LaravelFormComponentsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
        $this->setUiConfigDynamically();
    }

    protected function executeWebMiddlewareGroup(): void
    {
        // Hack in order to provide the $error variable in views.
        $this->app['router']->get('test', ['middleware' => 'web']);
        $this->call('GET', 'test');
    }

    protected function setUiConfigDynamically(): void
    {
        $testNamespace = $this::class;
        if (Str::contains($testNamespace, 'Bootstrap4')) {
            Config::set('form-components.ui', 'bootstrap-4');

            return;
        }
        Config::set('form-components.ui', 'bootstrap-5');
    }

    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
    protected function getPackageProviders($app): array
    {
        return [LaravelFormComponentsServiceProvider::class];
    }

    protected function renderComponent(
        string $componentClass,
        array $componentData = [],
        array $viewData = [],
        array $attributes = []
    ): string {
        /** @var \Illuminate\View\Component $input */
        $input = app($componentClass, $componentData);
        $input->withAttributes($attributes);

        return $input->render()->with(array_merge($input->data(), $viewData))->render();
    }

    protected function assertSeeHtmlInOrder(string $html, array $values): void
    {
        self::assertTrue((new SeeInOrder($html))->matches($values));
    }
}
