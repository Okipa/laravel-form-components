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

## Usage

Just call the components you need in your views and let this package take care of the HTML generation annoying part.

### Monolingual input use case with Bootstrap 5

Calling these components in your view:

```blade
<x-form::form method="POST" :action="route('user.update', $user)">
    @model($user)
        <x-form::input name="name"/>
        <x-form::input type="email" name="email"/>
        <x-form::textarea name="biography"/>
    @endmodel
</x-form:form>
```

And get this component displayed:

ToDo: screenshot

## Table of Contents

* [Installation](#installation)
* [Configuration](#configuration)
* [Views](#views)
* [Components](#components)
* [How to](#how-to)
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

### Form

Usage:

```Blade
<x-form::form 
    method="PUT" {{-- Override `GET` default method --}}
    >
    ...
</x-form::form>
```

Note:

* Hidden CSRF and spoofing method fields will be automatically generated when needed, according to the defined form method
* Forms are generated with a default `novalidate` HTML attribute, which is preventing browser validation in favor of a server-side validation (which is a good practice)

### Input

Usage:

```Blade
<x-form::input 
    id="custom-id" {{-- Override `<type>-<name>` default id --}}
    type="email" {{-- Override `text` default type --}}
    name="email"
    label="User email" {{-- Override default `__('validation.attributes.<name>)` label --}}
    floatingLabel="false" {{-- Override global `config('form-components.floating_label')` floating label mode --}}
    hideLabel="true" {{-- Override default `false` hiding label mode --}}
    prepend="<i class="fas fa-code fa-fw"></i>" {{-- Input prepended addon - Will not be displayed with a floating label - Can also be defined with the closure `fn(string $locale) => <your-code>` --}}
    append="<i class="fas fa-search fa-fw"></i>" {{-- Input appended addon - Will not be displayed with a floating label - Can also be defined with the closure `fn(string $locale) => <your-code>` --}}
    placeholder="Set your email..." {{-- Override `__('validation.attributes.<name>)` default placeholder --}}
    hidePlaceholder="true" {{-- Override default `false` hiding placeholder mode --}}
    :model="$user" {{-- Bind model to automatically fill the input value --}}
    :value="$user->email" {{-- Manually set the value - Can also be defined with the closure `fn(string $locale) => <your-code>` --}}
    caption="Please set a valid email address."
    displayValidationSuccess="false" {{-- Override global `config('form-components.display_validation_success')` display validation success mode --}}
    displayValidationFailure="false" {{-- Override global `config('form-components.display_validation_failure')` display validation failure mode --}}
    errorBag="custom_error_bag"  {{-- Override default `default` error bag --}}
    :locales="['fr', 'en']"  {{-- Activate multilingual mode with `fr` and `en` locales --}}
    />
```

Note:

* Checkbox and radio inputs are managed with their own component as they put in motion their proper behaviour

### Textarea

### Select

### Checkbox

### Switch

### Radio

## How to

### Set label

### Set floating label mode

### Set ID

### Set CSS classes

### Set type

### Set name

### Set placeholder

### Set addons

### Set caption

### Get value from model

### Set custom value

### Deal with old data

### Display validation success and failure

### Configure Livewire

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
