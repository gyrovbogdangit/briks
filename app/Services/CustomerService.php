<?php

namespace App\Services;

class CustomerService
{
    public static function addCity($name)
    {
        return session(['city' => $name]);
    }

    public static function getCity()
    {
        return session('city', 'Воронеж');
    }
}
