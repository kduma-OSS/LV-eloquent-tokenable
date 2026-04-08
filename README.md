# Eloquent Tokenable

[![Latest Stable Version](https://poser.pugx.org/kduma/eloquent-tokenable/v/stable.svg)](https://packagist.org/packages/kduma/eloquent-tokenable)
[![Total Downloads](https://poser.pugx.org/kduma/eloquent-tokenable/downloads.svg)](https://packagist.org/packages/kduma/eloquent-tokenable)
[![License](https://poser.pugx.org/kduma/eloquent-tokenable/license.svg)](https://packagist.org/packages/kduma/eloquent-tokenable)

Allows using tokens (HashIDs) instead of numeric IDs in Laravel Eloquent models.

Check full documentation here: [opensource.duma.sh/libraries/php/eloquent-tokenable](https://opensource.duma.sh/libraries/php/eloquent-tokenable)

## Requirements

- PHP `^8.3`
- Laravel `^13.0`

## Installation

```bash
composer require kduma/eloquent-tokenable
```

## Setup

Add the `Tokenable` trait to your model:

```php
use KDuma\Eloquent\Tokenable;

class Order extends Model
{
    use Tokenable;
}
```

## Configuration

### New style — PHP Attribute (recommended)

```php
use KDuma\Eloquent\Tokenable;
use KDuma\Eloquent\Attributes\HasToken;

#[HasToken(length: 12, alphabet: 'abcdef1234567890')]
class Order extends Model
{
    use Tokenable;
}
```

Available `HasToken` parameters:
- `length` — minimum hash length (default: `10`)
- `alphabet` — characters used in the hash (default: `abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890`)
- `salt` — custom salt added to `APP_KEY` (default: table name)

### Old style — model properties (deprecated, triggers `E_USER_DEPRECATED`)

```php
class Order extends Model
{
    use Tokenable;

    protected ?string $salt = 'SALT';       // ⚠️ deprecated
    protected int $length = 10;             // ⚠️ deprecated
    protected string $alphabet = 'abc...';  // ⚠️ deprecated
}
```

## Usage

- `$model->token` — returns the HashID token for the model
- `Model::whereToken($token)` — query scope to find by token

```php
$order = Order::find(1);
echo $order->token; // e.g. "k3Zx9mPqW2"

$found = Order::whereToken('k3Zx9mPqW2')->first();
```

## Packagist

[kduma/eloquent-tokenable](https://packagist.org/packages/kduma/eloquent-tokenable)
