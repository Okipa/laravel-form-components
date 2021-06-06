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
<x-form::form method="POST" :action="route('user.update', $user)" :model="$user">
    <x-form::input type="file" name="avatar" caption="Accepted types: jpg, png and webp."/>
    <x-form::input name="name"/>
    <x-form::input type="email" name="email"/>
    <x-form::textarea name="biography" :locale="['fr', 'en]"/>
    <x-form::select name="technologies" :options="[1 => 'Laravel', 2 => 'Bootstrap', 3 => 'Tailwind', 4 => 'Livewire']" multiple/>
    <x-form::checkbox name="hobbies" :group="[1 => 'Sport', 2 => 'Cinema', 3 => 'Literature', 4 => 'Travel']"/>
    <x-form::radio name="role" :group="[1 => 'Admin', 2 => 'Moderator', 3 => 'User']" inline/>
    <x-form::switch name="active"/>
    <x-form::submit>Create</x-form::submit>
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
  * [Input](#input)
  * [Textarea](#textarea)
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

## Components list

Here is the list of the available components:
* `<x-form::form></x-form::form>`
* `<x-form::input/>`
* `<x-form::checkbox/>`
* `<x-form::switch/>`
* `<x-form::radio/>`
* `<x-form::textarea/>`
* `<x-form::select/>`
* `<x-form::submit></x-form::submit/>`

## How to

### Deal with attributes and classes

Provided component are built using [Blade components](https://laravel.com/docs/blade#components).

Following how Blade components work, you can set any HTML attributes and classes:
* Attributes will replace default ones
* Classes will be merged to existing ones

### Declare form

All components can be wrapped into a form component.

If no custom method is set, a `GET` method will be set by default.

Hidden CSRF and spoofing method fields will be automatically generated when needed, according to the defined form method.

Forms are generated with a default `novalidate` HTML attribute, which is preventing browser validation in favor of a server-side validation (which is a good practice for security matters).

```Blade
<x-form::form method="PUT">
    <x-form::input name="first_name"/>
    ...
</x-form::form>
```

### Submit form

### Set inputs and textarea components

### Define select component

### Manage checkboxes, switches and radio button components

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

```Blade
<x-form::input name="first_name" label="First Name"/>
```

Following the same behaviour, all components that are allowing the use of the `placeholder` attribute will provide a default placeholder that will take the `label` value.

You can override this default value by setting a custom placeholder.

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

You also can bind data directly on a component and override the form binding.

In case of validation error, components will be repopulated by old values that will override bound values.

```blade
@php($data = ['description' => 'A wonderful description'];)
<x-form::form :bind="$user">
    <x-form::input type="email" name="email"/> {{-- Will set the value from `$user->email` --}}
    <x-form::textarea
        name="description"
        :bind="$data"/> {{-- Will set the value from `$data['description`] --}}
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
