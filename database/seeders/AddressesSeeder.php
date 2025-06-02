<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Address::create([
            'address' => 'ул. 9 Января, 195, Воронеж',
            'url' => 'https://yandex.ru/maps/org/briks/90388818819/gallery/?ll=39.138402%2C51.676745&z=16',
        ]);
    }
}
