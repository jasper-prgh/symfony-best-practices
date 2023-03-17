<?php

namespace App\BusinessDomain\Currency\ConverterStrategy;

class NamibianDollarsConverterStrategy implements ConverterStrategy {
    public function convert(float $usd): float {
        return $usd * 18.4;
    }
}
