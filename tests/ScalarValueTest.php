<?php declare(strict_types=1);

namespace Ivo\Test;

use Ivo\Mock\MockScalarValue;
use PHPUnit\Framework\TestCase;

final class ScalarValueTest extends TestCase
{
    public function test_instance()
    {
        $scalar = MockScalarValue::instance(1);
        $this->assertEquals(1, $scalar->value);
    }
}
