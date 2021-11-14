<?php

namespace Ivo\Trait;

use LogicException;

trait StringValueTrait
{
    use HasConstantsTrait;

    public function __toString(): string
    {
        return \strval($this->value());
    }

    abstract public function value();

    public static function validate($value): bool
    {
        if (! \is_string($value)) {
            return false;
        }
        if (! static::multibyte() && \strlen($value) !== \mb_strlen($value)) {
            return false;
        }
        if (static::hasConstant('STRING_REGEXP_PATTERN')) {
            $pattern = static::constant('STRING_REGEXP_PATTERN');
            if (! \preg_match($pattern, $value)) {
                return false;
            }
        }
        if (static::hasConstant('STRING_MINIMUM_LENGTH')) {
            $min = static::constant('STRING_MINIMUM_LENGTH');
            if (! \is_int($min) || $min < 0) {
                throw new LogicException();
            }
            if (static::strlen($value) < $min) {
                return false;
            }
        }
        if (static::hasConstant('STRING_MAXIMUM_LENGTH')) {
            $max = static::constant('STRING_MAXIMUM_LENGTH');
            if (! \is_int($max) || (isset($min) && $max < $min)) {
                throw new LogicException();
            }
            if (static::strlen($value) > $max) {
                return false;
            }
        }
        return true;
    }

    protected static function multibyte(): bool
    {
        if (static::hasConstant('STRING_MULTIBYTE')) {
            $mb = static::constant('STRING_MULTIBYTE');
            if (\is_bool($mb)) {
                return $mb;
            }
            throw new LogicException();
        }
        return true; // default
    }

    protected static function strlen(string $value): int
    {
        return static::multibyte() ? \mb_strlen($value) : \strlen($value);
    }
}
