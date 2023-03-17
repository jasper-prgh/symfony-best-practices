<?php

namespace App\Infrastructure\Controller;

use App\BusinessDomain\A\A;
use App\BusinessDomain\Pipeline\Payload;
use App\BusinessDomain\Pipeline\PipelineService;
use App\BusinessDomain\Pipeline\Steps\Step1;
use App\BusinessDomain\Rule\IsAdultRule;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class LuckyController extends AbstractController
{
    private int $age = 19;

    public function __construct(
        private A $a,
        private IsAdultRule $isAdultRule,
        private PipelineService $pipelineService,
    ) {}

    public function number(): Response
    {
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
            ]
        ]);
    }
}
