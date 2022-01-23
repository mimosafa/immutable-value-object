<?php declare(strict_types=1);

namespace Ivo\Trait;

use Ivo\Util\HasConstantsTrait;
use LogicException;

trait ComputableTrait
{
    use ScalarTrait, HasConstantsTrait;

    /**
     * Rules cache for computable value
     *
     * @var array<string, array<string, mixed>>
     */
    protected static $rulesForComputable = [];

    /**
     * Get a scalar value
     *
     * @return integer|float
     */
    public function value(): int|float
    {
        return $this->value;
    }

    /**
     * Validate a given value
     *
     * @param mixed $value
     * @return boolean
     */
    public static function validate($value): bool
    {
        if (! static::validateType($value)) {
            return false;
        }
        $rules = static::computableRules();

        if (isset($rules['gte']) && $value < $rules['gte']) {
            return false;
        }
        else if (isset($rules['gt']) && $value <= $rules['gt']) {
            return false;
        }

        if (isset($rules['lt']) && $value >= $rules['lt']) {
            return false;
        }
        else if (isset($rules['lte']) && $value > $rules['lte']) {
            return false;
        }

        return true;
    }

    /**
     * Validate a given value type
     *
     * @param mixed $value
     * @return boolean
     */
    protected static function validateType($value): bool
    {
        return \is_int($value) || (\is_float($value) && ! \is_nan($value) && ! \is_infinite($value));
    }

    /**
     * Get validation rule
     *
     * @return array<string, mixed>
     */
    protected static function computableRules(): array
    {
        $class = \get_called_class();
        return self::$rulesForComputable[$class] ?? self::$rulesForComputable[$class] = static::initComputableRules();
    }

    /**
     * Initialize validation rule
     *
     * @return array<string, mixed>
     */
    protected static function initComputableRules(): array
    {
        $rules = [
            'gte' => null,
            'gt' => null,
            'lt' => null,
            'lte' => null,
        ];

        if (static::hasConstant('GREATER_THAN_OR_EQUAL_TO')) {
            $gte = static::constant('GREATER_THAN_OR_EQUAL_TO');
            if (! self::validateType($gte)) {
                throw new LogicException();
            }
            $rules['gte'] = $gte;
        }
        if (static::hasConstant('GREATER_THAN')) {
            if (isset($rules['gte'])) {
                throw new LogicException();
            }
            $gt = static::constant('GREATER_THAN');
            if (! self::validateType($gt)) {
                throw new LogicException();
            }
            $rules['gt'] = $gt;
        }

        if (static::hasConstant('LESS_THAN')) {
            $lt = static::constant('LESS_THAN');
            if (! self::validateType($lt)) {
                throw new LogicException();
            }
            if (isset($rules['gte']) && $lt <= $rules['gte']) {
                throw new LogicException();
            }
            else if (isset($rules['gt']) && $lt <= $rules['gt']) {
                throw new LogicException();
            }
            $rules['lt'] = $lt;
        }
        if (static::hasConstant('LESS_THAN_OR_EQUAL_TO')) {
            if (isset($rules['lt'])) {
                throw new LogicException();
            }
            $lte = static::constant('LESS_THAN_OR_EQUAL_TO');
            if (! self::validateType($lte)) {
                throw new LogicException();
            }
            if (isset($rules['gte']) && $lte < $rules['gte']) {
                throw new LogicException();
            }
            else if (isset($rules['gt']) && $lte <= $rules['gt']) {
                throw new LogicException();
            }
            $rules['lte'] = $lte;
        }

        return $rules;
    }
}
