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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('company')->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('crv_number')->nullable();
            $table->string('ean_number')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();
            $table->string('zip')->nullable();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            //$table->enum('status', ['0', '1'])->default(0);
            $table->dateTime('approved_at')->nullable();
            $table->timestamps();
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
