<?php

namespace App\DataDomain\Car;

class Car {
    private $parts = [];

    public function addPart(string $name, $part): self {
        $this->parts[$name] = $part;
        return $this;
    }
}
