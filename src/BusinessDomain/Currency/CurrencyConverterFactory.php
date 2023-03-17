<?php

namespace App\BusinessDomain\Currency;
use App\BusinessDomain\Currency\ConverterStrategy\EuroConverterStrategy;
use App\BusinessDomain\Currency\ConverterStrategy\NamibianDollarsConverterStrategy;
use App\BusinessDomain\Currency\ConverterStrategy\RupeesConverterStrategy;

class CurrencyConverterFactory {
    public function buildByCountryCode(string $countryCode): CurrencyConverter {
        switch ($countryCode) {
            case 'de':
            case 'fr':
            case 'es':
            case 'at':
                return new CurrencyConverter(new EuroConverterStrategy());
            case 'na':
                return new CurrencyConverter(new NamibianDollarsConverterStrategy());
            case 'lk':
                return new CurrencyConverter(new RupeesConverterStrategy());
        }

        throw new \Exception('');
    }
}
