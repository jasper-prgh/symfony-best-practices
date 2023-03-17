<?php

namespace App\BusinessDomain\Currency;

use App\BusinessDomain\Currency\ConverterStrategy\ConverterStrategy;
use App\BusinessDomain\Currency\ConverterStrategy\EuroConverterStrategy;
use App\BusinessDomain\Currency\ConverterStrategy\NamibianDollarsConverterStrategy;
use App\BusinessDomain\Currency\ConverterStrategy\RupeesConverterStrategy;
use Exception;

class CurrencyConverterFactory {

    const STRATEGY_NAME_TO_COUNTRY_MAPPING = [
        EuroConverterStrategy::class => ['de', 'fr', 'es', 'at', 'dk',],
        NamibianDollarsConverterStrategy::class => ['na',],
        RupeesConverterStrategy::class => ['lk',],
    ];

    public function buildByCountryCode(string $countryCode): CurrencyConverter {
        return new CurrencyConverter($this->getStrategyFromMapping($countryCode));
    }

    private function getStrategyFromMapping(string $country): ConverterStrategy {
        foreach (self::STRATEGY_NAME_TO_COUNTRY_MAPPING as $className => $countries) {
            if (!in_array($country, $countries)) {
                continue;
            }

            try {
                $obj = new $className;
                if ($obj instanceof ConverterStrategy) {
                    return $obj;
                }
            } catch (Exception $e) {
                throw new Exception('');
            }
        }
        throw new Exception('');
    }
}
