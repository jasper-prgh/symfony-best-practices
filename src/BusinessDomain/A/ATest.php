<?php

namespace App\BusinessDomain\A;
use PHPUnit\Framework\TestCase;

class ATest extends TestCase {

    public function testA() {
        $a = new A();

        $this->assertSame(82, $a->a());
    }

    public function addNumbersProvider() {
        return [
            [1,2,3],
            [2,4,6],
            [8,4,12],
        ];
    }

    /**
     * @dataProvider addNumbersProvider
     */
    public function testAdd(int $num1, int $b, int $expected) {
        $a = new A();

        $actual = $a->add($num1, $b);

        $this->assertSame($expected, $actual);
    }

}
