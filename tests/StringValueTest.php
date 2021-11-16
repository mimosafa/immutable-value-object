<?php

namespace Ivo\Test;

use Ivo\Mock\StringValue;
use PHPUnit\Framework\TestCase;

class StringValueTest extends TestCase
{
    public function test_string_value()
    {
        $str = StringValue::instance('test');
        $this->assertEquals('test', $str->__toString());
    }
}
