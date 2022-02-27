<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            //$table->id();
            $table->bigIncrements('id');
            //$table->integer('brand_id');
            $table->unsignedBigInteger('category_id')->nullable();
            //$table->integer('user_id')->unsigned();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->string('product_name');
            $table->string('product_slug');
            $table->string('product_sku')->nullable();
            //$table->unsignedInteger('product_qty');
            //$table->string('product_tags');
            //$table->string('product_size')->nullable();
            //$table->string('product_color');
            $table->decimal('product_price', 8, 2)->nullable();
            //$table->string('discount_price')->nullable();
            $table->string('product_pdf')->nullable();
            $table->longText('description')->nullable();
            $table->string('product_thambnail');
            //$table->integer('hot_deals')->nullable();
            //$table->integer('featured')->nullable();
            //$table->integer('special_offer')->nullable();
            //$table->integer('special_deals')->nullable();

            $table->string('text_on_product')->nullable();
            $table->string('logo_on_product')->nullable();
            $table->text('logo_value')->nullable();
            $table->text('text_value')->nullable();

            $table->string('meta_title')->nullable();
            $table->string('meta_desc')->nullable();
            $table->string('meta_tag')->nullable();

            $table->integer('status')->default(1);
            $table->timestamps();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('SET NULL');
            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
