<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('student_id', 15)->unique();
            $table->string('name', 55);
            $table->string('department', 55);
            $table->string('batch', 4);
            $table->string('semester', 4);
            $table->unsignedBigInteger('advisor_id');
            $table->string('phone_number', 15)->unique();
            $table->string('email', 55)->unique();
            $table->tinyInteger('email_verified')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_verification_token', 128);
            $table->string('password', 128);
            $table->string('picture_path', 55)->nullable();
            $table->string('status', 28);
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('advisor_id')
                    ->references('id')->on('advisors')
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
        Schema::dropIfExists('users');
    }
}
