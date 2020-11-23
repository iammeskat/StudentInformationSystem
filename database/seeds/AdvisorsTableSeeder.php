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
        factory(Advisor::class, 8)->create();
    }
}
