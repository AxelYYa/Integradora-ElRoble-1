<?php

namespace Database\Seeders;

use App\Models\Place;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlacesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $places = [
            [
                'name' => 'Quinta',
                'description' => 'Quinta con alberca.'
            ],
            [
                'name' => 'Salón',
                'description' => 'Salón elegante.'
            ],
            [
                'name' => 'Quinta y Salón',
                'description' => 'Conjunto de Quinta y Salón para fiestas grandes.'
            ],
            ];
        foreach ($places as $place) {
            Place::create([
                'name' => $place['name'],
                'description' => $place['description']
            ]);
        }
    }
}
