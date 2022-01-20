<?php declare(strict_types=1);

namespace Ivo\Trait;

use Ivo\Util\HasConstantsTrait;
use LogicException;

trait IntegerTrait
{
    use ScalarTrait, HasConstantsTrait;

    /**
     * Rules for acceptable integer values
     *
     * @var array<string, array>
     */
    protected static $rulesForInteger;

    /**
     * Raw integer value getter
     *
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }

    public static function validate($value): bool
    {
        if (! \is_int($value)) {
            return false;
        }
        $rules = static::integerRules();
        if (isset($rules['min']) && $value < $rules['min']) {
            return false;
        }
        if (isset($rules['max']) && $value > $rules['max']) {
            return false;
        }
        return true;
    }

    protected static function integerRules(): array
    {
        $class = \get_called_class();
        return self::$rulesForInteger[$class] ?? self::$rulesForInteger[$class] = static::initIntegerRules();
    }

    protected static function initIntegerRules(): array
    {
        $rules = [
            'min' => null,
            'max' => null,
        ];
        if (static::hasConstant('MINIMUM')) {
            $min = static::constant('MINIMUM');
            if (! \is_int($min)) {
                throw new LogicException();
            }
            $rules['min'] = $min;
        }
        if (static::hasConstant('MAXIMUM')) {
            $max = static::constant('MAXIMUM');
            if (! \is_int($max) || (isset($min) && $max < $min)) {
                throw new LogicException();
            }
            $rules['max'] = $max;
        }
        return $rules;
    }
}
