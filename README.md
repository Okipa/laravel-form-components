![Laravel Form Components](/docs/laravel-form-components.png)
<p align="center">
    <a href="https://github.com/Okipa/laravel-form-components/releases" title="Latest Stable Version">
        <img src="https://img.shields.io/github/release/Okipa/laravel-form-components.svg?style=flat-square" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/Okipa/laravel-form-components" title="Total Downloads">
        <img src="https://img.shields.io/packagist/dt/okipa/laravel-form-components.svg?style=flat-square" alt="Total Downloads">
    </a>
    <a href="https://github.com/Okipa/laravel-form-components/actions" title="Build Status">
        <img src="https://github.com/Okipa/laravel-form-components/workflows/CI/badge.svg" alt="Build Status">
    </a>
    <a href="https://coveralls.io/github/Okipa/laravel-form-components?branch=main" title="Coverage Status">
        <img src="https://coveralls.io/repos/github/Okipa/laravel-form-components/badge.svg?branch=main" alt="Coverage Status">
    </a>
    <a href="/LICENSE.md" title="License: MIT">
        <img src="https://img.shields.io/badge/License-MIT-blue.svg" alt="License: MIT">
    </a>
</p>

**PACKAGE IN DEVELOPMENT**  
**DON'T USE IN PRODUCTION**

Save time and take advantage of a set of dynamical, ready-to-use and fully customizable form components.

Components are Livewire compatible and can be used with the following UI frameworks:
* Bootstrap 5
* Bootstrap 4 (coming soon, help welcomed)
* TailwindCSS 2 (coming soon, help welcomed)

Found this package helpful? Please consider supporting my work!

[![Donate](https://img.shields.io/badge/Buy_me_a-Ko--fi-ff5f5f.svg)](https://ko-fi.com/arthurlorent)
[![Donate](https://img.shields.io/badge/Donate_on-PayPal-green.svg)](https://paypal.me/arthurlorent)

## Compatibility

| Laravel | PHP | Package |
|---|---|---|
| ^8.0 | ^8.0 | ^1.0 |

## Upgrade guide

* [From okipa/laravel-bootstrap-components to okipa/laravel-form-components](/docs/upgrade-guides/from-laravel-bootstrap-components-to-laravel-form-components.md)

## Usage example

Just call the components you need in your views and let this package take care of the HTML generation time-consuming part.

```blade
<x-form::form method="POST" :action="route('user.update', $user)" :bind="$user">
    <x-form::input type="file" name="avatar" caption="Accepted types: jpg, png and webp."/>
    <x-form::input name="name"/>
    <x-form::input type="email" name="email"/>
    <x-form::textarea name="biography" :locale="['fr', 'en]"/>
    <x-form::select name="technologies" :options="[1 => 'Laravel', 2 => 'Bootstrap', 3 => 'Tailwind', 4 => 'Livewire']" multiple/>
    <x-form::checkbox name="hobbies" :group="[1 => 'Sport', 2 => 'Cinema', 3 => 'Literature', 4 => 'Travel']"/>
    <x-form::radio name="gender" :group="[1 => 'Male', 2 => 'Female']"/>
    <x-form::switch name="active"/>
    <x-form::submit/>
</x-form:form>
```

And get this component displayed:

<screenshot>

## Table of Contents

* [Installation](#installation)
* [Configuration](#configuration)
* [Views](#views)
* [Components](#components)
  * [Form](#form)
  * [Input and Textarea](#input-and-textarea)
  * [Select](#select)
  * [Checkbox, Switch and Radio](#checkbox-switch-and-radio)
  * [Buttons](#buttons)
* [How to](#how-to)
  * [Deal with attributes and classes](#deal-with-attributes-and-classes)
  * [Set id](#set-id)
  * [Manage label and placeholder](#manage-label-and-placeholder)
  * [Handle floating label displaying](#handle-floating-label-displaying)
  * [Set addons](#set-addons)
  * [Bind data](#bind-data)
  * [Set custom value](#set-custom-value)
  * [Handle validation statuses and errors](#handle-validation-statuses-and-errors)
  * [Add captions](#add-captions)
  * [Activate multilingual mode](#activate-multilingual-mode)
* [Testing](#testing)
* [Changelog](#changelog)
* [Contributing](#contributing)
* [Credits](#credits)
* [Licence](#license)

## Installation

You can install the package via composer:

```bash
composer require okipa/laravel-form-components
```

## Configuration

You can publish the config file with:

```bash
php artisan vendor:publish --tag=form-components:config
```

Among its configurations, this package allows you to choose which UI framework will be use.

Please note that you'll have to install and configure the UI framework you want to use before using this package.

## Views

You can publish the package views to customize them if necessary:

```bash
php artisan vendor:publish --tag=form-components:views
```

## Components

Here is the list of the available components:
* [Form](#form)
* [Input](#input-and-textarea)
* [Textarea](#input-and-textarea)
* [Select](#select)
* [Checkbox](#checkbox-switch-and-radio)
* [Switch](#checkbox-switch-and-radio)
* [Radio](#checkbox-switch-and-radio)
* [Submit](#buttons)
* [Button](#buttons)

See below how to use them.

### Form

Components can be wrapped into a form component.

If no custom method is set, a `GET` method will be set by default.

Hidden CSRF and spoofing method fields will be automatically generated when needed, according to the defined form method :
* You won't need to define a `@method()` directive, declare your `PUT`, `PATCH` or `DELETE` action directly in the `action` attribute
* You won't need to define a `@csrf()` directive, it will be automatically declared with `POST`, `PUT`, `PATCH` and `DELETE` actions

Forms are generated with a default `novalidate` HTML attribute, which is preventing browser validation in favor of a server-side validation (which is a good practice for security matters).

```Blade
<x-form::form method="PUT">
    <x-form::input name="first_name"/>
    ...
</x-form::form>
```

### Input and Textarea

Add inputs and textarea into your forms.

If you don't set a custom type to an input, it will take a default `text` type.

Radio, checkbox and button inputs must be used with their own components because of their different behaviour.

Textarea component can be used the same way as an input component but without declaring a type.

```Blade
<x-form::input type="file" name="avatar"/>
<x-form::input name="first_name"/>
<x-form::input type="email" name="email"/>
...
<x-form::textarea name="description"/>
```

### Select

Set select components in your forms.

Auto generate options by providing a basic key/value array.

HTML select elements natively don't accept placeholder attributes, however the select component allows you to handle a placeholder-like option, which is a selected, disabled and hidden option that is prepended to the other ones. This placeholder will behave [as for the other components](#manage-label-and-placeholder).

```Blade
@php($options = [1 => 'Laravel', 2 => 'Bootstrap', 3 => 'Tailwind', 4 => 'Livewire'])
<x-form::select name="hobbies" placeholder="What is your hobby prefered hobby?" :options="$options" selected="1"/>
<x-form::select name="hobbies" :hidePlaceholder="true" :options="$options" :selected="[2, 3]" multiple/>
```

### Checkbox, Switch and Radio

Checkbox, radio and toggle switch components can be used in single mode or in group mode.

Just declare a single component to use a checkbox, radio or toggle switch in single mode.

To trigger the group mode, you'll simply have to provide a basic key/value array to the `group` attribute, and you'll get your chekboxes, radio or toggle switches generated. 

```Blade
<x-form::checkbox name="hobbies" :group="[1 => 'Sport', 2 => 'Cinema', 3 => 'Literature', 4 => 'Travel']"/>
<x-form::radio name="gender" :group="[1 => 'Male', 2 => 'Female']"/>
<x-form::switch name="active"/>
```

### Buttons

Submit and link button components are available.

Submit button allows you to trigger a form and will provide a default `__('Submit')` body if none is defined.

Link button allows you to set actions like `Back` or `Cancel` in your forms by providing a link with a button-like display. As this component is an HTML link, it will provide a default title by analysing its body.

By default, both components will set a base background color if no custom class attribute is defined.

```Blade
<x-form::form>
    ...
    <div class="d-grid">
        <x-form::button.submit>Submit this form</x-form::submit> {{-- Will provide `btn-primary` class with Bootstrap UI --}}
        <x-form::button.link class="btn-secondary" href="{{ back() }}"> {{-- Will auto-generate `title="Back"` --}}
            <i class="fas fa-undo fa-fw"></i>
            Back
        </x-form::submit>
    </div>
</x-form::form>
```

## How to

### Deal with attributes and classes

Provided component are built using [Blade components](https://laravel.com/docs/blade#components).

Following how Blade components work, you can set any HTML attributes and classes:
* Attributes will replace default ones
* Classes will be merged to existing ones

## Set id

Define components ids as you would do for any HTML element.

If no custom id is set, an id will be generated using the kebab cased `<type>-<name>` values.

```Blade
<x-form::input id="custom-id" name="first_name"/> {{-- Default id: `input-first-name` --}}

<x-form::textarea id="custom-id" name="first_name"/> {{-- Default id: `textarea-first-name` --}}
```

### Manage label and placeholder

You can define labels on all components which are allowing to define the `<label>` attribute.

If no custom label is defined, labels will take the `__('validation.attributes.<name>)` default value.

You also can hide a label by setting the `hideLabel` attribute to `true`.

Following the same behaviour, all components that are allowing the use of the `placeholder` attribute will provide a default placeholder that will take the `label` value.

You can override this default value by setting a custom placeholder. You also can hide a placeholder by setting the `hidePlaceholder` attribute to true.

```Blade
<x-form::input name="first_name" label="First Name" placeholder="Please fill your first name..."/>
<x-form::input name="last_name" :hideLabel="true" hidePlaceholder="true"/>
```

### Handle floating label displaying

This package allows you to enable or disable floating labels displaying.

You can set the global floating label behaviour with `config('form-components.floating_label')` config.

You will be able to override this global behaviour at form level for all contained components.

```Blade
<x-form::form :floatingLabel="true">
    <x-form::input name="first_name"/> {{-- Will display a floating label even if it has been disabled in config --}}
</x-form::form>
```

Finally, you'll also can override all other defined behaviour on components themselves.

```Blade
    <x-form::input name="first_name" :floatingLabel="true"/>
```

### Set addons

You can define `prepend` and `append` HTML addons on input and textarea components.

```Blade
    <x-form::input name="" prepend="<i class="fas fa-code fa-fw"></i>"/>
    <x-form::input name="search" append="<i class="fas fa-search fa-fw"></i>"/>
```

Note: you may use HTML directly instead of components for complex addon's management.

### Bind data

You can bind Eloquent Models, objects, collections or arrays in order to autofill bound components values.

Binding data on the form component will trigger the binding of all of its contained components.

You can bind data directly on a component and override the form binding.

In case of validation error, components will be repopulated by old values that will override bound values.

For specific use case, you also can use the `@bind(<boundDataBatch>)` and the `$endbind` Blade directives to bind a group of components.

```blade
@php
    $dataBatch1 = ['description' => 'A wonderful description'];
    $dataBatch2 = ['first_name' => 'John', 'last_name' => 'Bonham'];
@endphp
<x-form::form :bind="$user">
    <x-form::input type="email" name="email"/> {{-- Will set the value from `$user->email` --}}
    <x-form::textarea name="description" :bind="$dataBatch1"/> {{-- Will set the value from `$dataBatch1['description`] --}}
    @bind($dataBatch2)
        <x-form::input name="first_name"/> {{-- Will set the value from `$dataBatch2['first_name`] --}}
        <x-form::input name="last_name"/> {{-- Will set the value from `$dataBatch2['last_name`] --}}
    @endbind
</x-form::form>
```

### Set custom value

Data binding can be overridden by setting custom values on components.

```blade
@php($data = ['description' => 'A wonderful description'];)
<x-form::form :bind="$user">
    ...
    <x-form::textarea
        name="description"
        :bind="$user"
        :value="$data['description']"/> {{-- Will set the value from `$data['description`] --}}
</x-form::form>
```

### Handle validation statuses and errors

Components will be able to display or hide their success/error statuses and error message when a validation error is triggered:
* If the validation success displaying is activated, components will only be marked as valid when other components in the form are detected as invalid
* If the validation failure displaying is activated, components in error will be marked as invalid and will display their related error message

You can control this behaviour at different levels:
* Define the global default behaviour with `config('form-components.display_validation_success')` and `config('form-components.display_validation_failure')`
* Customize this behaviour on a form and apply it locally for all its contained components
* Set a specific behaviour directly on a component

```blade
<x-form::form displayValidationSuccess="false" displayValidationFailure="false">
    <x-form::input type="email" name="email"/> {{-- Disabled success/error statuses and error message --}}
    <x-form::textarea
        name="description"
        displayValidationSuccess="true"
        displayValidationFailure="true"/> {{-- Enabled success/error statuses and error message --}}
</x-form::form>
```

You also can customize the error bag that should be used to determine components success/error statuses and error messages on form components.

```blade
<x-form::form errorBag="profile_update">
    ...
</x-form::form>
```

### Add captions

Help users and display additional instructions under you components by adding captions.

```Blade
    <x-form::input name="name" caption="Please fill this input with your full name."/>
```

### Activate multilingual mode

Activate multilingual mode on `input` and `textarea` components to benefit from the following features:
* Component duplication: one component per locale will be displayed
* Name localization: `name="description"` will be transformed into `name="description[<locale>]"`
* Default label and error message localization: `__(validation.attributes.name)` translation used to generate default label and error message will be appended with `(<LOCALE>)`

```Blade
<x-form::input name="name" :locales="['fr', 'en']"/>
<x-form::textarea name="description" :locales="['fr', 'en']"/>
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Arthur LORENT](https://github.com/Okipa)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
