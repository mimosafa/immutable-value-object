<?php declare(strict_types=1);

namespace Ivo\Trait;

use Ivo\Util\HasConstantsTrait;
use LogicException;

trait StringTrait
{
    use ScalarTrait, HasConstantsTrait;

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
        /**
         * Validation rules
         *
         * @static
         * @var array<string, mixed|null>
         */
        static $rules;

        if (! \is_string($value)) {
            return false;
        }
        if (! isset($rules)) {
            $rules = [
                'mb' => self::multibyte(),
                'regexp' => null,
                'min' => null,
                'max' => null,
            ];
            if (self::hasConstant('REGEXP_PATTERN')) {
                $pattern = self::constant('REGEXP_PATTERN');
                if (@\preg_match($pattern, '') === false) {
                    throw new LogicException();
                }
                $rules['regexp'] = $pattern;
            }
            if (self::hasConstant('MINIMUM_LENGTH')) {
                $min = self::constant('MINIMUM_LENGTH');
                if (! \is_int($min) || $min < 0) {
                    throw new LogicException();
                }
                $rules['min'] = $min;
            }
            if (self::hasConstant('MAXIMUM_LENGTH')) {
                $max = self::constant('MAXIMUM_LENGTH');
                if (! \is_int($max) || (isset($min) && $max < $min)) {
                    throw new LogicException();
                }
                $rules['max'] = $max;
            }
        }
        if (! $rules['mb'] && \strlen($value) !== \mb_strlen($value)) {
            return false;
        }
        if (($pattern = $rules['regexp']) && ! \preg_match($pattern, $value)) {
            return false;
        }
        if (isset($rules['min']) && self::strlen($value) < $rules['min']) {
            return false;
        }
        if (isset($rules['max']) && self::strlen($value) > $rules['max']) {
            return false;
        }
        return true;
    }

    private static function multibyte(): bool
    {
        if (self::hasConstant('MULTIBYTE')) {
            $mb = self::constant('MULTIBYTE');
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
