<?php

namespace App\BusinessDomain\Observer;

use DateTime;

class Event {
    public function __construct(
        private DateTime $date,
        private Observable $observable,
    ) {}

    public function getObservable(): Observable {
        return $this->observable;
    }

    public function getDate(): DateTime {
        return $this->date;
    }
}
