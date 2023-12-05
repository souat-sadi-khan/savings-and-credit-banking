<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoubleBenifitAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('double_benifit_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid')->nullable();
            $table->string('prefix')->nullable();
            $table->integer('code')->nullable();
            $table->unsignedBigInteger('member_id')->nullable();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');

            $table->integer('round')->nullable();
            $table->double('double_benifit_amt')->nullable();
            $table->string('double_benifit_type')->nullable();
            $table->double('interest_rate')->nullable();
            $table->double('double_benifit_duration')->nullable();
            $table->string('double_benifit_duration_type')->nullable();
            $table->double('total_interest_amt')->nullable();
            $table->double('grand_total_double_benifit')->nullable();
            $table->string('double_benifit_reason')->nullable();

            $table->string('nomenee_name1')->nullable();
            $table->string('nomenee_fathers_name1')->nullable();
            $table->string('nomenee_husbands_name1')->nullable();
            $table->string('nomenee_relation_with_member1')->nullable();
            $table->string('nomenee_age1')->nullable();
            $table->string('nomenee_part_asset1')->nullable();
            $table->string('nomenee_permanent_address1')->nullable();

            $table->string('nomenee_name2')->nullable();
            $table->string('nomenee_fathers_name2')->nullable();
            $table->string('nomenee_husbands_name2')->nullable();
            $table->string('nomenee_relation_with_member2')->nullable();
            $table->string('nomenee_age2')->nullable();
            $table->string('nomenee_part_asset2')->nullable();
            $table->string('nomenee_permanent_address2')->nullable();

            $table->string('nomenee_name3')->nullable();
            $table->string('nomenee_fathers_name3')->nullable();
            $table->string('nomenee_husbands_name3')->nullable();
            $table->string('nomenee_relation_with_member3')->nullable();
            $table->string('nomenee_age3')->nullable();
            $table->string('nomenee_part_asset3')->nullable();
            $table->string('nomenee_permanent_address3')->nullable();

            $table->unsignedBigInteger('identity_provider_id')->nullable();
            $table->foreign('identity_provider_id')->references('id')->on('members')->onDelete('cascade');

            $table->string('created_by')->nullable();
            $table->string('approved_by')->nullable();
            $table->string('status')->nullable();
            $table->string('approval')->default('Not Approved');
            $table->text('approval_comment')->nullable();
            $table->date('approval_date')->nullable();
            $table->string('transaction_id')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('completion_date')->nullable();
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
        Schema::dropIfExists('double_benifit_accounts');
    }
}
