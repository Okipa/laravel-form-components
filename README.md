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
    <a href="https://coveralls.io/github/Okipa/laravel-form-components?branch=master" title="Coverage Status">
        <img src="https://coveralls.io/repos/github/Okipa/laravel-form-components/badge.svg?branch=master" alt="Coverage Status">
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
|---|---|---|---|
| ^7.0 | ^8.0 | ^1.0 |

## Upgrade guide

* [From okipa/laravel-bootstrap-components to okipa/laravel-form-components](/docs/upgrade-guides/from-laravel-bootstrap-components-to-laravel-form-components.md)

## Usage

Just call the components you need in your views and let this package take care of the HTML generation annoying part.

### Monolingual input use case with Bootstrap 5

Call this component in your view:

```blade
<x-form::input name="first_name"/>
```

And get this component displayed:

ToDo: screenshot

```blade
ToDo: code
```

### Multilingual input use case with Bootstrap 5

Call this component in your view:

```blade
<x-form::input name="first_name"/>
```

And get this component displayed:

ToDo: screenshot

```blade
ToDo: code
```

## Table of Contents

* [Installation](#installation)
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

You can publish the config file with:

```bash
php artisan vendor:publish --tag=form-components:config
```

You can publish the package views to customize them if necessary:

```bash
php artisan vendor:publish --tag=form-components:views
```

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
