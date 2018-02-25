<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMpesaStkCallbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpesa_stk_callbacks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('MerchantRequestID');
            $table->string('CheckoutRequestID');
            $table->integer('ResultCode');
            $table->string('ResultDesc');
            $table->double('Amount', 10, 2);
            $table->string('MpesaReceiptNumber');
            $table->string('Balance')->nullable();
            $table->string('TransactionDate');
            $table->string('PhoneNumber');
            $table->timestamps();
        }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mpesa_stk_callbacks');
    }
}
