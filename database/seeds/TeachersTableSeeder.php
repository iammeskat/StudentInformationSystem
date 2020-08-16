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
        factory(Teacher::class, 10)->create();
    }
}
