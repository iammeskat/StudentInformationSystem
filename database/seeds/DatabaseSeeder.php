<?php

use Illuminate\Database\Seeder;
use App\Teacher;
use App\Advisor;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TeachersTableSeeder::class);
        $this->call(AdvisorsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
