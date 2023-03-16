<?php

namespace App\Pipeline\Steps;
use App\Pipeline\Payload;

class Step1 implements Step {

    public function execute(Payload $payload): Payload {
        return $payload->increment();
    }

}
