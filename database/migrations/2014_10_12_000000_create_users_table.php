<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->longText('photo')->nullable();
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('gender')->nullable();
            $table->string('username', 50)->unique();
            $table->string('email',70)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone', 20)->unique()->nullable();
            $table->string('password');
            $table->string('location')->nullable();
            $table->bigInteger('institute_id')->nullable();
            //if user is inactive it will be 1
            $table->boolean('is_locked')->default(false);
            // if user is logged in it will be 1
            $table->boolean('is_login')->default(false);
            $table->string('user_ip')->nullable();
            //who created the user
            $table->string('created_by')->nullable();
            $table->unsignedInteger('password_attempt_count')->nullable();
            $table->dateTime('password_attempt_date')->nullable();
            $table->dateTime('last_login_date')->nullable();
            $table->boolean('must_change_password')->default(false);
            $table->string('token')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
