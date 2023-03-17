<?php

namespace App\BusinessDomain\A;

// insures that during the runtime of an app, only 1 obj of a specific type exists.

class Singleton {

    private static ?self $instance = null;

    public int $number = 0;

    private function __construct() {

    }

    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function increment() {
        $this->number++;
    }

}


$a = Singleton::getInstance();

$a->increment();
$a->increment();
$a->increment();

$b = Singleton::getInstance();
$b->increment();
