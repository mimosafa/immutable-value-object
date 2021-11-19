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
    private $value;

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
        return new self($value);
    }

    /**
     * Constructor
     *
     * @access private
     *
     * @param mixed $value
     */
    private function __construct($value)
    {
        if (! self::validate($value)) {
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
