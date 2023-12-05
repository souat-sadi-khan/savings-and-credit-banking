<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('zone_id')->nullable();
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('set null');

            $table->unsignedBigInteger('area_id')->nullable();
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('set null');

            $table->unsignedBigInteger('savings_account_id')->nullable();
            $table->foreign('savings_account_id')->references('id')->on('savings_accounts')->onDelete('cascade');

            $table->unsignedBigInteger('loan_account_id')->nullable();
            $table->foreign('loan_account_id')->references('id')->on('loan_accounts')->onDelete('cascade');

            $table->unsignedBigInteger('dps_account_id')->nullable();
            $table->foreign('dps_account_id')->references('id')->on('dps_accounts')->onDelete('cascade');

            $table->unsignedBigInteger('double_benifit_account_id')->nullable();
            $table->foreign('double_benifit_account_id')->references('id')->on('double_benifit_accounts')->onDelete('cascade');

            $table->unsignedBigInteger('fdr_account_id')->nullable();
            $table->foreign('fdr_account_id')->references('id')->on('fdr_accounts')->onDelete('cascade');

            $table->unsignedBigInteger('salary_payment_id')->nullable();

            $table->unsignedBigInteger('share_id')->nullable();
            $table->foreign('share_id')->references('id')->on('members')->onDelete('cascade');

            $table->enum('tx_type', ['savings payment', 'savings repay', 'loan payment', 'loan repay', 'dps payment', 'dps repay', 'double benifit payment', 'double benifit repay', 'fdr payment', 'fdr repay', 'share payment', 'share repay', 'expense', 'income', 'sundry', 'slary payment', 'bank payment', 'bank repay', 'sundry payment', 'sundry repay'])->nullable();

            $table->enum('type', ['debit', 'credit'])->nullable();
            $table->enum('payment_status', ['due', 'paid', 'partial'])->nullable();

            $table->unsignedBigInteger('member_id')->nullable();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');

            $table->string('invoice_no')->nullable();
            $table->string('reference_no')->nullable();
            $table->date('tx_date')->nullable();
            $table->double('per_month_dps_amt')->nullable();
            $table->double('total_amt')->nullable();
            $table->double('interest_rate')->nullable();
            $table->double('total_interest_amt')->nullable();
            $table->double('installment_no')->nullable();
            $table->double('per_installment_amt')->nullable();
            $table->double('grand_total_amt')->nullable();
            $table->integer('no_of_paying_installment')->nullable();
            $table->integer('duration')->nullable();
            $table->string('duration_type')->nullable();
            $table->double('installment_duration')->nullable();
            $table->string('installment_duration_type')->nullable();

            $table->string('payment_method')->nullable();
            $table->string('mob_banking_name')->nullable();
            $table->string('mob_account_holder')->nullable();
            $table->string('sending_mob_no')->nullable();
            $table->string('receiving_mob_no')->nullable();
            $table->string('mob_tx_id')->nullable();
            $table->date('mob_payment_date')->nullable();

            $table->string('bank_name')->nullable();
            $table->string('account_holder')->nullable();
            $table->string('account_no')->nullable();
            $table->string('check_no')->nullable();
            $table->date('check_active_date')->nullable();

            $table->string('additional_note')->nullable();
            $table->string('stuff_note')->nullable();
            $table->double('tax')->nullable();
            $table->double('tax_amt')->nullable();

            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('transactions')->onDelete('cascade');

            $table->unsignedBigInteger('expense_category_id')->nullable();
            $table->foreign('expense_category_id')->references('id')->on('expense_categories')->onDelete('set null');

            $table->unsignedBigInteger('expense_id')->nullable();
            $table->foreign('expense_id')->references('id')->on('expenses')->onDelete('cascade');

            $table->unsignedBigInteger('expense_for')->nullable();
            $table->foreign('expense_for')->references('id')->on('employees')->onDelete('set null');

            $table->string('document')->nullable();
            $table->string('is_suspend')->nullable();
            $table->integer('created_by')->nullable();

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
        Schema::dropIfExists('transactions');
    }
}
