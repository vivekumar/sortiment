<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomizeProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customize_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->unsignedBigInteger('request_id')->nullable();
            $table->string('product_name');
            $table->string('product_slug');
            $table->string('product_sku')->nullable();
            $table->decimal('product_price', 8, 2)->nullable();
            $table->string('product_pdf')->nullable();
            $table->longText('description')->nullable();
            $table->string('product_thambnail');
            $table->string('name_on_product')->nullable();
            $table->string('delevery_days')->nullable();
            $table->enum('status', ['pending', 'approved','denied','ordered'])->default('pending');
            $table->integer('express_delivery_days')->nullable();
            $table->enum('express_delivery_status', ['0', '1'])->default('0');
            $table->string('meta_title')->nullable();
            $table->string('meta_desc')->nullable();
            $table->string('meta_tag')->nullable();

            $table->timestamps();
        });
        Schema::table('customize_products', function (Blueprint $table) {
            //$table->foreign('category_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('SET NULL');
            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('SET NULL');
            $table->foreign('request_id')->references('id')->on('price_requests')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customize_products');
    }
}
