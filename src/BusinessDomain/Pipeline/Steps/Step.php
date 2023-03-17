<?php

namespace App\BusinessDomain\Pipeline\Steps;

use App\BusinessDomain\Pipeline\Payload;

interface Step {
    public function execute(Payload $payload): Payload;
}
