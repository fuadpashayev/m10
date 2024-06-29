<?php

namespace App\Helpers;

use Exception;
use Propaganistas\LaravelPhone\PhoneNumber;

class Helper
{
    public static function phoneFormatter(?string $phone, string $country = 'AZ'): string
    {
        $phoneNumber = new PhoneNumber($phone, $country);

        try {
            if ($phoneNumber->isOfCountry($country)) {
                return $phoneNumber->formatForMobileDialingInCountry('AZ');
            }

            return $phone;
        } catch (Exception $exception) {
            return $phone;
        }
    }
}
