<?php

namespace App\BusinessDomain\Currency;
use App\BusinessDomain\Currency\ConverterStrategy\ConverterStrategy;
use App\BusinessDomain\Observer\Observable;

class CurrencyConverter extends Observable {

    public function __construct(
        private ConverterStrategy $converterStrategy,
    ) {}

    public function convert(float $usd): float {
        $converted = $this->converterStrategy->convert($usd);
        $this->notify();
        return $converted;
    }

    public function getStrategy(): ConverterStrategy {
        return $this->converterStrategy;
    }
}
