<?php declare(strict_types=1);

namespace Ivo\Trait;

use Ivo\Util\HasConstantsTrait;
use LogicException;

trait IntegerValueTrait
{
    use ScalarValueTrait, HasConstantsTrait;

    /**
     * Rules for acceptable integer values
     *
     * @var array
     */
    private static $integerValueRules;

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
        if (! isset(self::$integerValueRules)) {
            self::initRules();
        }
        if (isset(self::$integerValueRules['min']) && $value < self::$integerValueRules['min']) {
            return false;
        }
        if (isset(self::$integerValueRules['max']) && $value > self::$integerValueRules['max']) {
            return false;
        }
        return true;
    }

    private static function initRules(): void
    {
        self::$integerValueRules = [
            'min' => null,
            'max' => null,
        ];
        if (self::hasConstant('INTEGER_MINIMUM_RANGE')) {
            $min = self::constant('INTEGER_MINIMUM_RANGE');
            if (! \is_int($min)) {
                throw new LogicException();
            }
            self::$integerValueRules['min'] = $min;
        }
        if (self::hasConstant('INTEGER_MAXIMUM_RANGE')) {
            $max = self::constant('INTEGER_MAXIMUM_RANGE');
            if (! \is_int($max) || (isset($min) && $max < $min)) {
                throw new LogicException();
            }
            self::$integerValueRules['max'] = $max;
        }
    }
}
