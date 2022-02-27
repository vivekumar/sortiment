<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultiPriceQtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multi_price_qties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            //$table->foreign('product_id')->references('id')->on('customize_products')->onDelete('cascade');
            $table->unsignedInteger('qty');
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
        Schema::table('multi_price_qties', function($table) {
            $table->foreign('product_id')->references('id')->on('customize_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('multi_price_qties');
    }
}
