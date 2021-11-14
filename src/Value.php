<?php declare(strict_types=1);

namespace Ivo;

use BadMethodCallException;

abstract class Value
{
    /**
     * @var mixed[]
     */
    protected $value;

    /**
     * Constructor
     *
     * @param mixed $value
     */
    public function __construct(...$value)
    {
        if (\count($value) === 1) {
            $this->value = $value[0];
        } else {
            $this->value = $value;
        }
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

    public function __get($name)
    {
        if ($name === 'value') {
            return $this->value;
        }
        throw new BadMethodCallException();
    }
}
