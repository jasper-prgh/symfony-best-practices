<?php

namespace App\Infrastructure\Controller;

use App\BusinessDomain\A\A;
use App\BusinessDomain\Pipeline\Payload;
use App\BusinessDomain\Pipeline\PipelineService;
use App\BusinessDomain\Pipeline\Steps\Step1;
use App\BusinessDomain\Rule\IsAdultRule;
use App\BusinessDomain\World\Query\GetCountryByCodeQuery;
use App\BusinessDomain\World\Query\Handler\GetCountryByCodeQueryHandler;
use App\Repository\CityRepository;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class LuckyController extends AbstractController
{
    private int $age = 19;

    public function __construct(
        private A $a,
        private IsAdultRule $isAdultRule,
        private PipelineService $pipelineService,
        private CountryRepository $countryRepository,
        private CityRepository $cityRepository,
        private EntityManagerInterface $entityManager,
        private GetCountryByCodeQueryHandler $getCountryByCodeQueryHandler,
    ) {}

    public function number(): Response
    {
        $country = $this->getCountryByCodeQueryHandler->handle(new GetCountryByCodeQuery('ABW'));

        $payload = new Payload();
        $this->pipelineService->run([
            Step1::class,
            Step1::class,
            Step1::class,
            Step1::class,
            Step1::class,
            Step1::class,
        ], $payload);

        if (!$this->isAdultRule->appliesTo($this->age)) {
            return $this->json([
                'data' => [
                    'error' => 'Too young!',
                ]
            ]);
        }

        return $this->json([
            'data' => [
                'number' => $this->a->a() + $payload->getNumber(),
                'country' => $country->getName(),
            ]
        ]);
    }
}
