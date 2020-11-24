<?php

use Illuminate\Database\Seeder;
use App\Models\Advisor;
class AdvisorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seed = 8;
    	while($seed>0){
    		factory(Advisor::class, 1)->create();
    		$seed--;
    	}
    }
}
