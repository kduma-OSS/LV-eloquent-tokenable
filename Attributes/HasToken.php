<?php
declare(strict_types=1);

namespace KDuma\Eloquent\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class HasToken
{
    public function __construct(
        public readonly int $length = 10,
        public readonly string $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890',
        public readonly ?string $salt = null,
    ) {}
}
