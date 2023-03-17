<?php

namespace App\Infrastructure\Controller;

use App\BusinessDomain\Currency\CurrencyConverterFactory;
use App\BusinessDomain\Currency\CurrencyLoggingObserver;
use App\BusinessDomain\Currency\Observer;
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
            $converter->attachObserver(new CurrencyLoggingObserver());
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
