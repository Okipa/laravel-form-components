<?php

namespace Okipa\LaravelFormComponents\Tests;

use Okipa\LaravelFormComponents\LaravelFormComponentsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->executeWebMiddlewareGroup();
    }

    protected function executeWebMiddlewareGroup(): void
    {
        $this->app['router']->get('test', ['middleware' => 'web']);
        $this->call('GET', 'test');
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
}
