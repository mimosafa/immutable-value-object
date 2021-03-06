<?php declare(strict_types=1);

namespace Ivo\Trait;

use ValueError;

trait ScalarTrait
{
    /**
     * Scalar value
     *
     * @var mixed
     */
    protected $value;

    /**
     * Validate a given value
     *
     * @param mixed $value
     * @return bool
     */
    public static function validate($value): bool
    {
        return \is_scalar($value);
    }

    /**
     * Get instance with raw value
     *
     * @param mixed $value
     * @return static
     */
    public static function instance($value): static
    {
        if ($value instanceof static) {
            return new static($value->value());
        }
        return new static($value);
    }

    /**
     * Constructor
     *
     * @access protected
     *
     * @param mixed $value
     */
    protected function __construct($value)
    {
        if (! static::validate($value)) {
            throw new ValueError();
        }
        $this->value = $value;
    }

    /**
     * Get a scalar value
     *
     * @return mixed
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * Check for equivalence
     *
     * @param mixed $value
     * @return bool
     */
    public function equals($value): bool
    {
        return $value instanceof static
            && $this->value() === $value->value()
            && \get_called_class() === \get_class($value);
    }
}
