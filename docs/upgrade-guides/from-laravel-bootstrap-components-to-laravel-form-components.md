# Upgrade from okipa/laravel-bootstrap-components to okipa/laravel-form-components

This package is a full rewrite of the [okipa/laravel-bootstrap-components](https://github.com/Okipa/laravel-bootstrap-components) package.

This rewrite has been made for the following reasons:
* Migrating to a new repository with a name that would give a better representation of the package purpose
* Allowing choosing which UI framework is used to render components
* Taking advantage of the power of X Blade components which are allowing us to manipulate HTML directly instead of having to use PHP methods
* Migrating code to PHP 8.0
* Adding Livewire compatibility
* Adding a form component which would allow global model binding and global Livewire configuration

Follow the steps below to upgrade the package.

## Update component calls

For example, replace this code:

```Blade
{{ inputEmail()->name('email')->componentHtmlAttributes(['required', 'autofocus', 'autocomplete' => 'email']) }}
```

By this one:
```Blade
<x-form::input type="email" name="email" autofocus autocomplete="email" required/>
```

You'll have to execute this work for each of the following components:
* `inputText()->name('...')` should be replaced by `<x-form::input type="text" name="..."/>`
* `inputEmail()->name('...')` should be replaced by `<x-form::input type="email" name="..."/>`
* `inputPassword()->name('...')` should be replaced by `<x-form::input type="password" name="..."/>`
* `inputUrl()->name('...')` should be replaced by `<x-form::input type="url" name="..."/>`
* `inputTel()->name('...')` should be replaced by `<x-form::input type="tel" name="..."/>`
* `inputNumber()->name('...')` should be replaced by `<x-form::input type="number" name="..."/>`
* `inputColor()->name('...')` should be replaced by `<x-form::input type="color" name="..."/>`
* `inputDate()->name('...')` should be replaced by `<x-form::input type="date" name="..."/>`
* `inputTime()->name('...')` should be replaced by `<x-form::input type="time" name="..."/>`
* `inputDateTime()->name('...')` should be replaced by `<x-form::input type="datetime-local" name="..."/>`
* `inputFile()->name('...')` should be replaced by `<x-form::input type="file" name="..."/>`
* `inputCheckbox()->name('...')` should be replaced by `<x-form::checkbox name="..."/>`
* `inputSwitch()->name('...')` should be replaced by `<x-form::switch name="..."/>`
* `inputRadio()->name('...')` should be replaced by `<x-form::radio name="..."/>`
* `textarea()->name('...')` should be replaced by `<x-form::input name="..."/>`
* `select()->name('...')` should be replaced by `<x-form::select name="..."/>`

Of course if you used the Facade way to call these components in your views, you'll have to adapt the treatments reported below.

## Undocumented changes

If you see any forgotten and undocumented change, please submit a PR to add them to this upgrade guide.
