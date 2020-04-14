<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
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
            'Development',
            'Marketing',
            'Accounting',
            'IT support',
            
        ];

        for ($i=0; $i < count($department); $i++) { 
            
            DB::table('departments')->insert([
                'departmentName' => $department[$i]
            ]);
        }
    }
}
