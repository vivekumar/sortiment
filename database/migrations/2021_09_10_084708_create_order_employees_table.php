<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_item_id');
            $table->foreign('order_item_id')->references('id')->on('order_items')->onDelete('cascade');
            $table->unsignedBigInteger('employee_id');
            $table->string('employee_name')->nullable();
            $table->unsignedBigInteger('order_id');
            $table->string('label')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();

            $table->enum('status', ['pending', 'approved','denied','ordered'])->default('pending');
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
        Schema::dropIfExists('order_employees');
    }
}
