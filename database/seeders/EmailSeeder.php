<?php

namespace Database\Seeders;

use App\Models\Email;
use Illuminate\Database\Seeder;

class EmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Email::insert([
            ['email' => 'briks1@briks.ru', 'data' => 'Основной адрес для связи'],
        ]);
    }
}
