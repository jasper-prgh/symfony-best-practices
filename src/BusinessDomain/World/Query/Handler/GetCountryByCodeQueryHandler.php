<?php

namespace App\BusinessDomain\World\Query\Handler;

use App\BusinessDomain\World\Query\GetCountryByCodeQuery;
use App\Repository\CountryRepository;

class GetCountryByCodeQueryHandler {

    public function __construct(
        private CountryRepository $countryRepository,
    ) {}

    public function handle(GetCountryByCodeQuery $query) {
        return $this->countryRepository->find($query->getCountryCode());
    }
}
