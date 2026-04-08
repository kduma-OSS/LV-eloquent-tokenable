<?php
declare(strict_types=1);

namespace KDuma\Eloquent;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use KDuma\Eloquent\Attributes\HasToken;

trait Tokenable
{
    private function getHashingInstance(): Hashids
    {
        $salt = config('app.key') . (
            $this->resolveTokenableConfig('salt', 'salt', null)
            ?? $this->getTable()
        );
        $minHashLength = $this->resolveTokenableConfig('length', 'length', 10);
        $alphabet = $this->resolveTokenableConfig('alphabet', 'alphabet', 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');

        return new Hashids($salt, $minHashLength, $alphabet);
    }

    protected function token(): Attribute
    {
        return Attribute::make(
            get: fn (): string => $this->getHashingInstance()->encode($this->id),
        );
    }

    public function scopeWhereToken(Builder $query, string $token): Builder
    {
        $hashids = $this->getHashingInstance();
        $id = $hashids->decode($token);

        if ($id === []) {
            return $query->whereRaw('1 = 0');
        }

        return $query->where('id', $id[0]);
    }

    private function resolveTokenableConfig(string $attrProperty, string $legacyProperty, mixed $default): mixed
    {
        $value = static::resolveClassAttribute(HasToken::class, $attrProperty);
        if ($value !== null) {
            return $value;
        }

        if (property_exists($this, $legacyProperty)) {
            trigger_error(
                "Using \${$legacyProperty} on " . static::class . ' is deprecated. Use #[HasToken] attribute instead.',
                E_USER_DEPRECATED,
            );

            $value = $this->{$legacyProperty};

            // Treat 0 and '' as "use default" to preserve pre-deprecation behaviour (legacy used ?: operator)
            if ($value !== 0 && $value !== '') {
                return $value;
            }
        }

        return $default;
    }
}
