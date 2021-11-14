<?php declare(strict_types=1);

namespace Ivo\Test;

use Ivo\Mock\MockValue;
use PHPUnit\Framework\TestCase;

final class ValueTest extends TestCase
{
    public function test_construct()
    {
        $scalar = new MockValue('scalar');
        $this->assertEquals('scalar', $scalar->value);

        $null = new MockValue(null);
        $this->assertNull($null->value);

        $array1 = new MockValue(['a', 'b', 'c']);
        $array2 = new MockValue('a', 'b', 'c');
        $this->assertEquals($array1->value, $array2->value);

        $array3 = new MockValue([1]);
        $this->assertEquals([1], $array3->value);

        $notArray1 = new MockValue(...[1]);
        $this->assertEquals(1, $notArray1->value);
    }
}
