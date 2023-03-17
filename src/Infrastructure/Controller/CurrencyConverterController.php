<?php

namespace App\Infrastructure\Controller;

use App\BusinessDomain\Currency\CurrencyConverterFactory;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CurrencyConverterController extends AbstractController {

    public function __construct(
        private CurrencyConverterFactory $currencyConverterFactory,
    ) {}

    public function convert(string $countryCode) {
        $req = Request::createFromGlobals();
        $usd = $req->query->get('usd', 0);

        try {
            $converter = $this->currencyConverterFactory->buildByCountryCode($countryCode);
        } catch (Exception $e) {
            return $this->json(['error' => 'Converting failed']);
        }

        return $this->json([
            'usd' => $usd,
            'converted' => $converter->convert((float)$usd),
            'country' => $countryCode,
        ]);
    }

}
