<?php declare(strict_types=1);

namespace Ivo\Test;

use Ivo\Example\ScalarValue;
use PHPUnit\Framework\TestCase;

final class ScalarTest extends TestCase
{
    public function test_instance()
    {
        $scalar = ScalarValue::instance(1);
        $this->assertEquals(1, $scalar->value());
    }
}
