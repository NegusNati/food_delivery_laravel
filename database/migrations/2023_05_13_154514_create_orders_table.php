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
            $table->double('order_amount');
            $table->String('payment_status')->nullable();
            $table->text('order_status')->nullable();
            $table->double('total_tax_amount')->nullable();
            $table->text('order_note')->nullable();
            $table->double('delivery_charge')->nullable();
            $table->String('schedule_at')->nullable();
            $table->String('otp')->nullable();
            $table->String('pending')->nullable();
            $table->String('accepted')->nullable();
            $table->String('confirmed')->nullable();
            $table->String('processing')->nullable();
            $table->String('handover')->nullable();
            $table->String('picked_up')->nullable();
            $table->String('delivered')->nullable();
            $table->String('canceled')->nullable();
            $table->String('refund_requested')->nullable();
            $table->String('refunded')->nullable();
            $table->integer('scheduled')->nullable();
            $table->String('failed')->nullable();
            $table->integer('details_count')->nullable();
            $table->text('delivery_address')->nullable();
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
