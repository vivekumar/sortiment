<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('text_on_product')->nullable();
            $table->string('logo_on_product')->nullable();
            $table->text('logo_value')->nullable();
            $table->text('text_value')->nullable();
            $table->string('logo')->nullable();
            $table->string('profile_logo')->nullable();
            $table->text('message');
            $table->enum('status', ['Pending', 'Approved','Denied','Ordered']);
            $table->timestamps();

        });
        Schema::table('price_requests', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_requests');
    }
}
