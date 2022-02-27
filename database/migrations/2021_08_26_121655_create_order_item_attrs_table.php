<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemAttrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item_attrs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_item_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedInteger('attribute_id')->nullable();
            $table->string('attribute_name')->nullable();
            $table->string('attribute_value')->nullable();
            //$table->string('attribute_value_name')->nullable();
            $table->timestamps();
        });
        Schema::table('order_item_attrs', function($table) {
            $table->foreign('order_item_id')->references('id')->on('order_items')->onDelete('cascade');
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('SET NULL');
            //$table->foreign('attribute_value')->references('id')->on('attribute_values')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_item_attrs');
    }
}
