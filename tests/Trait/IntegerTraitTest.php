<?php declare(strict_types=1);

namespace Ivo\Test\Trait;

use Ivo\Trait\IntegerTrait;
use PHPUnit\Framework\TestCase;

final class IntegerTraitTest extends TestCase
{
    public function test_validate()
    {
        $maybeOks = [-3, 0, 1, 999999, 0x1A, 0b1101, \PHP_INT_MAX,];
        foreach ($maybeOks as $maybeOk) {
            $this->assertTrue(MockInteger::validate($maybeOk));
        }

        $maybeNgs = ['1', 3.14, true, \M_PI, \INF,];
        foreach ($maybeNgs as $maybeNg) {
            $this->assertFalse(MockInteger::validate($maybeNg));
        }
    }
}

final class MockInteger
{
    use IntegerTrait;
}
