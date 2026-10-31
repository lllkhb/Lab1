<?php

namespace Database\Seeders;

use App\Models\Flight;
use Illuminate\Database\Seeder;

class FlightSeeder extends Seeder
{
    public function run(): void
    {
        $flights = [
            //ID, вильот, прибуття, літак, дата/час вильоту, дата/час прибуття
            ['Бориспіль', 'Шопен', 'Boeing 737-800', '2026-11-01', '08:30', '2026-11-01', '09:50'],
            ['Шопен', 'Бориспіль', 'Boeing 737-800', '2026-11-01', '11:00', '2026-11-01', '12:20'],
            ['Бориспіль', 'Бранденбург', 'Airbus A320', '2026-11-02', '06:15', '2026-11-02', '08:00'],
            ['Львів', 'Шопен', 'Airbus A320', '2026-11-02', '09:00', '2026-11-02', '12:45'],
            ['Бориспіль', 'Гітроу', 'Embraer 190', '2026-11-03', '14:20', '2026-11-03', '15:10'],
        ];

        foreach ($flights as [$from, $to, $plane, $dd, $dt, $ad, $at]) {
            Flight::create([
                'departure_airport' => $from,
                'arrival_airport'   => $to,
                'aircraft_model'    => $plane,
                'departure_date'    => $dd,
                'departure_time'    => $dt,
                'arrival_date'      => $ad,
                'arrival_time'      => $at,
            ]);
        }
    }
}
