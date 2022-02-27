<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomizeProductAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customize_product_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('product_id');
            //$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedInteger('attribute_id');
            $table->unsignedInteger('attrvalue_id');
            $table->timestamps();
        });
        Schema::table('customize_product_attributes', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('customize_products')->onDelete('cascade');
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
            //$table->foreign('attrvalue_id')->references('id')->on('attribute_values')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customize_product_attributes');
    }
}
