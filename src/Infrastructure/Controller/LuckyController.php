<?php

namespace App\Infrastructure\Controller;

use App\BusinessDomain\A\A;
use App\BusinessDomain\Pipeline\Payload;
use App\BusinessDomain\Pipeline\PipelineService;
use App\BusinessDomain\Pipeline\Steps\Step1;
use App\BusinessDomain\Rule\IsAdultRule;
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
    ) {}

    public function number(): Response
    {

        $country = $this->countryRepository->find('ABW');
        $cities = $this->cityRepository->findBy(['countryCode' => 'ABW']);

        $country->setName('AAruba');

        $this->entityManager->persist($country);
        $this->entityManager->flush();

        $cs = [];
        foreach ($cities as $city) {
            $cs[] = $city->getName();
        }

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
                'cities' => $cs,
            ]
        ]);
    }
}
