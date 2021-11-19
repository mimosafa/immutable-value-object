<?php declare(strict_types=1);

namespace Ivo\Trait;

use Ivo\Util\HasConstantsTrait;
use LogicException;

trait StringTrait
{
    use ScalarTrait, HasConstantsTrait;

    /**
     * Rules for acceptable string values
     *
     * @var array<string, mixed|null>
     */
    private static $stringValueRules;

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
        if (! isset(self::$stringValueRules)) {
            self::initRules();
        }
        if (! self::$stringValueRules['mb'] && \strlen($value) !== \mb_strlen($value)) {
            return false;
        }
        if (($pattern = self::$stringValueRules['regexp']) && ! \preg_match($pattern, $value)) {
            return false;
        }
        if (isset(self::$stringValueRules['min']) && self::strlen($value) < self::$stringValueRules['min']) {
            return false;
        }
        if (isset(self::$stringValueRules['max']) && self::strlen($value) > self::$stringValueRules['max']) {
            return false;
        }
        return true;
    }

    private static function initRules(): void
    {
        self::$stringValueRules = [
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
            self::$stringValueRules['regexp'] = $pattern;
        }
        if (self::hasConstant('STRING_MINIMUM_LENGTH')) {
            $min = self::constant('STRING_MINIMUM_LENGTH');
            if (! \is_int($min) || $min < 0) {
                throw new LogicException();
            }
            self::$stringValueRules['min'] = $min;
        }
        if (self::hasConstant('STRING_MAXIMUM_LENGTH')) {
            $max = self::constant('STRING_MAXIMUM_LENGTH');
            if (! \is_int($max) || (isset($min) && $max < $min)) {
                throw new LogicException();
            }
            self::$stringValueRules['max'] = $max;
        }
    }

    private static function multibyte(): bool
    {
        if (self::hasConstant('MULTIBYTE_STRING_ACCEPTABLE')) {
            $mb = self::constant('MULTIBYTE_STRING_ACCEPTABLE');
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
