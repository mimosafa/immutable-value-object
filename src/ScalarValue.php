<?php

namespace Ivo;

use ValueError;

abstract class ScalarValue extends Value
{
    /**
     * Constructor
     *
     * @access protected
     * @param mixed $value
     */
    protected function __construct($value)
    {
        if (! static::validate($value)) {
            throw new ValueError();
        }
        $this->value = $value;
    }

    public function equals($value): bool
    {
        return $value instanceof static
            && $this->value() === $value->value()
            && \get_called_class() === \get_class($value);
    }

    public static function validate($value): bool
    {
        return \is_scalar($value);
    }

    public static function instance($value): static
    {
        return new static($value);
    }
}
