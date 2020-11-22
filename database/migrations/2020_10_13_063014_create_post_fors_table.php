<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostForsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_fors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->tinyInteger('all')->default(1);
            $table->tinyInteger('student')->default(0);
            $table->string('semester')->default(0);
            $table->tinyInteger('teacher')->default(0);
            $table->tinyInteger('cr')->default(0);
            $table->tinyInteger('batch')->default(0);
            $table->unsignedBigInteger('course_id')->nullable();
            $table->timestamps();
            $table->foreign('post_id')
                    ->references('id')->on('posts')
                    ->onDelete('cascade');
            $table->foreign('course_id')
                    ->references('id')->on('courses')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_fors');
    }
}
