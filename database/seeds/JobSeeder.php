<?php

use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $department=[
            
            "IT dev",
            "Marketing",
            "Accounting",
            "support",
            
        ];
        for ($i=1; $i <= 100; $i++) { 
            
            DB::table('jobs')->insert([
                'title' => $department[$i%4],
                'number'=>10,
                'qualification'=>($i%3)+1,
                'department'=>($i%4)+1
            ]);
        }
    }
}
