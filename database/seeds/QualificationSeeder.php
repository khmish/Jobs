<?php

use Illuminate\Database\Seeder;

class QualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        $qualification=[
            'Diploma',
            'Bachlor',
            'Master',
            
            
        ];

        for ($i=0; $i < count($qualification); $i++) { 
            
            DB::table('qualifications')->insert([
                'qualificationTitle' => $qualification[$i]
            ]);
        }
    }
}
