<?php

namespace App\Controller;

use App\A\A;
use App\Rule\IsAdultRule;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class LuckyController extends AbstractController
{

    // UNIT TESTING
    private int $age = 13;

    public function __construct(
        private A $a,
        private IsAdultRule $isAdultRule,
    ) {}

    public function number(): Response
    {
        if (!$this->isAdultRule->appliesTo($this->age)) {
            return $this->json([
                'data' => [
                    'error' => 'Too young!',
                ]
            ]);
        }


        return $this->json([
            'data' => [
                'number' => $this->a->a(),
            ]
        ]);
    }
}
