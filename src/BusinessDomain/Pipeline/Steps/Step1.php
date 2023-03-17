<?php

namespace App\BusinessDomain\Pipeline\Steps;
use App\BusinessDomain\Pipeline\Payload;

class Step1 implements Step {

    public function execute(Payload $payload): Payload {
        return $payload->increment();
    }

}
