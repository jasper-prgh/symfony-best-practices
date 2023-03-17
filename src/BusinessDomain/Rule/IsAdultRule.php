<?php

namespace App\BusinessDomain\Rule;

class IsAdultRule {

    public function appliesTo($age): bool {
        return $age >= 18;
    }

}
