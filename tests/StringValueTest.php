<?php

namespace Ivo\Test;

use Ivo\Mock\MockStringValue;
use PHPUnit\Framework\TestCase;

class StringValueTest extends TestCase
{
    public function test_string_value()
    {
        $str = MockStringValue::instance('test');
        $this->assertEquals('test', $str->__toString());
    }
}
