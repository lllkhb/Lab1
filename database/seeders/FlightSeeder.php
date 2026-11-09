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
            ['Бориспіль', 'Шопен', 'Boryspil', 'Chopin', 'Боїнг 737-800', 'Boeing 737-800', '2026-11-01', '08:30', '2026-11-01', '09:50'],
            ['Шопен', 'Бориспіль', 'Chopin', 'Boryspil', 'Боїнг 737-800', 'Boeing 737-800', '2026-11-01', '11:00', '2026-11-01', '12:20'],
            ['Бориспіль', 'Бранденбург', 'Boryspil', 'Brandenburg', 'Ейрбас A320', 'Airbus A320', '2026-11-02', '06:15', '2026-11-02', '08:00'],
            ['Львів', 'Шопен', 'Lviv', 'Chopin', 'Ейрбас A320', 'Airbus A320', '2026-11-02', '09:00', '2026-11-02', '12:45'],
            ['Бориспіль', 'Гітроу', 'Boryspil', 'Heathrow', 'Ембраєр 190', 'Embraer 190', '2026-11-03', '14:20', '2026-11-03', '15:10'],
            ['Львів', 'Фьюмічіно', 'Lviv', 'Fiumicino', 'Боїнг 737-800', 'Boeing 737-800', '2026-11-04', '10:15', '2026-11-04', '12:30'],
            ['Одеса', 'Стамбул', 'Odesa', 'Istanbul', 'Ейрбас A321', 'Airbus A321', '2026-11-05', '16:00', '2026-11-05', '17:35'],
        ];

        foreach ($flights as [$fromUk, $toUk, $fromEn, $toEn, $planeUk, $planeEn, $dd, $dt, $ad, $at]) {

            $flight = Flight::updateOrCreate(
                [
                    'departure_airport' => $fromUk,
                    'arrival_airport'   => $toUk,
                    'departure_date'    => $dd,
                    'departure_time'    => $dt,
                ],
                [
                    'aircraft_model' => $planeUk,
                    'arrival_date'   => $ad,
                    'arrival_time'   => $at,
                ]
            );

            $flight->translations()->updateOrCreate(
                ['locale' => 'uk'],
                [
                    'departure_airport' => $fromUk,
                    'arrival_airport'   => $toUk,
                    'aircraft_model'    => $planeUk,
                ]
            );

            $flight->translations()->updateOrCreate(
                ['locale' => 'en'],
                [
                    'departure_airport' => $fromEn,
                    'arrival_airport'   => $toEn,
                    'aircraft_model'    => $planeEn,
                ]
            );
        }
    }
}
