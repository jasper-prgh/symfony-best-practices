<?php

namespace App\BusinessDomain\Observer;

class Observable {


    /** @var Observer[] $observers */
    private array $observers = [];

    public function attachObserver(Observer $observer) {
        $this->observers[] = $observer;
    }

    public function detachObserver(Observer $observer) {
        $key = array_search($observer, $this->observers);

        if ($key) {
            unset($this->observers[$key]);
        }
    }

    public function notify() {
        $event = new Event(new \DateTime, $this);
        foreach ($this->observers as $observer) {
            $observer->update($event);
        }
    }

}
