<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TariffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tariffs = [
            ['name' => 'Економ Базовий',  'class_name' => 'Економ', 'baggage' => 'Ручна поклажа 8 кг'],
            ['name' => 'Економ Стандарт', 'class_name' => 'Економ', 'baggage' => '1 місце до 23 кг'],
            ['name' => 'Бізнес',          'class_name' => 'Бізнес', 'baggage' => '2 місця до 32 кг'],
        ];

        foreach ($tariffs as $t) {
            \App\Models\Tariff::firstOrCreate(['name' => $t['name']], $t);
        }
    }
}
