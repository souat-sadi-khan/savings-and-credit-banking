<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->bigIncrements('id');


            $table->unsignedBigInteger('income_category_id')->nullable();
            $table->foreign('income_category_id')->references('id')->on('income_categories')->onDelete('cascade');
            $table->string('reference_no')->nullable();
            $table->double('income_amt')->nullable();

            $table->double('paid_amt')->nullable();
            $table->double('due_amt')->nullable();

            $table->text('income_note')->nullable();
            $table->string('income_document')->nullable();
            $table->enum('payment_status', ['Paid', 'Due', 'Partial'])->nullable();
            $table->string('created_by')->nullable();
            $table->date('income_date')->nullable();




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
        Schema::dropIfExists('incomes');
    }
}
