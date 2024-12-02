<?php

namespace Database\Seeders;

use App\Models\Quote;
use DateTime;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class QuoteSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('es_MX');

        $eventTypes = [
            'Boda', 'XV años', 'Cumpleaños', 'Bautizo',
            'Primera Comunión', 'Graduación', 'Reunión Empresarial',
            'Baby Shower', 'Despedida de Soltero/a', 'Aniversario'
        ];

        // Helper function para generar horarios coherentes
        $getEventTimes = function() use ($faker) {
            $startHour = $faker->numberBetween(13, 19);
            $duration = $faker->numberBetween(5, 8);
        
            $start = new DateTime($startHour . ':00');
            $end = clone $start;
            $end->modify("+{$duration} hours");
        
            // Si la hora final pasa de medianoche, ajustar a 23:59
            if ($end->format('H') > 23) {
                $end->setTime(23, 59);
            }
        
            return [
                'start' => $start->format('H:i:s'),
                'end' => $end->format('H:i:s')
            ];
        };

        Quote::create([
            'user_id' => 1,
            'package_id' => 1,
            'place_id' => null,
            'date' => $faker->dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d'),
            'status' => 'pagada',
            'estimated_price' => 50000,
            'espected_advance' => 500,
            'start_time' => '14:00:00',
            'end_time' => '20:00:00',
            'type_event' => 'Boda',
            'guest_count' => 60,
            'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
            'updated_at' => $faker->dateTimeBetween('-6 months', 'now')
        ]);

        // Quotes with packages
        for ($i = 1; $i <= 30; $i++) {
            $times = $getEventTimes();
            Quote::create([
                'user_id' => rand(1, 10),
                'package_id' => rand(1, 6),
                'place_id' => null,
                'date' => $faker->dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d'),
                'status' => 'pendiente cotizacion',
                'estimated_price' => 0,
                'espected_advance' => 0,
                'start_time' => $times['start'],
                'end_time' => $times['end'],
                'type_event' => $faker->randomElement($eventTypes),
                'guest_count' => $faker->numberBetween(50, 70),
                'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                'updated_at' => $faker->dateTimeBetween('-6 months', 'now')
            ]);
        }

        // Quotes without packages
        for ($i = 1; $i <= 20; $i++) {
            $times = $getEventTimes();
            $estimated_price = $faker->numberBetween(10000, 40000);
            Quote::create([
                'user_id' => rand(1, 10),
                'package_id' => null,
                'place_id' => rand(1, 3),
                'date' => $faker->dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d'),
                'status' => 'pendiente',
                'estimated_price' => $estimated_price,
                'espected_advance' => $estimated_price * 0.30,
                'start_time' => $times['start'],
                'end_time' => $times['end'],
                'type_event' => $faker->randomElement($eventTypes),
                'guest_count' => $faker->numberBetween(50, 80),
                'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                'updated_at' => $faker->dateTimeBetween('-6 months', 'now')
            ]);
        }

        // Special events
        for ($i = 1; $i <= 100; $i++) {
            $times = $getEventTimes();
            $estimated_price = $faker->numberBetween(45000, 70000);
            Quote::create([
                'user_id' => rand(1, 10),
                'package_id' => rand(1, 6),
                'place_id' => null,
                'date' => $faker->dateTimeBetween('2024-06-01', '2024-12-31')->format('Y-m-d'),
                'status' => $faker->randomElement(['pagada', 'cancelada']),
                'estimated_price' => $estimated_price,
                'espected_advance' => $estimated_price * 0.30,
                'start_time' => $times['start'],
                'end_time' => $times['end'],
                'type_event' => $faker->randomElement(['Boda', 'XV años']),
                'guest_count' => $faker->numberBetween(60, 80),
                'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                'updated_at' => $faker->dateTimeBetween('-6 months', 'now')
            ]);
        }
        for ($i = 1; $i <= 40; $i++) {
            $times = $getEventTimes();
            $estimated_price = $faker->numberBetween(10000, 40000);
            Quote::create([
                'user_id' => rand(1, 10),
                'package_id' => null,
                'place_id' => rand(1, 3),
                'date' => $faker->dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d'),
                'status' => 'pendiente',
                'estimated_price' => $estimated_price,
                'espected_advance' => $estimated_price * 0.30,
                'start_time' => $times['start'],
                'end_time' => $times['end'],
                'type_event' => $faker->randomElement($eventTypes),
                'guest_count' => $faker->numberBetween(50, 80),
                'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                'updated_at' => $faker->dateTimeBetween('-6 months', 'now')
            ]);
        }
        $quotes = Quote::all();
        foreach ($quotes as $quote){
            $quote->services()->attach(1);
            $quote->services()->attach(2);
            $quote->services()->attach(3);
        };
    }
}