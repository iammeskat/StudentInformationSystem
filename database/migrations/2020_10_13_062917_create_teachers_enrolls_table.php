<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersEnrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers_enrolls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('course_id');
            $table->string('session', 32);
            $table->string('semester', 8);
            $table->string('status',16);
            $table->timestamps();
            $table->foreign('teacher_id')
                    ->references('id')->on('teachers')
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
        Schema::dropIfExists('teachers_enrolls');
    }
}
