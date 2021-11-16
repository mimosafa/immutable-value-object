<?php

namespace Ivo\Trait;

use LogicException;

trait StringValueTrait
{
    use ScalarValueTrait, HasConstantsTrait;

    /**
     * Acceptable string value rules
     *
     * @var array<string, mixed|null>
     */
    private static $rules;

    public function __toString(): string
    {
        return $this->value();
    }

    /**
     * Raw string value getter
     *
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    public static function validate($value): bool
    {
        if (! \is_string($value)) {
            return false;
        }
        if (! isset(self::$rules)) {
            self::initRules();
        }
        if (! self::$rules['mb'] && \strlen($value) !== \mb_strlen($value)) {
            return false;
        }
        if (($pattern = self::$rules['regexp']) && ! \preg_match($pattern, $value)) {
            return false;
        }
        if (isset(self::$rules['min']) && self::strlen($value) < self::$rules['min']) {
            return false;
        }
        if (isset(self::$rules['max']) && self::strlen($value) > self::$rules['max']) {
            return false;
        }
        return true;
    }

    private static function initRules(): void
    {
        self::$rules = [
            'mb' => self::multibyte(),
            'regexp' => null,
            'min' => null,
            'max' => null,
        ];
        if (self::hasConstant('STRING_REGEXP_PATTERN')) {
            $pattern = self::constant('STRING_REGEXP_PATTERN');
            if (@\preg_match($pattern, '') === false) {
                throw new LogicException();
            }
            self::$rules['regexp'] = $pattern;
        }
        if (self::hasConstant('STRING_MINIMUM_LENGTH')) {
            $min = self::constant('STRING_MINIMUM_LENGTH');
            if (! \is_int($min) || $min < 0) {
                throw new LogicException();
            }
            self::$rules['min'] = $min;
        }
        if (self::hasConstant('STRING_MAXIMUM_LENGTH')) {
            $max = self::constant('STRING_MAXIMUM_LENGTH');
            if (! \is_int($max) || (isset($min) && $max < $min)) {
                throw new LogicException();
            }
            self::$rules['max'] = $max;
        }
    }

    private static function multibyte(): bool
    {
        if (self::hasConstant('STRING_MULTIBYTE')) {
            $mb = self::constant('STRING_MULTIBYTE');
            if (\is_bool($mb)) {
                return $mb;
            }
            throw new LogicException();
        }
        return true; // default
    }

    private static function strlen(string $value): int
    {
        return self::multibyte() ? \mb_strlen($value) : \strlen($value);
    }
}
