<?php

use Illuminate\Database\Seeder;
use App\Models\Teacher;
class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seed = 10;
    	while($seed>0){
    		factory(Teacher::class, 1)->create();
    		$seed--;
    	}
    }
}
