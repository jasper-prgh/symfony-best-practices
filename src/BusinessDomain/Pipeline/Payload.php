<?php

namespace App\BusinessDomain\Pipeline;

class Payload {
    private int $number = 0;

    public function getNumber() {
        return $this->number;
    }

    public function increment(): self {
        $this->number++;
        return $this;
    }
}
