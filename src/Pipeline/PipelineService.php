<?php

namespace App\Pipeline;

use App\Pipeline\Steps\Step;

class PipelineService {

    public function run(array $classNames = [], Payload $payload) {
        foreach ($classNames as $className) {
            /**  @var Step $stepObj */
            $stepObj = new $className;
            $payload = $stepObj->execute($payload);
        }
    }

}
