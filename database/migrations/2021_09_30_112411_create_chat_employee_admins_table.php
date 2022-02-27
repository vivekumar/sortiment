<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatEmployeeAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_employee_admins', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->integer('admin_id');
            $table->integer('employee_id');
            $table->longText('message');
            $table->tinyInteger('attachment');
            $table->enum('sender', ['admin', 'employee']);
            $table->timestamp('datetime');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_employee_admins');
    }
}
