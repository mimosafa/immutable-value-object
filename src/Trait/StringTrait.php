<?php declare(strict_types=1);

namespace Ivo\Trait;

use Ivo\Util\HasConstantsTrait;
use LogicException;

trait StringTrait
{
    use ScalarTrait, HasConstantsTrait;

    /**
     * Rules for acceptable integer values
     *
     * @var array<string, array>
     */
    protected static $rulesForString = [];

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

        $class = \get_called_class();
        if (! isset(self::$rulesForString[$class])) {
            $rules = [
                'mb' => null,
                'regexp' => null,
                'min' => null,
                'max' => null,
            ];
            if (static::hasConstant('MULTIBYTE')) {
                $mb = static::constant('MULTIBYTE');
                if (! \is_bool($mb)) {
                    throw new LogicException();
                }
                $rules['mb'] = $mb;
            }
            if (static::hasConstant('REGEXP')) {
                $pattern = static::constant('REGEXP');
                if (@\preg_match($pattern, '') === false) {
                    throw new LogicException();
                }
                $rules['regexp'] = $pattern;
            }
            if (static::hasConstant('MINIMUM_LENGTH')) {
                $min = static::constant('MINIMUM_LENGTH');
                if (! \is_int($min) || $min < 0) {
                    throw new LogicException();
                }
                $rules['min'] = $min;
            }
            if (static::hasConstant('MAXIMUM_LENGTH')) {
                $max = static::constant('MAXIMUM_LENGTH');
                if (! \is_int($max) || (isset($min) && $max < $min)) {
                    throw new LogicException();
                }
                $rules['max'] = $max;
            }
            self::$rulesForString[$class] = $rules;
        }
        $rules = self::$rulesForString[$class];

        if ($rules['mb'] === false && \strlen($value) !== \mb_strlen($value)) {
            return false;
        }
        if (($pattern = $rules['regexp']) && ! \preg_match($pattern, $value)) {
            return false;
        }
        if (isset($rules['min']) && static::strlen($value) < $rules['min']) {
            return false;
        }
        if (isset($rules['max']) && static::strlen($value) > $rules['max']) {
            return false;
        }
        return true;
    }

    protected static function strlen(string $value): int
    {
        $class = \get_called_class();
        $mb = self::$rulesForString[$class]['mb'] ?? true;
        return $mb ? \mb_strlen($value) : \strlen($value);
    }
}
