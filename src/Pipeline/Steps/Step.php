<?php

namespace App\Pipeline\Steps;

use App\Pipeline\Payload;

interface Step {
    public function execute(Payload $payload): Payload;
}
