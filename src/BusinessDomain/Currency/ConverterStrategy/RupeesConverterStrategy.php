<?php

namespace App\BusinessDomain\Currency\ConverterStrategy;

class RupeesConverterStrategy implements ConverterStrategy {
    public function convert(float $usd): float {
        return $usd * 341.59;
    }
}
