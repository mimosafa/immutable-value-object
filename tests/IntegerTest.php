<?php declare(strict_types=1);

namespace Ivo\Test;

use Ivo\Example\IntegerValue;
use Ivo\Example\IntegerValueRangeDefined;
use PHPUnit\Framework\TestCase;

final class IntegerTest extends TestCase
{
    public function test_validate()
    {
        $maybeOks = [-3, 0, 1, 999999, 0x1A, 0b1101, \PHP_INT_MAX,];
        foreach ($maybeOks as $maybeOk) {
            $this->assertTrue(IntegerValue::validate($maybeOk));
        }

        $maybeNgs = ['1', 3.14, true, \M_PI, \INF,];
        foreach ($maybeNgs as $maybeNg) {
            $this->assertFalse(IntegerValue::validate($maybeNg));
        }
    }

    public function test_range_defined()
    {
        $maybeOks = [0, 100, 255, 0b011111111,];
        foreach ($maybeOks as $maybeOk) {
            $this->assertTrue(IntegerValueRangeDefined::validate($maybeOk));
        }

        $maybeNgs = [-1, 256, 0b100000000];
        foreach ($maybeNgs as $maybeNg) {
            $this->assertFalse(IntegerValueRangeDefined::validate($maybeNg));
        }
    }
}
