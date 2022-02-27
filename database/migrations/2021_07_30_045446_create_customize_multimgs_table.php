<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomizeMultimgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customize_multimgs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customize_product_id');
            $table->foreign('customize_product_id')->references('id')->on('customize_products')->onDelete('cascade');
            $table->string('photo_name');
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
        Schema::dropIfExists('customize_multimgs');
    }
}
