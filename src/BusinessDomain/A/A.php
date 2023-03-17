<?php

namespace App\BusinessDomain\A;

class A {
    public function a() {
        $h = 76 + 82;
        return $h;
    }

    public function add(int $a, int $b): int {
        return $a + $b;
    }
}
