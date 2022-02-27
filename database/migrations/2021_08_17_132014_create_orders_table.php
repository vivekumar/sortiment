<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('company')->nullable();
            $table->string('post_code')->nullable();


            $table->string('payment_method')->nullable();
            $table->string('cvr_no')->nullable();
            $table->string('ean_no')->nullable();
            //$table->string('bank_account_no')->nullable();
            $table->string('ref_no')->nullable();

            $table->string('currency');
            $table->float('amount',8,2);
            $table->float('delivery_costs',8,2);

            $table->string('order_number');
            $table->string('invoice_no')->nullable();
            $table->string('order_date');
            $table->string('order_month');
            $table->string('order_year');
            $table->timestamp('order_recieved_date')->nullable();
            $table->timestamp('payment_confirmed_date')->nullable();
            $table->timestamp('order_being_processed_date')->nullable();
            $table->timestamp('shipping_order_date')->nullable();
            $table->timestamp('order_delivered_date')->nullable();
            //$table->string('cancel_date')->nullable();
            //$table->string('return_date')->nullable();
            //$table->string('return_reason')->nullable();
            //$table->string('estimated_delivery_date')->nullable();
            $table->enum('status', ['Order recieved','Payment confirmed','Order being processed','Shipping order','Order delivered'])->default('Order recieved');
            $table->string('tracking_url')->nullable();
            $table->string('pdf')->nullable();

            $table->timestamp('updated_at')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
