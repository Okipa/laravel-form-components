<?php

return [

    /**
     * The UI framework that should be used to generate the orm components.
     * Can be set to `bootstrap-4`, `bootstrap-5` or `tailwind-2`.
     */
    'ui' => 'bootstrap-5',

    /**
     * The fully qualified class name of the components.
     * Here you can override them and/or define your own.
     * Make sure your component extends the Okipa\LaravelFormComponents\Components\AbstractComponent abstract class.
     */
    'components' => [
        // Partials
        Okipa\LaravelFormComponents\Components\Addon::class,
        Okipa\LaravelFormComponents\Components\Caption::class,
        Okipa\LaravelFormComponents\Components\Label::class,
        // Form
        Okipa\LaravelFormComponents\Components\Input::class,
    ],

    /** Whether components should use floating labels. */
    'floating_label' => true,

    /** Whether components should display their validation statuses. */
    'display_failed_validation' => true,
    'display_succeeded_validation' => true,

];
