<?php

namespace App\BusinessDomain\Currency;

use App\BusinessDomain\Observer\Event;

class CurrencyLoggingObserver implements \App\BusinessDomain\Observer\Observer {

    public function update(Event $event) {
        /** @var CurrencyConverter $observable */
        $observable = $event->getObservable();

        $file = fopen('log.log', 'a');
        fwrite($file,  $event->getDate()->format('Y-m-d H:i:s') . ': ' . $observable->getStrategy()::class . "\n");
        fclose($file);
    }

}
