<?php

namespace App\Utils\Traits;

trait HelperTrait
{
    /**
     * Check string value empty or null check.
     *
     * @param string $value
     * @return boolean
     */
    public function emptyCheck($value)
    {
        if (isset($value) && ($value != null) && ($value != '')) {
            $status = true;
        } else {
            $status = false;
        }
        return $status;
    }
}