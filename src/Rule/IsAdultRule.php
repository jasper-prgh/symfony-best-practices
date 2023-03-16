<?php

namespace App\Rule;

class IsAdultRule {

    public function appliesTo($age): bool {
        return $age >= 18;
    }

}
