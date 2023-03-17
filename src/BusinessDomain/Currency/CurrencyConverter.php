<?php

namespace App\BusinessDomain\Currency;
use App\BusinessDomain\Currency\ConverterStrategy\ConverterStrategy;

class CurrencyConverter {

    public function __construct(
        private ConverterStrategy $converterStrategy,
    ) {}

    public function convert(float $usd): float {
        return $this->converterStrategy->convert($usd);
    }   
}
