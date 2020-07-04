<?php

namespace App\Utils\Traits;

trait HelperTrait
{
    /**
     * Check emptiness of given value.
     *
     * @param string $value
     * @return boolean
     *
     * @author "Md. Abdullah-Al- Mamun" <mamuncse824@gmail.com>
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