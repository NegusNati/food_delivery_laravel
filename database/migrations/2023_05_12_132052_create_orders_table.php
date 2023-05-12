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
            $table->id()->unique();
            $table->integer('user_id');
            $table->integer('order_amount');
            $table->string('payment_status', 191);
            $table->string('payment_method', 191);
            $table->string('transaction_reference', 191);
            $table->string('order_status', 191);
            $table->timestamp('confirmed');
            $table->timestamp('accepted');
            $table->integer('scheduled');
            $table->timestamp('processing');
            $table->timestamp('handover');
            $table->timestamp('faild');
            $table->timestamp('scheduled_at');
            $table->integer('delivery_address_id');
            $table->text('order_note');
            $table->text('delivery_address');
            $table->string('otp');
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
        Schema::dropIfExists('orders');
    }
}
