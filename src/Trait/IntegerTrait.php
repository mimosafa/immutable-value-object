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
        /**
         * Validation rules
         *
         * @static
         * @var array<string, bool>
         */
        static $rules;

        if (! \is_int($value)) {
            return false;
        }
        if (! isset($rules)) {
            $rules = [
                'min' => null,
                'max' => null,
            ];
            if (self::hasConstant('MINIMUM')) {
                $min = self::constant('MINIMUM');
                if (! \is_int($min)) {
                    throw new LogicException();
                }
                $rules['min'] = $min;
            }
            if (self::hasConstant('MAXIMUM')) {
                $max = self::constant('MAXIMUM');
                if (! \is_int($max) || (isset($min) && $max < $min)) {
                    throw new LogicException();
                }
                $rules['max'] = $max;
            }
        }
        if (isset($rules['min']) && $value < $rules['min']) {
            return false;
        }
        if (isset($rules['max']) && $value > $rules['max']) {
            return false;
        }
        return true;
    }
}
