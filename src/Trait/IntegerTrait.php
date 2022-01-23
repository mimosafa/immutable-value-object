<?php declare(strict_types=1);

namespace Ivo\Trait;

trait IntegerTrait
{
    use ComputableTrait;

    /**
     * Get an integer value
     *
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }

    /**
     * Validate a given value type
     *
     * @param mixed $value
     * @return boolean
     */
    public static function validateType($value): bool
    {
        return \is_int($value);
    }
}
