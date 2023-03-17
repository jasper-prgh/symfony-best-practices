<?php

namespace App\BusinessDomain\Currency\ConverterStrategy;

interface ConverterStrategy {
    public function convert(float $usd): float;
}
