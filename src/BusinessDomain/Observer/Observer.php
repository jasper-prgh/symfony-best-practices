<?php

namespace App\BusinessDomain\Observer;

interface Observer {
    public function update(Event $event);
}
