<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
            $table->string('method');
            $table->double('amount');
            $table->string('tx_no');
            $table->string('card_tx_no');
            $table->string('card_no');
            $table->string('card_type');
            $table->string('card_holder_name');
            $table->string('card_month');
            $table->string('card_year');
            $table->string('card_security');
            $table->string('check_no');
            $table->string('bank_account_no');
            $table->string('paid_on');
            $table->string('payment_for');

            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('transaction_payments')->onDelete('cascade');

            $table->text('note');
            $table->string('document');
            $table->string('payment_reference_no');
            $table->string('created_by');
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
        Schema::dropIfExists('transaction_payments');
    }
}
