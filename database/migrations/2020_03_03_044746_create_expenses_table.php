<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('expense_category_id')->nullable();
            $table->foreign('expense_category_id')->references('id')->on('expense_categories')->onDelete('cascade');
            $table->string('reference_no')->nullable();
            $table->double('expense_amt')->nullable();
            $table->double('paid_amt')->nullable();
            $table->double('due_amt')->nullable();
            $table->unsignedBigInteger('expense_for')->nullable();
            $table->foreign('expense_for')->references('id')->on('employees')->onDelete('set null');
            $table->text('expense_note')->nullable();
            $table->string('expense_document')->nullable();
            $table->enum('payment_status', ['Paid', 'Due', 'Partial'])->nullable();
            $table->string('created_by')->nullable();
            $table->date('expense_date')->nullable();
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
        Schema::dropIfExists('expenses');
    }
}
