# Eloquent Tokenable

Eloquent trait for exposing Hashids-based tokens on Laravel models instead of numeric IDs.

Full documentation: [opensource.duma.sh/libraries/php/eloquent-tokenable](https://opensource.duma.sh/libraries/php/eloquent-tokenable)

## Requirements

- PHP `^8.3`
- Laravel `^13.0`

## Installation

```bash
composer require kduma/eloquent-tokenable
```

## Usage

```php
use KDuma\Eloquent\Tokenable;
use KDuma\Eloquent\Attributes\HasToken;

#[HasToken(length: 10)]
class Order extends Model
{
    use Tokenable;
}
```

```php
$order = Order::find(1);
echo $order->token; // e.g. "k3Zx9mPqW2"

$order = Order::whereToken('k3Zx9mPqW2')->first();
```
