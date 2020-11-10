# Changelog

All notable changes to `laravel-model-expires` will be documented in this file.

## [Unreleased]

## [v1.8.0] - 2020-11-10

### Added
- Support for PHP 8. [`27`](https://github.com/mvdnbrk/laravel-model-expires/pull/27)

### Removed
- Removed support for Laravel 5.5. [`28`](https://github.com/mvdnbrk/laravel-model-expires/pull/28)

## [v1.7.0] - 2020-09-18

### Added
- Added `discardExpiration` method. [`#22`](https://github.com/mvdnbrk/laravel-model-expires/pull/22), [`#25`](https://github.com/mvdnbrk/laravel-model-expires/pull/25)

## [v1.6.0] - 2020-08-08

### Added
- Added support for Laravel 8. [`#19`](https://github.com/mvdnbrk/laravel-model-expires/pull/19)

## [v1.5.1] - 2020-03-25

### Added
- Added type declarations. [`2680c1c`](https://github.com/mvdnbrk/laravel-model-expires/commit/2680c1c665bfd7b0f4fc4a8023f3c5beb503db39), [`c6a6c03`](https://github.com/mvdnbrk/laravel-model-expires/commit/c6a6c0358a5fc6c87ecc138678ea02f80ac84c60), [`ea4b9d3`](https://github.com/mvdnbrk/laravel-model-expires/commit/ea4b9d35f8b643104237e16192fc0a64f6b97505)

## [v1.5.0] - 2020-03-05

### Added
- Added support for Laravel 7. [`#18`](https://github.com/mvdnbrk/laravel-model-expires/pull/18)

## [v1.4.1] - 2019-11-23

### Fixed
- Make macros chainable. [`1dfe8b1`](https://github.com/mvdnbrk/laravel-model-expires/commit/1dfe8b1510dda68e08690e6e7ce40c033a626d33)

## [v1.4.0] - 2019-11-08

### Changed
- Changed namespace to `Mvdnbrk\EloquentExpirable`. [`#14`](https://github.com/mvdnbrk/laravel-model-expires/pull/14)
- Changed local scopes to a global `ExpiringScope`. [`#14`](https://github.com/mvdnbrk/laravel-model-expires/pull/13)

## [v1.3.0] - 2019-11-08

### Added
- Added `willExpire` method. [`#10`](https://github.com/mvdnbrk/laravel-model-expires/pull/10)
- Added `expiring` query scope. [`#11`](https://github.com/mvdnbrk/laravel-model-expires/pull/11)
- Added `notExpiring` query scope. [`#11`](https://github.com/mvdnbrk/laravel-model-expires/pull/11)

## [v1.2.0] - 2019-11-08

### Added
- Added `onlyExpired` query scope. [`#9`](https://github.com/mvdnbrk/laravel-model-expires/pull/9)
- Added `withoutExpired` query scope. [`#9`](https://github.com/mvdnbrk/laravel-model-expires/pull/9)

## [v1.1.0] - 2019-11-07

### Changed
- Changed `Expires` trait name to `Expirable`. [`#5`](https://github.com/mvdnbrk/laravel-model-expires/pull/5)

## v1.0.0 - 2019-11-07

[Unreleased]: https://github.com/mvdnbrk/laravel-model-expires/compare/v1.8.0...HEAD
[v1.8.0]: https://github.com/mvdnbrk/laravel-model-expires/compare/v1.7.0...v1.8.0
[v1.7.0]: https://github.com/mvdnbrk/laravel-model-expires/compare/v1.6.0...v1.7.0
[v1.6.0]: https://github.com/mvdnbrk/laravel-model-expires/compare/v1.5.1...v1.6.0
[v1.5.1]: https://github.com/mvdnbrk/laravel-model-expires/compare/v1.5.0...v1.5.1
[v1.5.0]: https://github.com/mvdnbrk/laravel-model-expires/compare/v1.4.1...v1.5.0
[v1.4.1]: https://github.com/mvdnbrk/laravel-model-expires/compare/v1.4.0...v1.4.1
[v1.4.0]: https://github.com/mvdnbrk/laravel-model-expires/compare/v1.3.0...v1.4.0
[v1.3.0]: https://github.com/mvdnbrk/laravel-model-expires/compare/v1.2.0...v1.3.0
[v1.2.0]: https://github.com/mvdnbrk/laravel-model-expires/compare/v1.1.0...v1.2.0
[v1.1.0]: https://github.com/mvdnbrk/laravel-model-expires/compare/v1.0.0...v1.1.0
