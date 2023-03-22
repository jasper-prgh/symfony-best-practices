<?php

namespace App\Infrastructure\Controller;

use App\BusinessDomain\Currency\CurrencyConverterFactory;
use App\BusinessDomain\Currency\CurrencyLoggingObserver;
use App\Entity\Country;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CurrencyConverterController extends AbstractController {

    public function __construct(
        private CurrencyConverterFactory $currencyConverterFactory,
        private CountryRepository $countryRepository,
        private EntityManagerInterface $entityManager,
    ) {}

    public function convert(string $countryCode) {

        $country = $this->countryRepository->find('AFG');

        // $country->setName($country->getName() . '1');
        // $this->entityManager->persist($country);
        // $this->entityManager->flush();

        // $this->entityManager->remove($country);
        // $this->entityManager->flush();

        // $afg = new Country();
        // $afg->setCode('AFG')->setName('Afghanistan');
        // $this->entityManager->persist($afg);
        // $this->entityManager->flush();

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
            'fromDB' => $country->getName(),
        ]);
    }

}
