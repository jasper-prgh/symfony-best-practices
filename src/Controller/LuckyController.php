<?php

namespace App\Controller;

use App\A\A;
use App\Pipeline\Payload;
use App\Pipeline\PipelineService;
use App\Pipeline\Steps\Step1;
use App\Rule\IsAdultRule;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class LuckyController extends AbstractController
{
    private int $age = 13;

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
