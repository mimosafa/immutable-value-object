<?php declare(strict_types=1);

namespace Ivo\Test;

use Ivo\Trait\PseudoEnumTrait;
use PHPUnit\Framework\TestCase;

final class PseudoEnumTest extends TestCase
{
    public function test_to_array()
    {
        $shikoku = [
            'Tokushima' => '徳島県',
            'Kagawa' => '香川県',
            'Ehime' => '愛媛県',
            'Kochi' => '高知県',
        ];
        $this->assertEquals($shikoku, MockEnumShikoku::toArray());
    }

    public function test_key_and_name_property()
    {
        $kochi = MockEnumShikoku::from('高知県');
        $this->assertEquals('Kochi', $kochi->key());

        $ehime = MockEnumShikoku::from('愛媛県');
        $this->assertEquals('Ehime', $ehime->name);
    }
}

final class MockEnumShikoku
{
    use PseudoEnumTrait;
    private const Tokushima = '徳島県';
    private const Kagawa = '香川県';
    private const Ehime = '愛媛県';
    private const Kochi = '高知県';
}
