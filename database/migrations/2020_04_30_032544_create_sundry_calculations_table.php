<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSundryCalculationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sundry_calculations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('share_id')->nullable();
            $table->foreign('share_id')->references('id')->on('members')->onDelete('cascade');

            $table->unsignedBigInteger('savings_id')->nullable();
            $table->foreign('savings_id')->references('id')->on('savings_accounts')->onDelete('cascade');

            $table->unsignedBigInteger('dps_id')->nullable();
            $table->foreign('dps_id')->references('id')->on('dps_accounts')->onDelete('cascade');

            $table->unsignedBigInteger('double_benifit_id')->nullable();
            $table->foreign('double_benifit_id')->references('id')->on('double_benifit_accounts')->onDelete('cascade');

            $table->unsignedBigInteger('fdr_id')->nullable();
            $table->foreign('fdr_id')->references('id')->on('fdr_accounts')->onDelete('cascade');

            $table->unsignedBigInteger('member_id')->nullable();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');

            $table->enum('tx_type', ['deposit', 'withdraw'])->nullable();
            $table->string('month')->nullable();
            $table->double('calculated_amt')->nullable();
            $table->double('submitted_amt')->nullable();
            $table->date('deposit_date')->nullable();
            $table->date('withdraw_date')->nullable();

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
        Schema::dropIfExists('sundry_calculations');
    }
}
