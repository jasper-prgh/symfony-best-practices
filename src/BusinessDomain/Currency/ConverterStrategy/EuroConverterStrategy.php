<?php

namespace App\BusinessDomain\Currency\ConverterStrategy;

class EuroConverterStrategy implements ConverterStrategy {
    public function convert(float $usd): float {
        return $usd * 0.94;
    }
}
