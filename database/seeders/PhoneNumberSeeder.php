<?php

namespace Database\Seeders;

use App\Models\PhoneNumber;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhoneNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PhoneNumber::insert(
            [
                [
                    'number' => '+7 (473) 288-88-82',
                    'data' => 'с 09:00 до 18:00'
                ],
            ]
        );
    }
}
