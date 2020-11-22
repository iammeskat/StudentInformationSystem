<?php

use Illuminate\Database\Seeder;
use App\Models\PostFor;

class Post_forTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PostFor::class, 10)->create();
    }
}
