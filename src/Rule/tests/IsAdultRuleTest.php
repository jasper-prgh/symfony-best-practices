<?php

namespace App\Rule\Test;

use App\Rule\IsAdultRule;
use PHPUnit\Framework\TestCase;

class IsAdultRuleTest extends TestCase {

    public function ageProvider() {
        return [
            '1 year old' => [1, false],
            '18 year old' => [18, true],
            [17, false],
            [-1, false],
            [9999999, true],
            [0, false],
        ];
    }

    /**
     * @dataProvider ageProvider
     */
    public function testAppliesTo(int $age, bool $expected) {
        $rule = new IsAdultRule();

        $this->assertSame($expected, $rule->appliesTo($age));
    }

}
