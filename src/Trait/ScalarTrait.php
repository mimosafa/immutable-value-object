<?php declare(strict_types=1);

namespace Ivo\Trait;

use ValueError;

trait ScalarTrait
{
    /**
     * Raw value
     *
     * @var mixed
     */
    protected $value;

    /**
     * Raw value validator
     *
     * @abstract
     *
     * @param mixed $value
     * @return bool
     */
    abstract public static function validate($value): bool;

    /**
     * Get instance from raw value
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
     * Raw value getter
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
