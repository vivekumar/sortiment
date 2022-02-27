<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatEmployeeCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_employee_companies', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->integer('employee_id');
            $table->integer('user_id');
            $table->longText('message');
            $table->tinyInteger('attachment');
            $table->enum('sender', ['employee', 'user']);
            $table->timestamp('datetime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_employee_companies');
    }
}
