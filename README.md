<img src="https://raw.githubusercontent.com/mvdnbrk/laravel-model-expires/main/docs/logo.png" alt="Laravel Model Expires">

---

![PHP version][ico-php-version]
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Tests][ico-tests]][link-tests]
[![Code style][ico-code-style]][link-code-style]
[![Total Downloads][ico-downloads]][link-downloads]

# Assign expiration dates to Eloquent models

## Installation

You can install the package via composer:

```bash
composer require mvdnbrk/laravel-model-expires
```
## Usage

To use an expiration date on a model, use the `Expirable` trait:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mvdnbrk\EloquentExpirable\Expirable;

class Subscription extends Model
{
    use Expirable;
}
```

You should add an `expires_at` column to your database table.  
This packages contains a helper method to create this column:

```php
class CreateSubscriptionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->expires();
        });
    }

    public function down(): void
    {
        Schema::dropExpires();
    }
}

```

The `Expirable` trait will automatically cast the `expires_at` attribute to a `DateTime` / `Carbon` instance for you.

### Customizing the column name

You may customize the column name by setting the `EXIRES_AT` constant or by overriding the `getExpiresAtColumn` method on your model.

```php
class Subscription extends Model
{
    use Expirable;

    const EXPIRES_AT = 'ends_at';
}
```

```php
$table->expires('ends_at');
$table->dropExpires('ends_at);
```

### Setting expiration

You may set the expiration of a model by setting the `expires_at` attribute with a TTL in seconds:

```php
$subscription->expires_at = 600;
```

Instead of passing the number of seconds as an integer, you may also pass a `DateTime` instance representing the expiration date:

```php
$subscription->expires_at = now()->addMinutes(10);
```

### Discarding expiration

You may discard the expiration of a model by setting a negative or zero TTL or use the `discardExpiration` method:

```php
$subscription->expires_at = 0;
$subscription->expires_at = -5;

$subscription->discardExpiration()->save();
```

### Determining expiration

To determine if a given model instance has expired, use the `expired` method:

```php
if ($subscription->expired()) {
    //
}
```

To determine if a given model will expire in the future use the `willExpire` method:

```php
if ($subscription->willExpire()) {
    //
}
```

### Querying models

The `withoutExpired` method will retrieve models that are not expired:

```php
$subscriptions = App\Models\Subscription::withoutExpired()->get();
```

The `onlyExpired` method will retrieve **only** the expired models:

```php
$subscriptions = App\Models\Subscription::onlyExpired()->get();
```

The `expiring` method will retrieve **only** models that will expire in the future:

```php
$subscriptions = App\Models\Subscription::expiring()->get();
```

The `notExpiring` method will retrieve **only** models that will not expire:

```php
$subscriptions = App\Models\Subscription::notExpiring()->get();
```

### Todo
- Add a `expired:prune` console command to delete expired models, or perform custom implementation.
- Add a query scope that will query models that will expire in `...`

## Testing

```bash
composer test
```
## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Mark van den Broek][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-php-version]: https://img.shields.io/packagist/php-v/mvdnbrk/gtin?style=flat-square
[ico-version]: https://img.shields.io/packagist/v/mvdnbrk/laravel-model-expires.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-tests]: https://img.shields.io/github/workflow/status/mvdnbrk/laravel-model-expires/tests/main?label=tests&style=flat-square
[ico-code-style]: https://styleci.io/repos/220024174/shield?branch=main
[ico-downloads]: https://img.shields.io/packagist/dt/mvdnbrk/laravel-model-expires.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/mvdnbrk/laravel-model-expires
[link-tests]: https://github.com/mvdnbrk/laravel-model-expires/actions?query=workflow%3Atests
[link-code-style]: https://styleci.io/repos/220024174
[link-downloads]: https://packagist.org/packages/mvdnbrk/laravel-model-expires
[link-author]: https://github.com/mvdnbrk
[link-contributors]: ../../contributors
