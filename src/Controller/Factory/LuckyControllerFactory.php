<?php

namespace App\Controller\Factory;

use App\A\A;
use App\Controller\LuckyController;

class LuckyControllerFactory {
    public  static function createController() {
        return new LuckyController(new A());
    }
}
