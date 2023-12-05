<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIncomeIdToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('income_id')->after('expense_for')->nullable();
            $table->foreign('income_id')->references('id')->on('incomes')->onDelete('cascade');
            $table->unsignedBigInteger('income_category_id')->after('expense_id')->nullable();
            $table->foreign('income_category_id')->references('id')->on('income_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            //
        });
    }
}
