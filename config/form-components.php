<?php

return [

    /**
     * The UI framework that should be used to generate the components.
     * Can be set to `bootstrap-5` or `tailwind-2`.
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
        Okipa\LaravelFormComponents\Components\ErrorMessage::class,
        Okipa\LaravelFormComponents\Components\Label::class,
        // Form
        Okipa\LaravelFormComponents\Components\Input::class,
    ],

    /** Whether form components should use floating labels. */
    'floating_label' => true,

    /**
     * Whether form input/textarea/checkbox/radio/switch components should display their validation success.
     * Success status will be display when errors are sent to the view with no matching with the component name.
     */
    'display_validation_success' => true,

    /**
     * Whether form input/textarea/checkbox/radio/switch components should display their validation failure.
     * Fail status will be display when errors are sent to the view with a match with the component name.
     */
    'display_validation_failure' => true,

];
