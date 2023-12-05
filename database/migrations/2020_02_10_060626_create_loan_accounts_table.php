<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid')->nullable();
            $table->string('prefix')->nullable();
            $table->integer('code')->nullable();
            $table->unsignedBigInteger('member_id')->nullable();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');

            $table->string('zone_id')->nullable();
            // $table->foreign('zone_id')->references('id')->on('zones')->onDelete('null');
            $table->string('area_id')->nullable();
            // $table->foreign('area_id')->references('id')->on('areas')->onDelete('null');
            $table->string('business_name')->nullable();
            $table->string('business_duration')->nullable();
            $table->string('duration_indication')->nullable();
            $table->string('business_address')->nullable();
            $table->string('business_investment')->nullable();
            $table->string('business_stock')->nullable();
            $table->string('business_average_sell')->nullable();
            $table->string('business_average_income')->nullable();
            $table->string('business_shop_owner')->nullable();

            $table->integer('round')->nullable();
            $table->double('loan_amount')->nullable();
            $table->string('loan_type')->nullable();
            $table->double('interest_rate')->nullable();
            $table->double('installment_no')->nullable();
            $table->double('installment_amount')->nullable();
            $table->double('installment_interest')->nullable();
            $table->double('installment_total')->nullable();
            $table->double('loan_duration')->nullable();
            $table->string('loan_duration_type')->nullable();
            $table->double('installment_duration')->nullable();
            $table->string('installment_duration_type')->nullable();
            $table->text('loan_reason')->nullable();

            $table->string('sponsonr_name1')->nullable();
            $table->string('sponsor_fathers_name1')->nullable();
            $table->string('sponsor_husbands_name1')->nullable();
            $table->string('sponsor_relation_with_member1')->nullable();
            $table->string('sponsor_account_no1')->nullable();
            $table->string('sponsor_permanent_address1')->nullable();

            $table->string('sponsonr_name2')->nullable();
            $table->string('sponsor_fathers_name2')->nullable();
            $table->string('sponsor_husbands_name2')->nullable();
            $table->string('sponsor_relation_with_member2')->nullable();
            $table->string('sponsor_account_no2')->nullable();
            $table->string('sponsor_permanent_address2')->nullable();

            $table->string('created_by')->nullable();
            $table->string('verified_by')->nullable();
            $table->string('approved_by')->nullable();
            $table->string('status')->nullable();
            $table->string('confirmation')->nullable();
            $table->string('approval')->default('Not Approved');
            $table->text('approval_comment')->nullable();
            $table->date('approval_date')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('completion_date')->nullable();
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
        Schema::dropIfExists('loan_accounts');
    }
}
