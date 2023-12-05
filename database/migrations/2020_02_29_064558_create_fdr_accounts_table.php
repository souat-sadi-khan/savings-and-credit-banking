<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFdrAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fdr_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid')->nullable();
            $table->string('prefix')->nullable();
            $table->integer('code')->nullable();

            $table->integer('round')->nullable();
            $table->double('loan_amt')->nullable();
            $table->string('loan_type')->nullable();
            $table->double('interest_rate')->nullable();
            $table->double('loan_duration')->nullable();
            $table->string('loan_duration_type')->nullable();
            $table->double('total_interest_amt')->nullable();
            $table->double('grand_total_amt')->nullable();
            $table->string('loan_reason')->nullable();

            $table->string('nomenee_name1')->nullable();
            $table->string('nomenee_fathers_name1')->nullable();
            $table->string('nomenee_husbands_name1')->nullable();
            $table->string('nomenee_relation_with_member1')->nullable();
            $table->string('nomenee_age1')->nullable();
            $table->string('nomenee_part_asset1')->nullable();
            $table->string('nomenee_permanent_address1')->nullable();

            $table->string('receipt_no')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('completion_date')->nullable();

            $table->string('created_by')->nullable();
            $table->string('approved_by')->nullable();
            $table->string('status')->nullable();
            $table->string('approval')->default('Not Approved');
            $table->text('approval_comment')->nullable();
            $table->date('approval_date')->nullable();
            $table->date('start_date')->nullable();
            $table->string('transaction_id')->nullable();
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
        Schema::dropIfExists('fdr_accounts');
    }
}
