<?php

use App\Models\Advisor;
use Illuminate\Database\Seeder;

class AdvisorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Advisor::class, 10)->create();
    }
}
