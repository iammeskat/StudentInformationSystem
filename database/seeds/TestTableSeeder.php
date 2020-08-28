<?php

use Illuminate\Database\Seeder;
use App\Models\Test;

class TestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Test::class, 10)->create();
    }
}
