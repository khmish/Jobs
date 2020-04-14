<?php

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities=[
            'Riyadh',
            'Makkah',
            'Jeddah',
            'Dammam',
            
        ];

        for ($i=0; $i < count($cities); $i++) { 
            
            DB::table('cities')->insert([
                'cityName' => $cities[$i]
            ]);
        }
    }
}
