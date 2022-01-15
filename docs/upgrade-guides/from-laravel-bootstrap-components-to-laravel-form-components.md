# Upgrade from okipa/laravel-bootstrap-components to okipa/laravel-form-components

This package is a full rewrite of the [okipa/laravel-bootstrap-components](https://github.com/Okipa/laravel-bootstrap-components) package.

This rewrite has been made for the following reasons:
* Migrating to a new repository with a name that would give a better representation of the package purpose
* Allowing choosing which UI framework is used to render components
* Taking advantage of the power of X Blade components which are allowing us to manipulate HTML directly instead of having to manipulate PHP
* Migrating code to PHP 8.0/8.1
* Adding and improving features
* Adding Livewire compatibility

Follow the steps below to upgrade the package.

## Replace native HTML form calls

You now can use a form component which will automatically generate CSRF and method spoofing hidden fields for you.

As so, you should:
* Replace your native HTML form implementations
* Remove you CSRF and spoofing method hidden fields implementations

See documentation to check [how to use form component](../../README.md#form).

## Replacing component calls

For example, you'll have to replace this component call:

```Blade
{{ inputEmail()->name('email')->componentHtmlAttributes(['required', 'autofocus', 'autocomplete' => 'email']) }}
```

By this one:
```Blade
<x-form::input type="email" name="email" autofocus autocomplete="email" required/>
```

You'll have to execute this replacement work for each of the following components:

* All the following components must be replaced by the [input](../../README.md#input-and-textarea) component
  * `inputText()`
  * `inputEmail()`
  * `inputPassword()`
  * `inputUrl()`
  * `inputTel()`
  * `inputNumber()`
  * `inputColor()`
  * `inputDate()`
  * `inputTime()`
  * `inputDateTime()`
  * `inputFile()`
* The `textarea()` component must be replaced by the [textarea](../../README.md#input-and-textarea) component   
* The `select()` component must be replaced by the [select](../../README.md#select) component
* The `inputCheckbox()` component must be replaced by the [checkbox](../../README.md#checkbox-switch-and-radio) component
* The `inputSwitch()` component must be replaced by the [toggle-switch](../../README.md#checkbox-switch-and-radio) component
* The `inputRadio()` component must be replaced by the [radio](../../README.md#select) component
* All the following components must be replaced by the [button.submit](../../README.md#buttons) component
  * `submit()`
  * `submitValidate()`
  * `SubmitCreate()`
  * `SubmitUpdate()`
* All the following components must be replaced by the [button.link](../../README.md#buttons) component
  * `button()`
  * `buttonBack()`
  * `buttonCancel()`
  * `buttonLink()`

Of course if you did use the Facade way to call the `okipa/laravel-bootstrap-components` components in your views, you'll have to adapt the replacements specified above.

## Undocumented changes

If you see any forgotten and undocumented change, please submit a PR to add them to this upgrade guide.
