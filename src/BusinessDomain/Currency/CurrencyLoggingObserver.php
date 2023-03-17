<?php

namespace App\BusinessDomain\Currency;

use App\BusinessDomain\Observer\Event;
use App\BusinessDomain\Observer\Observer;

class CurrencyLoggingObserver implements Observer {

    public function update(Event $event) {
        /** @var CurrencyConverter $observable */
        $observable = $event->getObservable();

        $file = fopen('log.log', 'a');
        fwrite($file,  $event->getDate()->format('Y-m-d H:i:s') . ': ' . $observable->getStrategy()::class . "\n");
        fclose($file);
    }

}
