<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $experience=[
            'Less than 5 years',
            '5 to 10 years',
            'more than 10 years',
            
            
        ];
        //
        $faker = \Faker\Factory::create();
        for ($i=1; $i <= 10; $i++) { 
            
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'password'=>bcrypt('secret'),
                'birth' => $faker->dateTimeBetween($startDate = '-60 years', $endDate = '-20 years', $timezone = null),
                'qualification'=>($i%3)+1,
                'department'=>($i%4)+1,
                'city'=>($i%4)+1,
                'experienceYears'=>$experience[$i%3]
            ]);
        }
    }
}
