# Changelog

All notable changes to `laravel-model-expires` will be documented in this file.

## [Unreleased]

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

[Unreleased]: https://github.com/mvdnbrk/laravel-model-expires/compare/v1.5.0...HEAD
[v1.5.0]: https://github.com/mvdnbrk/laravel-model-expires/compare/v1.4.1...v1.5.0
[v1.4.1]: https://github.com/mvdnbrk/laravel-model-expires/compare/v1.4.0...v1.4.1
[v1.4.0]: https://github.com/mvdnbrk/laravel-model-expires/compare/v1.3.0...v1.4.0
[v1.3.0]: https://github.com/mvdnbrk/laravel-model-expires/compare/v1.2.0...v1.3.0
[v1.2.0]: https://github.com/mvdnbrk/laravel-model-expires/compare/v1.1.0...v1.2.0
[v1.1.0]: https://github.com/mvdnbrk/laravel-model-expires/compare/v1.0.0...v1.1.0
