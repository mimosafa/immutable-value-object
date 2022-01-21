<?php declare(strict_types=1);

namespace Ivo\Trait;

trait IntegerTrait
{
    use ComputableTrait;

    /**
     * Raw integer value getter
     *
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }

    public static function validateType($value): bool
    {
        return \is_int($value);
    }
}
