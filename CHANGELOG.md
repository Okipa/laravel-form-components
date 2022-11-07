# Changelog

All notable changes to this package will be documented in this file.

## [1.0.9](https://github.com/Okipa/laravel-form-components/compare/1.0.8...1.0.9)

2022-11-07

* Fixed Bootstrap 4 checkbox & radio wrong classes by @Balsakup in https://github.com/Okipa/laravel-form-components/pull/22
* Fix Bootstrap 4 caption and error message positioning that caused displaying issue when declaring an input group by @Balsakup (first contribution) in https://github.com/Okipa/laravel-form-components/pull/21

## [1.0.8](https://github.com/Okipa/laravel-form-components/compare/1.0.7...1.0.8)

2022-10-27

* Improved CI

## [1.0.7](https://github.com/Okipa/laravel-form-components/compare/1.0.6...1.0.7)

2022-08-01

* Replaced `phpcs/phpcbf` by `laravel/pint`

## [1.0.6](https://github.com/Okipa/laravel-form-components/compare/1.0.5...1.0.6)

2022-04-15

* Fixed Bootstrap 4 input file input validation class wrong positioning:
  * `is-valid` and `is-invalid` classes are now added to the `custom-file` div without addon declaration
  * `is-valid` and `is-invalid` classes are now added to the `input-group` div with addon declaration
* Fixed Bootstrap 4 input caption and error message positioning: they are now positioned under input group div in order to be displayed correctly

## [1.0.5](https://github.com/Okipa/laravel-form-components/compare/1.0.4...1.0.5)

2022-03-18

* Fixed remaining input components without `name` attributes when they were wired
 
## [1.0.4](https://github.com/Okipa/laravel-form-components/compare/1.0.3...1.0.4)

2022-03-18

* Fixed inputs in order to let them generate the `name` attribute even if they are wired

## [1.0.3](https://github.com/Okipa/laravel-form-components/compare/1.0.2...1.0.3)

2022-03-17

* Fixed Bootstrap 4 file input missing label
* Transformed Bootstrap 4 file input custom label to behave as a placeholder

## [1.0.2](https://github.com/Okipa/laravel-form-components/compare/1.0.1...1.0.2)

2022-02-23

* Fixed Bootstrap 4 file input
* Fixed Bootstrap 4 caption partial

## [1.0.1](https://github.com/Okipa/laravel-form-components/compare/1.0.0...1.0.1)

2022-02-23

* Fixed Bootstrap 4 toggle-switch classes

## [1.0.0](https://github.com/Okipa/laravel-form-components/releases/tag/1.0.0)

2022-01-15

* Initial release
