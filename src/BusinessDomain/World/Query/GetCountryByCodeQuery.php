<?php

namespace App\BusinessDomain\World\Query;

class GetCountryByCodeQuery {
    public function __construct(
        private string $countryCode
    ) {}

    public function getCountryCode(): string {
        return $this->countryCode;
    }
}
