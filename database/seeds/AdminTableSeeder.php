<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
        	'user_type' => 'admin',
        	'phone_number' => '01811111111',
        	'email' => 'admin@sis.com',
        	'email_verified' => 1,
        	'email_verified_at' => now(),
        	'email_verification_token' => 'n/a',
        	'password' => bcrypt('123456'),
        	'status' => 1,
        ]);

        Admin::create([
        	'user_id' => $user->id,
        	'name' => 'SIS Admin'
        ]);
    }
}
